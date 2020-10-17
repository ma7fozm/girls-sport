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

@section('search')
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="search">
            <div class="search-wrap">
                <div class="search-input-elm">
                    <input name="query" class="search-input" type="text" placeholder="ابحث هنا .."/>

                    {{--<input type='hidden' name='models[]' value='App\News'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Media'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Match'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    <input type='hidden' name='models[]' value='App\Event'>
                    <input type='hidden' name='col_name[]' value='name'>

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
    <!-- Blog Page Start Here -->
    <div class="blog-page-area">
        <div class="container">
            <div id="scroll" class="row mb-20 mt-20">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> الفعاليات </h3>
                        </div>
                    </div>

                    @if(count($events)>0)
                        @foreach($events as $event)
                            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 flo-right">
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
                                                @if(Auth::user())
                                                    @if(count(@$event->authUser) == 0)
                                                        <a href="{{url('events/join/'.$event->id)}}"
                                                           class="btn-send bt-plus confirmation"
                                                           id="plus">انضم</a>
                                                    @elseif(count(@$event->authUser) >= 0 && @$event->authUser->first()->pivot->status == 0)
                                                        <a href="{{url('events/disJoin/'.$event->id)}}"
                                                           class="btn-send bt-minus confirmation"
                                                           id="minus">إلغاء</a>
                                                    @else
                                                        <span style="display: inline-block;width: -moz-max-content;border-radius: 5px !important;background-color: #72746B;color: #fff; font-size: 14px; padding: 2px"> <i
                                                                    class="fa fa-thumbs-up" aria-hidden="true"></i>  تم الانضمام  </span>
                                                    @endif
                                                @else
                                                    <a href="{{url('login')}}"
                                                       class="btn-send bt-plus "
                                                       id="plus">انضم</a>
                                                @endif
                                            </div>
                                        </div>


                                        <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">

                                            <h3><a href="{{url('events/'.$event->id)}}">{{$event->name}}</a></h3>
                                            @if($event->added_by->roles_id == 1)
                                                <span class="admin"> <i class="fa fa-user-o" aria-hidden="true"></i> {{$event->added_by->name}} </span>
                                            @else
                                                <span class="admin"> <a href="{{url('profile/preview/'.$event->added_by->id)}}"><i
                                                                class="fa fa-user-o flo-right" style="margin-top: 4px;" aria-hidden="true"></i> {{$event->added_by->name}} </a></span>
                                            @endif
                                            @if(count($event->users)>0)
                                                <span class="like"><a><i class="fa fa-users "
                                                                                 aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers(count($event->users))}} </a></span>
                                            @endif

                                        </div>
                                        @auth
                                            @if(Auth::user()->roles_id == 3)
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <button value="{{$event->id}}"
                                                                class="btn-send send-bt send_msg_btn"
                                                                type="submit" data-toggle="modal"
                                                                data-target="#exampleModal2"> ارسال رسالة
                                                        </button>
                                                    </div>
                                                </div>
                                            @endif
                                        @endauth
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                        @else
                        <div style="text-align: center">
                            لا توجد فعاليات متاحة الان
                        </div>
                    @endif
                    <input type="hidden" value="{{url('/')}}">
                </div>
            </div>

            <div style="text-align: center">
                {{ $events->links('pagination.customPagination') }}
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
        </div>
    </div>
    <!-- Blog Page End Here -->

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
                        <h4 class="modal-title flo-right" id="exampleModalLabel">أضف فعاليه</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group col-md-12">
                            <div style="text-align: center;display: none" id="validation-errors"></div>
                        </div>
                        <div class="single-blog-page-area contact-page-area pt">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">

                                    <div class="leave-comments-area ">
                                        <h3> أضف فعاليه</h3>

                                        <form>
                                            <fieldset>
                                                <div class="row ">
                                                    <div class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>أسم الفعاليه</label>
                                                            <input type="text" name="name" class="form-control" required
                                                                   oninvalid="setCustomValidity('من فضلك قم بادخال اسم الفعاليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6 flo-right">
                                                        <div class="form-group ">
                                                            <label>تاريخ بدء الفعاليه </label>
                                                            <input type="date" name="start_date" class="form-control"
                                                                   required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار تاريخ بداية الفعاليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-6 flo-right">
                                                        <div class="form-group ">
                                                            <label>تاريخ إنتهاء الفعاليه </label>
                                                            <input type="date" name="end_date" class="form-control"
                                                                   required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار تاريخ نهاية الفعاليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 ">
                                                        <div class="form-group ">
                                                            <label>عدد المشاركين </label>
                                                            <input type="text" name="num_of_attendees"
                                                                   class="form-control" required
                                                                   oninvalid="setCustomValidity('من فضلك قم بادخال عدد المشتركين فى الفعاليه')"
                                                                   oninput="this.setCustomValidity('')">
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12 flo-right">
                                                        <div class="form-group">
                                                            <label>المكان</label>
                                                            <select name="place_id" class="form-control" required
                                                                    oninvalid="setCustomValidity('من فضلك اختر مكان الفعاليه')"
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
                                                            <label>اضف فعاليه الى : </label>
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
                                                        الفعاليه </label>
                                                        <textarea class="form-control hei-85"
                                                                  id="exampleFormControlTextarea1" name="agenda"
                                                                  rows="3" required
                                                                  oninvalid="setCustomValidity('من فضلك ادخل وصفا للفعاليه')"
                                                                  oninput="this.setCustomValidity('')"></textarea>

                                                    </div>

                                                    <div class="form-group col-md-12 dir mb-50">
                                                        <div class="wrap-custom-file">
                                                            <input type="file" name="eventImg" id="image1"
                                                                   accept=".gif, .jpg, .png" required
                                                                   oninvalid="setCustomValidity('من فضلك قم اختيار صورة الفعاليه')"
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
            $('#create_event')[0].reset();

            $(".send_msg_btn").click(function () {
                $("#event_id").val(this.value);
                $('#validation-errors1').html('');
                $('#validation-errors1').hide();
            });

            $(".close_modal").click(function () {
                $('#send_msg')[0].reset();
            });

            $(".close_modal1").click(function () {
                $('#create_event')[0].reset();
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
                        $('#validation-errors').html('<div class="alert alert-success"> تمت اضافة الفعاليه بنجاح </div>').slideDown();
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

    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الانضمام الى تلك الفعاليه ومشاركة جميع احداثها',
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
                    text: '! هل تود حقا الغاء طلب المشاركة بتلك الفعاليه',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الالغاء !",
                        text: "تم الغاء طلب انضمامكم للفعاليه",
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