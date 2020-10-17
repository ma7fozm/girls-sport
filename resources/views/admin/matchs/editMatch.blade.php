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

        radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {

            height: 54px;
            -webkit-box-shadow: none !important;
        }

        .radio-button-place {
            line-height: 58px;
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

    <h1 class="text-center"> <i class="fa fa-edit"> تعديل بيانات المباراة </i><i class="fa fa-futbol-o"> </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/matchs/'.$match->id)}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="form-group">
            <label class="col-md-2 control-label">عنوان المباراة</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{$match->title}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">مكان المباراة</label>
            <div class="col-md-10 ls-group-input">
                <select class="form-control" name="place_id">
                    @foreach($places as $place)
                        <option value="{{$place->id}}" {{($match->place_id == $place->id)?'selected':''}}>{{$place->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">الرعاة</label>
            <div class="col-md-10">
                <select id="select-state" name="sponsors[]" multiple class="demo-default" placeholder="اختر رعاة المباراة...">
                    @foreach($sponsors as $sponsor)
                        <option value="{{$sponsor->id}}"{{(in_array($sponsor->id,$match_sponsors_ids))?'selected':''}}>{{$sponsor->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

       <div class="form-group">
            <label class="col-md-2 control-label">الدوري</label>
            <div class="col-md-10 ls-group-input">
               <select style="margin-bottom: 10px;" name="league_id" id="drop" class="form-control">
                  <option value="">-- اختر --</option>

                    @foreach($leagues as $league)
                        <option value="{{$league->id}}" {{$match->league_id== $league->id ? 'selected':''}}>{{$league->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="form-group">
            <label style="margin-top: 6px" class="col-md-2 control-label">نتيجة المباراة</label>
            <div class="col-md-10">
                <input style="margin-top: 6px" type="text" name="result" class="form-control active" value="{{$match->result}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">وصف المباراة</label>
            <div class="col-md-10">
                <textarea name="description" class="form-control active">{{$match->description}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">تاريخ المباراة</label>
            <div class="col-md-4">
                <input id="show_date" name="show_date" class="form-control " type="text" value="{{($match->date)}}"
                       readonly/>
            </div>
            <label class="col-md-2 control-label">تعديل تاريخ المباراة</label>
            <div class="col-md-4">
                <input id="date" name="date" class="form-control datePickerOnly" type="text"
                       value="{{($match->date)}}"/>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">من الساعة :</label>
            <div class="col-md-4">
                <input id="StartDate" name="start_time" class="form-control timePickerOnly" type="text"
                       value="{{$match->start_time}}"/>
            </div>

            <label class="col-md-2 control-label">الى الساعة :</label>
            <div class="col-md-4">
                <input id="EndDate" name="end_time" class="form-control timePickerOnly" value="{{$match->end_time}}"
                       type="text"/>
            </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 23px;" class="col-md-2 control-label">حالة المباراة</label>
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
            <label style="margin-top: 21px;" class="col-md-2 control-label">نوع المباراة</label>
            <div class="col-md-10">
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio-button-place">
                            <label style="margin-bottom: 10px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="match_type"
                                       value="single" {{($match->match_type == 'single')?'checked':''}}>
                                فردية
                            </label>
                            <label style="margin-right: 35px;margin-bottom: 10px" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="match_type"
                                       value="team" {{($match->match_type == 'team')?'checked':''}}>
                                جماعية
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div id="match_members">
            <div class="form-group">
                <label class="col-md-2 control-label">الاعضاء</label>
                <div class="col-md-4 ls-group-input">
                    <select id="user1_id" class="form-control" name="user1_id">
                        <option value="">-- اختر --</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{($match->match_type == 'single')?(($match->users->get(0)->id == $user->id)?'selected':'') : ''}}>{{$user->name}} </option>
                        @endforeach
                    </select>
                </div>

                <label style="font-weight: bold" class="col-md-2 control-label text-center">V.S</label>

                <div class="col-md-4 ls-group-input">
                    <select id="user2_id" class="form-control" name="user2_id">
                        <option value="">-- اختر --</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{($match->match_type == 'single')? ( ($match->users->get(1)->id == $user->id)?'selected':'') : ''}}>{{$user->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <hr>
        <div id="match_teams">
            <div class="form-group">
                <label class="col-md-2 control-label">الفرق</label>
                <div class="col-md-4 ls-group-input">
                    <select id="team1_id" class="form-control" name="team1_id">
                        <option value="">-- اختر --</option>
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" {{($match->match_type == 'team')?(($match->teams->get(0)->id == $team->id)?'selected':''):''}}>{{$team->name}} </option>
                        @endforeach
                    </select>
                </div>

                <label style="font-weight: bold" class="col-md-2 control-label text-center">V.S</label>

                <div class="col-md-4 ls-group-input">
                    <select id="team2_id" class="form-control" name="team2_id">
                        <option value="">-- اختر --</option>
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" {{($match->match_type == 'team')?(($match->teams->get(1)->id == $team->id)?'selected':''):''}}>{{$team->name}} </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">صورة المباراة</label>
            <div class="col-md-10 ls-group-input">
                <div>
                    <div id="welcomeDiv" class="file-input"><input type="hidden">
                        <div class="file-preview">
                            <div class="file-preview-status text-center text-success"></div>
                            <div class="close fileinput-remove text-right">×</div>
                            <div class="file-preview-thumbnails">
                                <div class="file-preview-frame"><img
                                            src="{{asset('/'.$match->image)}}" name="matchImg"
                                            class="file-preview-image" title="{{$match->image}}"
                                            alt="{{$match->image}}"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <input class="btn btn-ls btn-file" id="file-3" name="matchImg" type="file" value=""
                           onclick="showDiv()" enctype="multipart/form-data" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
        </div>

        <div class="form-group" style="text-align: center">
            <div class="col-md-10">
                <input class="btn btn-primary" type="submit" value="حفظ" style="border-radius: 10px;">
            </div>
        </div>


    </form>

@endsection

@section('js')


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $('#match_members').hide();
        $('#match_teams').hide();
        // $('input[type=radio][name=match_type]').prop('checked', false);

        $(document).ready(function () {

            if ($("input[name='match_type']:checked").val() == 'single') {
                $('#match_teams').hide();
                $('#match_members').fadeIn(2000);
            } else if ($("input[name='match_type']:checked").val() == 'team') {
                $('#match_members').hide();
                $('#match_teams').fadeIn(2000);
            }

            $('input[type=radio][name=match_type]').change(function () {
                if (this.value == 'single') {
                    $('#match_teams').hide();
                    $('#match_members').fadeIn(2000);
                } else if (this.value == 'team') {
                    $('#match_members').hide();
                    $('#match_teams').fadeIn(2000);
                }
            });

            $('#user1_id').on('change', function () {
                if ($('#user2_id').val() == this.value) {
                    alert('لا يمكن ان يخوض الشخص المباراة ضد نفسه , قم باختيار شخص اخر');
                    $("#user1_id").val($("#user1_id option:first").val());
                }
            });

            $('#user2_id').on('change', function () {
                if ($('#user1_id').val() == this.value) {
                    alert('لا يمكن ان يخوض الشخص المباراة ضد نفسه , قم باختيار شخص اخر');
                    $("#user2_id").val($("#user2_id option:first").val());
                }
            });

            $('#team1_id').on('change', function () {
                if ($('#team2_id').val() == this.value) {
                    alert('لا يمكن ان يخوض الفريق المباراة ضد نفسه , قم باختيار فريق اخر');
                    $("#team1_id").val($("#team1_id option:first").val());
                }
            });

            $('#team2_id').on('change', function () {
                if ($('#team1_id').val() == this.value) {
                    alert('لا يمكن ان يخوض الفريق المباراة ضد نفسه , قم باختيار فريق اخر');
                    $("#team2_id").val($("#team2_id option:first").val());
                }
            });
            $("#date").blur(function () {
                // alert(this.value);
                $("#show_date").val(this.value);

            });
        });
    </script>

    <script type="text/javascript">
        function showDiv() {
            document.getElementById('welcomeDiv').style.display = "none";
        }

        function showDiv1() {
            document.getElementById('cvDiv').style.display = "none";
        }
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
