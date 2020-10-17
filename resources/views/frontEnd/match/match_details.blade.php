@extends('frontEnd.master')

@section('css')

@endsection

@section('content')

    <!-- Inner Page Header serction start here -->
    <div class="inner-page-header">
        <div class="banner">
            <img src="{{asset('design/frontEnd')}}/images/banner/3.jpg" alt="Banner">
        </div>
        <div class="banner-text">
            <div class="container">
                <div class="row dir">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a>
                                    التفاصيل
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>التفاصيل</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Blog Single Start Here -->
    <div class="single-blog-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 single-image ">
                        <img class="new-hei" src="{{asset('storage/upload/matchImages/'.$match->image)}}" alt="" >
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                        <h3>{{$match->title}}</h3>
                        <p>{{$match->description}}</p>
                    </div>
                    <blockquote>

                        <div class="row">
                            <div class="item col-lg-6 col-md-4 col-sm-4 col-xs-12 flo-right">
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                    <div class="inner">
                                        @if($match->match_type == 'team' )
                                            <img style="width: 142px; height: 142px;"
                                                 src="{{asset('storage/upload/teamSlogans/'.$match->teams->toArray()[0]['slogan'])}}">
                                            <div style="text-align: center;margin-top: 5px;">
                                                <h4> {{$match->teams->toArray()[0]['name']}} </h4></div>
                                            @elseif($match->match_type == 'single' )
                                            <img style="width: 142px; height: 142px;"
                                            src="{{asset('storage/upload/images/'.$match->users->toArray()[0]['image'])}}">
                                            <div style="text-align: center;margin-top: 5px;">
                                                <h4> {{$match->users->toArray()[0]['name']}} </h4></div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                    <div style="text-align: center">
                                        <span class="vs">Vs</span><br>
                                        <span class="radison">{{$match->date}}</span><br>
                                        <span class="radison">{{$match->place}}</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="inner">
                                        @if($match->match_type == 'team' )
                                            <img style="width: 142px; height: 142px;"
                                                 src="{{asset('storage/upload/teamSlogans/'.$match->teams->toArray()[1]['slogan'])}}">
                                            <div style="text-align: center;margin-top: 5px;">
                                                <h4> {{$match->teams->toArray()[1]['name']}} </h4></div>
                                        @elseif($match->match_type == 'single' )
                                            <img style="width: 142px; height: 142px;"
                                            src="{{asset('storage/upload/images/'.$match->users->toArray()[1]['image'])}}">
                                            <div style="text-align: center;margin-top: 5px;">
                                                <h4> {{$match->users->toArray()[1]['name']}} </h4></div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                    </blockquote>

                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 life-style flo-right">
                            <span class="admin"> <i class="fa fa-user-o" aria-hidden="true"></i> Admin <a
                                        href="#"> <i class="fa fa-comment-o" aria-hidden="true"></i> 12</a></span>
                                <span class="date">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> Sep 13, 2017 </span>
                            </div>

                        </div>
                    </div>

                    <div class="share-section share-section2">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                <span> يمكنك المشاركة عن طريق :  </span>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <ul class="share-link">
                                    <li class="hvr-bounce-to-right"><a href="#"> <i class="fa fa-facebook"
                                                                                    aria-hidden="true"></i> فيسبوك</a>
                                    </li>
                                    <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-twitter"
                                                                                   aria-hidden="true"></i> تويتر</a>
                                    </li>
                                    <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-google"
                                                                                   aria-hidden="true"></i> جوجل</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="fetuered-videos team-page-area dir-l">
                        <div class="container">
                            <div class="row">
                                <div class="view-area flo-right">
                                    <div class="col-sm-12">
                                        <h3 class="title-bg mr-10"> الرعاة </h3>
                                    </div>
                                </div>
                            </div>
                            <div id="author-slider-section" class="owl-carousel">
                                <div class="item">
                                    <div class="single-videos">
                                        <div class="single-member-area spc-o">
                                            <div class="cl-single-member">
                                                <figure><img class="img-responsive slider-img"
                                                             src="{{asset('design/frontEnd')}}/images/team/anthoni.jpg"
                                                             alt=""></figure>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-videos">
                                        <div class="single-member-area spc-o">
                                            <div class="cl-single-member">
                                                <figure><img class="img-responsive slider-img"
                                                             src="{{asset('design/frontEnd')}}/images/team/ridisha.jpg"
                                                             alt=""></figure>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-videos">
                                        <div class="single-member-area spc-o">
                                            <div class="cl-single-member">
                                                <figure><img class="img-responsive slider-img"
                                                             src="{{asset('design/frontEnd')}}/images/team/rashid.jpg"
                                                             alt=""></figure>

                                            </div>

                                        </div>
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="single-videos">
                                        <div class="single-member-area spc-o">
                                            <div class="cl-single-member">
                                                <figure><img class="img-responsive slider-img"
                                                             src="{{asset('design/frontEnd')}}/images/team/hussy.jpg"
                                                             alt=""></figure>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="item">
                                    <div class="single-videos">
                                        <div class="single-member-area spc-o">
                                            <div class="cl-single-member">
                                                <figure><img class="img-responsive slider-img"
                                                             src="{{asset('design/frontEnd')}}/images/team/raisha.jpg"
                                                             alt=""></figure>

                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="author-comment">
                        <h3 class="title-bg"> التعليقات</h3>
                        <ul>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                        <div class="image-comments"><img
                                                    src="{{asset('design/frontEnd')}}/images/single/3.jpg" alt=""></div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                                    <span class="reply"> <span class="date"><i class="fa fa-calendar-check-o"
                                                                               aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod
                                                tempor incidi dunt ut labore et dolore magna aliquat enim ad minim
                                                veniam ad
                                                minim veniam.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                        <div class="image-comments"><img
                                                    src="{{asset('design/frontEnd')}}/images/single/3.jpg" alt=""></div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                                    <span class="reply"> <span class="date"><i class="fa fa-calendar-check-o"
                                                                               aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod
                                                tempor.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="row">
                                    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                        <div class="image-comments"><img
                                                    src="{{asset('design/frontEnd')}}/images/single/3.jpg" alt=""></div>
                                    </div>
                                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                                    <span class="reply"><span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"></i> Sep 13, 2017</span></span>
                                        <div class="dsc-comments">
                                            <h4>Thesera Minton</h4>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do they
                                                eiusmod
                                                tempor incidi dunt ut labore et dolore magna aliquat enim ad minim
                                                veniam ad
                                                minim veniam.</p>
                                            <a href="#"> Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 flo-right leave-comments-area">
                        <h4 class="title-bg"> اترك تعليقك</h4>
                        <form>
                            <fieldset>
                                <div class="form-group">
                                    <label>الاسم</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>البريد الإلكتروني</label>
                                    <input type="email" class="form-control">
                                </div>


                                <div class="form-group">
                                    <label>اكتب تعليقك هنا </label>
                                    <textarea cols="40" rows="10" class="textarea form-control txtarea1-hi"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn-send" type="submit"> تأكيد</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Details Page end here -->

@endsection

@section('scripts')

@endsection