@extends('frontend/layouts/master')
@section('content')
<section>
    <div class="container">
        <div class="row">
            @include('frontend.layouts.left-sidebar')
            <div class="col-sm-9">
                <div class="blog-post-area">
                    <h2 class="title text-center">Latest From our Blog</h2>
                    <?php
                        foreach ($posts as $key=>$value) {
                    ?>
                        <div class="single-blog-post">
                            <h3><?php echo $value->title; ?></h3>
                            <div class="post-meta">
                                <ul>
                                    <li><i class="fa fa-user"></i> Mac Doe</li>
                                    <li><i class="fa fa-clock-o"></i>{{ $value->created_at->format('H:i') }}</li>
                                    <li><i class="fa fa-calendar"></i>{{ $value->created_at->format('d-m-Y') }}</li>
                                </ul>
                                <span>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                </span>
                            </div>
                            <a href="">
                                <img src="{{ asset('upload/blogs/image/'.$value->image) }}" alt="">
                            </a>
                            <p><?php echo $value->description; ?></p>
                            <a  class="btn btn-primary" href="{{ url('blog/detail/'.$value->id) }}">Read More</a>
                        </div>
                    <?php
                        }
                    ?>
                    <!-- <div class="single-blog-post">
                        <h3>Girls Pink T Shirt arrived in store</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>
                        <a href="">
                            <img src="images/blog/blog-two.jpg" alt="">
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <a  class="btn btn-primary" href="">Read More</a>
                    </div>
                    <div class="single-blog-post">
                        <h3>Girls Pink T Shirt arrived in store</h3>
                        <div class="post-meta">
                            <ul>
                                <li><i class="fa fa-user"></i> Mac Doe</li>
                                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
                                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
                            </ul>
                            <span>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                            </span>
                        </div>
                        <a href="">
                            <img src="images/blog/blog-three.jpg" alt="">
                        </a>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
                        <a  class="btn btn-primary" href="">Read More</a>
                    </div> -->
                    <div class="pagination-area">
                    {{$posts->links('pagination::bootstrap-4')}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
	
@endsection