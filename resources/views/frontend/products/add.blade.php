@extends('frontend/layouts/master')
@section('content')
<section>
		<div class="container">
			<div class="row">
                @include('frontend/layouts/menu-account')
                <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Add Product</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Add Product!</h2>
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
						<form method="POST" enctype="multipart/form-data">
                            @csrf
							<input type="text" placeholder="Name" name="name"/>
							<input type="text" placeholder="Price" name="price"/>
                            <select name="id_category" id="">
                                <?php
                                    foreach ($dataCategory as $key=>$value) {
                                ?>
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select name="id_brand" id="">
                                <?php
                                    foreach ($dataBrand as $key=>$value) {
                                ?>
                                    <option value="{{$value->id}}">{{$value->name}}</option>
                                <?php
                                    }
                                ?>
                            </select>
                            <select name="status" id="status">
                                <option value="0">Sale</option>
                                <option value="1">Normal</option>
                            </select>
                            <input type="text" id="sale" placeholder="%" name="sale">
                            <input type="text" placeholder="Company" name="company"/>
                            <input type="file" name="image[]" multiple>
                            <textarea name="detail" id="" rows="11"></textarea>
                            <button type="submit" class="btn btn-default">Add Product</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            toggleSaleField();

            $('#status').change(function() {
                toggleSaleField();
            });

            function toggleSaleField() {
                const statusValue = $('#status').val();
                if (statusValue == '1') {
                    $('#sale').hide();
                } else {
                    $('#sale').show();
                }
            }
        });
    </script>
@endsection