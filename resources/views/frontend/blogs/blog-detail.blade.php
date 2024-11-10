@extends('frontend/layouts/master')
@section('content')
<section>
    <div class="container">
        <div class="row">
            @include('frontend.layouts.left-sidebar')
            <div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
                            <div class="single-blog-post">
                                <h3>{{ $posts->title }}</h3>
                                <div class="post-meta">
                                    <ul>
                                        <li><i class="fa fa-user"></i> Mac Doe</li>
                                        <li><i class="fa fa-clock-o"></i>{{ $posts->created_at->format('H:i') }}</li>
                                        <li><i class="fa fa-calendar"></i>{{ $posts->created_at->format('d-m-Y') }}</li>
                                    </ul>
                                    <!-- <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                    </span> -->
                                </div>
                                {!! $posts->content !!}
                                <div class="pager-area">
                                    <ul class="pager pull-right">
                                        <!-- Pre -->
                                        <?php
                                            if ($idPre == 0) {
                                        ?>
                                        <li  style="display: none;"><a href="{{ url('blog/detail/'.$idPre) }}">Pre</a></li>
                                        <?php
                                            } else {
                                        ?>
                                        <li><a href="{{ url('blog/detail/'.$idPre) }}">Pre</a></li>
                                        <?php
                                            }
                                        ?>
                                        <!-- Next -->
                                        <?php
                                            if ($idNext == 0) {
                                        ?>
                                        <li style="display: none;"><a href="{{ url('blog/detail/'.$idNext) }}">Next</a></li>
                                        <?php
                                            } else {
                                        ?>
                                        <li><a href="{{ url('blog/detail/'.$idNext) }}">Next</a></li>
                                        <?php
                                            }
                                        ?>
                                    </ul>
                                </div>
                            </div>
					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
                                <div class="rate">
                                    <div class="vote">
                                    <?php
                                        for ($i = 1; $i <= 5; $i++) {
                                            $class = ($i <= $avg) ? 'ratings_over' : '';
                                            echo '
                                            <div class="star_' . $i . ' ratings_stars ' . $class . '">
                                                <input value="' . $i . '" type="hidden">
                                            </div>
                                            ';
                                        }
                                    ?>
                                        <span class="rate-np">{{$votes}}</span>
                                    </div> 
                                </div>
							</li>
							<li class="color">(6 votes)</li>
						</ul>
						<ul class="tag">
							<li>TAG:</li>
							<li><a class="color" href="">Pink <span>/</span></a></li>
							<li><a class="color" href="">T-Shirt <span>/</span></a></li>
							<li><a class="color" href="">Girls</a></li>
						</ul>
					</div>


					<div class="socials-share">
						<a href=""><img src="images/blog/socials.png" alt=""></a>
					</div><!--/socials-share-->

					<!-- <div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="images/blog/man-one.jpg" alt="">
						</a>
						<div class="media-body">
							<h4 class="media-heading">Annie Davis</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
							<div class="blog-socials">
								<ul>
									<li><a href=""><i class="fa fa-facebook"></i></a></li>
									<li><a href=""><i class="fa fa-twitter"></i></a></li>
									<li><a href=""><i class="fa fa-dribbble"></i></a></li>
									<li><a href=""><i class="fa fa-google-plus"></i></a></li>
								</ul>
								<a class="btn btn-primary" href="">Other Posts</a>
							</div>
						</div>
					</div> --><!--Comments-->
					<div class="response-area">
						<h2>3 RESPONSES</h2>
						<ul class="media-list">
							<?php
								foreach ($cmt as $key=>$value) {
									if ($value->level == 0) {
							?>
										<li class="media" data-id="{{$value->id}}">
											<a class="pull-left" href="#">
												<img class="media-object" src="{{ asset('upload/user/avatar/'.$value->avatar) }}" alt="" style="width: 50px;">
											</a>
											<div class="media-body">
												<ul class="sinlge-post-meta">
													<li><i class="fa fa-user"></i>{{ $value->name }}</li>
													<li><i class="fa fa-clock-o"></i>{{ $value->created_at->format('H:i') }}</li>
													<li><i class="fa fa-calendar"></i>{{ $value->created_at->format('d-m-Y') }}</li>
												</ul>
												<p>{{ $value->cmt }}</p>
												<button class="btn btn-primary"><i class="fa fa-reply"></i>Reply</button>
											</div>
											<div class="replay-box" style="display: none;">
												<div class="row">
													<div class="col-sm-12">
														<h2>Leave a replay</h2>
														<form class="commentForm">
															<div class="text-area">
																<div class="blank-arrow">
																	<label>Your Name</label>
																</div>
																<span>*</span>
																<textarea name="message" rows="11" required></textarea>
																<input type="hidden" name="level" value="{{$value->id}}"></input>
																<button class="btn btn-primary postCommentBtn">Post Comment</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</li>
										<?php
										foreach ($cmt as $key1=>$value1) {
											if ($value1->level == $value->id) {
										?>
										<li class="media second-media" data-id="{{$value1->level}}">
											<a class="pull-left" href="#">
												<img class="media-object" src="{{ asset('upload/user/avatar/'.$value1->avatar) }}" alt="" style="width: 50px;">
											</a>
											<div class="media-body">
												<ul class="sinlge-post-meta">
													<li><i class="fa fa-user"></i>{{ $value1->name }}</li>
													<li><i class="fa fa-clock-o"></i>{{ $value1->created_at->format('H:i') }}</li>
													<li><i class="fa fa-calendar"></i>{{ $value1->created_at->format('d-m-Y') }}</li>
												</ul>
												<p>{{ $value1->cmt }}</p>
												<button class="btn btn-primary"><i class="fa fa-reply"></i>Reply</button>
											</div>
											<div class="replay-box" style="display: none;">
												<div class="row">
													<div class="col-sm-12">
														<h2>Leave a replay</h2>
														<form class="commentForm">
															<div class="text-area">
																<div class="blank-arrow">
																	<label>Your Name</label>
																</div>
																<span>*</span>
																<textarea name="message" rows="11" required></textarea>
																<input type="hidden" name="level" value="{{$value1->id}}"></input>
																<button class="btn btn-primary postCommentBtn">Post Comment</button>
															</div>
														</form>
													</div>
												</div>
											</div>
										</li>
								<?php
											}
										}
									}
								}
								?>
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-sm-12">
								<h2>Leave a replay</h2>
								<form class="commentForm">
									<div class="text-area">
										<div class="blank-arrow">
											<label>Your Name</label>
										</div>
										<span>*</span>
										<textarea name="message" rows="11" required></textarea>
										<input type="hidden" name="level" value="0"></input>
										<button class="btn btn-primary postCommentBtn">Post Comment</button>
									</div>
								</form>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
        </div>
    </div>
