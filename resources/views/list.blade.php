@extends('body')
@section('content')
<div class="row">
	<div class="col-12">
		<h2>Ordendes Generadas</h2>
	</div>
</div>
<div class="row">
	<table class="table table-striped table-compact"><thead><th>Referencia</th><th>Nombre</th><th>Email</th><th>Movil</th><th>Request ID</th><th>URL</th><th>Estatus</th></thead><tbody>
		@foreach($items as $k=>$it)
		<tr>
			<td>
				<a href="{{url('status/'.$it->requestid)}}">
					{{$it->reference}}
				</a>
			</td>
			<td>
				{{$it->customer_name}}
			</td>
			<td>
				{{$it->customer_email}}
			</td>
			<td>
				{{$it->customer_mobile}}
			</td>
			<td>
				{{$it->requestid}}
			</td>
			<td>
				<a target="_blank" href="{{$it->url}}">{{$it->url}}</a>				
			</td>
			<td>
				{{$it->status}}
			</td>
		</tr>
		@endforeach:
	</tbody></table>
</div>
@stop
