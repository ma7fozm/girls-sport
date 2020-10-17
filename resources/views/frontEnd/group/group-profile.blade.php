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

        .imp {
            background: #f2f2f2;
            border: 1px solid #b9b3b3;
            border-radius: 0;
            height: 25px !important;
            width: 100%;
            right: -13px;
            margin-top: 21px !important;
        }

        /*:required {*/

        /*border: 1px solid red !important;*/

        /*-moz-box-shadow: 0 0 2px red !important;*/

        /*-webkit-box-shadow: 0 0 2px red !important;*/

        /*box-shadow: 0 0 2px red !important;*/

        /*}*/

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
                                    </a> الملف الشخصي
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>{{$user->name}} </h1>
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
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 flo-right">
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

                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">


                    <div class="view-area mt-42">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> مجموعات المشاركة </h3>
                        </div>
                    </div>
                    <div class="blog-page-area">
                        <div class="">
                            @if(count($groups)>0)
                                @foreach($groups as $group)
                                    <div class="row mb-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

                                                            <h3>
                                                                <a href="{{url('groups/'.$group->id)}}">{{$group->name}}</a>
                                                            </h3>
                                                            <span class="admin"><i class="fa fa-user-o"
                                                                                   aria-hidden="true"></i> {{$group->added_by->name}}</span>
                                                            <span class="like"><i class="fa fa-users"
                                                                                  aria-hidden="true"></i> {{count($group->users)}} </span>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right: 14px;">
                                    <span style="vertical-align: middle;padding: 20px;"> لا توجد مجموعات </span>
                                </div>
                            @endif
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div class="pagination-area">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                            <div style="text-align: center">
                                                {{ $groups->links('pagination.customPagination') }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                        <div class="view-area mt-42">
                            <div class="col-sm-12 text-right">
                                <h3 class="title-bg "> مجموعات الادمن </h3>
                            </div>
                        </div>
                        <div class="blog-page-area">
                            <div class="">
                                @if(count($admin_groups)>0)
                                @foreach($admin_groups as $group)
                                    <div class="row mb-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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

                                                            <h3>
                                                                <a href="{{url('groups/'.$group->id)}}">{{$group->name}}</a>
                                                            </h3>
                                                            <span class="admin"><i class="fa fa-user-o"
                                                                                   aria-hidden="true"></i> {{$group->added_by->name}}</span>
                                                            <span class="like"><i class="fa fa-users"
                                                                                  aria-hidden="true"></i> {{count($group->users)}} </span>

                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                    @else
                                    <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right: 14px;">
                                        <span style="vertical-align: middle;padding: 20px;"> لا توجد مجموعات </span>
                                    </div>
                                @endif

                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                        <div class="pagination-area">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                                <div style="text-align: center">
                                                    {{ $groups->links('pagination.customPagination') }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    @auth
                        @if(Auth::user()->roles_id == 5)
                            @if(count($teams)>0 || count($sports)>0)
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn-send btnn" type="submit" data-toggle="modal"
                                                    data-target="#exampleModal" data-whatever="@mdo">أضف مجموعة
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    @endauth
                </div>

            </div>
        </div>
    </div>
    <!-- modal add group start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_modal flo-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف مجموعة</h4>
                </div>
                <div class="modal-body">
                    <div class="single-blog-page-area contact-page-area pt">

                        <div class="row">
                            <div class="form-group col-md-12">
                                <div style="text-align: center;display: none" id="validation-errors"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف مجموعة</h3>

                                    <form id="group_data" role="form" enctype="multipart/form-data" method="post"
                                          action="{{url('groups')}}" class="ls_form">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="row ">
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>أسم المجموعة</label>
                                                        <input type="text" name="group_name" class="form-control"
                                                               required
                                                               oninvalid="setCustomValidity('من فضلك ادخل اسم المجموعة')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>وصف المجموعة</label>
                                                        <textarea cols="12" name="description" rows="5"
                                                                  class="textarea form-control txtarea2-hi"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>أضف مجموعة الى</label>
                                                        <select id="drop" name="group_to" class="form-control" required
                                                                oninvalid="setCustomValidity('من فضلك حدد الفئة المراد اضافة المجموعة لها')"
                                                                oninput="this.setCustomValidity('')">
                                                            @if(count($sports)>0)
                                                                <option value="sport">رياضة</option>
                                                            @endif
                                                            @if(count($teams)>0)
                                                                <option value="team">فريق</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>

                                                <div id="sport_div" class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>حدد الرياضة</label>
                                                        <select name="sport_id" class="form-control">
                                                            <option value="">اختر</option>
                                                            @foreach($sports as $sport)
                                                                <option value="{{$sport->id}}">{{$sport->name}}</option>
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

                                                <div class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="groupImg" id="image1"
                                                               accept=".gif, .jpg, .png" required
                                                               oninvalid="setCustomValidity('من فضلك اختر صورة للمجموعة')"
                                                               oninput="this.setCustomValidity('')"/>
                                                        <label for="image1">
                                                            <span>تحميل صورة المجموعة</span>
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
    <!-- modal add group end-->

@endsection

@section('scripts')

    <script>

        $(document).ready(function () {

            $('#group_data')[0].reset();
            $('#sport_div').hide();
            $('#team_div').hide();

            $('#drop').on('change', function () {
                if (this.value == 'team') {
                    $('#sport_div').slideUp();
                    $('#team_div').slideDown();
                } else if (this.value == 'sport') {
                    $('#team_div').slideUp();
                    $('#sport_div').slideDown();
                } else {
                    $('#team_div').slideUp();
                    $('#sport_div').slideUp();
                }
            });

            if ($('#drop').val() == 'team') {
                $('#team_div').slideDown();
                $('#sport_div').slideUp();
            } else if ($('#drop').val() == 'sport') {
                $('#team_div').slideUp();
                $('#sport_div').slideDown();
            } else {
                $('#team_div').hide();
                $('#sport_div').hide();
            }


            $(".close_modal").click(function () {
                $('#group_data')[0].reset();
            });

            $("form#group_data").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $('#group_data').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة الجروب بنجاح </div>').slideDown();
                        $('#group_data')[0].reset();

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