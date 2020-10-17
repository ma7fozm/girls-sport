@extends('admin.master')
@section('css')
    <style>
        input {
            margin-bottom: 10px;
        }

        select {
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

    <h1 class="text-center"><i class="fa fa-plus"> اضافة مقال جديد </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/articles')}}" class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="col-md-2 control-label">عنوان المقال</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{old('title')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">مقدمة المقال</label>
            <div class="col-md-10">
                <input type="text" name="intro" class="form-control active" value="{{old('intro')}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">محتوى المقال</label>
            <div class="col-md-10">
                <textarea name="articleContent" class="form-control active">{{old('articleContent')}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">صورة المقال</label>
            <div class="col-md-10 ls-group-input">
                <input id="file-3" name="articleImg" type="file" value="{{old('articleImg')}}"
                       enctype="multipart/form-data"
                       accept="image/gif, image/jpeg, image/png">
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 flo-right">حدد الفئة</label>
            <div class="col-md-10">
                <select style="margin-bottom: 10px;" name="category_id" class="form-control">
                    <option value="0" selected>اختر...</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}">{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group ">
            <label class="col-sm-2 flo-right">اضف المقال الى : </label>
            <div class="col-md-10">
                <select style="margin-bottom: 20px;" id="drop" name="belongTo" class="form-control">
                    <option value="0" selected>اختر...</option>
                    @if(count($users)>0)
                        <option value="member">عضو</option>
                    @endif
                    @if(count($groups)>0)
                        <option value="group">مجموعة</option>
                    @endif
                    @if(count($teams)>0)
                        <option value="team">فريق</option>
                    @endif
                </select>
                <hr>
            </div>
        </div>

        <div id="memberDrop" class="col-sm-12 flo-right">
            <label>اختر العضو المراد اضافة المقال له : </label>
            <div class="form-group ">
                <div class="col-md-13">
                    <select style="margin-bottom: 10px;" name="user_id" id="user_id" class="form-control">
                        <option value="0" selected>اختر...</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
        </div>

        <div id="groupDrop" class="col-sm-12 flo-right">
            <label>اختر المجموعة المراد اضافة المقال لها : </label>
            <div class="form-group ">
                <div class="col-md-13">
                    <select id="group_id" name="group_id" class="form-control">
                        <option value="0" selected>اختر...</option>
                        @foreach($groups as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <hr>
        </div>


        <div id="teamDrop" class="col-sm-12 flo-right">
            <div class="form-group ">
                <label>اختر الفريق المراد اضافة المقال له : </label>
                <select id="team_id" name="team_id" class="form-control">
                    <option value="0" selected>اختر...</option>
                    @foreach($teams as $team)
                        <option value="{{$team->id}}">{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
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


    <script>
        $(document).ready(function () {
            $('#memberDrop').hide();
            $('#groupDrop').hide();
            $('#teamDrop').hide();
            $("#drop").change(function () {

                if (($('#drop').val()) == 'group') {
                    $('#groupDrop').slideDown();
                    $('#teamDrop').hide();
                    $('#memberDrop').hide();
                } else if (($('#drop').val()) == 'team') {
                    $('#teamDrop').slideDown();
                    $('#memberDrop').hide();
                    $('#groupDrop').hide();
                } else if (($('#drop').val()) == 'member') {
                    $('#memberDrop').slideDown();
                    $('#groupDrop').slideUp();
                    $('#teamDrop').slideUp();
                }
            });
        });
    </script>

@endsection
