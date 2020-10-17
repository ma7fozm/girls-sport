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
                                    </a> المبارايات
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> المبارايات</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!-- Blog Page Start Here -->
    <div class="blog-page-area">
        <div class="container">

            <!-- individual sports places start-->
            @if(isset($indvMatchs))
                <div class="row">
                    <div class="view-area mt-20">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الألعاب الفردية </h3>
                        </div>
                    </div>

                    @foreach($indvMatchs as $match)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right dir">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="blog-image">
                                            <a href="{{url('matchs/show/details/'.$match->id)}}">
                                                <i class="fa fa-link" aria-hidden="true"></i>
                                                <img style="width: 247px; height: 179px;"
                                                     src="{{asset('storage/upload/matchImages/'.$match->image)}}"
                                                     alt="Blog photo"
                                                     srcset="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <span class="date"> <i class="fa fa-calendar-check-o" aria-hidden="true"> </i>{{$match->date}}</span>
                                        <h3><a href="{{url('matchs/show/details/'.$match->id)}}">{{$match->title}}</a>
                                        </h3>
                                        {{--<span class="admin"><a href="#"><i class="fa fa-user-o"--}}
                                        {{--aria-hidden="true"></i> Admin</a></span> <span--}}
                                        {{--class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>--}}
                                        <p>{{$match->description}}</p>
                                        <a href="{{url('matchs/show/details/'.$match->id)}}" class="more">المزيد <i
                                                    class="fa fa-angle-double-left"
                                                    aria-hidden="true"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    @endforeach

                </div>
            @endif
        <!--individual sports places end-->

            <!--team sports places start-->
            @if(isset($teamMatchs))

                <div class="row">
                    <div class="view-area mt-20">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الألعاب الجماعية </h3>
                        </div>
                    </div>

                    @foreach($teamMatchs as $match)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right dir">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="blog-image">
                                            <a href="{{url('matchs/show/details/'.$match->id)}}">
                                                <i class="fa fa-link" aria-hidden="true"></i>
                                                <img style="width: 247px; height: 179px;"
                                                     src="{{asset('storage/upload/matchImages/'.$match->image)}}"
                                                     alt="Blog photo"
                                                     srcset="">
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                        <span class="date"> <i class="fa fa-calendar-check-o" aria-hidden="true"> </i>{{$match->date}}</span>
                                        <h3><a href="{{url('matchs/show/details/'.$match->id)}}">{{$match->title}}</a>
                                        </h3>
                                        {{--<span class="admin"><a href="#"><i class="fa fa-user-o"--}}
                                        {{--aria-hidden="true"></i> Admin</a></span> <span--}}
                                        {{--class="like"><a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i>  12 </a></span>--}}
                                        <p>{{$match->description}}</p>
                                        <a href="{{url('matchs/show/details/'.$match->id)}}" class="more">المزيد <i
                                                    class="fa fa-angle-double-left"
                                                    aria-hidden="true"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>

                    @endforeach
                </div>
            @endif
        </div>

        <div style="text-align: center">

            {{ $all_matchs->links('pagination.customPagination') }}
        </div>
    </div>
    <!-- Blog Page End Here -->


@endsection

@section('scripts')

@endsection