</section>
	
@endsection
@section('js')
<script>
    	
    	$(document).ready(function(){
			//vote
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
                var checkLogin = "{{Auth::Check()}}";
                var userId = "{{ Auth::user() ? Auth::user()->id : '' }}";
                if (checkLogin) {
                    var rate =  $(this).find("input").val();
                    if ($(this).hasClass('ratings_over')) {
                        $('.ratings_stars').removeClass('ratings_over');
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    } else {
                        $(this).prevAll().andSelf().addClass('ratings_over');
                    }
                $.ajax({
                    type:'POST',
                    url:'{{url("blog/rate")}}',
                    data:{
                        rate: rate,
                        id_blog: "{{ $posts->id }}",
                        id_user: userId,
                    },
                    success:function(average){
                        $('.ratings_stars').removeClass('ratings_over');
                            // for (var i = 1; i <= 5; i++) {
                            //     if (i <= average) {
                            //         $('.ratings_stars').addClass('ratings_over');
                            //     }
                            // }
                    }
                })
                } else {
                    alert ('Chua Login')
                }
		    });

			var baseUrl = "{{ asset('upload/user/avatar/') }}";
			$('.postCommentBtn').click(function(e){
				e.preventDefault();
				var checkLogin = "{{Auth::Check()}}";
                var userId = "{{ Auth::user() ? Auth::user()->id : '' }}";
                var name = "{{ Auth::user() ? Auth::user()->name : '' }}";
                var avatar = "{{ Auth::user() ? Auth::user()->avatar : '' }}";
				if (checkLogin) {
                    var cmt =  $(this).closest(".text-area").find('textarea').val();
					var level = $(this).closest(".text-area").find('input').val();
					console.log(cmt);
					$.ajax({
                    type:'POST',
                    url:'{{url("blog/cmt")}}',
                    data:{
                        cmt: cmt,
                        id_blog: "{{ $posts->id }}",
                        id_user: userId,
						name : name,
						avatar : avatar,
						level : level,
                    },
                    success:function(data){
						console.log(data);
						console.log(data['data'].level)
						if (data['data'].level == 0) {
							$('div.response-area ul.media-list').append(
							'<li class="media" data-id="' + data['data'].id + '">' +
								'<a class="pull-left" href="#">' +
									'<img class="media-object" src="' + baseUrl + '/' + data['data'].avatar + '" alt="" style="width: 50px;">' +
								'</a>' +
								'<div class="media-body">' +
									'<ul class="sinlge-post-meta">' +
										'<li><i class="fa fa-user"></i>' + data['data'].name + '</li>' +
										// '<li><i class="fa fa-clock-o"></i>' + moment(data['data'].created_at).format("H:mm") + '</li>' +
										// '<li><i class="fa fa-calendar"></i>' + moment(data['data'].created_at).format("DD-MM-YYYY") + '</li>' +
									'</ul>' +
									'<p>' + data['data'].cmt + '</p>' +
									'<button class="btn btn-primary"><i class="fa fa-reply"></i>Reply</button>' +
								'</div>' +
								'<div class="replay-box" style="display: none;">' +
									'<div class="row">' +
										'<div class="col-sm-12">' +
											'<h2>Leave a replay</h2>' +
											'<form class="commentForm">' +
												'<div class="text-area">' +
													'<div class="blank-arrow">' +
														'<label>Your Name</label>' +
													'</div>' +
													'<span>*</span>' +
													'<textarea name="message" rows="11" required></textarea>' +
													'<input type="hidden" name="level" value="' + data['data'].id + '">' +
													'<button class="btn btn-primary postCommentBtn" type="submit">Post Comment</button>' +
												'</div>' +
											'</form>' +
										'</div>' +
									'</div>' +
								'</div>' +
							'</li>'
							);
						} else {
							$('li.media[data-id="' + data['data'].level + '"]').find('div.replay-box').css("display", "none");
							$('li.media[data-id="' + data['data'].level + '"]').after(
							'<li class="media second-media">' +
								'<a class="pull-left" href="#">' +
									'<img class="media-object" src="' + baseUrl + '/' + data['data'].avatar + '" alt="" style="width: 50px;">' +
								'</a>' +
								'<div class="media-body">' +
									'<ul class="sinlge-post-meta">' +
										'<li><i class="fa fa-user"></i>' + data['data'].name + '</li>' +
										// '<li><i class="fa fa-clock-o"></i>' + moment(data['data'].created_at).format("H:mm") + '</li>' +
										// '<li><i class="fa fa-calendar"></i>' + moment(data['data'].created_at).format("DD-MM-YYYY") + '</li>' +
									'</ul>' +
									'<p>' + data['data'].cmt + '</p>' +
									'<button class="btn btn-primary"><i class="fa fa-reply"></i>Reply</button>' +
								'</div>' +
								'<div class="replay-box" style="display: none;">' +
									'<div class="row">' +
										'<div class="col-sm-12">' +
											'<h2>Leave a replay</h2>' +
											'<form class="commentForm">' +
												'<div class="text-area">' +
													'<div class="blank-arrow">' +
														'<label>Your Name</label>' +
													'</div>' +
													'<span>*</span>' +
													'<textarea name="message" rows="11" required></textarea>' +
													'<input type="hidden" name="level" value="' + data['data'].id + '">' +
													'<button class="btn btn-primary postCommentBtn" type="submit">Post Comment</button>' +
												'</div>' +
											'</form>' +
										'</div>' +
									'</div>' +
								'</div>' +
							'</li>'
							);
						}
					}
                })
				} else {
					alert ('Chua login');
				}
			});
			$('div.media-body button').click(function(){
				$(this).closest('li.media').find('div.replay-box').removeAttr("style")
			});

		});
    </script>
    @endsection