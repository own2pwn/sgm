@extends('layouts.order')

@section('breadcrumb')
| Review
@endsection

@section('content')
@include('shared.message')
@include('shared.success')
@include('shared.error')
<div class="container">
	@if (Cart::count() > 0)
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-hover table-bordered">
						<thead>
							<tr class="active">
								<td>Product</td>
								<td class="text-center">Quantity</td>
								<td class="text-center">Price</td>
							</tr>
						</thead>
						<tbody>
							@foreach(Cart::content() as $row) 
								<tr>
									<td>
										<a href="{{ url('products/'.$row->id) }}">{{ $row->name }} - <small>{{ $row->options['color'] }}</small></a>
									</td>
									<td class="text-center">{{ $row->qty }}</td>
									<td class="text-center">RM{{ $row->total }}</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot>
					        <tr class="active">
					            <td>&nbsp</td>
					            <td class="text-center" style="vertical-align:middle;">Total</td>
					            <td class="text-center" style="vertical-align:middle;">RM{{ Cart::total() }}</td>
					        </tr>
					        @if($couponTotalValue > 0)
								<tr class="active">
									<td>&nbsp</td>
									<td class="text-center">Discount</td>
									<td class="text-center">-RM{{ $couponTotalValue }}</td>
								</tr>
							@endif
							<tr class="active">
					            <td>&nbsp</td>
					            <td class="text-center" style="vertical-align:middle;">Delivery</td>
					            <td class="text-center" style="vertical-align:middle;">RM{{ $deliveryCost }}</td>
					        </tr>
							<tr class="active">
					            <td>&nbsp</td>
					            <td class="text-center" style="vertical-align:middle;">Final Price</td>
					            <td class="text-center" style="vertical-align:middle;">RM{{ $finalPrice }}</td>
					        </tr>
						</tfoot>
					</table>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<table class="table table-bordered">
						<tr>
							<td class="active">Name</td>
							<td class="text-center">{{ $name }}</td>
						</tr>
						<tr>
							<td class="active">Email</td>
							<td class="text-center">{{ $email }}</td>
						</tr>
						<tr>
							<td class="active">Phone Number</td>
							<td class="text-center">{{ $phoneNumber }}</td>
						</tr>
						<tr>
							<td class="active">Address</td>
							<td class="text-center">{{ $address}}</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	@else
		<div class="row">
			<div class="col-md-12">
				<h2>Your cart is empty</h2> 
				<a class="btn btn-link" href="{{ url('products') }}">Continue to products</a>
				<br><br><br><br><hr>
			</div>
		</div>
	@endif
	<hr>
	<div class="row">
		<div class="col-md-12">
			@include('shared.form.back', ['link' => 'cart'])
			<form class="form-inline pull-right" action="https://www.mobile88.com/epayment/entry.asp" method="post">
				<input type="hidden" name="MerchantCode" value="{{ $merchantCode }}" />
				<input type="hidden" name="PaymentId" value="" />
				<input type="hidden" name="RefNo" value="{{ $refNo }}" />
				<input type="hidden" name="Amount" value="{{ $amount }}" />
				<input type="hidden" name="Currency" value="{{ $currency }}" />
				<input type="hidden" name="ProdDesc" value="Baby product" />
				<input type="hidden" name="UserName" value="{{ $name }}" />
				<input type="hidden" name="UserEmail" value="{{ $email }}" />
				<input type="hidden" name="UserContact" value="{{ $phoneNumber }}" />
				<input type="hidden" name="Remark" value="" />
				<input type="hidden" name="Lang" value="UTF-8" />
				<input type="hidden" name="Signature" value="{{ $signature }}" />
				<input type="hidden" name="ResponseURL" value="http://www.supremeglobal.com.my/payment/response" />
				<input type="hidden" name="BackendURL" value="http://www.supremeglobal.com.my/payment/responseBE" />
	            @include('shared.form.submit', ['text' => 'Proceed to payment'])
			</form>
		</div>
	</div>
</div>
@endsection