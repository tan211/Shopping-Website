@extends('frontend/layouts/master')
@section('content')
<section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Check out</li>
				</ol>
			</div><!--/breadcrums-->

			<div class="step-one">
				<h2 class="heading">Step1</h2>
			</div>
			<div class="checkout-options">
				<h3>New User</h3>
				<p>Checkout options</p>
				<ul class="nav">
					<li>
						<label><input type="checkbox"> Register Account</label>
					</li>
					<li>
						<label><input type="checkbox"> Guest Checkout</label>
					</li>
					<li>
						<a href=""><i class="fa fa-times"></i>Cancel</a>
					</li>
				</ul>
			</div><!--/checkout-options-->

			<div class="register-req">
				<p>Please use Register And Checkout to easily get access to your order history, or use Checkout as Guest</p>
			</div><!--/register-req-->
			<div class="review-payment">
				<h2>Review & Payment</h2>
			</div>

			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Item</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
						</tr>
					</thead>
					<tbody>
							<?php
								$total = 0;
								foreach ($data as $value) {
									$image = json_decode($value['image'], true);
									$cart = session()->get('Cart');
									$qty = 0;
									foreach ($cart as $value1) {
										if ($value1['product_id'] == $value['id']) {
											$qty = $value1['qty']; 
											$total += $value1['qty']*$value['price'];
											$sum = $value1['qty']*$value['price'];
											break;
										}
									}
							?>
							<tr>
								<td class="cart_product">
									<a href=""><img src="images/cart/one.png" alt=""></a>
								</td>
								<td class="cart_description">
									<h4><a href="">{{$value['name']}}</a></h4>
									<p>Web ID: {{$value['id']}}</p>
								</td>
								<td class="cart_price">
									<p>${{$value['price']}}</p>
								</td>
								<td class="cart_quantity">
									<p>{{$qty}}</p>
								</td>
								<td class="cart_total">
									<p class="cart_total_price">${{$sum}}</p>
								</td>
							</tr>
						<?php
							}
						?>
						<tr>
							<td colspan="4">&nbsp;</td>
							<td colspan="2">
								<table class="table table-condensed total-result">
									<tr>
										<td>Cart Sub Total</td>
										<td>${{$total}}</td>
									</tr>
									<tr>
										<td>Exo Tax</td>
										<td>${{$total*5/100}}</td>
									</tr>
									<tr class="shipping-cost">
										<td>Shipping Cost</td>
										<td>Free</td>										
									</tr>
									<tr>
										<td>Total</td>
										<td><span>${{$total + $total*5/100}}</span></td>
									</tr>
									<tr>
										<td class="order">
											@if (!Auth::check())
												<a class="btn btn-primary" href="{{ url('users/register') }}">Order</a>
											@else
												<a class="btn btn-primary" href="{{url('test')}}">Order</a>
											@endif
										</td>
									</tr>
								</table>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			<!-- <div class="payment-options">
					<span>
						<label><input type="checkbox"> Direct Bank Transfer</label>
					</span>
					<span>
						<label><input type="checkbox"> Check Payment</label>
					</span>
					<span>
						<label><input type="checkbox"> Paypal</label>
					</span>
			</div> -->
		</div>
	</section> <!--/#cart_items-->

@endsection
@section('js')
	<script>
		$(document).ready(function() {

			$.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
			$('.order').click(function(){
				var checkLogin = "{{Auth::Check()}}";
				if (!checkLogin) {
					
				}
			})
		})
	</script>
@endsection