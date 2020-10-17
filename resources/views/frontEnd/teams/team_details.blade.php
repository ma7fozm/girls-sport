@extends('frontEnd.master')

@section('css')

    <link rel="stylesheet" href="{{url('/')}}/assets/swal2/sweetalert2.min.css" type="text/css"/>

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
                                    تفاصيل الفريق
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> تفاصيل الفريق</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!--    about sports start-->
    <div class="home-about-area">
        <div class="container">

            <div id="scroll" class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <img src="{{asset('/'.$team->slogan)}}"
                             class="flo-right player-im">
                        <h2 class="title2 text-right mt-25">{{$team->name}}</h2>
                    </div>

                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">
                        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <div style="width: 113px;" class="form-group">
                                @guest
                                    <a href="{{url('/login')}}"
                                       class="btn-send bt-plus" id="plus"> انضم </a>
                                @else
                                    @if(count(@$team->authUser) == 0)
                                        <a href="{{url('teams/join/'.$team->id)}}"
                                           class="btn-send bt-plus confirmation" id="plus"> انضم </a>
                                    @elseif(count(@$team->authUser) >= 0 && @$team->authUser->first()->pivot->status == 0)
                                        <a href="{{url('teams/disJoin/'.$team->id)}}"
                                           class="btn-send bt-minus confirmation" id="minus"> الغاء </a>
                                    @else
                                        <a href="{{url('teams/disJoin/'.$team->id)}}"
                                           class="btn-send bt-minus confirmation" id="minus"> الغاء </a>
                                    @endif
                                @endguest
                            </div>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10 text-right">
                            <h3>{{$team->name}}</h3>
                        </div>
                        <p>{{$team->description}}</p>
                        @auth
                            @if(Auth::user()->id == $team->admin_id)
                                <div class="">
                                    <div class="">
                                        <div class="form-group">
                                            <button class="btn-send btnn add_group_btn flo-left" type="submit"
                                                    style="margin-bottom: 10px;"
                                                    data-toggle="modal" data-target="#exampleModal2" data-whatever="@mdo">
                                                أضف مجموعة
                                            </button>
                                            <input type="hidden" id="team_id" value="{{$team->id}}">
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p><img src="{{asset('/'.$team->slogan)}}" alt=""
                                class="new-hei"></p>

                    </div>

                </div>

            </div>
        </div>

    </div>
    <!--    about sports end-->
    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
        @if(count($users)>0)
            <!-- players start-->
                <div id="scroll_mem" class="row">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الأعضاء </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                        @foreach($users as $user)
                            <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12 flo-right">
                                <img src="{{asset('/'.$user->image)}}"
                                     class="col-lg-4 col-md-4 col-sm-4 col-xs-4 flo-right player-im">
                                <h4 class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right mt-25 flo-right"><a
                                            href="{{url('profile/preview/'.$user->id)}}">{{$user->name}} </a></h4>
                                @auth
                                @if(Auth::user()->id == $team->admin_id)
                                    <a id="plus" class="confirmation_del"
                                       href="{{url('teams/delete/user/'.$team->id.'/'.$user->id)}}">
                                        <i class="fa fa-times ico-r col-lg-2 col-md-2 col-sm-2 col-xs-2 mt-25"
                                           aria-hidden="true"></i></a>
                                @endif
                                    @endauth
                            </div>
                        @endforeach
                    </div>

                </div>
                <!--players ends-->
        @endif

        @if(count($groups)>0)
            @auth
                @if(count($team->authUser) > 0)
                    <!-- Category Page Start Here -->
                        <div class="blog-page-area gallery-page category-page ">
                            <div class="container">
                                <div id="scroll_group" class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
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
                                                            <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                                                <ul class="border-clo">
                                                                    <li>
                                                                        <div style="margin-top: 20px;" class="col-sm-2">
                                                                            <div class="form-group">
                                                                                @if(count(@$group->authUser) == 0)
                                                                                    <a href="{{url('groups/join/'.$group->id)}}"
                                                                                       class="btn-send bt-plus confirmation_add"
                                                                                       id="plus"><i class="fa fa-plus"
                                                                                                    aria-hidden="true"></i></a>
                                                                                @elseif(count(@$group->authUser) >= 0 && @$group->authUser->first()->pivot->status == 0)
                                                                                    <a href="{{url('groups/disJoin/'.$group->id)}}"
                                                                                       class="btn-send bt-minus confirmation_add"
                                                                                       id="minus"><i class="fa fa-minus"
                                                                                                     aria-hidden="true"></i></a>
                                                                                @else
                                                                                    <a href="{{url('groups/disJoin/'.$group->id)}}"
                                                                                       class="btn-send bt-minus confirmation_add"
                                                                                       id="minus"><i class="fa fa-minus"
                                                                                                     aria-hidden="true"></i></a>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                                            <div class="blog-image">
                                                                                <img style="width: 142px; height: 119px"
                                                                                     src="{{asset('/'.$group->image_url)}}"
                                                                                     alt="Blog photo"
                                                                                     srcset="images/blog/1.1.jpg 2x">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">

                                                                            <h3><a href="">{{$group->name}}</a></h3>
                                                                            <span class="admin"><i class="fa fa-user-o"
                                                                                                   aria-hidden="true"></i> {{$group->added_by->name}}</span>
                                                                            <span class="like"><i class="fa fa-users"
                                                                                                  aria-hidden="true"></i> {{count($group->users)}} </span>

                                                                        </div>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endif
            @endauth
        @endif
        <!--team sport end-->

            <div class="container">
                    @if(count($images)>0)
                        <div class="blog-page-area gallery-page gellary-area">
                            <div class="row">
                                <div class="view-area">
                                    <div class="col-sm-12 text-right">
                                        <h3 class="title-bg "> الصور </h3>
                                    </div>
                                </div>
                                @foreach($images as $image)
                                    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 flo-right mb-30">
                                        <div class="single-gellary">
                                            <div class="image">
                                                <img style="width: 253px; height: 350px;"
                                                     src="{{asset('/'.$image->media_link)}}" alt="">
                                                <div class="overley">
                                                </div>
                                            </div>
                                            <div class="gellary-informations dir">
                                                <ul>
                                                    <li>
                                                        <h3>
                                                            <a href="{{url('gallary-details/'.$image->id)}}">{{$image->title}}</a>
                                                        </h3>
                                                        <span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"> </i> {{\Arabicdatetime::date(strtotime(@$image->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                                        <i class="fa fa-comments"
                                                           aria-hidden="true"></i> {{count($image->comments)}}</li>
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
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    @for($i=1 ; $i< count($videos);$i+=2)
                                        <div class="row dir">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div class="carousel-inner">
                                                            <div class="blog-image">
                                                                <iframe width="320" height="240" src="http://www.youtube.com/embed/{{$videos[$i]['media_link']}}" frameborder="0" allowfullscreen></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                                                        <h3><a href="{{url('video-details/'.$videos[$i]['id'])}}">{{$videos[$i]['title']}}</a></h3>
                                                        <span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime(@$videos[$i]['created_at']) , 0 , 'j M Y'  ,'indian')}}</span>
                                                        <span
                                                                class="like"><i class="fa fa-comment-o"
                                                                                aria-hidden="true"></i> {{count($videos[$i]->comments)}} </span>
                                                        <p>{{$videos[$i]['description']}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endfor

                                </div>
                                <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

                                    @for($i=0 ; $i< count($videos);$i+=2)
                                        <div class="row dir">
                                            <ul>
                                                <li>
                                                    <div class="col-lg-7 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                        <div class="carousel-inner">
                                                            <div class="blog-image">
                                                                  <iframe width="320" height="240" src="http://www.youtube.com/embed/{{$videos[$i]['media_link']}}" frameborder="0" allowfullscreen></iframe>
                                                                                                                          </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-6 col-sm-6 col-xs-12 ">
                                                        <h3><a href="{{url('video-details/'.$videos[$i]['id'])}}">{{$videos[$i]['title']}}</a></h3>
                                                        <span class="date"><i class="fa fa-calendar-check-o"
                                                                              aria-hidden="true"></i>{{\Arabicdatetime::date(strtotime(@$videos[$i]['created_at']) , 0 , 'j M Y'  ,'indian')}}</span>
                                                        <span class="date"><i class="fa fa-comment-o"
                                                                                aria-hidden="true"></i> {{count($videos[$i]->comments)}} </span>
                                                        <p>{{$videos[$i]['description']}}</p>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    @endfor

                                </div>

                            </div>

                        </div>
                    @endif

            @if(count($articles)>0)
                <!-- latest news Start Here -->
                    <div class="row">
                        <div class="view-area">
                            <div class="row">
                                <div class="col-sm-12 ">
                                    <h3 class="title-bg flo-right">المقالات </h3>
                                </div>

                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12 tab-home flo-right">
                            <!-- Featured News Start here-->

                            <div class="tab-content featured-all">
                                <div id="featured1" class="tab-pane fade in active">
                                    <div class="tab-bottom-content">
                                        @foreach($articles as $article)
                                            <div class="row">
                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                    <div class="news-box">
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding flo-right">
                                                            <img style="width: 370px; height: 325px;" src="{{asset('/'.$article->image)}}" alt=""></a>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 images-padding">
                                                            <div class="dsc pa-dec">
                                                                <a class="more-btn">{{$article->category->name}}</a>
                                                                <br/>
                                                                <h4><a href="#"> {{$article->title}} </a>
                                                                </h4>
                                                                <span class="date"><i
                                                                            class="fa fa-calendar-check-o flo-right"
                                                                            aria-hidden="true"> </i>{{\Arabicdatetime::date(strtotime(@$article->created_at) , 0 , 'j M Y'  ,'indian')}}</span>
                                                                <p>{{$article->intro}}</p>
                                                                <ul class="author-all">
                                                                    @if($article->public == 1)
                                                                        <li class="flo-right"><a
                                                                                    href="{{url('/profile/preview/'.$article->added_by_admin->id)}}"> {{$article->added_by_admin->name}} </a>
                                                                        </li>
                                                                    @else
                                                                        <li class="flo-right"><a
                                                                                    href="{{url('/profile/preview/'.$article->added_by_user->id)}}"> {{$article->added_by_user->name}} </a>
                                                                        </li>
                                                                    @endif
                                                                    <li class="dir">
                                                                        <a href="#" class="comment"><i
                                                                                    class="fa fa-comment-o"
                                                                                    aria-hidden="true"></i> {{count($article->comments)}}
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 sidebar-home">
                            <!-- Blog Single Sidebar Start Here -->
                            @if(count($matchs)>0)
                                <div class="sidebar-area home-sidebar">

                                    <div class="club-rankng">
                                        <h3 class=" text-right"> الإنجازات</h3>
                                        <div id="club-rankng" class="inner owl-carousel ">
                                            <div class="item dir">
                                                <ul>
                                                    @foreach($matchs as $match)
                                                        <li>
                                                            <table>
                                                                <tr>
                                                                    <td>{{$match->title}}</td>
                                                                    <td>{{$match->result}}</td>
                                                                </tr>
                                                            </table>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
            <div style="text-align: center">
                @if($max_length == 'img')
                    {{ $images->links('pagination.customPagination') }}
                @elseif($max_length == 'vid')
                    {{ $videos->links('pagination.customPagination') }}
                @elseif($max_length == 'us')
                    {{ $users->links('pagination.customPagination') }}
                @elseif($max_length == 'art')
                    {{ $articles->links('pagination.customPagination') }}
                @elseif($max_length == 'mat')
                    {{ $matchs->links('pagination.customPagination') }}
                @elseif($max_length == 'gro')
                    {{ $groups->links('pagination.customPagination') }}
                @endif
            </div>

        </div>
    </div>

    <!-- modal add group start-->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close_modal flo-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title flo-right" id="exampleModalLabel">أضف مجموعة</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group col-md-12">
                        <div style="text-align: center;display: none" id="validation-errors1"></div>
                    </div>
                    <div class="single-blog-page-area contact-page-area pt">

                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                <div class="leave-comments-area ">
                                    <h3> أضف مجموعة</h3>

                                    <form id="add_group" role="form" enctype="multipart/form-data" method="post"
                                          action="{{url('/teams/add/group')}}"
                                          class="ls_form">
                                        {!! csrf_field() !!}
                                        <fieldset>
                                            <div class="row ">
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>أسم المجموعة</label>
                                                        <input type="text" name="group_name" class="form-control"
                                                               required
                                                               oninvalid="setCustomValidity('من فضلك قم بادخال اسم المجموعة')"
                                                               oninput="this.setCustomValidity('')">
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 flo-right">
                                                    <div class="form-group">
                                                        <label>وصف المجموعة</label>
                                                        <textarea cols="12" name="description" rows="5"
                                                                  class="textarea form-control txtarea2-hi" required
                                                                  oninvalid="setCustomValidity('من فضلك قم بادخال وصف للمجموعة')"
                                                                  oninput="this.setCustomValidity('')"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6 flo-right">
                                                    <div class="wrap-custom-file">
                                                        <input type="file" name="groupImg" id="image1"
                                                               accept=".gif, .jpg, .png" required
                                                               oninvalid="setCustomValidity('من فضلك قم باختيار صورة للمجموعة')"
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
                                                        <button class="btn-send">تأكيد</button>
                                                        <button type="button" class=" btn-send close_modal"
                                                                data-dismiss="modal">إغلاق
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
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

    <script>

        $(document).ready(function () {
            if (window.location.hash != null && window.location.hash != '') {
                var type = window.location.hash.substr(1);
                var myTarget = document.querySelector('#' + type);
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop - 70, 10)}, 1000);
            }
        });

    </script>

    <script>

        $(document).ready(function () {

            $('#add_group')[0].reset();

            $(".add_group_btn").click(function () {
                $('#validation-errors1').html('');
                $('#validation-errors1').hide();
            });

            $(".close_modal").click(function () {
                $('#add_group')[0].reset();
            });

            $("form#add_group").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('teamID', $('#team_id').val());
                var url = $('#add_group').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors1').html('<div class="alert alert-success"> تمت اضافة المجموعة بنجاح </div>').slideDown();
                        $('#add_group')[0].reset();

                        $("#exampleModal2").animate({scrollTop: 0}, "slow");

                        setTimeout(function () {
                            $('#validation-errors1').slideUp();
                        }, 2000);

                    }, error: function (xhr) {

                        var err = xhr.responseJSON.error;
                        // $('#validation-errors').html('<div class="alert alert-danger">' + err + '</div>');

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
        });

    </script>

    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الانضمام الى هذا الفريق ومشاركة جميع احداثه',
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

    <script type="text/javascript">
        $('.confirmation_del').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد من الحذف؟',
                    text: '! هل تود حقا حذف هذا العضو نهائيا من الفريق',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم !',
                    cancelButtonText: 'لا !',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم حذف العضو من الفريق !",
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
                        text: "تم الغاء الحذف :)",
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

    <script type="text/javascript">
        $('.confirmation_add').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الانضمام الى تلك المجموعة ومشاركة جميع احداثها',
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
                    text: '! هل تود حقا الغاء طلب الانضمام لهذه المجموعة',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الالغاء !",
                        text: "تم الغاء طلب انضمامكم للمجموعة",
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