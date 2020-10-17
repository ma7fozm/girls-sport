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
                            <h3 class="title-bg "> الفعاليات </h3>
                        </div>
                    </div>
                    <div class="blog-page-area">
                        <div class="">
                            @if(count($events)>0)
                                @foreach($events as $event)
                                    <div class="row mb-20">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                                <ul class="border-clo">
                                                    <li>
                                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                                                            <div class="blog-image">
                                                                <a>
                                                                    <img src="{{asset('/'.$event->image)}}"
                                                                         alt="Blog photo" class="img-hi">
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                                                            <h3>
                                                                <a href="{{url('events/'.$event->id)}}">{{$event->name}}</a>
                                                            </h3>
                                                            <span class="admin"><i class="fa fa-user-o"
                                                                                   aria-hidden="true"></i> {{$event->added_by->name}}</span>
                                                            <span class="like"><i class="fa fa-users"
                                                                                  aria-hidden="true"></i>  {{count($event->users)}} </span>

                                                        </div>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div style="text-align: center;border: dashed;margin-bottom: 40px;margin-right: 14px;">
                                    <span style="vertical-align: middle;padding: 20px;"> لا توجد فاعليات </span>
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="row flo-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="pagination-area">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                                <div style="text-align: center">
                                    {{ $events->links('pagination.customPagination') }}
                                </div>
         
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
                                 @auth
                @if(Auth::user()->roles_id == 5)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <button class="btn-send btnn" type="submit" data-toggle="modal"
                                        data-target="#exampleModal"
                                        data-whatever="@mdo">أضف فعاليه
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            @endauth
<!-- modal add event start-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="create_event" role="form" enctype="multipart/form-data" method="post"
                      action="{{url('/events/create')}}" class="ls_form">
                    {!! csrf_field() !!}
                    <div class="modal-header">
                        <button type="button" class="close flo-left close_modal1" data-dismiss="modal"
                                aria-label="Close"><span
                                    aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title flo-right" id="exampleModalLabel">أضف فاعلية</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12">
                            <div style="text-align: center;display: none" id="validation-errors"></div>
                        </div>
                        <div class="single-blog-page-area contact-page-area pt">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                    <div class="leave-comments-area ">
                                        <h3> أضف فاعلية</h3>

                                        <form>
                                            <fieldset>
                                                <div class="row ">
                                                    <div class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>أسم الفاعلية</label>
                                                            <input type="text" name="name" class="form-control" required
                                                                   oninvalid="setCustomValidity('من فضلك قم بادخال اسم الفاعلية')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 flo-right">
                                                        <div class="form-group ">
                                                            <label>تاريخ بدء الفاعلية </label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                   required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار تاريخ بداية الفاعليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 flo-right">
                                                        <div class="form-group ">
                                                            <label>تاريخ إنتهاء الفاعلية </label>
                                                            <input type="date" name="end_date" class="form-control"
                                                                   required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار تاريخ نهاية الفاعليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 ">
                                                        <div class="form-group ">
                                                            <label>عدد المشاركين </label>
                                                            <input type="text" name="num_of_attendees"
                                                                   class="form-control" required
                                                                   oninvalid="setCustomValidity('من فضلك قم بادخال عدد المشتركين فى الفاعليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>المكان</label>
                                                            <select name="place_id" class="form-control" required
                                                                    oninvalid="setCustomValidity('من فضلك اختر مكان الفاعلية')"
                                                                    oninput="this.setCustomValidity('')">
                                                                <option value="">اختر ...</option>
                                                                @foreach($places as $place)
                                                                    <option value="{{$place->id}}">{{$place->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>اضف فاعلية الى : </label>
                                                            <div class="col-sm-12 flo-right mb-20">
                                                                <label class="radio-inline flo-right" style="    padding-right: 21px;
    margin-left: 30px;">
                                                                    <input type="radio" name="event_type"
                                                                           style="height: 22px; margin-bottom: 20px;    margin-right: -57px;"
                                                                           value="group">
                                                                    مجموعة</label>
                                                                <label class="radio-inline flo-right">
                                                                    <input type="radio" name="event_type"
                                                                           style="height: 22px; margin-bottom: 20px;    margin-right: -50px;"
                                                                           value="team">
                                                                    فريق </label>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div id="group_div" class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>المجموعة</label>
                                                            <select name="group_id" class="form-control">
                                                                <option value="">اختر ...</option>
                                                                @foreach($groups as $group)
                                                                    <option value="{{$group->id}}">{{$group->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="team_div" class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>الفريق</label>
                                                            <select name="team_id" class="form-control">
                                                                <option value="">اختر ...</option>
                                                                @foreach($teams as $team)
                                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleFormControlTextarea1" style="float: right">
                                                            وصف
                                                            الفاعلية </label>
                                                        <textarea class="form-control hei-85"
                                                                  id="exampleFormControlTextarea1" name="agenda"
                                                                  rows="3" required
                                                                  oninvalid="setCustomValidity('من فضلك ادخل وصفا للفاعليه')"
                                                                  oninput="this.setCustomValidity('')"></textarea>

                                                    </div>

                                                    <div class="form-group col-md-12 dir mb-50">
                                                        <div class="wrap-custom-file">
                                                            <input type="file" name="eventImg" id="image1"
                                                                   accept=".gif, .jpg, .png" required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار صورة الفاعليه')"
                                                                   oninput="this.setCustomValidity('')"/>
                                                            <label for="image1">
                                                                <span>Upload Photo  </span>
                                                                <i class="fa fa-plus-circle"></i>
                                                            </label>
                                                        </div>
                                                    </div>

                                                </div>

                                                <div class="row">

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <button class="btn-send">تأكيد</button>
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
                </form>
            </div>

        </div>
    </div>
    <!-- modal add event end-->
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

            
      
            $('#team_div').hide();
            $('#group_div').hide();
            $('input[type=radio][name=event_type]').prop('checked', false);

            $('input[type=radio][name=event_type]').change(function () {
                if (this.value == 'group') {
                    $('#team_div').hide();
                    $('#group_div').slideDown('1500');
                } else if (this.value == 'team') {
                    $('#group_div').hide();
                    $('#team_div').slideDown('1500')
                }
            });


            $("form#create_event").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                var url = $('#create_event').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة الفاعلية بنجاح </div>').slideDown();
                        $('#create_event')[0].reset();

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