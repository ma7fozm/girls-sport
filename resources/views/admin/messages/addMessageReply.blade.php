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

        .col-sm-4 {

            width: 33.33333333%;
            margin-bottom: 10px;

        }

        .radio-inline {

            padding-right: 10px;
            /*float: right;*/
            margin-left: 20px;

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

    <h1 class="text-center"><i class="fa fa-reply"> اضافة رد للرسالة </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/messages')}}" class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">عنوان الرسالة</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{old('title')}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">محتوى الرسالة</label>
            <div class="col-md-10">
                <textarea name="msgContent" class="form-control active">{{old('newContent')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">صورة للرسالة</label>
            <div class="col-md-10 ls-group-input">
                <input id="file-3" name="msgImg" type="file" value="{{old('msgImg')}}" enctype="multipart/form-data"
                       accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <div class="form-group">
            <label style="margin-top: 22px;" class="col-md-2 control-label">حالة الرسالة</label>
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
        <input type="hidden" name="msg_id" value="{{$id}}">

        <div class="form-group" style="text-align: center">
            <div class="col-md-10">
                <input class="btn btn-primary" type="submit" value="حفظ" style="border-radius: 10px;">
            </div>
        </div>
    </form>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
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
