@extends('frontEnd.master')

@section('css')

    <style>
        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {

            z-index: 3;
            color: #f00;
            background-color: #337ab7;
            border-color: #337ab7;
            cursor: default;

        }

        .home-about-area {
            padding: 11px 0 24px;
        }
    </style>

@endsection

@section('search')
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="search">
            <div class="search-wrap">
                <div class="search-input-elm">
                    <input name="query" class="search-input" type="text" placeholder="ابحث هنا .."/>

                    <input type='hidden' name='models[]' value='App\News'>
                    <input type='hidden' name='col_name[]' value='title'>

                    {{--<input type='hidden' name='models[]' value='App\Media'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Match'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Event'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Place'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Team'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    <input type='hidden' name='models[]' value='App\Sport'>
                    <input type='hidden' name='col_name[]' value='name'>


                </div>
                <a href="#search" data-toggle="collapse" class="search-btn"><i class="fa fa-search"
                                                                               aria-hidden="true"></i></a>
            </div>
        </div>
    </form>
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
                                    رياضات وفرق
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> رياضات وفرق</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <div class="home-about-area">
    </div>

    <!--    about sports start-->
    <div class="home-about-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2 class="title2 text-right">الألعاب الفردية </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <p>الرياضة الفردية هي الرياضة التي يمكن لأي الفرد ممارستها وحده، وتشمل: السباحة، وألعاب القوى بجميع أنواعها، ورياضة المشي، وتنس الطاولة، ورياضة ركوب الخيل، وقفز الحواجز، وألعاب الدفاع عن النفس مثل: الملاكمة، والمبارزة، والكراتية.
                        </p>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p class="flo-right"><img src="{{asset('design/frontEnd')}}/images/about/1.jpg" alt="" class="hei-7"></p>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 ">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <h2 class="title2 text-right">الألعاب الجماعية </h2>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <p>الرياضة الجماعية هي الرياضة التي تتضمّن عدداً من اللاعبين يعملون معاً في فريق واحد في سبيل تحقيق فوز مشترك وتشمل : الهوكي، وكرة السلة، وكرة الطائرة والتنس، وكرة القدم، وكرة القدم الأمريكية، وكرة الماء، والكريكيت، والتجديف، وكرة اليد وغيرها .
                        </p>

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p class="flo-right"><img src="{{asset('design/frontEnd')}}/images/about/2.jpg" alt="" class="hei-7"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--    about sports end-->

    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <!--personal sports-->
            @if(count($indvSports)>0)
                <div class="row">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الألعاب الفردية </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row">
                            <div class="col-md-12 flo-right">
                                @foreach($indvSports as $sport)
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 flo-right">
                                        <ul>
                                            <li>
                                                <div class="blog-image">
                                                    <img
                                                            src="{{asset('/'.$sport->image)}}" alt="" class="hei-n">
                                                </div>

                                                <h3 class="text-center padd"><a
                                                            href="{{url('/sports/'.$sport->id)}}">{{$sport->name}} </a></h3>

                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    </div>

                </div>
            @endif
        <!--personal sports ends-->
            <!--team sport start-->
            @if(count($teamSports)>0)
                <div class="row">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الألعاب الجماعية </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        <div class="row">
                            <div class="col-md-12 flo-right">
                                @foreach($teamSports as $sport)
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 flo-right">
                                        <ul>
                                            <li>
                                                <div class="blog-image">

                                                    <img src="{{asset('/'.$sport->image)}}"
                                                         alt="" class="hei-n">
                                                </div>

                                                <h3 class="text-center padd"><a
                                                            href="{{url('/sports/'.$sport->id)}}">{{$sport->name}}</a></h3>

                                            </li>
                                        </ul>
                                    </div>

                                @endforeach
                            </div>

                        </div>

                    </div>

                </div>
            @endif


            <div class="container">
                <!-- latest news Start Here -->

                @if(count($news)>0)
                    <div class="row">
                        <div class="view-area">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <h3 class="title-bg flo-right">أخر الأخبار </h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tab-home flo-right">
                            <!-- Featured News Start here-->

                            <div class="tab-content featured-all">
                                <div id="featured1" class="tab-pane fade in active">
                                    <div class="tab-bottom-content">
                                        @foreach($news as $new)
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="news-box">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding flo-right">
                                                            <img style="width: 370px;height: 270px;"
                                                                 src="{{asset('/'.$new->image)}}" alt="">
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding">
                                                            <div class="dsc pa-dec">

                                                                <h4>
                                                                    <a href="{{url('news/'.$new->id)}}"> {{$new->title}} </a>
                                                                </h4>
                                                                <span class="date"><i
                                                                            class="fa fa-calendar-check-o flo-right"
                                                                            aria-hidden="true"> </i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$new->created_at)))}}</span>
                                                                <p>                                             {!! Str::words($new->intro,10, '...')!!}
                                                                </p>
                                                                <ul class="author-all">
                                                                    <li class="flo-right"><a>{{$new->user->name}}</a></li>
                                                                    <li class="dir">

                                                                        @if(count($new->comments)>0)
                                                                            <a href="{{url('news/'.$new->id.'#scroll')}}"
                                                                               class="comment"><i class="fa fa-comment-o"
                                                                                                  aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($new->comments))}}
                                                                            </a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <a class="btn-send btnn padd-btn" href="{{url('news')}}">المزيد</a>
                                                </div>
                                            </div>

                                        @endforeach
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 sidebar-home">
                            <!-- Blog Single Sidebar Start Here -->
                            @if(count($sports)>0)
                                <div class="sidebar-area home-sidebar" style="margin-top: -71px !important">
                                    <div class="playoffs-area">
                                        <div class="view-area">
                                            <div class="row">
                                                <div class="col-sm-12 ">
                                                    <h3 class="title-bg flo-right">الرياضات المتاحة</h3>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="responsive-table">
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <table class="table table-bordered dir">

                                                        @foreach($sports as $sport)
                                                            <tr>
                                                                <td class="first-td">{{$count++}} <img
                                                                            src="{{asset('/'.$sport->image)}}"
                                                                            alt="" class="sport-im"></td>
                                                                <td class="second"><span> {{$sport->name}} </span></td>

                                                            </tr>
                                                        @endforeach

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                @endif

            </div>
        </div>
        <div class="overflow-all">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

                    {{--@if($max_length == 'individuals')--}}
                        {{--{{ $indvSports->links('pagination.customPagination') }}--}}
                    {{--@elseif($max_length == 'teams')--}}
                        {{--{{ $teamSports->links('pagination.customPagination') }}--}}
                    {{--@else--}}
                        {{--{{ $news->links('pagination.customPagination') }}--}}
                    {{--@endif--}}
                    {{ $news->links('pagination.customPagination') }}

                </div>
            </div></div>

    </div>
    </div>


@endsection

@section('scripts')

@endsection