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
                                <li><a href="i{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>
                                    الملف الشخصي
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>{{auth()->user()->name}}</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                    <div class="sidebar-area pa-50">
                        <figure><img style="width: 360px; height: 295px;" class="img-responsive"
                                     src="{{asset('/'.$user->image)}}" alt=""></figure>

                        <div class="like-box-area">
                            <ul>
                                <li><a href="{{url('personal/info/')}}"><i class="fa fa-user-circle-o faa flo-right"
                                                                           aria-hidden="true"></i> <span
                                                class="like-page">البيانات الشخصية</span></a></li>
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)                                    <li><a href="{{url('articles')}}"><i class="fa fa-book faa flo-right"
                                                                                                                                                                            aria-hidden="true"></i> <span
                                                class="like-page">المقالات</span></a>
                                </li>
                                @endif
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)

                                    <li><a href="{{url('teams_profile')}}"><i class="fa fa-users faa flo-right"
                                                                              aria-hidden="true"></i> <span
                                                    class="like-page">الفرق</span></a>
                                    </li>
                                @endif
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="{{url('media')}}"><i class="fa fa-picture-o faa flo-right"
                                                                      aria-hidden="true"></i> <span
                                                    class="like-page">الميديا</span></a></li>
                                @endif

                                @if(auth()->user()->roles_id == 3)
                                    <li><a href="{{url('messages')}}"><i class="fa fa-comments-o faa flo-right"
                                                                         aria-hidden="true"></i> <span
                                                    class="like-page">الرسائل</span></a>
                                    </li>
                                @endif
                                <li><a href="{{url('events_profile')}}"><i class="fa fa-calendar faa flo-right"
                                                                           aria-hidden="true"></i> <span
                                                class="like-page">الفعاليات</span></a>
                                </li>
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="{{url('groups')}}"><i class="fa fa-tags faa flo-right"
                                                                       aria-hidden="true"></i> <span
                                                    class="like-page">المجموعات</span></a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="account-page-area">
                        <div class="">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir">
                                    <div class="border">
                                        <h3 class="title-bg mb-45 mr-sp"> البيانات الشخصية </h3>
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                <h5>الاسم: <span class="spann">{{$user->name}}</span></h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <h5>البريد الإلكتروني: <span class="spann">{{$user->email}} </span></h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                <h5>اسم المستخدم: <span class="spann">{{$user->username}}</span></h5>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <h5>نوع العضوية : <span class="spann">{{$user->role->name}} </span></h5>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                <h5> الدولة: <span class="spann">{{$user->countries->name}} </span></h5>
                                            </div>
                                            @if($user->countries->type == 'gov')
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <h5> المحافظة : <span class="spann">{{$user->govarea->name}} </span></h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                    <h5> المدينة : <span class="spann">{{$user->city->name}} </span></h5>
                                                </div>
                                            @else
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                    <h5> المنطقة : <span class="spann">{{$user->govarea->name}} </span></h5>
                                                </div>
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                    <h5> المحافظة : <span class="spann">{{$user->city->name}} </span></h5>
                                                </div>
                                            @endif
                                        </div>

                                        @if($user->cv_link != null)
                                            <div class="row">
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 floatright">
                                                    <h5>السيرة الذاتية: <span class="spann"><a
                                                                    href="{{url('/'.$user->cv_link)}}">السيرة الذاتية</a></span>
                                                    </h5>
                                                </div>

                                            </div>
                                        @endif

                                        <div class="row">
                                            <div class="col-sm-2">
                                                <div class="form-group">
                                                    <button class="btn-send btnn" type="submit"
                                                            onclick="window.location.href = '{{url('/update/profile')}}';">
                                                        تحديث
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>

                </div>
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

@endsection