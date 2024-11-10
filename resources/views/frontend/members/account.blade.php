@extends('frontend/layouts/master')
@section('content')
<section>
		<div class="container">
			<div class="row">
                @include('frontend/layouts/menu-account')
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Update user</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Update User</h2>
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
							<input type="text" placeholder="Name" value="<?php echo $user['name'] ?>" name="name"/>
							<input type="email" placeholder="Email Address" value="<?php echo $user['email'] ?>" readonly name="email"/>
							<input type="password" placeholder="Password" name="password"/>
							<input type="text" placeholder="Phone Number" value="<?php echo $user['phone'] ?>" name="phone"/>
							<input type="text" placeholder="Address" value="<?php echo $user['address'] ?>" name="address"/>
							<input type="file" name="avatar"/>
                            <select name="id_country">
                                <?php
                                    foreach ($dataCountry as $key=>$value) {
                                ?>
                                    <option value="{{$value->id}}" {{$value->id == $user['id_country'] ? 'selected' : ''}}>{{$value->name}}</option>
                                <?php
                                    }
                                ?>
                            </select>
							<button type="submit" class="btn btn-default">Update User</button>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection