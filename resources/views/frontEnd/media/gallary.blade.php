@extends('frontEnd.master')

@section('css')


@endsection

@section('search')
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="search">
            <div class="search-wrap">
                <div class="search-input-elm">
                    <input name="query" class="search-input" type="text" placeholder="ابحث هنا .."/>

                    {{--<input type='hidden' name='models[]' value='App\News'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    <input type='hidden' name='models[]' value='App\Media'>
                    <input type='hidden' name='col_name[]' value='name'>

                    {{--<input type='hidden' name='models[]' value='App\Match'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Event'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Place'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

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
                                    الصور والفيديوهات
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> الصور والفيديوهات</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <div class="row">

                @if(count($gallery_images)!=0 && count($gallery_videos)!=0)

                    <div class="col-lg-12 col-md-8 col-sm-12 col-xs-12">

                        @if(isset($gallery_images) && count(@$gallery_images) > 0)
                            <div class="blog-page-area gallery-page gellary-area">
                                <div class="row">
                                    <div class="view-area">
                                        <div class="col-sm-12 text-right">
                                            <h3 class="title-bg "> الصور </h3>
                                        </div>
                                    </div>

                                    @foreach($gallery_images as $media)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                            <div class="single-gellary">
                                                <div class="image">
                                                    <img src="{{asset('/'.$media->media_link)}}" alt="">

                                                </div>
                                                <div class="gellary-informations dir">
                                                    <ul>
                                                        <li>
                                                            <a href="images/gallery2/1.jpg" data-lightbox="example-set"
                                                               data-title=""></a>
                                                            <a href="{{ route('gallary-details',['id'=>$media->id])}}">
                                                                <h3>{{$media->title}}</h3></a>
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"> </i>
                                    {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$media->created_at)))}}</span>
                                                            @if($media->comments->count())
                                                                <a href="#"><i class="fa fa-comments"
                                                                               aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers($media->comments->count())}}
                                                                </a>
                                                            @endif
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                    @endforeach
                                </div>

                            </div>
                        @endif

                        @if(isset($gallery_videos) && count(@$gallery_videos) > 0)
                            <div class="blog-page-area gallery-page category-page">
                                <div class="row">
                                    <div class="view-area">
                                        <div class="col-sm-12 text-right">
                                            <h3 class="title-bg "> الفيديوهات </h3>
                                        </div>
                                    </div>

                                    @foreach($gallery_videos as $media)

                                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">

                                            <div class="row dir">
                                                <ul>
                                                    <li>
                                                        <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                            <div class="">
                                                                <div class="">
                                                                    <div class="">

                                                                    </div>
                                                                    <iframe width="320" height="240"
                                                                            src="http://www.youtube.com/embed/{{$media->media_link}}"
                                                                            frameborder="0" allowfullscreen></iframe>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 ">
                                                            <a href="{{ route('Video-details',['id'=>$media->id])}}">
                                                                <h3>{{$media->title}}</h3></a>
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"></i>
                                {{ App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$media->created_at)))}}</span>

                                                            @if($media->comments->count()>0)
                                                                <span class="like"><a href="#"><i
                                                                                class="fa fa-comment-o"
                                                                                aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers($media->comments->count())}} </a></span>
                                                            @endif
                                                            <p>
                                                                {!!Str::words($media->description,10, '...')!!}
                                                            </p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>

                                        </div>
                                    @endforeach

                                </div>

                            </div>
                        @endif
                    </div>
                @else
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> ميديا </h3>
                        </div>
                    </div>
                    <div style="text-align: center">
                        لا يتوفر الموقع على ميديا بعد
                    </div>
                @endif
            </div>
        </div>
        <div style="text-align: center">
            <?php
            if($max_length == "images"){ ?>
            {{ $gallery_images->links() }}
            <?php }else{ ?>
            {{ $gallery_videos->links() }}
            <?php } ?>
        </div>
    </div>
    <!-- modal add img/vid start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close flo-left" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف صورة / فيديو</h4>
                </div>
                <div class="modal-body">
                    <div class="single-blog-page-area contact-page-area pt">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف صورة / فيديو</h3>

                                    <form>
                                        <fieldset>
                                            <div class="row ">
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>العنوان </label>
                                                        <input type="text" name="fname" class="form-control" required>
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 flo-right">
                                                    <div class="form-group">
                                                        <label>تاريخ الإنشاء</label>
                                                        <input type="date" name="fname" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label>تاريخ التعديل</label>
                                                        <input type="date" name="fname" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>لينك الفيديو </label>
                                                        <input type="text" name="fname" class="form-control" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>الوصف </label>
                                                        <textarea cols="12" name="message" rows="5"
                                                                  class="textarea form-control txtarea1-hi"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="image1" id="image1"
                                                               accept=".gif, .jpg, .png"/>
                                                        <label for="image1">
                                                            <span>تحميل الصورة</span>
                                                            <i class="fa fa-plus-circle"></i>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button class="btn-send" type="submit">تأكيد</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </form>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>

    <!-- modal add img/vid end-->

@endsection

@section('scripts')

@endsection