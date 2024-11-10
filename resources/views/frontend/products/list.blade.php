@extends('frontend/layouts/master')
@section('content')
<section>
		<div class="container">
			<div class="row">
                @include('frontend/layouts/menu-account')
                <div class="col-sm-9">
					<div class="table-responsive cart_info">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                {{session('success')}}
                            </div>
                        @endif
                        @if($errors->any())
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{$error}}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
                                    <td>Id</td>
									<td class="description">name</td>
									<td class="image">image</td>
									<td class="price">price</td>
									<td class="total">action</td>
								</tr>
							</thead>
							<tbody>
                                <?php 
                                    if (count($dataProduct) == 0) {
                                        echo 'Khong co san pham';
                                    } else {
                                        foreach ($dataProduct as $key=>$value) {
                                            $image = json_decode($value['image'], true);
                                ?>
                                        <tr>
                                            <td>{{$value->id}}</td>
                                            <td class="cart_description">
                                                <h4><a href="">{{$value->name}}</a></h4>
                                            </td>
                                            <td class="cart_product">
                                                <a href=""><img style="width: 100px;" src="{{asset("upload/product/{$value->id_user}/{$image[0]}")}}" alt="" ></a>
                                            </td>
                                            <td class="cart_price">
                                                <p>{{$value->price}}</p>
                                            </td>
                                            <td class="cart_total">
                                                <a href="{{url("users/product/edit/{$value->id}")}}" >edit</a>
                                                <a href="{{url("users/product/delete/{$value->id}")}}">delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                        }
                                    }
                                ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection