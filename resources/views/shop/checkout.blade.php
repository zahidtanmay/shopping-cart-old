@extends('layouts.master')

@section('title')
Laravel Shopping Cart
@endsection

@section('styles')
<link rel="stylesheet" type="text/css" href="{{url('css/checkout.css')}}">
@endsection

@section('content')

@if(Session::has('error'))
<div class="row">
	<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
		<div class="alert alert-danger">
			{{Session::get('error')}}
		</div>
	</div>
</div>

@endif
<div class="row">
	<div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
		<h1>Checkout</h1>
		<form action="{{url('/checkout')}}" method="POST" id="checkout-form">
			<div class="row">
				<div class="col-xs-12">
					<div class="group">
						<label>
							<span>Name</span>
							<input name="cardholder-name" class="field" placeholder="Jane Doe" />
						</label>
						<label>
							<span>Phone</span>
							<input name="address" class="field" placeholder="(123) 456-7890" type="tel" />
						</label>
					</div>
					<div class="group">
						<label>
							<span>Card</span>
							<div id="card-element" class="field"></div>
						</label>
					</div>
					<button type="submit">Pay ${{$total}}</button>
				</div>
			</div>
			{!! csrf_field() !!}
		</form>
	</div>
</div>

@endsection

@section('scripts')
<script type="text/javascript" src="https://js.stripe.com/v3/"></script>
<script type="text/javascript"  src="{{url('js/checkout.js')}}"></script>
@endsection