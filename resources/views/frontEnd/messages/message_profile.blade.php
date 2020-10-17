@extends('frontEnd.master')

@section('css')
    <style>

        .radio-container {
            margin-bottom: 30px;
        }

        #inputState {
            height: 31px !important;
            padding: 1px 12px;
            border-radius: 6px !important;
            cursor: pointer;
        }

        .input_State {
            width: 30%;
            margin-top: 13px;
            margin-right: 20px;

        }

        video {
            width: 100% !important;
            height: auto !important;
        }

        .im {
            background: #f2f2f2;
            border: 1px solid #b9b3b3;
            border-radius: 0;
            height: 25px !important;
            margin-top: 27px !important;
            margin-bottom: 30px !important;
            width: 100%;
            right: -13px;
        }
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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a> الملف الشخصي
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>{{$user->name}}</h1>
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 flo-right">
                    <div class="sidebar-area pa-50">
                        <figure><img style="width: 360px;height: 295px" class="img-responsive"
                                     src="{{asset('/'.$user->image)}}" alt=""></figure>

                        <div class="like-box-area">
                            <ul>
                                <li><a href="{{url('personal/info/')}}"><i class="fa fa-user-circle-o faa flo-right"
                                                                           aria-hidden="true"></i> <span
                                                class="like-page">البيانات الشخصية</span></a></li>
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="{{url('articles')}}"><i class="fa fa-book faa flo-right"
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
                                    <li><a href="groups"><i class="fa fa-tags faa flo-right"
                                                            aria-hidden="true"></i> <span
                                                    class="like-page">المجموعات</span></a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                    <div class="view-area mt-42">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الرسائل </h3>
                        </div>
                    </div>
                    <div class="sidebar-page-container">
                        <div class="auto-container">
                            <div class="row clearfix">

                                <!--Content Side / Blog Single-->
                                <div class="content-side col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                    <!--notifis Area-->
                                    <div class="notifis-area">
                                        <div class="inner-box">
                                            <!--notifi Box-->

                                            @if(count($messages)>0)
                                                @foreach($messages as $message)
                                                    <div class="notifi-box">
                                                        <div class="notifi">
                                                            <div class="author-thumb"><img
                                                                        src="{{asset('/'.$message->user->image)}}"
                                                                        alt=""></div>
                                                            <div class="notifi-inner">
                                                                <div class="notifi-info clearfix">
                                                                    <strong>{{$message->title}}</strong></div>
                                                                <div class="text">{{$message->content}}</div>
                                                                <ul class="post-info">
                                                                    <li>{{\Arabicdatetime::date(strtotime(@$message->created_at) , 0 , 'j M Y'  ,'indian')}}</li>
                                                                </ul>
                                                            </div>
                                                        </div>

                                                        @foreach($message->replies as $reply)
                                                            <div class="notifi reply-notifi">
                                                                <div class="author-thumb"><img
                                                                            src="{{asset('/'.$reply->user->image)}}"
                                                                            alt=""></div>
                                                                <div class="notifi-inner">
                                                                    <div class="notifi-info clearfix">
                                                                        <strong>{{$reply->title}}</strong></div>
                                                                    <div class="text">{{$reply->content}}</div>
                                                                    <ul class="post-info">
                                                                        <li>{{\Arabicdatetime::date(strtotime(@$reply->created_at) , 0 , 'j M Y'  ,'indian')}}</li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        @endforeach

                                                    </div>
                                                @endforeach
                                                @else
                                                <div style="text-align: center;border: dashed;margin-bottom: 40px;">
                                                    <span style="vertical-align: middle;padding: 20px;"> لا توجد رسايل </span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row flo-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pagination-area">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div style="text-align: center">
                                        {{ $messages->links('pagination.customPagination') }}
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
    <script>
    </script>
@endsection