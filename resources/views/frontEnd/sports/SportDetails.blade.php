@extends('frontEnd.master')

@section('css')
    <style>
        .player-im {

            height: 70px;
            width: 70px;
            border-radius: 50%;
            margin-left: 7px;
            margin-bottom: 25px;

        }

        a {
            transition: all 0.5s ease 0s;
            text-decoration: none;
        }

        .team-im {

            height: 70px;
            width: 70px;
            margin-left: 7px;
            margin-bottom: 25px;
        }

        .mt-25 {

            margin-top: 25px !important;

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
                                <li><a href="index.html">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>
                                    تفاصيل الرياضة
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> تفاصيل الرياضة</h1>
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
                        <img src="{{asset('/'.$sport->image)}}" class="flo-right player-im">
                        <h2 class="title2 text-right mt-25">{{$sport->name}} </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <p>{{$sport->description}}</p>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p><img src="{{asset('/'.$sport->image)}}" alt="" class="new-hei"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--    about sports end-->
    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <div class="row">
                <div class="view-area">
                    @if($sport->type == 'فرديه' && count($users)>0)
                        <div class="col-sm-6 text-right flo-right">
                            <h3 class="title-bg "> الأعضاء </h3>
                        </div>
                    @endif
                    @if($sport->type == 'جماعيه' && count($teams)>0)
                        <div class="col-sm-6 text-right flo-right ">
                            <h3 class="title-bg "> الفرق </h3>
                        </div>
                    @endif
                </div>
            @if($sport->type == 'فرديه')
                <!-- players start-->
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                        @foreach($users as $user)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                                <img src="{{asset('/'.$user->image)}}" class="flo-right player-im">
                                <h4 class="text-right mt-25"><a
                                            href="{{url('profile/preview/'.$user->id)}}">{{$user->name}} </a>
                                </h4>
                            </div>
                        @endforeach
                    </div>
                    <!-- players end-->
            @endif
            @if($sport->type == 'جماعيه')
                <!-- teams start-->
                    <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right ">
                        @foreach($teams as $team)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                                <img src="{{asset('/'.$team->slogan)}}" class="flo-right team-im">
                                <h4 class="text-right mt-25"><a href="{{url('teams/'.$team->id)}}">{{$team->name}} </a>
                                </h4>
                            </div>
                        @endforeach
                    </div>
                    <!--  teams end-->
                @endif

            </div>
        </div>
    </div>
    <!--players ends-->

    @if($sport->type=='فرديه')
        <!-- Category Page Start Here -->
        <div class="blog-page-area gallery-page category-page">
            <div class="container">
                <div class="row">

                    @if(count($groups)>0)
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="view-area mt-42">
                                <div class="col-sm-12 text-right">
                                    <h3 class="title-bg "> المجموعات </h3>
                                </div>
                            </div>
                            <div class="blog-page-area">
                                <div class="">
                                    <div class="row mb-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @foreach($groups as $group)
                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                                    <ul class="border-clo">
                                                        <li>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                                <div class="blog-image">
                                                                    <img src="{{asset('/'.$group->image_url)}}"
                                                                         alt="Blog photo"
                                                                         srcset="images/blog/1.1.jpg 2x">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">

                                                                <h3>
                                                                    <a href="{{url('groups/'.$group->id)}}">{{$group->name}}</a>
                                                                </h3>
                                                                <span class="admin"><i class="fa fa-user-o flo-right" style="margin-top: 4px"
                                                                                       aria-hidden="true"></i> {{$group->added_by->name}}</span>
                                                                <span class="date"><i class="fa fa-users"
                                                                                      aria-hidden="true"></i> {{count($group->users)}} </span>

                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    @endif

@endsection

@section('scripts')

@endsection