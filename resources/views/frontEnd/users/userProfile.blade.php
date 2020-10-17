@extends('frontEnd.master')

@section('css')
    <style>
    </style>

@endsection

@section('content')

    <!-- Inner Page Header serction start here -->
    <div class="inner-page-header">
        <div class="banner">
            <img src="{{asset('design/frontEnd')}}/images/banner/3.jpg" alt="Banner">
        </div>
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="index.html">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a> الملف الشخصي </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>دينا محمد </h1>
                        </div>
                        <div class="header-page-subtitle">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Single Author Page Start Here -->
    <div class="single-team-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 single-image flo-right ">
                    <figure><img class="img-responsive" src="{{asset('design/frontEnd')}}/images/single/toya.jpg" alt="Toya"></figure>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 single-bio dir">
                    <h2 class="member-name">دينا محمد</h2>
                    <h3 class="member-title">ادمن</h3>
                    <div class="member-desc">
                        <p>Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since thewhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>

                        <p>Simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since thewhen an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</p>
                    </div>
                    <div class="contact-info">
                        <ul>
                            <li><i class="fa fa-phone"></i><a href="tel: +61 3 8376 6284">+61 3 8376 6284</a></li>
                            <li><i class="fa fa-envelope-o"></i><a href="">info@email.com</a></li>
                            <li><i class="fa fa-share-alt" aria-hidden="true"></i><a href="#">facebook</a>,<a class="social_share" href="#">twitter</a>,<a class="social_share" href="#">linked</a></li>
                        </ul>
                    </div>
                </div>

                <div class="blog-page-area gallery-page category-page ">

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">

                        <div class="row pa-100">
                            <h3 class="member-name text-right">المقالات</h3>
                            <hr>
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right ">
                                        <div class="carousel-inner">
                                            <div class="blog-image">
                                                <a href="">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/4.jpg" alt="category photo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <h3><a href="">Pellentesque Odio Nisi Euismod In Pharet</a></h3>
                                        <span class="date "><i class="fa fa-calendar-check-o " aria-hidden="true"></i> Sep 13, 2017</span> <span class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes ...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="carousel-inner">
                                            <div class="blog-image">
                                                <a href="">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/3.jpg" alt="category photo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <h3><a href="">Pellentesque Odio Nisi Euismod In Pharet</a></h3>
                                        <span class="date "><i class="fa fa-calendar-check-o " aria-hidden="true"></i> Sep 13, 2017</span> <span class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes ...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="carousel-inner">
                                            <div class="blog-image">
                                                <a href="">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/4.jpg" alt="category photo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <h3><a href="">Pellentesque Odio Nisi Euismod In Pharet</a></h3>
                                        <span class="date "><i class="fa fa-calendar-check-o " aria-hidden="true"></i> Sep 13, 2017</span> <span class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes ...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="row">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="carousel-inner">
                                            <div class="blog-image">
                                                <a href="">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/3.jpg" alt="category photo">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                        <h3><a href="">Pellentesque Odio Nisi Euismod In Pharet</a></h3>
                                        <span class="date "><i class="fa fa-calendar-check-o " aria-hidden="true"></i> Sep 13, 2017</span> <span class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>
                                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes ...</p>
                                    </div>
                                </li>
                            </ul>
                        </div>

                        <div class="row flo-right">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="pagination-area">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">. . .</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><a href="#"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <!-- Footer Area Section Start Here -->

@endsection
@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}")
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}")
        @endif
    </script>
@endsection