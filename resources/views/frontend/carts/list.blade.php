@extends('frontend/layouts/master')
@section('content')
<section>
		<div class="container">
			<div class="row">
                
                <section id="cart_items">
                    <div class="container">
                        <div class="breadcrumbs">
                            <ol class="breadcrumb">
                            <li><a href="#">Home</a></li>
                            <li class="active">Shopping Cart</li>
                            </ol>
                        </div>
                        <div class="table-responsive cart_info">
                            <table class="table table-condensed">
                                <thead>
                                    <tr class="cart_menu">
                                        <td class="image">Item</td>
                                        <td class="description"></td>
                                        <td class="price">Price</td>
                                        <td class="quantity">Quantity</td>
                                        <td class="total">Total</td>
                                        <td></td>
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
                                                    break;
                                                }
                                            }
                                    ?>
                                        <tr>
                                            <td class="cart_product">
                                                <a href=""><img style="width: 100px;" src="{{asset("upload/product/{$value['id_user']}/{$image[0]}")}}" alt="" ></a>
                                            </td>
                                            <td class="cart_description">
                                                <h4><a href="">{{$value['name']}}</a></h4>
                                                <p>Web ID: {{$value['id']}}</p>
                                            </td>
                                            <td class="cart_price">
                                                <p>${{$value['price']}}</p>
                                            </td>
                                            <td class="cart_quantity">
                                                <div class="cart_quantity_button">
                                                    <a class="cart_quantity_up"> + </a>
                                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$qty}}" autocomplete="off" size="2">
                                                    <a class="cart_quantity_down"> - </a>
                                                </div>
                                            </td>
                                            <td class="cart_total">
                                                <p class="cart_total_price">${{$value['price']*$qty}}</p>
                                            </td>
                                            <td class="cart_delete">
                                                <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section> <!--/#cart_items-->

                <section id="do_action">
                    <div class="container">
                        <div class="heading">
                            <h3>What would you like to do next?</h3>
                            <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="chose_area">
                                    <ul class="user_option">
                                        <li>
                                            <input type="checkbox">
                                            <label>Use Coupon Code</label>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <label>Use Gift Voucher</label>
                                        </li>
                                        <li>
                                            <input type="checkbox">
                                            <label>Estimate Shipping & Taxes</label>
                                        </li>
                                    </ul>
                                    <ul class="user_info">
                                        <li class="single_field">
                                            <label>Country:</label>
                                            <select>
                                                <option>United States</option>
                                                <option>Bangladesh</option>
                                                <option>UK</option>
                                                <option>India</option>
                                                <option>Pakistan</option>
                                                <option>Ucrane</option>
                                                <option>Canada</option>
                                                <option>Dubai</option>
                                            </select>
                                            
                                        </li>
                                        <li class="single_field">
                                            <label>Region / State:</label>
                                            <select>
                                                <option>Select</option>
                                                <option>Dhaka</option>
                                                <option>London</option>
                                                <option>Dillih</option>
                                                <option>Lahore</option>
                                                <option>Alaska</option>
                                                <option>Canada</option>
                                                <option>Dubai</option>
                                            </select>
                                        
                                        </li>
                                        <li class="single_field zip-field">
                                            <label>Zip Code:</label>
                                            <input type="text">
                                        </li>
                                    </ul>
                                    <a class="btn btn-default update" href="">Get Quotes</a>
                                    <a class="btn btn-default check_out" href="">Continue</a>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="total_area">
                                    <ul>
                                        <li>Cart Sub Total <span>$59</span></li>
                                        <li>Eco Tax <span>$2</span></li>
                                        <li>Shipping Cost <span>Free</span></li>
                                        <li>Total <span>${{$total}}</span></li>
                                    </ul>
                                        <a class="btn btn-default update" href="">Update</a>
                                        <a class="btn btn-default check_out" href="{{url("users/checkout")}}">Check Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section><!--/#do_action-->
			</div>
		</div>
	</section>
@endsection
@section('js')
	<script>
		$(document).ready(function() {

			$.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var chucnang = 0;
			function cart_ajax(chucnang,parent){
				var getId = $(parent).closest("tr").find("td.cart_description p").text();
				getId = getId.replace("Web ID: ", "");
				console.log(getId);
				console.log(chucnang)
				$.ajax({
					url: '{{url("users/cart")}}',
					type: 'POST',
					// dataType: 'html',
					data: {
						id: getId,
						chucnang: chucnang,
					},
					success: function(response) {
						let a = JSON.parse(response)
						$('div.total_area ul li:nth-child(4) span').html('$' + a['sum']);
						$('div.shop-menu ul li:nth-child(4) a sup').html(a['sumQty']);
					}
				})
			}

			$('a.cart_quantity_up').click(function(){
				parent = $(this);
				var getQty = Number($(this).closest('div.cart_quantity_button').find('.cart_quantity_input').val());
				getQty += 1;
				$(this).closest("div.cart_quantity_button").find("input").val(getQty);
				var price = $(this).closest("tr").find("td.cart_price p").text();
				price = price.replace("$", "");
				price = Number(price);
				var total = price*getQty;
				$(this).closest("tr").find("td.cart_total p.cart_total_price").text('$' + total);
				chucnang = 1;
				cart_ajax(chucnang,parent)
			});
			$('a.cart_quantity_down').click(function(){
				parent = $(this);
				var getQty = Number($(this).closest('div.cart_quantity_button').find('.cart_quantity_input').val());
				if (getQty > 1) {
					getQty -= 1;
					$(this).closest("div.cart_quantity_button").find("input").val(getQty);
					var price = $(this).closest("tr").find("td.cart_price p").text();
					price = price.replace("$", "");
					price = Number(price);
					var total = price*getQty;
					$(this).closest("tr").find("td.cart_total p.cart_total_price").text('$' + total);
					chucnang = 2;
					cart_ajax(chucnang,parent)
				} else {
					alert("Khong duoc xoa san pham");
				}
			});
			$('a.cart_quantity_delete').click(function(){
				parent = $(this);
				var getDelete = $(this).closest("tr");
				$(getDelete).remove();
				chucnang = 3;
				cart_ajax(chucnang,parent)
			});
		})
	</script>
@endsection