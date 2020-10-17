@extends('frontEnd.master')

@section('css')
    <style>
        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {

            z-index: 3;
            color: #b01712;
            background-color: #337ab7;
            border-color: #337ab7;
            cursor: default;

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

                    <input type='hidden' name='models[]' value='App\Match'>
                    <input type='hidden' name='col_name[]' value='title'>

                    <input type='hidden' name='models[]' value='App\Event'>
                    <input type='hidden' name='col_name[]' value='name'>

                    <input type='hidden' name='models[]' value='App\Place'>
                    <input type='hidden' name='col_name[]' value='name'>

                    {{--<input type='hidden' name='models[]' value='App\Team'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Sport'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}


                </div>
                <a href="#search" data-toggle="collapse" class="search-btn"><i class="fa fa-search"
                                                                               aria-hidden="true"></i></a>
            </div>
        </div>
    </form>
@endsection

@section('content')

    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <div class="row mt-20 text-right">

                <ul>
                    <li>
                        <div class="col-lg-8 col-md-12 col-sm-12 col-xs-12 flo-right">
                            @if(count(@$news)> 0)
                                <h6 class="title-bg"> أخر الأخبار</h6>
                                <div id="news-Carousel1" class="carousel carousel-top-category slide"
                                     data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <!-- Left and right controls -->
                                    <div class="next-prev">
                                        <a class="left news-control" href="#news-Carousel1" data-slide="prev">
                                    <span class="news-arrow-left"><i class="fa fa-angle-left"
                                                                     aria-hidden="true"></i></span>
                                        </a>
                                        <a class="right news-control" href="#news-Carousel1" data-slide="next">
                                        <span class="news-arrow-right"><i class="fa fa-angle-right"
                                                                          aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <div class="blog-image">
                                                <a href="">

                                                    <img style="width: 750px;height: 418px"
                                                         src="{{asset('/'.@$news[0]->image)}}" alt="">
                                                </a>
                                            </div>
                                            <div class="dsc">
                                                <h3 style="color: #ffffff;">{{@$news[0]->title}}
                                                    <br/> {!!Str::words(@$news[0]->intro,10, '...')!!}
                                                </h3>
                                                <span class="date"> <i class="fa fa-calendar-check-o flo-right"
                                                                       aria-hidden="true"></i>{{  \Arabicdatetime::date(strtotime($news[0]->created_at) , 0 , 'j M Y'  ,'indian')}}</span>

                                                @if(count(@$news[0]->comments)>0)
                                                    <span class="date"><i class="fa fa-comment-o"
                                                                          aria-hidden="true"></i>&nbsp; {{App\Http\Controllers\ArticleController::convertArabicNumbers(count(@$news[0]->comments))}}</span>
                                                @endif
                                            </div>
                                        </div>

                                        @for($i=1;$i<count($news);$i++)
                                            <div class="item ">
                                                <div class="blog-image">
                                                    <a href="">
                                                        <img style="width: 750px;height: 418px"
                                                             src="{{asset('/'.$news[$i]->image)}}" alt="">
                                                    </a>
                                                </div>
                                                <div class="dsc">
                                                    <h3 style="color: #ffffff">{{$news[$i]->title}}
                                                        <br/> {!! Str::words($news[$i]->intro,10, '...')!!} </h3>
                                                    <span class="date"> <i class="fa fa-calendar-check-o flo-right"
                                                                           aria-hidden="true"></i>{{ \Arabicdatetime::date(strtotime($news[$i]->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                                    @if(count($news[$i]->comments)>0)
                                                        <span style="color: #ffffff" class="like"><i
                                                                    class="fa fa-comment-o"
                                                                    aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($news[$i]->comments))}} </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            @else
                                <h6 class="title-bg"> أخر الأخبار</h6>
                                <div id="news-Carousel1" class="carousel carousel-top-category slide"
                                     data-ride="carousel">
                                    <!-- Wrapper for slides -->
                                    <!-- Left and right controls -->
                                    <div class="next-prev">
                                        <a class="left news-control" href="#news-Carousel1" data-slide="prev">
                                    <span class="news-arrow-left"><i class="fa fa-angle-left"
                                                                     aria-hidden="true"></i></span>
                                        </a>
                                        <a class="right news-control" href="#news-Carousel1" data-slide="next">
                                            <span class="news-arrow-right"><i class="fa fa-angle-right"
                                                                              aria-hidden="true"></i></span>
                                        </a>
                                    </div>
                                    <div class="carousel-inner">
                                        <div class="item active">
                                            <div class="blog-image">
                                                <a href="">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/6.jpg"
                                                         alt="">
                                                </a>
                                            </div>
                                            <div class="dsc">
                                                <h3><a href="{{url('/news')}}">Hackers Can Steal Your Financial Info
                                                        With<br/> Your
                                                        Name and Email</a></h3>
                                                <span class="date"> <i class="fa fa-calendar-check-o"
                                                                       aria-hidden="true"></i> Sep 13, 2017</span>
                                                <span class="date"><a><i class="fa fa-comment-o"
                                                                         aria-hidden="true"></i>  12 </a></span>
                                            </div>
                                        </div>
                                        <div class="item">
                                            <div class="blog-image">
                                                <a href="{{url('/news')}}">
                                                    <i class="fa fa-link" aria-hidden="true"></i>
                                                    <img src="{{asset('design/frontEnd')}}/images/category/3.jpg"
                                                         alt="category photo">
                                                </a>
                                            </div>
                                            <div class="dsc">
                                                <h3><a href="{{url('/news')}}">Hackers Can Steal Your Financial Info
                                                        With<br/> Your
                                                        Name and Email</a></h3>
                                                <span class="date"><i class="fa fa-calendar-check-o"
                                                                      aria-hidden="true"></i> Sep 13, 2017</span>
                                                <span class="date"><a><i class="fa fa-comment-o"
                                                                         aria-hidden="true"></i>  12 </a></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right">

                            <!--events Start here -->
                            @if (empty($events))
                                <h6 class="title-bg"> أخر الفعاليات</h6>
                                <div class="tab-content popular-tab">
                                    <div id="tab-popular" class="tab-pane fade in active">
                                        <div class="full-slider-area">
                                            <ul class="tab-popular">
                                                <li>
                                                    <div class="image">
                                                        <a href="{{url('/events')}}"><img
                                                                    src="{{asset('design/frontEnd')}}/images/popular/4.jpg"
                                                                    alt="news image"></a>
                                                        <div class="slider-content">

                                                            <h2><a href=""> Alchemists women team tryouts <span>Will start in january</span></a>
                                                            </h2>
                                                            <a href="{{url('/events')}}" class="more-btn2"><i
                                                                        class="fa fa-long-arrow-left"
                                                                        aria-hidden="true"></i> المزيد
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            @else
                                <h6 class="title-bg"> أخر الفعاليات</h6>
                                <div class="tab-content popular-tab">
                                    <div id="tab-popular" class="tab-pane fade in active">
                                        <div class="full-slider-area">
                                            <ul class="tab-popular">
                                                <li>
                                                    <div class="image">
                                                        <a href="{{url('/events/'.$event['id'])}}"><img
                                                                    style="width: 360px;height: 192px"
                                                                    src="{{url('/'.$event['image'])}}"
                                                                    alt="news image"></a>
                                                        <div class="slider-content">

                                                            <h2>
                                                                <a href="{{url('/events/'.$event['id'])}}"> {{$event['name']}}
                                                                </a>
                                                            </h2>
                                                            <a href="{{url('/events')}}" class="more-btn2"><i
                                                                        class="fa fa-long-arrow-left"
                                                                        aria-hidden="true"></i> المزيد
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                        @endif
                        <!-- End events -->
                        </div>
                        <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 text-right">
                            <!--events Start here -->
                            @if (empty($places))
                                <h6 class="title-bg"> الاماكن المتاحة</h6>
                                <div class="tab-content popular-tab">
                                    <div id="tab-popular1" class="tab-pane fade in active">
                                        <div class="full-slider-area">
                                            <ul class="tab-popular">
                                                <li>
                                                    <div class="image">
                                                        <a href="{{url('/places')}}"><img
                                                                    src="{{asset('design/frontEnd')}}/images/popular/4.jpg"
                                                                    alt="news image"></a>
                                                        <div class="slider-content">

                                                            <h2><a href="{{url('/places')}}"> Alchemists women team
                                                                    tryouts
                                                                    <span>Will start in january</span></a>
                                                            </h2>
                                                            <a href="{{url('/places')}}" class="more-btn2"><i
                                                                        class="fa fa-long-arrow-left"
                                                                        aria-hidden="true"></i> المزيد
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                            @else
                                <h6 class="title-bg"> الاماكن المتاحة</h6>
                                <div class="tab-content popular-tab">
                                    <div id="tab-popular1" class="tab-pane fade in active">
                                        <div class="full-slider-area">
                                            <ul class="tab-popular">
                                                <li>
                                                    <div class="image">
                                                        <img
                                                                style="width: 360px;height: 192px"
                                                                src="{{url('/'.$place['image'])}}"
                                                                alt="news image">
                                                        <div class="slider-content">

                                                            <h2>
                                                                <a> {{$place['name']}} </a>

                                                            </h2>
                                                            <a href="{{url('/places')}}" class="more-btn2"><i
                                                                        class="fa fa-long-arrow-left"
                                                                        aria-hidden="true"></i> المزيد
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>

                                    </div>

                                </div>
                        @endif
                        <!-- End events -->
                        </div>

                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right text-right">

                    <h3 class="title-bg"> جميع الاخبار</h3>
                    <div class="row">
                        <ul>
                            @if(count($news)>0)
                                @foreach($news as $new)
                                    <li>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                            <div id="news-Category" class="carousel slide" data-ride="carousel">
                                                <!-- Wrapper for slides -->
                                                <!-- Left and right controls -->
                                                <div class="carousel-inner">
                                                    <div class="item active">
                                                        <div class="blog-image">
                                                            <i class="fa fa-link" aria-hidden="true"></i>
                                                            <img style="width:360 px !important; height: 263px;"
                                                                 src="{{asset('/'.$new->image)}}"
                                                                 alt="category photo">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                            <h3><a href="{{url('news/'.$new->id)}}">{{$new->title}}</a>
                                            </h3>


                                            <span class="date"><i class="fa fa-calendar-check-o flo-right "
                                                                  aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime($new->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                            @if(count($new->comments)>0)
                                                <span class="date"><i class="fa fa-comment-o "
                                                                         aria-hidden="true"></i>  {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($new->comments))}} </span>
                                                <p>  {!!Str::words($new->intro,10, '...')!!}</p>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                                @else
                                <div>
                                    <span> لم يتم اضافة اخبار بعد </span>
                                </div>
                                @endif
                        </ul>
                    </div>

                    <div class="row flo-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                            <div class="pagination-area">
                                {{--<div style="text-align: center">--}}
                                {{ $news->links('pagination.customPagination') }}
                                {{--</div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                    <div class="sidebar-area text-right ">


                        @if(count(@$played_matchs))
                            <div class="recent-results">
                                <h3 class="title-bg"> أخر النتائج</h3>
                                <div class="inner dir">
                                    <ul>
                                        @foreach(@$played_matchs as $match)
                                            <li class="bg_color">
                                                <table>
                                                    <tr>
                                                        <td> {{$match->title}} </td>
                                                        <td class="text-left"><i class="fa fa-calendar-check-o"
                                                                                 aria-hidden="true"></i>
                                                            {{ \Arabicdatetime::date(strtotime(@$match->date) , 0 , 'j M Y'  ,'indian') }}
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                            <li>
                                                <table>
                                                    <tr>
                                                        <td>{{@$match->teams[0]['name']}} <i class="fa fa-caret-left"
                                                                                             aria-hidden="true"></i>
                                                        </td>
                                                        <td> {{@$match->result}} </td>
                                                        <td class="text-left"> {{$match->teams[1]['name']}} </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif

                        @if(count(@$comming_matchs)>0)

                            <div class="next-match-area">
                                <h3 class="title-bg"> المبارايات القادمة</h3>
                                <div class="inner">
                                    <div class="row">
                                        <div id="championship" class="inner owl-carousel">
                                            @foreach(@$comming_matchs as $match)

                                                <div class="item">
                                                    <span class="date">{{  \Arabicdatetime::date(strtotime($match->date) , 0 , 'j M Y'  ,'indian') }}</span>


                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                                        <div class="inner">
                                                            @if($match->match_type == 'team' )
                                                                <img style="width: 90px;height: 90px;border-radius: 50%;"
                                                                     src="{{asset('/'.@$match->teams[0]['slogan'])}}"
                                                                     alt="">
                                                                <h4> {{(@$match->teams[0]['name']) ? @$match->teams[0]['name'] :''}}
                                                                    <span></span></h4>
                                                            @elseif($match->match_type == 'single' )

                                                                <img style="width: 90px;height: 90px;border-radius: 50%;"
                                                                     src="{{asset('/'.@$match->users[0]['image'])}}"
                                                                     alt="">
                                                                <h4> {{(@$match->users[0]['name']) ? @$match->users[0]['name'] :''}}
                                                                    <span></span></h4>
                                                            @endif

                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                                        <span class="vs">ضد</span>
                                                        <span class="radison">{{ \Arabicdatetime::date(strtotime(@$match->start_time) , 0 , 'h:i A'  ,'indian') }} <br> {{$match->place->name}}</span>
                                                        {{--                                                        <span class="radison">{{date('h:i A', strtotime($match->start_time))}} <br> {{$match->place->name}}</span>--}}
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                        <div class="inner">
                                                            @if($match->match_type == 'team' )
                                                                <img style="width: 90px;height: 90px;border-radius: 50%;"
                                                                     src="{{asset('/'.@$match->teams[0]['slogan'])}}"
                                                                     alt="">
                                                                <h4> {{(@$match->teams[1]['name']) ? @$match->teams[1]['name'] :''}}
                                                                    <span></span></h4>
                                                            @elseif($match->match_type == 'single' )

                                                                <img style="width: 90px;height: 90px;border-radius: 50%;"
                                                                     src="{{asset('/'.@$match->users[1]['image'])}}"
                                                                     alt="">
                                                                <h4> {{(@$match->users[1]['name']) ? @$match->users[1]['name'] :''}}
                                                                    <span></span></h4>
                                                            @endif

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection