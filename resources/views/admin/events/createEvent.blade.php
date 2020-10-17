@extends('admin.master')
@section('css')
    <style>
        input {
            margin-bottom: 10px;
        }

        textarea {
            margin-bottom: 10px;
        }

        .cus {
            width: 10px;
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

            height: 38px;
            -webkit-box-shadow: none !important;
        }

        .radio-button-place {
            line-height: 44px;
        }

    </style>


    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/jquery.datetimepicker-rtl.css">
    <!-- Plugin Css Put Here -->
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/fileinput-rtl.css">
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/plugins/icheck/skins/all.css">
    <link rel="stylesheet" href="{{asset('design/admin')}}/assets/css/rtl-css/plugins/selectize.bootstrap3-rtl.css">

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

    <h1 class="text-center"><i class="fa fa-calendar"> اضافة فاعلية جديدة </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/events')}}" class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">عنوان الفاعلية</label>
            <div class="col-md-10">
                <input type="text" name="name" class="form-control active" value="{{old('name')}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">مكان الفاعلية</label>
            <div class="col-md-10 ls-group-input">
                <select class="form-control" name="place_id">
                    <option value="">-- اختر --</option>
                    @foreach($places as $place)
                        <option value="{{$place->id}}" {{(old('place_id') == $place->id)?'selected':''}}>{{$place->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">وصف الفاعلية</label>
            <div class="col-md-10">
                <textarea name="agenda" class="form-control active">{{old('agenda')}}</textarea>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label"> بداية الفاعلية :</label>
            <div class="col-md-4">
                <input id="date_timepicker_start" name="start_date" class="form-control" type="text" value="{{old('start_date')}}"/>
            </div>

            <label class="col-md-2 control-label"> نهاية الفاعلية :</label>
            <div class="col-md-4">
                <input id="date_timepicker_end" name="end_date" class="form-control" type="text" value="{{old('end_date')}}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">الرعاة</label>
            <div class="col-md-10">
                <select id="select-state" name="sponsors[]" multiple class="demo-default"
                        placeholder="اختر رعاة المباراة...">
                    @foreach($sponsors as $sponsor)
                        <option value="{{$sponsor->id}}">{{$sponsor->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<label style="margin-top: 7px;" class="col-md-2 control-label">تصنيف الفاعلية </label>--}}
            {{--<div class="col-md-10 ls-group-input">--}}
                {{--<select style="margin-top: 7px" id="drop" class="form-control" name="event_type">--}}
                    {{--<option value="">-- اختر --</option>--}}
                    {{--<option value="صحه" {{(old('event_type') == 'صحه')?'selected':''}}>صحه</option>--}}
                    {{--<option value="رياضه" {{(old('event_type') == 'مباريات')?'selected':''}}>مباريات</option>--}}
                    {{--<option value="لا للفراغ" {{(old('event_type') == 'لا للفراغ')?'selected':''}}>لا للفراغ</option>--}}
                    {{--<option value="عام" {{(old('event_type') == 'عام')?'selected':''}}>عام</option>--}}
                    {{--<option value="فريق" {{(old('event_type') == 'فريق')?'selected':''}}>فريق</option>--}}
                    {{--<option value="جروب" {{(old('event_type') == 'جروب')?'selected':''}}>جروب</option>--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}

        <div id="teams" class="form-group">
            <label class="col-md-2 control-label">اختر الفريق </label>
            <div class="col-md-10 ls-group-input">
                <select id="drop" class="form-control" name="team_id">
                    <option value="">-- اختر --</option>
                    @foreach($teams as $team)
                        <option value="{{$team->id}}" {{(old('team_id') == $team->id)?'selected':''}}>{{$team->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="groups" class="form-group">
            <label class="col-md-2 control-label">اختر الجروب</label>
            <div class="col-md-10 ls-group-input">
                <select id="drop" class="form-control" name="group_id">
                    <option value="">-- اختر --</option>
                    @foreach($groups as $group)
                        <option value="{{$group->id}}" {{(old('group_id') == $group->id)?'selected':''}}>{{$group->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">عدد الحضور</label>
            <div class="col-md-10">
                <input style="margin-top: 7px;" type="text" name="num_of_attendees" class="form-control active"
                       value="{{old('num_of_attendees')}}">
            </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 15px;" class="col-md-2 control-label">حالة الفاعلية</label>
            <div class="col-md-10">

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio-button-place">
                            <label style="margin-right: 10px;"
                                   class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="1" checked>
                                نشطة
                            </label>
                            <label style="margin-right: 35px;"
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
            <label class="col-md-2 control-label">صورة الفاعلية</label>
            <div class="col-md-10 ls-group-input">
                <input id="file-3" name="eventImg" type="file"
                       enctype="multipart/form-data"
                       accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <div class="form-group" style="text-align: center;">
            <div class="col-md-10">
                <input class="btn btn-primary" type="submit" value="حفظ" style="border-radius: 10px;margin-top: 20px;">
            </div>
        </div>
    </form>

@endsection

@section('js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>


        $(document).ready(function () {

            $('#teams').hide();
            $('#groups').hide();

            $('#drop').on('change', function () {
                if (this.value == 'فريق') {
                    $('#teams').fadeIn(1500);
                    $('#groups').hide();
                }else if (this.value == 'جروب') {
                    $('#teams').hide();
                    $('#groups').fadeIn(1500);
                }else {
                    $('#teams').hide();
                    $('#groups').hide();
                }
            });

            if ($('#drop').val() == 'فريق') {
                $('#teams').fadeIn(1500);
                $('#groups').hide();
            }else if ($('#drop').val() == 'جروب') {
                $('#teams').hide();
                $('#groups').fadeIn(1500);
            }else {
                $('#teams').hide();
                $('#groups').hide();
            }

        });

    </script>


    <!--Layout Script start -->
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/color.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/lib/jquery-1.11.min.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/lib/jqueryui.js"></script>
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

    <!--selectize Library start-->
    <script src="{{asset('design/admin')}}/assets/js/selectize.min.js"></script>
    <!--selectize Library End-->

    <!--Select & Tag demo start-->
    <script src="{{asset('design/admin')}}/assets/js/pages/selectTag.js"></script>
    <!--Select & Tag demo end-->
    <script src="{{asset('design/admin')}}/assets/js/pages/pickerTool.js"></script>

    <!-- Date & Time Picker Library Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/jquery.datetimepicker.js"></script>
    <!-- Date & Time Picker Library Script End -->

    <!-- Script For Icheck -->
    <script src="{{asset('design/admin')}}/assets/js/icheck.min.js"></script>
    <!-- Script For Icheck -->

    <!--Advance Radio and checkbox demo start-->
    <script src="{{asset('design/admin')}}/assets/js/pages/checkboxRadio.js"></script>
    <!--Advance Radio and checkbox demo start-->

    <!--Demo for Date, Time Color Picker Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/pages/pickerTool.js"></script>
    <!--Demo for Date, Time Color Picker Script End -->
@endsection
