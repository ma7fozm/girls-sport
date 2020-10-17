@extends('frontEnd.master')

@section('css')
    <style>
    </style>
@endsection

@section('popup')

    <div class='popup'>
        <div class='cnt223'>
            <h3 class="text-right"> ! شكرا لزيارتكم </h3>
            <p>
                هذا النسخه من موقع جيرلز سبورتس هي نسخه تحت التجربة سعداء بتلقي ملاحظاتكم علي <a href="">Girlssp017@gmail.com</a>
                <br/>
                <br/>
                <a href='' class='closee flo-left'>إغلاق</a>
            </p>
        </div>
    </div>

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

                    <input type='hidden' name='models[]' value='App\Media'>
                    <input type='hidden' name='col_name[]' value='name'>

                    <input type='hidden' name='models[]' value='App\Event'>
                    <input type='hidden' name='col_name[]' value='name'>

                    <input type='hidden' name='models[]' value='App\Place'>
                    <input type='hidden' name='col_name[]' value='name'>

                    <input type='hidden' name='models[]' value='App\Team'>
                    <input type='hidden' name='col_name[]' value='name'>

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

    <!-- Slider Section Start Here -->
    <div class="slider-main">
        <div id="main-slider" class="owl-carousel">
            @if(count($slider_images)==0)
                <div class="item">
                    <img src="{{asset('/design/frontEnd')}}/images/full-slider/1.jpg" alt="Slider image">

                </div>
                <div class="item">
                    <img src="{{asset('/design/frontEnd')}}/images/full-slider/6.jpg" alt="Slider image">

                </div>
                <div class="item">
                    <img src="{{asset('/design/frontEnd')}}/images/full-slider/2.jpg" alt="Slider image">
                </div>
            @else
                @foreach($slider_images as $slider_image)
                    <div class="item">
                        <img style="width:1349px !important; height:563px !important; "
                             src="{{asset('/'.$slider_image->media_link)}}" alt="Slider image">
                    </div>
                @endforeach
            @endif
        </div>

    </div>

    <!-- All News Section Start Here -->
    <div class="all-news-area">
        @if(count($news)>0)
            <div class="slider-of-news">
                <div class="container">
                    <div class="row text-right">
                        <h2 class="title-bg"> أخر الأخبار</h2>
                        <div class="slider slider-of-latest">

                            @foreach($news as $new)
                                <div class="inner-text">
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12 images flo-right">
                                        <img style="width: 653px;height:362px;"
                                             src="{{asset('/'.$new->image)}}" alt="">
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 inner-text">
                                        <a href="{{url('/news')}}"><h3>{{$new->title}}</h3></a>
                                        <p>                                               {!!Str::words($new->intro,10, '...')!!}
                                        </p>
                                        <a href="{{url('/news')}}" class="read-more"><i class="fa fa-angle-double-left"
                                                                                        aria-hidden="true"></i> المزيد
                                        </a>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        @endif
    <!-- img/video Start Here -->
        @if(count($images)>0 || count($videos)>0)
            <div class="fetuered-videos team-page-area  ">
                <div class="container">
                    <div class="row">
                        <div class="view-area">
                            <div class="col-sm-12 text-right">
                                {{--@if(isset($images))--}}
                                <h3 class="title-bg "> الصور والفيديوهات</h3>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                            <div id="author-slider-section" class="owl-carousel" style="margin-top: 7px;">

                                @if(isset($videos))
                                    @foreach($videos as $video)

                                        <div class="item">
                                            <div class="single-videos">
                                                <div class="single-member-area spc-o">
                                                    <div class="cl-single-member">

                                                        <iframe width="375" height="275"
                                                                src="http://www.youtube.com/embed/{{$video->media_link}}"
                                                                frameborder="0" allowfullscreen></iframe>
                                                    </div>

                                                </div>
                                                <div class="article">
                                                    <h3><a href="{{url('video-details/'.$video->id)}}" data-id="1"
                                                           class="cl-single-item-popup">{{$video->title}}</a></h3>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>

                        @if(count($images)>0)
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 blog-page-area gallery-page category-page ">

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
                                        <div class="carousel-inner">

                                            @for($i=0;$i<count($images);$i++)
                                                <div class="item {{($i == 0)?'active':''}}">
                                                    <div class="blog-image">
                                                        <img style="width: 390px; height: 275px;"
                                                             src="{{asset('/'.$images[$i]->media_link)}}"
                                                             alt="category photo" class="img-hei">
                                                    </div>
                                                    <div class="dsc text-right">
                                                        <p style="color: #ffffff">{{$images[$i]->title}}
                                                            <br> {!! Str::words($images[$i]->description,10, '...')!!}
                                                        </p>
                                                        <span class="date "> <i class="fa fa-calendar-check-o flo-right"
                                                                                aria-hidden="true"></i> {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$images[$i]->created_at)))}}</span>


                                                    </div>
                                                </div>
                                            @endfor
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 inner-text mt-20">
                                    <a href="{{url('gallary')}}" class="read-more more"> المزيد </a>
                                </div>
                            </div>
                    </div>
                    @endif
                </div>
            </div>
        @endif

    <!-- img/video End Here -->
        <div class="container">
            <!-- latest news Start Here -->
            <div class="row">


                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 tab-home flo-right text-right">
                    @if(count($events)>0)
                        <h2 class="title-bg "> أحدث الفعاليات </h2>
                        <!--events Start here -->
                        <div class="tab-content popular-tab">
                            <div class="tab-pane fade in active">
                                <div class="full-slider-area">
                                    <ul class="tab-popular">
                                        <li>
                                            <div class="image">
                                                <a href="blog-single.html"><img style="width: 555; height: 296px"
                                                                                src="{{asset('/'.$event['image'])}}"
                                                                                alt="news image"></a>
                                                <div class="slider-content">
                                                    {{--<span class="date dir"><i class="fa fa-calendar-check-o"--}}

                                                    <h2><a href="{{url('/events/'.$event['id'])}}"> {{$event['name']}}
                                                            <span> {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$event['from_datetime'])))}}</span></a>



                                                    </h2>
                                                    <a href="{{url('/events')}}" class="more-btn2"><i
                                                                class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                                        المزيد
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <!-- End events -->
                    @endif
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 tab-home text-right">

                @if(count($places)>0)
                    <!--places Start here -->
                        <h2 class="title-bg mb-30"> أماكن الفعاليات</h2>

                        <div class="tab-content popular-tab">
                            <div class="tab-pane fade in active">
                                <div class="full-slider-area">
                                    <ul class="tab-popular">
                                        <li>
                                            <div class="image">
                                                <a href="blog-single.html"><img style="width: 555; height: 296px"
                                                                                src="{{asset('/'.$place['image'])}}"
                                                                                alt="news image"></a>
                                                <div class="slider-content">
                                                    <h2> {{$place['name']}}
                                                    </h2>
                                                    <a href="{{url('/places')}}" class="more-btn2"><i
                                                                class="fa fa-long-arrow-left" aria-hidden="true"></i>
                                                        المزيد
                                                    </a>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                            </div>

                        </div>
                        <!-- End places -->
                    @endif
                </div>
            </div>
        </div>
        <!-- All News Section end Here -->

        <!-- wa3yyyy start-->

        @if(count($healthNews)>0)
            <div class="slider-of-news">
                <div class="container">
                    <div class="row text-right">
                        <h2 class="title-bg"> الصحة </h2>


                        <div class="slider slider-nav">
                            @foreach($healthNews as $healthNew)
                                <div>
                                    <div class="row">
                                        <div class="inner">
                                            <div class="col-md-6 col-sm-6 col-xs-6 flo-right">
                                                <img src="{{asset('/'.$healthNew->image)}}" alt="">
                                            </div>
                                            <div class="col-md-6 col-sm-6 pad_o col-xs-6 ">
                                                <span> {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$healthNew->created_at)))}}</span>



                                                <a href="{{url('news/show/details/'.$healthNew->id)}}"><p
                                                            style="color:darkgray">{!! Str::words($healthNew->title,7, '...')!!}</p></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
    @endif
    <!--wa3yyyy end-->

        <!-- sports and teams-->
        <div class="blog-page-area gallery-page gellary-area">
            <div class="container">
                <div class="row dir">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">

                            <h3 class="title-bg "> الرياضات والفرق </h3>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-10 flo-right">
                            @if(count($teamSports)>0)
                                @foreach($teamSports as $sport)
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 flo-right">
                                        <ul>
                                            <li>
                                                <div class="blog-image">

                                                    <img src="{{asset('/'.$sport->image)}}"
                                                         alt="" class="hei-9">
                                                </div>

                                                <h3 class="text-center padd"><a
                                                            href="{{url('/sports/'.$sport->id)}}">{{$sport->name}}</a>
                                                </h3>

                                            </li>
                                        </ul>
                                    </div>

                                @endforeach
                            @endif
                            @if(count($indvSports)>0)
                                @foreach($indvSports as $sport)
                                    <div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 flo-right">
                                        <ul>
                                            <li>
                                                <div class="blog-image">

                                                    <img src="{{asset('/'.$sport->image)}}"
                                                         alt="" class="hei-9">
                                                </div>

                                                <h3 class="text-center padd"><a
                                                            href="{{url('/sports/'.$sport->id)}}">{{$sport->name}}</a>
                                                </h3>

                                            </li>
                                        </ul>
                                    </div>

                                @endforeach
                            @endif
                        </div>
                        <div class="col-md-2 col-lg-2 col-sm-9 col-xs-9"><a href="{{url('sports')}}" class="more " tabindex="-1"
                                                                            style="margin-top: 60px"><i class="fa fa-angle-double-left"
                                                                                                        aria-hidden="true"></i> المزيد
                            </a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

@section('scripts')

    <script>
        $(function () {
            var overlay = $('<div id="overlay"></div>');
            overlay.show();
            overlay.appendTo(document.body);
            $('.popup').show();
            $('.closee').click(function () {
                $('.popup').hide();
                overlay.appendTo(document.body).remove();
                return false;
            });


            $('.x').click(function () {
                $('.popup').hide();
                overlay.appendTo(document.body).remove();
                return false;
            });
        });

    </script>
@endsection

