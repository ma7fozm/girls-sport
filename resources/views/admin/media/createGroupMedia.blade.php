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

        #save {
            margin-top: 10px;
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

    <h1 class="text-center"><i class="fa fa-image"> اضافة ميديا الى المجموعة </i></h1>
    <form id="ffrm" role="form" enctype="multipart/form-data" method="post" action="{{url('admin/groups/media')}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">اسم المجموعة</label>
            <div class="col-md-10 ls-group-input">
                @if(isset($group_id))
                    <select class="form-control" name="group_id">
                        <option value="">-- اختر --</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}" {{($group->id == $group_id)?'selected':''}}>{{$group->name}}</option>
                        @endforeach
                    </select>
                @else
                    <select class="form-control" name="group_id">
                        <option value="">-- اختر --</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                @endif
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

        <div class="form-group" style="text-align: center">
            <input id="save" class="btn btn-primary" type="submit" value="حفظ" style="border-radius: 10px;">
        </div>

        </div>
        </div>
    </form>
@endsection

@section('js')

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