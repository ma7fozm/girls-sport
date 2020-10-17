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

    <h1 class="text-center"><i class="fa fa-newspaper-o"> اضافة خبر جديد </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/news')}}" class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">عنوان الخبر</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{old('title')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">مقدمة الخبر</label>
            <div class="col-md-10">
                <input type="text" name="intro" class="form-control active" value="{{old('intro')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">محتوى الخبر</label>
            <div class="col-md-10">
                <textarea name="newContent" class="form-control active" >{{old('newContent')}}</textarea>
            </div>
        </div>


        <div class="form-group">
            <label class="col-sm-2 flo-right">حدد الفئة</label>
            <div class="col-md-10">
                <select style="margin-bottom: 10px;" name="category_id" id="drop" class="form-control">
                    <option value="0">اختر...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{old('category_id')== $category->id ? 'selected':''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

            <div class="form-group">
            <label class="col-md-2 control-label">تصنيف الخبر</label>
            <div class="col-md-10 ls-group-input">
                <select id="drop" class="form-control" name="news_type">
                    <option value="" >-- اختر --</option>
                    <option value="صحه" {{(old('news_type') == 'صحه')?'selected':''}}>صحه</option>
                    <option value="رياضه" {{(old('news_type') == 'رياضه')?'selected':''}}>رياضه</option>
                    <option value="لا للفراغ" {{(old('news_type') == 'لا للفراغ')?'selected':''}}>لا للفراغ</option>
                    <option value="عام" {{(old('news_type') == 'عام')?'selected':''}}>عام</option>
                </select>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">صورة الخبر</label>
            <div class="col-md-10 ls-group-input">
                <input id="file-3" name="newImg" type="file" value="{{old('newImg')}}" enctype="multipart/form-data"
                       accept="image/gif, image/jpeg, image/png">
            </div>
        </div>


          <div class="form-group">
            <label style="margin-top: 34px;" class="col-sm-2 control-label">حالة الفريق</label>
            <div class="col-sm-10">

                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio-button-place">
                            <label class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="1" checked>
                                نشط
                            </label>
                            <label style="margin-right: 35px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="status" value="0">
                                غير مفعل
                            </label>

                        </div>
                    </div>
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
