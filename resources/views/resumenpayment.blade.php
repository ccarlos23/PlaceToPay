@extends('body')
@section('content')
<div class="row">
  <div class="col-12">
    @if(empty($request->status))
    <h2>Resumen de tu compra</h2>
    @else
    <h2>Compra {{$request->status}}</h2>
    @endif
  </div>
</div>
<div class="row">
  @if(empty($request->status)||$request->status=='REJECTED')
  <form class="form col-12" role="form" action="{{url('pay')}}" method="post">
    @else
    <form class="form col-12" role="form" action="{{url('/')}}" method="post">
      @endif
      @csrf
      <div class="form-group">
        <label for="customer_name">Producto:&nbsp;</label>Producto Virtual
        <input type="hidden" class="form-control" id="customer_name" value="{{$request->customer_name}}" name="customer_name" placeholder="Ingrese nombre">
      </div>
      <div class="form-group">
        <label for="customer_name">Monto:&nbsp;</label>30.000,00 COP
        <input type="hidden" class="form-control" id="customer_name" value="{{$request->customer_name}}" name="customer_name" placeholder="Ingrese nombre">
      </div>

      <div class="form-group">
        <label for="customer_name">Nombre:&nbsp;</label>{{$request->customer_name}}
        <input type="hidden" class="form-control" id="customer_name" value="{{$request->customer_name}}" name="customer_name" placeholder="Ingrese nombre">
      </div>
      <div class="form-group">

        <label for="customer_email">Email:&nbsp;</label>{{$request->customer_email}}
        <input type="hidden" class="form-control" id="customer_email" value="{{$request->customer_email}}"  name="customer_email" aria-describedby="emailHelp" placeholder="Enter email">
      </div>
      <div class="form-group">
        <label for="customer_mobile">Movil:&nbsp;</label>{{$request->customer_mobile}}
        <input type="hidden" class="form-control" id="customer_mobile" value="{{$request->customer_mobile}}" name="customer_mobile" placeholder="Ingrese telefono">
      </div>
      <div class="float-right">
        <a href="{{ redirect()->getUrlGenerator()->previous() }}" class="btn btn-danger">Atras</a>
        @if(empty($request->status)||$request->status=='REJECTED')
        <button type="submit" class="btn btn-primary">Pagar</button>
	@elseif($request->status=='CREATED' || $request->status=='PENDING')
	<a target="_blank" class="btn btn-primary"  href="{{$request->url}}">Pagar</a>
        @endif
      </div>
    </form>
  </div>
  @stop
