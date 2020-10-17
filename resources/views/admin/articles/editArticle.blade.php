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

            padding-right: 5px;
            /*float: right;*/
            margin-left: 5px;
        }

        #editbtn {
            margin-bottom: 40px;
        }

        .col-sm-4 {

            width: 33.33333333%;
            margin-bottom: 10px;

        }

        #show {
            cursor: pointer;
        }

        radio input[type="radio"], .radio-inline input[type="radio"], .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"] {
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
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif

    <h1 class="text-center"><i class="fa fa-edit"> تعديل بيانات المقال </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/articles/'.$article->id)}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}

        <div class="form-group">
            <label class="col-md-2 control-label">عنوان المقال</label>
            <div class="col-md-10">
                <input type="text" name="title" class="form-control active" value="{{$article->title}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">مقدمة المقال</label>
            <div class="col-md-10">
                <input type="text" name="intro" class="form-control active" value="{{$article->intro}}">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">محتوى المقال</label>
            <div class="col-md-10">
                <textarea name="articleContent" class="form-control active">{{$article->content}}</textarea>
            </div>
        </div>

        <div class="form-group">
            <label class="col-sm-2 flo-right">حدد الفئة</label>
            <div class="col-md-10 ">
                <select style="margin-bottom: 10px;" name="category_id" id="drop" class="form-control">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{$article->category_id== $category->id ? 'selected':''}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
             <div class="form-group">
            <label style="margin-top: 22px;" class="col-sm-2 control-label">اضافة الى : </label>
            <div class="col-sm-10">
              <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <div class="radio-button-place">
                            <label style="margin-right: 10px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="group_to"
                                       value="userR" {{($article->user_id != NULL)?'checked':''}}>
                                شخص
                            </label>
                            <label style="margin-right: 35px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="group_to"
                                       value="groupR" {{($article->group_id !== NULL)?'checked':''}}>
                                مجموعه
                            </label>

                              <label style="margin-right: 35px;" class="radio-inline icheck-radio-inline">
                                <input type="radio" name="group_to"
                                       value="teamR" {{($article->team_id !== NULL)?'checked':''}}>
                                فريق
                            </label>

                        </div>
                    </div>
                </div>
              </div>
            </div>

        <div id="UserDiv" class="form-group">
            <label class="col-sm-2 flo-right">حدد العضو</label>
            <div class="col-md-10 ">
                <select style="margin-bottom: 10px;" name="user_id" id="drop" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$article->user_id== $user->id ? 'selected':''}}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div id="groupDrop" class="col-sm-12 flo-right">
            <label>اختر المجموعة المراد اضافة المقال لها : </label>
            <div class="form-group ">
                <div class="col-md-13">
                    <select id="group_id" name="group_id" class="form-control">
                    @foreach($groups as $group)
                            <option value="{{$group->id}}"  {{$article->group_id== $group->id ? 'selected':''}}>{{$group->name}}</option>
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
                        <option value="{{$team->id}}" {{$article->team_id== $team->id ? 'selected':''}}>{{$team->name}}</option>
                    @endforeach
                </select>
            </div>
            <hr>
        </div>

      

        <div class="form-group">
            <label class="col-md-2 control-label">صورة المقال</label>
            <div class="col-md-10 ls-group-input">
                <div>
                    <div id="welcomeDiv" class="file-input"><input type="hidden">
                        <div class="file-preview">
                            <div class="file-preview-status text-center text-success"></div>
                            <div class="close fileinput-remove text-right">×</div>
                            <div class="file-preview-thumbnails">
                                <div class="file-preview-frame"><img
                                          src="{{asset($article->image)}}" name="articleImg"
                                            class="file-preview-image"></div>
                            </div>
                            <div class="clearfix"></div>
                        </div>

                    </div>
                    <input class="btn btn-ls btn-file" id="file-3" name="articleImg" type="file" value=""
                           onclick="showDiv()" enctype="multipart/form-data" accept="image/gif, image/jpeg, image/png">
                </div>
            </div>
        </div>


        <div class="form-group" style="text-align: center">
            <div class="col-md-10">
                <input id="editbtn" class="btn btn-primary" type="submit" value="تعديل"
                       style="border-radius: 10px;">
            </div>
        </div>
        <br>
    </form>
@endsection

@section('js')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>
        $(document).ready(function () {

            $('input[type=radio][name=group_to]').change(function () {

                if (this.value == 'userR') {
                    $('#groupDrop').hide();
                    $('#teamDrop').hide();
                    $('#UserDiv').fadeIn(1500);
                } else if (this.value == 'teamR') {
                    $('#UserDiv').hide();
                    $('#groupDrop').hide();
                    $('#teamDrop').fadeIn(1500);
                }
                else if (this.value == 'groupR') {
                    $('#UserDiv').hide();
                    $('#teamDrop').hide();
                    $('#groupDrop').fadeIn(1500);
                }
            });

            if ($('input[name=group_to]:checked').val() == 'teamR') {
                    $('#UserDiv').hide();
                    $('#groupDrop').hide();
                    $('#teamDrop').fadeIn(1500);
            
            } else if ($('input[name=group_to]:checked').val() == 'userR') {
                    $('#groupDrop').hide();
                    $('#teamDrop').hide();
                    $('#UserDiv').fadeIn(1500);
            }
            else if ($('input[name=group_to]:checked').val() == 'groupR') {
                    $('#UserDiv').hide();
                    $('#teamDrop').hide();
                    $('#groupDrop').fadeIn(1500);
            }

        });

    </script>

    <script>
        $('.all_members').hide()
        $('.chkboxs').prop('checked', false);
        $('.afieldgroup').hide()
        // $('.btnAdd').prop('disabled', true);
        // $('.btnAdd').removeAttr('href');
        // $('.btnAdd').css('opacity', '0');
        $('.btnAdd').hide();
        // $('.rdb').attr('checked',false);
        $('#show').click(function () {
            $('.all_members').slideDown(3000);
        });


        function activeType(chk_id, rd_id, btnAdd_id) {
            $('#' + chk_id).change(function () {
                if ($(this).is(':checked')) {
                    $("#" + rd_id).show();
                    // $('#' + btnAdd_id).css('opacity', '1');
                    $('#' + btnAdd_id).show();
                    // $('#' + btnAdd_id).addAttr('href');
                } else if ($(this).prop("checked") == false) {
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

        window.onload = function () {
            $('.all_members').slideDown(3000);
        }

    </script>
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