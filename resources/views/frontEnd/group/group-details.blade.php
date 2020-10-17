@extends('frontEnd.master')

@section('css')

    <link rel="stylesheet" href="{{url('/')}}/assets/swal2/sweetalert2.min.css" type="text/css"/>

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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a>
                                    تفاصيل المجموعة
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> تفاصيل المجموعة</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!--    about sports start-->
    <div class="home-about-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset('/'.$group->image_url)}}" class="flo-right player-im">
                        <h2 class="title2 text-right mt-25"> {{$group->name}} </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <p>{{$group->description}}</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p><img style="width: 540px; height: 300px;" src="{{asset('/'.$group->image_url)}}" alt=""
                                class="hei-3"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--    about sports end-->
    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">

        @if(count($users)>0)
            <!-- players start-->
                <div id="scroll_mem" class="row">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الأعضاء </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        @foreach($users as $user)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                                <img src="{{asset('/'.$user->image)}}"
                                     class="col-lg-4 col-md-4 col-sm-4 col-xs-4 flo-right player-im">
                                <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right mt-25 flo-right"><a
                                            href="{{url('profile/preview/'.$user->id)}}">{{$user->name}} </a></h4>
                                @if(Auth::user()->id == $group->admin_id)
                                    <a id="plus" class="confirmation_del"
                                       href="{{url('groups/delete/user/'.$group->id.'/'.$user->id)}}">
                                        <i class="fa fa-times ico-r col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-25"
                                           aria-hidden="true"></i></a>
                                @endif
                            </div>
                        @endforeach

                    </div>

                </div>
                <!--players ends-->
        @endif
        <!--team sport end-->
            <div class="container">
                <!-- latest news Start Here -->
                @if(count($articles))
                    <div class="row">
                        <div class="view-area">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <h3 class="title-bg flo-right">أخر المقالات </h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tab-home flo-right">
                            <!-- Featured News Start here-->

                            <div class="tab-content featured-all">
                                <div id="featured1" class="tab-pane fade in active">
                                    <div class="tab-bottom-content">

                                        @foreach($articles as $article)
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="news-box">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding flo-right">
                                                            <img style="width: 370px; height: 325px;" src="{{asset('/'.$article->image)}}" alt="">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding">
                                                            <div class="dsc pa-dec">
                                                                <br/>
                                                                <h4><a href="{{asset('article-details/'.$article->id)}}">{{$article->title}}</a></h4>
                                                                <span class="date"><i
                                                                            class="fa fa-calendar-check-o flo-right"
                                                                            aria-hidden="true"> </i>{{\Arabicdatetime::date(strtotime(@$article->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                                                <p>{{$article->intro}}</p>
                                                                <ul class="author-all">
                                                                    <li class="flo-right"><a href="{{url('profile/preview/'.$article->user->id)}}">
                                                                            {{$article->user->name}}</a></li>
                                                                    <li class="dir">
                                                                        <i class="fa fa-comment-o" aria-hidden="true"></i> {{count($article->comments)}}</a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                            </div>

                        </div>

                    </div>
                @endif
                  @if(count($videos)>0)
                        <div class="blog-page-area gallery-page category-page">

                            <div class="row">
                                <div class="view-area">
                                    <div class="col-sm-12 text-right">
                                        <h3 class="title-bg "> الفيديوهات </h3>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    @for($i=1 ; $i< count($videos);$i+=2)
                                        <div class="row dir">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div class="carousel-inner">
                                                            <div class="blog-image">
                                                                <iframe width="320" height="240" src="http://www.youtube.com/embed/{{$videos[$i]['media_link']}}" frameborder="0" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                        <h3><a href="{{url('video-details/'.$videos[$i]['id'])}}">{{$videos[$i]['title']}}</a></h3>
                                                        <span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime(@$videos[$i]['created_at']) , 0 , 'j M Y'  ,'indian')}}</span>
                                                        <span
                                                                class="like"><i class="fa fa-comment-o"
                                                                                aria-hidden="true"></i> {{count($videos[$i]->comments)}} </span>
                                                        <p>{{$videos[$i]['description']}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endfor

                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    @for($i=0 ; $i< count($videos);$i+=2)
                                        <div class="row dir">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div class="carousel-inner">
                                                            <div class="blog-image">
                                                                  <iframe width="320" height="240" src="http://www.youtube.com/embed/{{$videos[$i]['media_link']}}" frameborder="0" allowfullscreen></iframe>
                                                                                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                        <h3><a href="{{url('video-details/'.$videos[$i]['id'])}}">{{$videos[$i]['title']}}</a></h3>
                                                        <span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime(@$videos[$i]['created_at']) , 0 , 'j M Y'  ,'indian')}}</span>
                                                        <span
                                                                class="like"><i class="fa fa-comment-o"
                                                                                aria-hidden="true"></i> {{count($videos[$i]->comments)}} </span>
                                                        <p>{{$videos[$i]['description']}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endfor

                                </div>

                            </div>

                        </div>
                    @endif
            </div>

            <div style="text-align: center">
                @if($max_length == 'us')
                    {{ $users->links('pagination.customPagination') }}
                @elseif($max_length == 'vid')
                    {{ $videos->links('pagination.customPagination') }}
                @else
                    {{ $articles->links('pagination.customPagination') }}
                @endif

            </div>

        </div>
    </div>

@endsection

@section('scripts')

    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

    <script>

        $(document).ready(function () {
            if (window.location.hash != null && window.location.hash != '') {
                var type = window.location.hash.substr(1);
                var myTarget = document.querySelector('#' + type);
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop - 70, 10)}, 1000);
            }
        });

    </script>

    <script type="text/javascript">
        $('.confirmation_del').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد من الحذف؟',
                    text: '! هل تود حقا حذف هذا العضو نهائيا من المجموعة',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    cancelButtonText: 'لا !',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " جار حذف العضو من المجموعة !",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    swal({
                        title: " الغاء !",
                        text: "تم الغاء الحذف :)",
                        type: "error",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        location.reload();
                    });

                });

            }
        });
    </script>

@endsection