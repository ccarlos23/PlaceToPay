<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Dnetix\Redirection\PlacetoPay;
use Carbon\Carbon;
use App\Order;
class PlacetoPlayController extends Controller
{
    //

	private $Login='6dd490faf9cb87a9862245da41170ff2';
	private $TranKey='024h1IlD';
	private $Url='https://dev.placetopay.com/redirection/';

	private $validator = [
		'customer_email'			=> 'required|email',
		'customer_name'				=> 'required',
		'customer_mobile'			=> 'required'
	];
	private $messages= [
		'customer_email.required'=>'EMAIL Obligatorio',
		'customer_name.required'=>'Nombre Obligatorio',
		'customer_mobile.required'=>'Movil Obligatorio'          
	];

	public function resumen(Request $request){
		$this->validate($request, $this->validator,$this->messages);


		return view('resumenpayment', compact('request'));		

	}
	public function getstatus($requesID){
		if(empty($requesID)){
			return redirect()->back()->withInput();
		}
		$order=Order::where('requestid',$requesID)->first();

		$placetopay = new PlacetoPay([
			'login' => $this->Login,'tranKey' => $this->TranKey,'url' => $this->Url]);
		$response = $placetopay->query($requesID);

		$est="";
		if ($response->isSuccessful()) {
			if ($response->status()->isApproved()) {
			// The payment has been approved
				$est="PAYED";
			}else{
			//dd($response->status()->status());
				if($response->status()->status()=='PENDING')$est='PENDING';
				else $est='REJECTED';	
			}
			
			
			$request=Order::where('id',$order->id)->where('requestid',$requesID)->update(['status' => $est]);
			$request=$order;

			return view('resumenpayment', compact('request'));

		} else {
		    // There was some error with the connection so check the message
			return redirect()->back()->withInput();
		}
	}
	public function payment(Request $request){
		$placetopay = new PlacetoPay([
			'login' => $this->Login,'tranKey' => $this->TranKey,'url' => $this->Url]);
		$date=carbon::now();

		$reference =  str_random(5);
		$send = [
			'payment' => [
				'reference' => $reference,
				'description' => 'Pago producto virtual '.$reference,
				'amount' => [
					'currency' => 'COP',
					'total' => 30000,
				],
			],
			'expiration' => $date->add('1 days'),
			'returnUrl' => url('check').'/reference=' . $reference,
			'ipAddress' => '127.0.0.1',
			'userAgent' => 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/52.0.2743.116 Safari/537.36',
		];

		$response = $placetopay->request($send);
		if ($response->isSuccessful()) {
			
			$order=New Order();
			$order->customer_email=$request->customer_email;
			$order->customer_name=$request->customer_name;
			$order->customer_mobile=$request->customer_mobile;
			//$order->status =$response->status()->status();
			$order->status ='CREATED';
			$order->reference=$reference;
			$order->requestid=$response->requestId;
			$order->url=$response->processUrl();
			$order->save();
			$requestid=$response->requestId;
			$url=$response->processUrl();
		   	return view('endpayment', compact('requestid','url'));	
			//header('Location: ' . $response->processUrl());
		} else {
		    // There was some error so check the message and log it
			//$response->status()->message();
			return redirect()->back()->withInput();
		}

    	//dd($placetopay);
	}

    /**
	 * Metodo para obtener una lista de ordenes.
     * @return array
     */
    public function getList() {
    	try{
    		$items=Order::all();
    		return view('list', compact('items'));		
    	}catch(Exception $e){
    		return redirect()->back()->withInput();
    	}

    }
}
