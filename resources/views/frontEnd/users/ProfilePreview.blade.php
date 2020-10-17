@extends('frontEnd.master')

@section('css')

    <link rel="stylesheet" href="{{url('/')}}/assets/swal2/sweetalert2.min.css" type="text/css"/>


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
                                    </a>
                                    الفعاليات
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>الفعاليات</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->


    <!-- Single Author Page Start Here -->
    <div class="single-team-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 single-image flo-right ">
                    <figure><img style="width: 360px; height: 399px;" class="img-responsive"
                                 src="{{asset('/'.$user->image)}}" alt="Toya"></figure>
                </div>
                <div class="col-lg-8 col-md-8 col-sm-6 col-xs-12 single-bio dir">
                    <h2 class="member-name">{{$user->name}}</h2>
                    <h3 class="member-title">{{$user->role->name}}</h3>
                    <div class="contact-info">
                        <ul>
                            <li><i class="fa fa-envelope-o"></i>{{$user->email}}</li>
                            <li><i class="fa fa-flag"></i>{{$user->countries->name}}</li>
                            <li><i class="fa fa-building-o"></i>{{$user->city->name}}</li>

                        </ul>
                    </div>
                </div>

                <div class="blog-page-area gallery-page category-page ">

                    <div id="scroll" class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                        <!--events-->

                        @if(count($events)>0)
                            <div class="view-area mt-42">
                                <div class="col-sm-12 text-right">
                                    <h3 class="title-bg "> الفعاليات </h3>
                                </div>
                            </div>
                            <div class="blog-page-area">
                                <div class="">
                                    <div class="row mb-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            @foreach($events as $event)
                                                <div class="col-lg-6 col-md-4 col-sm-6 col-xs-12 flo-right">
                                                    <ul>
                                                        <li>
                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right">
                                                                <div class="blog-image">
                                                                    <img src="{{asset('/'.$event->image)}}"
                                                                         alt="Blog photo" class="img-hi">
                                                                </div>
                                                            </div>
                                                            <div style="margin-top: 20px;" class="col-sm-2">
                                                                <div class="form-group">
                                                                    @if(count(@$event->authUser) == 0)
                                                                        <a href="{{url('events/join/'.$event->id)}}"
                                                                           class="btn-send bt-plus confirmation"
                                                                           id="plus"><i class="fa fa-plus"
                                                                                        aria-hidden="true"></i></a>
                                                                    @elseif(count(@$event->authUser) >= 0 && @$event->authUser->first()->pivot->status == 0)
                                                                        <a href="{{url('events/disJoin/'.$event->id)}}"
                                                                           class="btn-send bt-minus confirmation"
                                                                           id="minus"><i class="fa fa-minus"
                                                                                         aria-hidden="true"></i></a>
                                                                    @else
                                                                        <span style="display: inline-block;width: -moz-max-content;border-radius: 5px !important;background-color: #72746B;color: #fff; font-size: 14px"> <i
                                                                                    class="fa fa-thumbs-up"
                                                                                    aria-hidden="true"></i>  تم الانضمام  </span>
                                                                    @endif
                                                                </div>
                                                            </div>

                                                            <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                                                                <h3>
                                                                    <a href="{{url('events/'.$event->id)}}">{{$event->name}}</a>
                                                                </h3>
                                                                <span class="admin"><a href="#"><i class="fa fa-user-o flo-right mt-5"
                                                                                                   aria-hidden="true"></i> {{$event->added_by->name}}</a></span>
                                                                @if(count($event->users)>0)
                                                                    <span class="like"><a href=""><i class="fa fa-users"
                                                                                                     aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($event->users))}} </a></span>
                                                                @endif

                                                            </div>
                                                            <div class="col-sm-12">
                                                                @if(auth()->user()->roles_id == 3)
                                                                <div class="form-group">
                                                                    <button value="{{$event->id}}"
                                                                            class="btn-send send-bt send_msg_btn"
                                                                            type="submit" data-toggle="modal"
                                                                            data-target="#exampleModal2"> ارسال رسالة
                                                                    </button>
                                                                </div>
                                                                    @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>

                                            @endforeach
                                        </div>
                                    </div>

                                </div>
                            </div>
                        @endif

                    <!--groups-->
                        @if(count($groups)>0)
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
                                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                    <ul class="border-clo">
                                                        <li>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                                <div class="blog-image">
                                                                    <img style="width: 142px; height: 119px;"
                                                                         src="{{asset('/'.$group->image_url)}}"
                                                                         alt="Blog photo"
                                                                         srcset="images/blog/1.1.jpg 2x">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">

                                                                <h3><a href="">{{$group->name}}</a></h3>

                                                                @if(count($group->users)>0)
                                                                    <span class="date"><i class="fa fa-users flo-right mt-5"
                                                                                          aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($group->users))}} </span>
                                                                @endif
                                                                |
                                                                <span class="admin"><i class="fa fa-user-o"
                                                                                       aria-hidden="true"></i> {{$group->groupAdmin->name}} </span>


                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif

                    <!--teams-->
                        @if(count($teams)>0)
                            <div class="row mt-20">
                                <div class="view-area mt-42">
                                    <div class="col-sm-12 text-right">
                                        <h3 class="title-bg "> الفرق </h3>
                                    </div>
                                </div>
                                <hr>

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
                                                                href="">{{$team->name}}</a>
                                                    </h3>
                                                    <p>{{$team->description}}</p>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        @endif

                        @if(count($images)>0)
                        <!-- imges-->
                            <div class="view-area mt-42">
                                <div class="col-sm-12 text-right">
                                    <h3 class="title-bg "> الصور </h3>
                                </div>
                            </div>
                            <div class="blog-page-area gallery-page gellary-area">
                                <div class="row">
                                    @foreach($images as $image)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                            <div class="single-gellary">
                                                <div class="image">
                                                    <img src="{{asset('/'.$image->media_link)}}" alt="">

                                                </div>
                                                <div class="gellary-informations dir">
                                                    <ul>
                                                        <li>
                                                            <h3>{{$image->title}}</h3>
                                                            <i class="fa fa-comments"
                                                               aria-hidden="true"></i> 12
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"> </i> {{\Arabicdatetime::date(strtotime(@$image->created_at) , 0 , 'j M Y'  ,'indian')}} </span>

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                                        @foreach($videos as $video)
                                            <div class="row dir">
                                                <ul>
                                                    <li>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                            <div class="carousel-inner">
                                                                <div class="blog-image">
                                                                    <div class="videos-icon">
                                                                        <a class="popup-videos"
                                                                           href="{{url('/'.$video->media_link)}}">
                                                                            <i class="fa fa-caret-right"
                                                                               aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <a href="">
                                                                        <img style="width: 360px;height: 262px;"
                                                                             src="{{url('design/frontEnd')}}/images/fetuered/video-icon.png"
                                                                             alt="">
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                            <h3>{{$video->title}}</h3>
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime(@$video->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                                            <span class="like"><a href="#"><i class="fa fa-comment-o"
                                                                                              aria-hidden="true"></i>  12 </a></span>
                                                            <p>{{$video->description}}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>
                            @endif
                            <!-- articles-->

                                @if(count($articles)>0)
                                    <div class="row">
                                        <div class="view-area mt-42">
                                            <div class="col-sm-12 text-right">
                                                <h3 class="title-bg "> المقالات </h3>
                                            </div>
                                        </div>
                                        <hr>
                                        <ul>
                                            @foreach($articles as $article)
                                                <li>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right ">
                                                        <div class="carousel-inner">
                                                            <div class="blog-image">
                                                                <i class="fa fa-link" aria-hidden="true"></i>
                                                                <img style="width: 360px;height: 263px;"
                                                                     src="{{asset('/'.$article->image)}}"
                                                                     alt="category photo">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                                        <h3>
                                                            <a href="{{asset('article-details/'.$article->id)}}">{{$article->title}}</a>
                                                        </h3>
                                                        <span class="date "><i class="fa fa-calendar-check-o "
                                                                               aria-hidden="true"></i> {{\Arabicdatetime::date(strtotime(@$article->created_at) , 0 , 'j M Y'  ,'indian')}} </span>
                                                        @if(count($article->comments)>0)
                                                            <span class="like"><i class="fa fa-comment-o"
                                                                                  aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($article->comments))}} </span>
                                                        @endif
                                                        <p>{{$article->intro}}</p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                    </div>

                </div>
            </div>

        </div>
    </div>


    <!-- Send message Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="send_msg" role="form" enctype="multipart/form-data" method="post" action="{{url('/events')}}"
                      class="ls_form">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <h5 class="modal-title flo-right" id="exampleModalLabel">إرسال رسالة</h5>
                        <button type="button" class="close flo-left close_modal" data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group col-md-12">
                            <div style="text-align: center;display: none" id="validation-errors1"></div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1" style="float: right"> عنوان الرسالة</label>
                                <input style="direction: rtl" class="form-control" name="msgTitle" type="text">

                            </div>
                            <div class="form-group col-md-12">
                                <label for="exampleFormControlTextarea1" style="float: right"> أترك رسالتك</label>
                                <textarea style="direction: rtl" name="msgContent" class="form-control hei-85"
                                          id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                            <div class="form-group col-md-12 dir mb-50">
                                <div class="wrap-custom-file">
                                    <input type="file" name="msgImg" id="image1" accept=".gif, .jpg, .png"/>
                                    <label for="image1">
                                        <span>اضافة صورة الراعى  </span>
                                        <i class="fa fa-plus-circle"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary close_modal" data-dismiss="modal">إغلاق</button>
                        <button class="btn btn-primary"> حفظ</button>
                        <input type="hidden" id="event_id">
                        <input type="hidden" id="customURL" value="{{url('/events')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="container">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">

            @if($max_length == 'eve')
                {{ $events->links('pagination.customPagination') }}
            @elseif($max_length == 'grou')
                {{ $groups->links('pagination.customPagination') }}
            @elseif($max_length == 'tea')
                {{ $teams->links('pagination.customPagination') }}
            @elseif($max_length == 'img')
                {{ $images->links('pagination.customPagination') }}
            @elseif($max_length == 'vid')
                {{ $videos->links('pagination.customPagination') }}
            @elseif($max_length == 'art')
                {{ $articles->links('pagination.customPagination') }}
            @endif

        </div>
    </div>
    </div>
    <!-- Footer Area Section Start Here -->

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
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

    <script>

        $(document).ready(function () {

            $('#send_msg')[0].reset();

            $(".send_msg_btn").click(function () {
                $("#event_id").val(this.value);
                $('#validation-errors1').html('');
                $('#validation-errors1').hide();
            });

            $(".close_modal").click(function () {
                $('#send_msg')[0].reset();
                $('#validation-errors1').html('');
                $('#validation-errors1').hide();
            });

            $("form#send_msg").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('eventID', $('#event_id').val());
                var url = $('#send_msg').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors1').html('<div class="alert alert-success"> تمت ارسال رسالتك بنجاح </div>').slideDown();
                        $('#send_msg')[0].reset();

                        $("#exampleModal2").animate({scrollTop: 0}, "slow");

                        setTimeout(function () {
                            $('#validation-errors1').slideUp();
                        }, 2000);

                    }, error: function (xhr) {

                        var err = xhr.responseJSON.error;
                        // $('#validation-errors1').html('<div class="alert alert-danger">' + err + '</div>');

                        $('#validation-errors1').html('');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-errors1').append('<div class="alert alert-danger">' + value + '</div>').slideDown();
                        });

                        $("#exampleModal2").animate({scrollTop: 0}, "slow");

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });


            if (window.location.hash != null && window.location.hash != '') {
                var type = window.location.hash.substr(1);
                var myTarget = document.querySelector('#' + type);
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop - 25, 10)}, 1000);
            }
        });

    </script>

    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الانضمام الى تلك الفاعلية ومشاركة جميع احداثها',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم ,أريد الانضمام !',
                    cancelButtonText: 'لا ,شكرا !',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم ارسال طلب الانضمام !",
                        text: "تم ارسال طلب انضمامكم للادمن وهو قيد الموافقة",
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
                        text: "تم الغاء طلب الانضمام :)",
                        type: "error",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        location.reload();
                    });

                });

            } else if (this.id == 'minus') {

                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الغاء طلب المشاركة بتلك الفاعلية',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الالغاء !",
                        text: "تم الغاء طلب انضمامكم للفاعلية",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    location.reload();

                });
            }
        });
    </script>

@endsection