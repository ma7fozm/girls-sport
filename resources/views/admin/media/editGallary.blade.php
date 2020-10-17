@extends('admin.master')
@section('css')
    <style>
        input {
            margin-bottom: 10px;
        }

        input [type='radio'] {
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

    <h1 class="text-center"><i class="fa fa-edit"> تعديل بيانات الميديا </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/gallary/update/'.$media->id)}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}

        <div class="form-group">
            <label class="col-md-2 control-label">النوع</label>
            <div class="col-md-10">
                <input type="text" readonly name="username" class="form-control active" value="{{$media->type}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">اللينك</label>
            <div class="col-md-10">
                <input type="text" readonly name="password" class="form-control active" value="{{$media->media_link}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">الحالة</label>
            <div class="col-md-10">
                <input type="text" readonly name="email" class="form-control active"
                       value="{{($media->status == 0)?'غير مفعل':'مفعل'}}">
            </div>
        </div>

        <hr>


        <div class="form-group">
            <label class="col-md-2 control-label">عنوان الميديا</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{$media->title}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">وصف الميديا</label>
            <div class="col-md-10">
                <textarea style="margin-bottom: 10px;" type="text" name="description"
                          class="form-control active">{{$media->description}}</textarea>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">تصنيف الميديا</label>
            <div class="col-md-10 ls-group-input">
                <select id="drop" class="form-control" name="media_type">
                    <option value="صحه" {{($media->media_type == 'صحه')?'selected':''}}>صحه</option>
                    <option value="رياضه" {{($media->media_type == 'رياضه')?'selected':''}}>رياضه</option>
                    <option value="لا للفراغ" {{($media->media_type == 'لا للفراغ')?'selected':''}}>لا للفراغ</option>
                    <option value="عام" {{($media->media_type == 'عام')?'selected':''}}>عام</option>
                </select>
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
                                <input type="radio" name="status" value="1" {{($media->status == '1')?'checked':''}}>
                                مفعله
                            </label>
                            <label style="margin-right: 35px;margin-bottom: 10px;"
                                   class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="0" {{($media->status == '0')?'checked':''}}>
                                غير مفعله
                            </label>

                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">تعديل الميديا</label>
            @if($media->type == 'صورة')
                <div class="col-md-10 ls-group-input">
                    <div>
                        <div id="welcomeDiv" class="file-input"><input type="hidden">
                            <div class="file-preview">
                                <div class="file-preview-status text-center text-success"></div>
                                <div class="close fileinput-remove text-right">×</div>
                                <div class="file-preview-thumbnails">
                                    <div class="file-preview-frame"><img
                                                src="{{asset('/'.$media->media_link)}}" name="media"
                                                class="file-preview-image" title="{{$media->name}}"
                                                alt="{{$media->name}}"></div>
                                </div>
                                <div class="clearfix"></div>
                            </div>

                        </div>
                        <input class="btn btn-ls btn-file" id="file-3" name="media_file" type="file" value=""
                               onclick="showDiv()" enctype="multipart/form-data"
                               accept=".jpg,.png,.jpeg,.gif,.tif,.tiff,.mp3,.ogg,.wav,.acc,.WebM,.mp4,.ogg,.wma">
                    </div>
                </div>
            @else
                <div class="col-md-10 ls-group-input">
                    <div>
                        <div id="welcomeDiv" class="file-input"><input type="hidden">
                            <div class="file-preview ">
                                <div class="file-preview-status text-center text-success"></div>
                                <div class="close fileinput-remove text-right"></div>
                                <div class="file-preview-thumbnails">
                                    <div class="file-preview-frame">
                                        <div class="file-preview-other"><h2><i class="glyphicon glyphicon-file"></i>
                                            </h2>{{$media->name}}
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <input class="btn btn-ls btn-file" id="file-3" name="media_file" type="file" value=""
                               onclick="showDiv()" enctype="multipart/form-data"
                               accept=".jpg,.png,.gif,.tif,.tiff,.mp3,.ogg,.wav,.acc,.WebM,.mp4,.ogg">
                    </div>
                </div>
            @endif
            <div class="form-group" style="text-align: center">
                <input class="btn btn-primary" type="submit" value="تعديل" style="border-radius: 10px;">
            </div>

        </div>


        </div>
    </form>
@endsection

@section('js')
    <script type="text/javascript">
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

@endsection