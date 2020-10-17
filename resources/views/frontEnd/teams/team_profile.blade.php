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
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                    <div class="sidebar-area pa-50">
                        <figure><img style="width: 360px;height: 295px" class="img-responsive"
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
                                    <li><a href="groups"><i class="fa fa-tags faa flo-right"
                                                            aria-hidden="true"></i> <span
                                                    class="like-page">المجموعات</span></a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="view-area mt-42">
                            <div class="col-sm-12 text-right">
                                <h3 class="title-bg "> فرق المشاركة </h3>
                            </div>
                        </div>
                        <!-- teams Start Here -->
                        <div class="blog-page-area">
                            <div class="">
                                <div class="row mt-20">
                                    @if(count($teams)>0)
                                    @foreach($teams as $team)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 flo-right">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div>
                                                            <img src="{{asset('/'.$team->slogan)}}"
                                                                 alt=" photo" class="te-im">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                                                        <h3 class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a
                                                                    href="{{url('teams/'.$team->id)}}">{{$team->name}}</a>
                                                        </h3>
                                                        <p>{{$team->description}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                        @else
                                        <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right:28px">
                                            <span style="vertical-align: middle;padding: 20px;"> لم يتم انضمامك الى اى فريق بعد  </span>
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="pagination-area">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <div style="text-align: center">
                                                        {{ $teams->links('pagination.customPagination') }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <div class="view-area mt-42">
                            <div class="col-sm-12 text-right">
                                <h3 class="title-bg "> فرق الادمن </h3>
                            </div>
                        </div>
                        <!-- teams Start Here -->
                        <div class="blog-page-area">
                            <div class="">
                                <div class="row mt-20">
                                    @if(count($admin_teams)>0)
                                    @foreach($admin_teams as $team)
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 flo-right">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div>
                                                            <img src="{{asset('/'.$team->slogan)}}"
                                                                 alt=" photo" class="te-im">
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                                                        <h3 class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><a
                                                                    href="{{url('teams/'.$team->id)}}">{{$team->name}}</a>
                                                        </h3>
                                                        <p>{{$team->description}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endforeach
                                        @else
                                        <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right:28px">
                                            <span style="vertical-align: middle;padding: 20px;"> انت غير ادمن لأى فريق </span>
                                        </div>
                                    @endif
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div class="pagination-area">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <div style="text-align: center">
                                                        {{ $teams->links('pagination.customPagination') }}
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

@endsection