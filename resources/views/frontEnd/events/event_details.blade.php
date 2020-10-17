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

    <meta property="og:url" content="{{url('/')}}"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="{{ $event->name }}"/>
    <meta property="og:description" content="{{ $event->agenda }}"/>
    <meta property="og:image" content="{{ url('/'.$event->image) }}"/>

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
                                    </a> تفاصيل الفاعلية
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>تفاصيل الفاعلية</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Blog Single Start Here -->
    <div class="single-blog-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 single-image flo-right">
                        <img class="new-hei" src="{{asset('/'.$event->image)}}" alt="">
                    </div>
                    <div style="margin-top: 20px;" class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                        <div class="col-sm-2 col-lg-2 col-xs-12 col-md-6 text-center">
                            <div class="form-group">
                                @if(Auth::user())
                                    @if(count(@$event->authUser) == 0)
                                        <a href="{{url('events/join/'.$event->id)}}"
                                           class="btn-send bt-plus confirmation"
                                           id="plus">انضم</a>
                                    @elseif(count(@$event->authUser) >= 0 && @$event->authUser->first()->pivot->status == 0)
                                        <a href="{{url('events/disJoin/'.$event->id)}}"
                                           class="btn-send bt-minus confirmation"
                                           id="minus"><i class="fa fa-minus" aria-hidden="true"></i></a>
                                    @else
                                        <span style="display: inline-block;width: -moz-max-content;border-radius: 5px !important;background-color: #72746B;color: #fff; font-size: 14px"> <i
                                                    class="fa fa-thumbs-up"
                                                    aria-hidden="true"></i>  تم الانضمام  </span>
                                    @endif
                                @else
                                    <a href="{{url('login')}}"
                                       class="btn-send bt-plus "
                                       id="plus">انضم</a>
                                @endif
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                            <h3>{{$event->name}}</h3>

                        </div>
                        <p>{{$event->agenda}}</p>
                        @if(count($event->users)>0)
                            <h5><i class="fa fa-users" aria-hidden="true"></i> عدد المشتركين :
                                <span>{{App\Http\Controllers\ArticleController::convertArabicNumbers(count($event->users))}}</span></h5>
                        @endif
                        <h5><i class="fa fa-calendar-check-o" aria-hidden="true"></i> تاريخ بداية الفاعلية :
                            <span>{{ App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$event->from_datetime))) }}</span>
                        </h5>
                        <h5><i class="fa fa-calendar-check-o" aria-hidden="true"></i> تاريخ نهاية الفاعلية :
                            <span>{{ App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$event->to_datetime))) }}</span>
                        </h5>
                        <span class="date"></span>
                    </div>

                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 life-style flo-right">

                            </div>

                        </div>
                    </div>

                <!--    <div class="share-section share-section2">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                <span> يمكنك المشاركة عن طريق :  </span>
                            </div>
                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                <ul class="share-link">
                                    <li class="hvr-bounce-to-right"><i class="fa fa-facebook" aria-hidden="true"></i>
                                        @php($url=url('/events/'.$event->id))
                        <a href="javascript:void(0);"
                           onclick="fb_share('{{ $url }}', '{{$event->name}}')" class="fbBtm">
                                            فيسبوك </a>
                                    </li>
                                    <li></li>
                                    <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-twitter"
                                                                                   aria-hidden="true"></i> تويتر</a>
                                    </li>
                                    <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-google"
                                                                                   aria-hidden="true"></i> جوجل</a></li>
                                </ul>
                            </div>
                        </div>
                    </div> -->

                    <!--sponsers-->
                    @if(count($event->sponsors)>0)
                        <div class="fetuered-videos team-page-area dir-r">
                            <div class="container">
                                <div class="row">
                                    <div class="view-area flo-right">
                                        <div class="col-sm-12">
                                            <h3 class="title-bg mr-10"> الرعاة </h3>
                                        </div>
                                    </div>
                                </div>
                                <div id="author-slider-section" class="owl-carousel">
                                    @foreach($event->sponsors as $sposor)
                                        <div class="item">
                                            <div class="single-videos">
                                                <div class="single-member-area spc-o">
                                                    <div class="cl-single-member">
                                                        <figure><img class="img-responsive slider-img"
                                                                     src="{{asset('/'.$sposor->image)}}"
                                                                     alt=""></figure>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                     <div class="row text-right">
                    <div class="author-comment">
                        {{--<a name="scroll"></a>--}}
                        <h3 id="scroll" class="title-bg"> التعليقات</h3>
                        <ul>
                            @foreach($event->comments->where('parent','=',0) as $comment)
                                <li>
                                    <div class="row">
                                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                            <div class="image-comments"><img
                                                        src="{{asset('/'.$comment->added_by->image)}}" alt=""></div>
                                        </div>

                                        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">

                                            <span class="reply">
                                            @if(isset(Auth::user()->id))

                                                    @if($comment->added_by->id == Auth::user()->id)
                                                        <a href="" id="{{$comment->id}}" class="edit_btn"
                                                           aria-hidden="true" data-toggle="modal"
                                                           data-target="#exampleModalc"><i
                                                                    class="fa fa-pencil ico-r "></i></a>
                                                    @endif

                                                    @if($comment->added_by->id == Auth::user()->id || $event->eventAdmin->id == Auth::user()->id)
                                                        <form id="{{'my_form'.$comment->id}}"
                                                              style="display: inline-block;"
                                                              method="post"
                                                              action="{{url('/events/delete/comment/'.$event->id.'/'.$comment->id)}}">
                                                                                                        {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                                                                            <a><i class="fa fa-trash-o ico-r"
                                                                                                                  onclick="submit_form('{{'my_form'.$comment->id}}')"
                                                                                                                  style="cursor: pointer"
                                                                                                                  aria-hidden="true"></i></a>
                                                                                                            </form>
                                                    @endif
                                                @endif
                                                                                            </span>

                                            <div class="dsc-comments">
                                                <h4><a href="{{url('profile/preview/'.$comment->added_by->id)}}">{{$comment->added_by->name}}</a></h4>
                                                <span class="date"><i class="fa fa-calendar-check-o"
                                                                      aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$comment->created_at)))}}</span>
                                                <p>{{$comment->comment}}</p> <b style="color: #1b4b72">اضف ردا</b>

                                                <div class="add_comm">
                                                    <form method="post"
                                                          action="{{url('/events/add/reply/'.$event->id.'/'.$comment->id)}}">
                                                        {!! csrf_field() !!}
                                                        <textarea cols="40" rows="10" name="reply"
                                                                  class="textarea form-control txtarea1-hi"></textarea>
                                                        <div class="form-group col-md-2">
                                                            <button style="margin-bottom: 10px" class="btn-send btnn "
                                                                    type="submit">تأكيد
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @foreach($comment->replies as $reply)
                                        <div style="margin-bottom: 45px;" class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                                <div style="padding: 0px 68px 7px 0px;" class="image-comments"><img
                                                            src="{{asset('/'.$reply->added_by->image)}}" alt=""></div>
                                            </div>
                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                                                                                            <span class="reply">
                                                                                                @if(isset(Auth::user()->id))
                                                                                                    @if($reply->added_by->id == Auth::user()->id)
                                                                                                        <a href=""
                                                                                                           id="{{$reply->id}}"
                                                                                                           data-toggle="modal"
                                                                                                           data-target="#exampleModalc"
                                                                                                           class="edit_btn"><i
                                                                                                                    class="fa fa-pencil ico-r"></i></a>
                                                                                                        <form id="{{'my_form'.$reply->id}}"
                                                                                                              style="display: inline-block;"
                                                                                                              method="post"
                                                                                                              action="{{url('/events/delete/comment/'.$event->id.'/'.$reply->id)}}">
                                                                                                        {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                                                                            <input type="hidden"
                                                                                                                   name="comment_id"
                                                                                                                   value="{{$reply->id}}">
                                                                                                        <a style="cursor: pointer"
                                                                                                           onclick="submit_form('{{'my_form'.$reply->id}}')"><i
                                                                                                                    class="fa fa-trash-o ico-r"
                                                                                                                    aria-hidden="true"></i></a>
                                                                                                        </form>
                                                                                                    @endif
                                                                                                @endif
                                                                                                <div  class="dsc-comments flo-right text-right ">
                                                    <h4><a href="{{url('profile/preview/'.$comment->added_by->id)}}">{{$reply->added_by->name}}</a></h4>
                                                    <span class="date"><i class="fa fa-calendar-check-o"
                                                                          aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$comment->created_at)))}}</span>
                                                    <p>{{$reply->comment}}</p>
                                                </div>
                                                                                            </span>


                                            </div>
                                        </div>

                                    @endforeach

                                </li>
                            @endforeach

                        </ul>
                    </div>

                    <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 flo-right leave-comments-area">
                        <h4 id="scroll_comm" class="title-bg"> اترك تعليقك</h4>
                        <form method="post"
                              action="{{url('/events/add/comment/'.$event->id)}}">
                            {!! csrf_field() !!}
                            <fieldset>

                                <div class="form-group">
                                    <label>اكتب تعليقك هنا </label>

                                    <textarea style="direction:rtl;" cols="40" rows="10" name="comment"
                                              class="textarea form-control txtarea1-hi"></textarea>
                                </div>
                                <div class="form-group">
                                    <button class="btn-send" type="submit"> تأكيد</button>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                </div>
            </div>
        </div>
    </div>
    <!-- Blog Details Page end here -->
    <!-- edit Modal -->
    <div class="modal fade" id="exampleModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title flo-right" id="exampleModalLabel">تعديل التعليق </h5>
                    <button type="button" class="close flo-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="edit_comment" method="post" action="{{url('/events/edit/comment/')}}">
                    {!! csrf_field() !!}
                    <div class="modal-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div style="text-align: center" id="validation-errors"></div>
                                <label for="exampleFormControlTextarea1" style="float: right"> تعليقك </label>
                                <textarea style="direction:rtl;" class="form-control hei-85"
                                          id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                        <button class="btn btn-primary"> حفظ</button>
                        <input type="hidden" id="comm_id">
                        <input type="hidden" id="customURL" value="{{url('events/'.$event->id.'/#scroll')}}">
                    </div>
                </form>
            </div>
        </div>
    </div>


