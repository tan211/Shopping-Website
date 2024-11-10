@extends('frontend/layouts/master')
@section('content')
	<section>
		<div class="container">
			<div class="row">
                @include('frontend.layouts.left-sidebar')
				<div class="col-sm-9 padding-right">
					<div class="features_items">
						<h2 class="title text-center">Features Items</h2>
                        <div class="search_box" style="margin-bottom: 10px;">
							<form action="{{url('/search-advanced')}}" method="POST" style="display: flex; justify-content:space-between" >
                                @csrf
								<input type="text" placeholder="Search" name="search" style="margin-right: 3px"/>
                                <select name="price" style="margin-right: 3px;height:35px;">
                                    <option value="">Choose price</option>
                                    <option value="0-1000">< 1000</option>
                                    <option value="1000-2000">1000-2000</option>
                                </select>
                                <select name="id_category" id="" style="margin-right: 3px;height:35px;">
                                    <option value="">Choose category</option>
                                    <?php
                                        foreach ($dataCategory as $key=>$value) {
                                    ?>
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <select name="id_brand" id="" style="margin-right: 3px;height:35px;">
                                    <option value="">Choose brand</option>
                                    <?php
                                        foreach ($dataBrand as $key=>$value) {
                                    ?>
                                        <option value="{{$value->id}}">{{$value->name}}</option>
                                    <?php
                                        }
                                    ?>
                                </select>
                                <select name="status" style="margin-right: 3px;height:35px;">
                                    <option value="">Choose Status</option>
                                    <option value="1">Normal</option>
                                    <option value="0">Sale</option>
                                </select>
                                <button type="submit" class="btn btn-primary" style="margin-top: 0;">Search</button>
							</form>
						</div>
                        <div id="product_list">
                        <?php
							foreach ($dataProduct as $key=>$value) {
								$image = json_decode($value['image'], true);
						?>
						<div class="col-sm-4">
							<div class="product-image-wrapper">
								<div class="single-products">
										<div class="productinfo text-center">
											<img src="{{asset("upload/product/{$value['id_user']}/{$image[0]}")}}" alt="" />
											<h2>${{$value['price']}}</h2>
											<p>{{$value['name']}}</p>
											<button href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
										</div>
										<div class="product-overlay">
											<div class="overlay-content">
												<h2>${{$value['price']}}</h2>
												<p>{{$value['name']}}</p>
												<h1 style="display: none;">{{$value['id']}}</h1>
												<a href="" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
											</div>
										</div>
								</div>
								<div class="choose">
									<ul class="nav nav-pills nav-justified">
										<li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
										<li><a href="{{url("users/product/detail/{$value['id']}")}}"><i class="fa fa-plus-square"></i>Detail</a></li>
									</ul>
								</div>
							</div>
						</div>
						<?php
							}
						?>
                        </div>
					</div>
                    <ul class="pagination">
                        <li class="active"><a href="">1</a></li>
                        <li><a href="">2</a></li>
                        <li><a href="">3</a></li>
                        <li><a href="">&raquo;</a></li>
                    </ul>
				</div>
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

			$('.well').click(function(e){
				e.preventDefault();
				var data = $(this).find('input').val();
                $.ajax({
                    type:'POST',
                    url:'{{url("search-price")}}',
                    data:{
                        price: data
                    },
                    success:function(data){
						$('#product_list').empty();
                        let productHTML = '';
                        data.forEach(function(product){
                            var image = JSON.parse(product.image, true);
                            productHTML += `
                            <div class="col-sm-4">
                                <div class="product-image-wrapper">
                                    <div class="single-products">
                                        <div class="productinfo text-center">
                                            <img src="/upload/product/${product.id_user}/${image[0]}" alt="" />
                                            <h2>$${product.price}</h2>
                                            <p>${product.name}</p>
                                            <button class="btn btn-default add-to-cart">
                                                <i class="fa fa-shopping-cart"></i>Add to cart
                                            </button>
                                        </div>
                                        <div class="product-overlay">
                                            <div class="overlay-content">
                                                <h2>$${product.price}</h2>
                                                <p>${product.name}</p>
                                                <a href="#" class="btn btn-default add-to-cart">
                                                    <i class="fa fa-shopping-cart"></i>Add to cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="choose">
                                        <ul class="nav nav-pills nav-justified">
                                            <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                            <li><a href="/users/product/detail/${product.id}"><i class="fa fa-plus-square"></i>Detail</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `;
                        })
                        $('#product_list').html(productHTML);
                    }
                })
			})
		})
    </script>
@endsection