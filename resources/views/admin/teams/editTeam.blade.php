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

        .radio-inline {

            padding-right: 10px;
            /*float: right;*/
            margin-left: 20px;
        }

        #editbtn {
            margin-bottom: 40px;
        }

        radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
            height: 80px;
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
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif

    <h1 class="text-center"><i class="fa fa-group"> تعديل بيانات الفريق </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/teams/'.$team->id)}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="form-group">
            <label class="col-md-2 control-label">اسم الفريق</label>
            <div class="col-md-10">
                <input type="text" name="name" class="form-control active" value="{{$team->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">الوصف</label>
            <div class="col-md-10">
                <textarea name="description" class="form-control active">{{$team->description}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label id="sport" class="col-sm-2 flo-right">ادمن الفريق</label>
            <div style="margin-bottom: 10px;" class="col-sm-10 flo-right ">
                <select name="admin_id" class="form-control">
                    <option value="0">اختر...</option>
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$team->admin_id == $user->id ? 'selected':''}} >{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label id="sport" class="col-sm-2 flo-right">اختر الرياضة</label>
            <div style="margin-bottom: 10px;" class="col-sm-10 flo-right ">
                <select name="sport_id" class="form-control">
                    @foreach($sports as $sport)
                        <option value="{{$sport->id}}"{{($team->sport_id == $sport->id)?'selected':''}} >{{$sport->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 34px;" class="col-sm-2 control-label">حالة الفريق</label>
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio-button-place">
                            <label class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="1" {{($team->status == 1)?'checked':''}} >
                                نشط
                            </label>
                            <label style="margin-right: 35px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="0" {{($team->status == 0)?'checked':''}}>
                                غير مفعل
                            </label>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">صورة الفريق</label>
            <div class="col-md-10 ls-group-input">
                <div>
                    <div id="welcomeDiv" class="file-input"><input type="hidden">
                        <div class="file-preview">
                            <div class="file-preview-status text-center text-success"></div>
                            <div class="close fileinput-remove text-right">×</div>
                            <div class="file-preview-thumbnails">
                                <div class="file-preview-frame">
                                    @if($team->slogan != NULL)
                                        <img src="{{asset('/'.$team->slogan)}}" name="teamSlogan"
                                             class="file-preview-image" title="{{$team->slogan}}"
                                             alt="{{$team->slogan}}"></div>
                                @else
                                    <img src="{{asset('design/admin/assets/images/noImagee.jpg')}}" name="groupImg"
                                         class="file-preview-image"></div>
                            @endif

                        </div>
                        <div class="clearfix"></div>
                    </div>

                </div>
                <input class="btn btn-ls btn-file" id="file-3" name="teamSlogan" type="file" value=""
                       onclick="showDiv()" enctype="multipart/form-data" accept="image/gif, image/jpeg, image/png">
            </div>
        </div>
        </div>


        <div class="form-group" style="text-align: center">
            <div class="col-md-10">
                <input id="editbtn" class="btn btn-primary" type="submit" value="تعديل" style="border-radius: 10px;">
            </div>
        </div>
        <br>
    </form>
@endsection

@section('js')

    <script>
        $('.all_members').hide();
        $('.chkboxs').prop('checked', false);
        $('.afieldgroup').hide();
        // $('.btnAdd').prop('disabled', true);
        // $('.btnAdd').removeAttr('href');
        // $('.btnAdd').css('opacity', '0');
        $('.btnAdd').hide();
        // $('.rdb').attr('checked',false);
        $('#show').click(function () {
            $('.all_members').fadeIn(3000);
        });


        function activeType(chk_id, rd_id, btnAdd_id) {
            $('#' + chk_id).change(function () {
                if ($(this).is(':checked')) {
                    $("#" + rd_id).show();
                    // $('#' + btnAdd_id).css('opacity', '1');
                    $('#' + btnAdd_id).show();
                    // $('#' + btnAdd_id).addAttr('href');
                } else if ($(this).is(':unchecked')) {
                    $("#" + rd_id).hide();
                    // $('#' + btnAdd_id).css('opacity', '0');
                    $('#' + btnAdd_id).hide();
                    // $('#' + btnAdd_id).removeAttr('href');;
                }
            });
        }

        function add_member(add_url, rdb_name) {
            mem_type = $('input[name=' + rdb_name + ']:checked').val();
            // var r =  $('input[name=type5]:checked').val();
            //  alert(mem_type);
            path = add_url + mem_type;
            // alert(path);
            window.location.href = path;
        }

        function showDiv() {
            document.getElementById('welcomeDiv').style.display = "none";
        }

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