@endsection

@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if ($errors->any())

        @foreach ($errors->all() as $error)
        toastr.error("{{$error}}");
        @endforeach
        @endif
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function submit_form($frm_id) {
            var res = confirm('هل انت متأكد من حذف هذا التعليق ؟ ');
            if (res) {
                document.getElementById($frm_id).submit()
            }
        }

        $(document).ready(function () {

            $('.edit_btn').click(function () {
                $('#comm_id').val(this.id);
            });

            if (window.location.hash != null && window.location.hash != '') {
                var myTarget = document.querySelector('#scroll');
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop + 400, 10)}, 1000);
            }

            $("form#edit_comment").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('commentID', $('#comm_id').val());
                var url = $('#edit_comment').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت التعديل بنجاح </div>');
                        $('#edit_comment')[0].reset();

                        setTimeout(function () {
                            window.location.href = $('#customURL').val();
                        }, 1000);

                    }, error: function (xhr) {

                        var err = xhr.responseJSON.error;
                        // $('#validation-errors').html('<div class="alert alert-danger">' + err + '</div>');

                        $('#validation-errors').html('');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                        });

                        $("#exampleModal2").animate({scrollTop: 0}, "slow");

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>

    <script>
        (function (d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id))
                return;
            js = d.createElement(s);
            js.id = id;
            js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.3&appId=846581989017642";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));

        function fb_share(dynamic_link, dynamic_title) {
            var app_id = '846581989017642';
            var pageURL = "https://www.facebook.com/dialog/feed?app_id=" + app_id + "&link=" + dynamic_link;
            var w = 600;
            var h = 400;
            var left = (screen.width / 2) - (w / 2);
            var top = (screen.height / 2) - (h / 2);
            window.open(pageURL, dynamic_title, 'toolbar=no, location=no, directories=no, status=no, menubar=yes, scrollbars=no, resizable=no, copyhistory=no, width=' + 800 + ', height=' + 650 + ', top=' + top + ', left=' + left);
            return false;
        }
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

@endsection