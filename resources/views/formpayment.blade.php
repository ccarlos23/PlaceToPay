@extends('body')
@section('content')
<div class="row">
	<div class="col-12">
		<h2>Pago</h2>
		<h4>Producto Virtual 30.000,00 COP</h4>
	</div>
</div>
<div class="row">
	<form class="form col-12" role="form" action="{{url('resumen')}}" method="post">
		@csrf
		<div class="form-group">
			<label for="customer_name">Nombre</label>
			<input type="text" class="form-control" id="customer_name" name="customer_name" placeholder="Ingrese nombre">
			<p class="text-danger">{{ $errors->first('customer_name') }}</p>
		</div>
		<div class="form-group">

			<label for="customer_email">Email</label>
			<input type="email" class="form-control" id="customer_email" name="customer_email" aria-describedby="emailHelp" placeholder="Enter email">
			<p class="text-danger">{{ $errors->first('customer_email') }}</p>
			<small id="emailHelp" class="form-text text-muted">Ingrese email.</small>
		</div>
		<div class="form-group">
			<label for="customer_mobile">Movil</label>
			<input type="tel" class="form-control" id="customer_mobile" name="customer_mobile" placeholder="Ingrese telefono">
			<p class="text-danger">{{ $errors->first('customer_mobile') }}</p>  
		</div>
		
		<button type="submit" class="btn btn-xl btn-primary float-right">Pagar</button>
	</form>
</div>
@stop
