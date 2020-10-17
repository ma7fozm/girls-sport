@extends('admin.master')
@section('css')
    <style>
        input {
            margin-bottom: 10px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
        }

        h1 {
            font-weight: bold;
            color: #1d68a7;
            margin-bottom: 30px;
        }

        .btn btn-default {
            display: none;
        }

        .radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {

            height: 54px;
            -webkit-box-shadow: none !important;
        }

        .radio-button-place {
            line-height: 58px;
        }
    </style>

    <!-- Plugin Css Put Here -->
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/fileinput-rtl.css">

@endsection
@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if(session()->has('note'))
        <div class="alert alert-info">
            {{session()->get('note')}}
        </div>
    @endif

    <h1 class="text-center"><i class="fa fa-image"> اضافة ميديا الى البوم بفاعلية </i></h1>
    <form id="ffrm" role="form" enctype="multipart/form-data" method="post" action="{{url('admin/eventMedia')}}"
          class="ls_form" style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">اختر الفاعلية</label>
            <div class="col-md-10 ls-group-input">

                <select id="eventSelect" class="form-control" name="event_id">
                    <option value="">-- اختر --</option>
                    @foreach($events as $event)
                        <option value="{{$event->id}}" {{(old('event_id')== $event->id)?'selected':''}} >{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="no_albums" class="form-group">
            <div class="col-md-2 control-label"></div>
            <div class="col-md-10 ls-group-input">
                <p style="color: #1b7e5a"><i class="fa fa-bell"></i> تلك الفاعلية لاتحتوى بعد على البومات , قم بانشاء
                    البوم اولا حتى تتمنك من اضافة الميديا اليها <a href="{{url('/admin/event/album/create/')}}">انشاء
                        البوم بالفاعلية</a> <i class="fa fa-bell"></i></p>
                <input type="hidden" name="event_ID" value="kbhhj">
            </div>
        </div>

        <div id="media_area">
            <div class="form-group">
                <label class="col-md-2 control-label">اختر الالبوم</label>
                <div class="col-md-10 ls-group-input">
                    <select id="albumSelect" class="form-control" name="album_id">
                        <option value="">-- اختر --</option>

                    </select>
                </div>
            </div>

            <div class="form-group">

                <label class="col-md-2 control-label">عنوان الميديا</label>
                <div class="col-md-10">
                    <input type="text" name="title" class="form-control active" value="{{old('title')}}">
                </div>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">وصف الميديا</label>
                <div class="col-md-10">
                <textarea style="margin-bottom: 10px;" type="text" name="description"
                          class="form-control active">{{old('description')}}</textarea>
                </div>
            </div>


            <div class="form-group">
                <label style="margin-top: 20px;" class="col-md-2 control-label">حالة الميديا</label>
                <div class="col-md-10">

                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="radio-button-place">
                                <label style="margin-right: 10px; margin-bottom: 10px"
                                       class="radio-inline icheck-radio-inline">
                                    <input type="radio" name="status" value="1" checked>
                                    مفعله
                                </label>
                                <label style="margin-right: 35px;margin-bottom: 10px;"
                                       class="radio-inline icheck-radio-inline">
                                    <input type="radio" name="status" value="0" {{(old('status') == '0')?'checked':''}}>
                                    غير مفعله
                                </label>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">اضافة ميديا</label>
                <div class="col-md-10 ls-group-input">
                    <input id="file-3" name="media_file" type="file" value="{{old('media_file')}}"
                           enctype="multipart/form-data"
                           accept=".jpg,.png,.jpeg,.gif,.tif,.tiff,.mp3,.ogg,.wav,.acc,.wma">
                </div>
            </div>
        </div>

        <div id="save_btn" class="form-group" style="text-align: center">
            <input class="btn btn-primary" type="submit" value="حفظ" style="border-radius: 10px;">
        </div>
        <input id="get_event_albums_Url" type="hidden"
               value="{{url('admin/event/albums')}}">
    </form>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            $("#no_albums").hide();
            $("#media_area").hide();
            $("#save_btn").hide();


            $("#eventSelect").change(function () {

                var event_id = this.value;

                var url = $('#get_event_albums_Url').val();
                var _token = $("input[name='_token']").val();

                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'post',
                    data: {_token: _token, eventID: event_id},
                    beforeSend: function () {
                        $("#albumSelect").empty();
                    },
                    success: function (albums) {
                        if (albums.length == 0) {

                            $("#media_area").hide();
                            $("#save_btn").hide();
                            $("#no_albums").fadeIn();

                        } else {
                            $('#albumSelect').append($('<option>', {
                                value: '',
                                text: '--اختر--'
                            }));
                            albums.forEach(function (album) {
                                $('#albumSelect').append($('<option>', {
                                    value: album['id'],
                                    text: album['name']
                                }))

                                $("#no_albums").hide();
                                $("#media_area").fadeIn();
                                $("#save_btn").fadeIn();

                            });
                        }
                    }, error: function (xhr) {
                        console.log(xhr.responseJSON);
                    },

                });

            });

            var event_id = $("#eventSelect").val();
            var url = $('#get_event_albums_Url').val();
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: {_token: _token, eventID: event_id},
                beforeSend: function () {
                    $("#albumSelect").empty();
                },
                success: function (albums) {

                    if (albums.length == 0) {

                        $("#media_area").hide();
                        $("#save_btn").hide();
                        $("#no_albums").fadeIn();

                    } else {
                        $('#albumSelect').append($('<option>', {
                            value: '',
                            text: '--اختر--'
                        }));
                        albums.forEach(function (album) {
                            $('#albumSelect').append($('<option>', {
                                value: album['id'],
                                text: album['name']
                            }))

                            $("#no_albums").hide();
                            $("#media_area").fadeIn();
                            $("#save_btn").show();

                        });
                    }
                }, error: function (xhr) {
                    console.log(xhr.responseJSON);
                },

            });
        });
    </script>

    <!--Layout Script start -->
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/color.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/lib/jquery-1.11.min.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/multipleAccordion.js"></script>

    <!--easing Library Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/lib/jquery.easing.js"></script>
    <!--easing Library Script End -->

    <!--Nano Scroll Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/jquery.nanoscroller.min.js"></script>
    <!--Nano Scroll Script End -->

    <!--switchery Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/switchery.min.js"></script>
    <!--switchery Script End -->

    <!--bootstrap switch Button Script Start-->
    <script src="{{asset('design/admin')}}/assets/js/bootstrap-switch.js"></script>
    <!--bootstrap switch Button Script End-->

    <!--easypie Library Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/jquery.easypiechart.min.js"></script>
    <!--easypie Library Script Start -->

    <!--bootstrap-progressbar Library script Start-->
    <script src="{{asset('design/admin')}}/assets/js/bootstrap-progressbar.min.js"></script>
    <!--bootstrap-progressbar Library script End-->

    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/pages/layout.js"></script>
    <!--Layout Script End -->

    <!--Upload button Script Start-->
    <script src="{{asset('design/admin')}}/assets/js/fileinput.min.js"></script>
    <!--Upload button Script End-->

    <!--Auto resize  text area Script Start-->
    <script src="{{asset('design/admin')}}/assets/js/jquery.autosize.js"></script>
    <!--Auto resize  text area Script Start-->
    <script src="{{asset('design/admin')}}/assets/js/pages/sampleForm.js"></script>

@endsection