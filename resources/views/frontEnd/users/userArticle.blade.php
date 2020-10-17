@extends('frontEnd.master')

@section('css')
    <style>
    </style>

@endsection

@section('content')

    <!--Header area end here-->
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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>
                                    المقالات
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>{{Auth::user()->name}}</h1>
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
                        <figure><img style="width: 360px;height: 355px;" class="img-responsive"
                                     src="{{asset('storage/upload/images/'.Auth::user()->image)}}" alt=""></figure>

                        <div class="like-box-area">
                            <ul>
                                <li><a href="personal-info.html"><i class="fa fa-user-circle-o faa flo-right"
                                                                    aria-hidden="true"></i> <span class="like-page">البيانات الشخصية</span></a>
                                </li>
                                <li><a href="{{url('/articles')}}"><i class="fa fa-book faa flo-right"
                                                                      aria-hidden="true"></i> <span class="like-page">المقالات</span></a>
                                </li>
                                <li><a href="{{url('/teams')}}"><i class="fa fa-users faa flo-right"
                                                                   aria-hidden="true"></i> <span class="like-page">الفرق</span></a>
                                </li>
                                <li><a href="{{url('/media')}}"><i class="fa fa-image faa flo-right"
                                                                   aria-hidden="true"></i>
                                        <span class="like-page">مالتيميديا</span></a></li>

                                <li><a href="{{url('/groups')}}"><i class="fa fa-tags faa flo-right"
                                                                    aria-hidden="true"></i> <span class="like-page">المجموعات</span></a>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="row pa-50">
                        <ul>
                            <li>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                        <img src="{{asset('design/frontEnd')}}/images/category/3.jpg"
                                                             alt="category photo">
                                                    </a>
                                                </div>
                                                <div class="dsc">
                                                    <h3><a href="">Hackers Can Steal Your Financial Info With<br/> Your
                                                            Name and Email</a></h3>
                                                    <span class="date"> <i class="fa fa-calendar-check-o"
                                                                           aria-hidden="true"></i> Sep 13, 2017</span>
                                                    <span class="like"><a href="#"><i class="fa fa-comment-o"
                                                                                      aria-hidden="true"></i>  12 </a></span>
                                                </div>
                                            </div>
                                            <div class="item">
                                                <div class="blog-image">
                                                    <a href="">
                                                        <i class="fa fa-link" aria-hidden="true"></i>
                                                        <img src="{{asset('design/frontEnd')}}/images/category/6.jpg"
                                                             alt="category photo">
                                                    </a>
                                                </div>
                                                <div class="dsc">
                                                    <h3><a href="">Hackers Can Steal Your Financial Info With<br/> Your
                                                            Name and Email</a></h3>
                                                    <span class="date"><i class="fa fa-calendar-check-o"
                                                                          aria-hidden="true"></i> Sep 13, 2017</span>
                                                    <span class="like"><a href="#"><i class="fa fa-comment-o"
                                                                                      aria-hidden="true"></i>  12 </a></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>


                    @if(isset($articles))
                        @foreach($articles as $article)

                            <div class="row">
                                <ul style="border: 1px solid #ccc ; margin-bottom: 20px">
                                    <li>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                            <div class="carousel-inner">
                                                <div class="blog-image" style="margin-bottom: 0 !important; margin-top: 10px">
                                                    <a href="">
                                                        <i class="fa fa-trash-o" aria-hidden="true"></i>
                                                        <img style="height: 220px; width: 360px;"
                                                             src="{{asset('storage/upload/articleImages/'.$article->image)}}"
                                                             alt="{{$article->image}}">
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                                            <h3><a href="">{{$article->title}}</a></h3>
                                            <span class="date "><i class="fa fa-calendar-check-o "
                                                                   aria-hidden="true"></i> {{ \Arabicdatetime::date(strtotime(@$article->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                            <span class="like"><a href="#"><i class="fa fa-comment-o"
                                                                              aria-hidden="true"></i>  12 </a></span>
                                            <p>{{$article->intro}}</p>
                                        </div>
                                    </li>
                                </ul>
                            </div>

                        @endforeach

                    @endif


                    <div class="row">

                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn-send btnn" type="submit" data-toggle="modal"
                                        data-target="#exampleModal" data-whatever="@mdo">أضف مقال
                                </button>
                            </div>
                        </div>

                        <div style="text-align: center">

                        </div>
                    </div>

                </div>

            </div>
        </div>
        <div style="text-align: center">

            {{ $articles->links('pagination.customPagination') }}
        </div>
    </div>
    <!-- modal add article start-->

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close flo-left" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف مقال</h4>

                </div>
                <div class="modal-body">
                    <div class="single-blog-page-area contact-page-area pt">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف مقال</h3>

                                    <form id="article_data" method="post" enctype="multipart/form-data"
                                          action="{{url('articles')}}">
                                        {!! csrf_field() !!}

                                        <fieldset>
                                            <div class="row ">
                                                <div id="validation-errors"></div>
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>عنوان المقال</label>
                                                        <input type="text" name="title" class="form-control" required
                                                               oninvalid="setCustomValidity('من فضلك قم بادخال عنوان للمقال')"
                                                               oninput="this.setCustomValidity('')"
                                                        >
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>مقدمة المقال</label>
                                                        <input type="text" name="intro" class="form-control" required
                                                               oninvalid="setCustomValidity('من فضلك قم بادخال مقدمة للمقال')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>محتوي المقال </label>
                                                        <textarea cols="12" name="articleContent" rows="5"
                                                                  class="textarea form-control txtarea1-hi" required
                                                                  oninvalid="setCustomValidity('من فضلك قم بادخال محتوى المقال')"
                                                                  oninput="this.setCustomValidity('')"></textarea>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <div class="col-sm-12 flo-right">
                                                        <label>حدد الفئة</label>
                                                        <select id="cat_drop" style="margin-bottom: 10px;"
                                                                name="category_id" class="form-control">
                                                            <option value="0" selected>اختر...</option>
                                                            @foreach($categories as $category)
                                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        <label>اضف المقال الى : </label>

                                                        @if(count($groups)>0 && count($teams)==0)
                                                            <select id="drop" name="belongTo" class="form-control">
                                                                <option value="profile">ملفى الشخصى</option>
                                                                <option value="group">مجموعة</option>
                                                            </select>
                                                        @elseif(count($groups)==0 && count($teams)>0)
                                                            <select id="drop" name="belongTo" class="form-control">
                                                                <option value="profile">ملفى الشخصى</option>
                                                                <option value="team">فريق</option>
                                                            </select>
                                                        @elseif(count($groups)==0 && count($teams)==0)
                                                            <select id="drop" name="belongTo" class="form-control">
                                                                <option value="profile">ملفى الشخصى</option>
                                                            </select>
                                                        @else
                                                            <select id="drop" name="belongTo" class="form-control">
                                                                <option value="profile">ملفى الشخصى</option>
                                                                <option value="group">مجموعة</option>
                                                                <option value="team">فريق</option>
                                                            </select>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div id="groupDrop" class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        @if(count($groups)>0)
                                                            <label>اختر المجموعة المراد اضافة المقال لها : </label>
                                                            <select id="group_id" name="group_id" class="form-control">
                                                                <option value="0" selected>اختر...</option>
                                                                @foreach($groups as $group)
                                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <span style="color: #4c110f;">انت غير مشترك فى اى مجموعة</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div id="teamDrop" class="col-sm-12 flo-right">
                                                    <div class="form-group ">
                                                        @if(count($teams)>0)
                                                            <label>اختر الفريق المراد اضافة المقال له : </label>
                                                            <select id="team_id" name="team_id" class="form-control">
                                                                <option value="0" selected>اختر...</option>
                                                                @foreach($teams as $team)
                                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                            <span style="color: #4c110f;">انت غير مشترك فى اى فريق</span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="articleImg" id="image1"
                                                               accept=".gif, .jpg, .png" required
                                                               oninvalid="setCustomValidity('من فضلك قم باختيار صورة للمقال')"
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
                                                        <button id="add_article" class="btn-send">تأكيد</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>


                                    </form>

                                    <input type="hidden" id="customURL" name="customURL" value="{{url('/articles')}}" />
                                </div>

                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    {{--<!-- modal add article end-->--}}


@endsection
@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}")
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}")
        @endif
    </script>

    <script>
        $(document).ready(function () {
            $('#groupDrop').hide();
            $('#teamDrop').hide();
            $('#drop').val('profile');
            $('#cat_drop').val('0');
            $('#group_id').val('0');
            $('#team_id').val('0');
            $("#drop").change(function () {
                if (($('#drop').val()) == 'group') {
                    $('#groupDrop').slideDown();
                    $('#teamDrop').hide();
                } else if (($('#drop').val()) == 'team') {
                    $('#teamDrop').slideDown();
                    $('#groupDrop').hide();
                } else if (($('#drop').val()) == 'profile') {
                    $('#groupDrop').slideUp();
                    $('#teamDrop').slideUp();
                }
            });
        });
    </script>

    <script>
        $("form#article_data").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var url = $('#article_data').attr('action');
            $.ajax({
                url: url,
                // dataType: 'JSON',
                type: 'post',
                data: formData,
                success: function (data) {

                    $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة المقال بنجاح </div>');
                    $('#article_data')[0].reset();
                    $("#exampleModal").animate({ scrollTop: 0 }, "slow");

                    setTimeout(function() {
                        window.location.href = $('#customURL').val();
                    }, 1500);


                }, error: function (xhr) {

                    console.log(xhr);
                    var err = xhr.responseJSON.error;
                    $('#validation-errors').html('<div class="alert alert-danger">' + err + '</div>');

                    $("#exampleModal").animate({ scrollTop: 0 }, "slow");
                    // $("html, body").animate({ scrollTop: 0 }, "slow");

                    // $('#validation-errors').html('');
                    // $.each(xhr.responseJSON.errors, function(key,value) {
                    //     $('#validation-errors').append('<div class="alert alert-danger">'+value+'</div>');
                    // });

                },
                cache: false,
                contentType: false,
                processData: false
            });
            // return false;
        });

    </script>

@endsection