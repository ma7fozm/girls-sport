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
                            <h3 class="title-bg "> المقالات </h3>
                        </div>
                    </div>

                    @if(count($articles) > 0)

                        @foreach($articles as $article)
                            <div class="row">
                                <ul>
                                    <li>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                            <div class="carousel-inner">
                                                <div class="blog-image">
                                                    <a><img style="width: 360px; height: 263px;"
                                                            src="{{asset('/'.$article->image)}}"
                                                            alt="category photo"></a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                            <h3>
                                                <a href="{{url('article-details/'.$article->id)}}">{{$article->title}}</a>
                                            </h3>
                                            <span class="date "><i class="fa fa-calendar-check-o flo-right"
                                                                   aria-hidden="true"></i> {{\Arabicdatetime::date(strtotime(@$article->created_at) , 0 , 'j M Y'  ,'indian')}} </span>
                                            <span class="date"><i class="fa fa-comment-o"
                                                                  aria-hidden="true"></i>  {{count($article->comments)}}</span>
                                            <p>{{$article->intro}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        @endforeach

                    @else
                        <div style="text-align: center;border: dashed">
                        <span style="vertical-align: middle;padding: 20px;"> لا توجد مقالات </span>
                        </div>
                    @endif

                    <div class="row flo-right">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div class="pagination-area">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                    <div style="text-align: center">
                                        {{ $articles->links('pagination.customPagination') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        @auth
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn-send btnn" type="submit" data-toggle="modal"
                                            data-target="#exampleModal" data-whatever="@mdo">أضف مقال
                                    </button>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- modal add article start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_modal flo-left" data-dismiss="modal"
                            aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف مقال</h4>
                </div>
                <div class="modal-body">

                    <div class="single-blog-page-area contact-page-area pt">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div style="text-align: center;display: none" id="validation-errors"></div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف مقال</h3>

                                    <form id="add_article" role="form" enctype="multipart/form-data" method="post"
                                          action="{{url('articles')}}" class="ls_form">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="row ">
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>عنوان المقال</label>
                                                        <input type="text" name="title" class="form-control" required
                                                               oninvalid="setCustomValidity('من فضلك ادخل عنوانا للمقال')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>مقدمة المقال </label>
                                                        <input type="text" name="intro" class="form-control" required
                                                               oninvalid="setCustomValidity('من فضلك ادخل مقدمة للمقال')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>محتوي المقال </label>
                                                        <textarea cols="12" name="articleContent" rows="5" required
                                                                  oninvalid="setCustomValidity('من فضلك ادخل محتوى المقال')"
                                                                  oninput="this.setCustomValidity('')"
                                                                  class="textarea form-control txtarea1-hi"></textarea>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>حدد الفئة</label>
                                                        <select name="category_id" class="form-control" required
                                                                oninvalid="setCustomValidity('من فضلك حدد تصنيف المقال')"
                                                                oninput="this.setCustomValidity('')">
                                                            <option value="">اختر</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>أضف مقال الى</label>
                                                        <select id="drop" name="belongTo" class="form-control" required
                                                                oninvalid="setCustomValidity('من فضلك حدد الفئة المراد اضافة المقال لها')"
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

                                                <div class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="articleImg" id="image1"
                                                               accept=".gif, .jpg, .png" required
                                                               oninvalid="setCustomValidity('من فضلك اختر صورة المقال')"
                                                               oninput="this.setCustomValidity('')"/>
                                                        <label for="image1">
                                                            <span>تحميل صورة المقال</span>
                                                            <i class="fa fa-plus-circle"></i>
                                                        </label>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="row">

                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button class="btn-send">تأكيد</button>
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
    <!-- modal add article end-->

@endsection

@section('scripts')

    <script>

        $(document).ready(function () {

            $('#add_article')[0].reset();
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
                $('#add_article')[0].reset();
            });

            $("form#add_article").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $('#add_article').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة المقال بنجاح </div>').slideDown();
                        $('#add_article')[0].reset();

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

            if (window.location.hash != null && window.location.hash != '') {
                var myTarget = document.querySelector('#scroll');
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop - 70, 10)}, 1000);
            }
        });

    </script>

@endsection