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
                                    </a>
                                    الملف الشخصي
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


                    <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                        <div class="view-area mt-42" style="margin-right: -13px;">
                            <div class="col-sm-12 text-right">
                                <h3 class="title-bg "> الصور </h3>
                            </div>
                        </div>
                        <div class="blog-page-area gallery-page gellary-area">
                            <div class="row">
                                @if(count($images)>0)
                                    @foreach($images as $image)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                            <div class="single-gellary">
                                                <div class="image">
                                                    <img style="width: 220px;height: 350px;"
                                                         src="{{asset('/'.$image->media_link)}}" alt="">
                                                    <div class="overley">
                                                    </div>
                                                </div>
                                                <div class="gellary-informations dir">
                                                    <ul>
                                                        <li>
                                                            <a href="images/gallery2/1.jpg" data-lightbox="example-set"
                                                               data-title=""></a>
                                                            <h3>
                                                                <a href="{{url('gallary-details/'.$image->id)}}">{{$image->title}}</a>
                                                            </h3>
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"> </i> {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime($image->created_at)))}} </span>
                                                            <i class="fa fa-comments"
                                                               aria-hidden="true"></i> {{count($image->comments)}}

                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right:13px">
                                        <span style="vertical-align: middle;padding: 20px;"> لا توجد صور </span>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="blog-page-area gallery-page category-page">

                            {{--                        @if(count($videos)>0)--}}
                            <div class="row">
                                <div class="view-area">
                                    <div class="col-sm-12 text-right">
                                        <h3 class="title-bg "> الفيديوهات </h3>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    @if(count($videos)>0)
                                        @foreach($videos as $video)
                                            <div class="row dir">
                                                <ul>
                                                    <li>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                            <div class="carousel-inner">
                                                                <div class="blog-image">
                                                                    <div class="videos-icon">
                                                                        <a class="popup-videos"
                                                                           href="{{$video->media_link}}">
                                                                            <i class="fa fa-caret-right"
                                                                               aria-hidden="true"></i>
                                                                        </a>
                                                                    </div>
                                                                    <img src="{{asset('design/frontEnd')}}/images/category/2.jpg"
                                                                         alt="category photo">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                            <h3>
                                                                <a href="{{url('video-details/'.$video->id)}}">{{$video->title}}</a>
                                                            </h3>
                                                            <span class="date"><i class="fa fa-calendar-check-o"
                                                                                  aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime($video->created_at)))}}</span>
                                                            <span class="like"><a><i class="fa fa-comment-o"
                                                                                     aria-hidden="true"></i>  {{count($video->comments)}} </a></span>
                                                            <p>{{$video->description}}</p>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endforeach
                                    @else
                                        <div style="text-align: center;border: dashed">
                                            <span style="vertical-align: middle;padding: 20px;"> لا توجد فيديوهات </span>
                                        </div>
                                    @endif
                                    {{--@endif--}}

                                </div>

                            </div>

                            @auth
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn-send btnn" type="submit" data-toggle="modal"
                                                    data-target="#exampleModal" data-whatever="@mdo">أضف صورة / فيديو
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                        @endauth

                    </div>

            </div>
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                <div style="text-align: center">
                    @if($max_length == 'img')
                        {{ $images->links('pagination.customPagination') }}
                    @else
                        {{ $videos->links('pagination.customPagination') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- modal add img/vid start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_modal flo-left" data-dismiss="modal"
                            aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف صورة / فيديو</h4>
                </div>
                <div class="modal-body">
                    <div class="single-blog-page-area contact-page-area pt">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div style="text-align: center;display: none" id="validation-errors"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف صورة / فيديو</h3>

                                    <form id="media_data" role="form" enctype="multipart/form-data" method="post"
                                          action="{{url('media')}}" class="ls_form">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="row ">
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>العنوان </label>
                                                        <input type="text" name="title" class="form-control" required
                                                               oninvalid="setCustomValidity('من فضلك ضع عنوانا للميديا')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>الوصف </label>
                                                        <textarea cols="12" name="description" rows="5"
                                                                  class="textarea form-control txtarea1-hi" required
                                                                  oninvalid="setCustomValidity('من فضلك ضع وصفا الميديا')"
                                                                  oninput="this.setCustomValidity('')"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>أضف ميديا الى</label>
                                                        <select id="drop" name="belongTo" class="form-control" required
                                                                oninvalid="setCustomValidity('من فضلك حدد الفئة المراد اضافة الميديا لها')"
                                                                oninput="this.setCustomValidity('')">
                                                            <option value="profile">الملف الشخصى</option>
                                                            @if(count($groups)>0)
                                                                <option value="group">مجموعة</option>
                                                            @endif
                                                            @if(count($teams)>0)
                                                                <option value="team">فريق</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="group_div" class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>حدد المجموعة</label>
                                                        <select name="group_id" class="form-control">
                                                            <option value="">اختر</option>
                                                            @foreach($groups as $group)
                                                                <option value="{{$group->id}}">{{$group->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="team_div" class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>حدد الفريق</label>
                                                        <select name="team_id" class="form-control">
                                                            <option value="">اختر</option>
                                                            @foreach($teams as $team)
                                                                <option value="{{$team->id}}">{{$team->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right mb-20">
                                                    <label class="radio-inline flo-right"
                                                           style="padding-right: 21px; margin-left: 30px;">
                                                        <input type="radio" value="img" name="optradio"
                                                               {{(old('optradio')=='img')?'checked':''}}
                                                               style="height: 22px; margin-bottom: 20px;    margin-right: -50px;">
                                                        صوره</label>
                                                    <label class="radio-inline flo-right">
                                                        <input type="radio" value="vid" name="optradio"
                                                               {{(old('optradio')=='vid')?'checked':''}}
                                                               style="height: 22px; margin-bottom: 20px; margin-right: -50px;">
                                                        فيديو</label>
                                                </div>

                                                <div id="vid_div" class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>لينك الفيديو </label>
                                                        <input type="text" name="video_link" class="form-control">
                                                    </div>
                                                </div>

                                                <div id="img_div" class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="media_file" id="image1"
                                                               accept=".jpg,.png,.jpeg,.gif,.tif,.tiff"/>
                                                        <label for="image1">
                                                            <span>اضافة صورة</span>
                                                            <i class="fa fa-plus-circle"></i>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button class="btn-send" type="submit">تأكيد</button>
                                                        <button class="btn-send close_modal" data-dismiss="modal">
                                                            اغلاق
                                                        </button>
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
    <script>

        $(document).ready(function () {

            $('#vid_div').hide();
            $('#img_div').hide();
            $("input[name='optradio']:checked").val('img');
            var radioValue = $("input[name='optradio']:checked").val();

            if (radioValue == 'img') {
                $('#vid_div').hide();
                $('#img_div').slideDown();
            } else if (radioValue == 'vid') {
                $('#img_div').hide();
                $('#vid_div').slideDown();
            }

            $('input[type=radio][name=optradio]').change(function () {
                if (this.value == 'img') {
                    $('#vid_div').hide();
                    $('#img_div').slideDown();
                } else if (this.value == 'vid') {
                    $('#img_div').hide();
                    $('#vid_div').slideDown();
                }
            });


            $('#media_data')[0].reset();
            $('#group_div').hide();
            $('#team_div').hide();

            $('#drop').on('change', function () {
                if (this.value == 'team') {
                    $('#group_div').slideUp();
                    $('#team_div').slideDown();
                } else if (this.value == 'group') {
                    $('#team_div').slideUp();
                    $('#group_div').slideDown();
                } else {
                    $('#team_div').slideUp();
                    $('#group_div').slideUp();
                }
            });

            if ($('#drop').val() == 'team') {
                $('#team_div').slideDown();
                $('#group_div').slideUp();
            } else if ($('#drop').val() == 'group') {
                $('#team_div').slideUp();
                $('#group_div').slideDown();
            } else {
                $('#team_div').hide();
                $('#group_div').hide();
            }


            $(".close_modal").click(function () {
                $('#media_data')[0].reset();
            });

            $("form#media_data").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $('#media_data').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة الميديا بنجاح </div>').slideDown();
                        $('#media_data')[0].reset();

                        $("#exampleModal").animate({scrollTop: 0}, "slow");

                        setTimeout(function () {
                            $('#validation-errors').slideUp();
                        }, 2000);

                    }, error: function (xhr) {

                        var err = xhr.responseJSON.error;
                        // $('#validation-errors').html('<div class="alert alert-danger">' + err + '</div>');

                        $('#validation-errors').html('');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>').slideDown();
                        });

                        $("#exampleModal").animate({scrollTop: 0}, "slow");

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });

    </script>
@endsection
