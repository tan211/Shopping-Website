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
							<input type="text" placeholder="Name" name="name" value="{{$dataProduct[0]['name']}}"/>
							<input type="text" placeholder="Price" name="price" value="{{$dataProduct[0]['price']}}"/>
                            <input type="hidden" name="id_user" value="{{$dataProduct[0]['id_user']}}">
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
                                <option value="0" {{ $dataProduct[0]['status'] == 0 ? 'selected' : '' }}>Sale</option>
                                <option value="1" {{ $dataProduct[0]['status'] == 1 ? 'selected' : '' }}>Normal</option>
                            </select>
                            <input type="text" id="sale" placeholder="%" name="sale" value="{{ $dataProduct[0]['status'] == 0 ? $dataProduct[0]['sale'] : '' }}" @if ($dataProduct[0]['status'] == 1) style="display:none;" @endif>
                            <input type="text" placeholder="Company" name="company" value="{{$dataProduct[0]['company']}}"/>
                            <input type="file" name="image[]" multiple id="uploadimg">
                            <?php
                                $image = json_decode($dataProduct[0]['image'], true);
                                foreach ($image as $key=>$value) {
                            ?>
                                    <div class="rmvimage" style="display: inline-block;">
                                        <img style="width: 50px; height:50px;" src="{{asset("upload/product/{$dataProduct[0]['id_user']}/{$value}")}}" alt="" >
                                        <input type="checkbox" name="removeimage[]" value="{{$value}}">
                                    </div>
                            <?php
                                }
                            ?>
                            <textarea name="detail" id="" rows="11">{{$dataProduct[0]['detail']}}</textarea>
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

        $('#uploadimg').change(function() {
            const files = $(this)[0].files;
            for (let i = 0; i < files.length; i++) {
                const fileURL = URL.createObjectURL(files[i]);
                $('#uploadimg').after(
                    `<div class="rmvimage" style="display: inline-block;">
                        <img style="width: 50px; height:50px;" src="${fileURL}" alt="">
                        <input type="checkbox" name="removeimage[]" value="${files[i].name}">
                    </div>`
                );
            }
        })
        });
    </script>
@endsection