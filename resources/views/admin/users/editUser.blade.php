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

    <h1 class="text-center"><i class="fa fa-edit"> تعديل بيانات العضو </i></h1>
    <form role="form" enctype="multipart/form-data" method="post" action="{{url('admin/users/'.$user->id)}}"
          class="ls_form"
          style="width: 700px ; margin: 0 auto; ">
        {!! csrf_field() !!}
        {!! method_field('PUT') !!}
        <div class="form-group">
            <label class="col-md-2 control-label">الاسم</label>
            <div class="col-md-10">
                <input type="text" name="name" class="form-control active" value="{{$user->name}}">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">اسم المستخدم</label>
            <div class="col-md-10">
                <input type="text" name="username" class="form-control active" value="{{$user->username}}" readonly>
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">كلمة المرور</label>
            <div class="col-md-10">
                <input type="password" name="password" class="form-control active">
            </div>
            <div style="text-align: center; color: #1b7e5a">
                <i class="fa fa-circle-o"></i>
                اذا تركت كلمة المرور فارغة فهذا يعنى ان كلمة المرور القديمة ستبقى كما هى
                <i class="fa fa-circle-o"></i>
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-2 control-label">البريد الالكترونى</label>
            <div class="col-md-10">
                <input type="text" name="email" class="form-control active" value="{{$user->email}}" readonly>
            </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">صورة العضو</label>
            <div class="col-md-10 ls-group-input">
                <div>
                    <div id="welcomeDiv" class="file-input"><input type="hidden">
                        <div class="file-preview">
                            <div class="file-preview-status text-center text-success"></div>
                            <div class="close fileinput-remove text-right">×</div>
                            <div class="file-preview-thumbnails">
                                <div class="file-preview-frame">

                                    @if($user->image != NULL)
                                        <img src="{{asset('/'.$user->image)}}" name="userImg"
                                             class="file-preview-image" title="Capture.PNG" alt="Capture.PNG"></div>
                                @else
                                    <img src="{{asset('design/admin/assets/images/no_profile_pic.gif')}}"
                                         name="userImg" class="file-preview-image"></div>
                            @endif

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <input class="file" name="userImg" type="file" value=""
                       onclick="showDiv()" enctype="multipart/form-data" accept="image/gif, image/jpeg, image/png">
            </div>
        </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">السيرة الذاتية</label>
            <div class="col-md-10 ls-group-input">
                <div>
                    <div id="cvDiv" class="file-input"><input type="hidden">
                        <div class="file-preview ">
                            <div class="file-preview-status text-center text-success"></div>
                            <div class="close fileinput-remove text-right"></div>
                            <div class="file-preview-thumbnails">
                                <div class="file-preview-frame">
                                    <div class="file-preview-other"><h2><i class="glyphicon glyphicon-file"></i>
                                            @if($user->cv_link != NULL)
                                        </h2>{{$user->cv_link}}</div>
                                    @else
                                    </h2>لاتوجد سيرة ذاتية لهذا العضو
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
                <input type="file" name="cv" class="file"
                       onclick="showDiv1()" accept=".docx, .pdf, .pptx">
            </div>
        </div>
        </div>


        <div class="form-group">
            <label class="col-md-2 control-label">الدولة</label>
            <div class="col-md-10 ls-group-input">
                <select class="form-control" name="country_id" id="country_id">
                    {{--<option value="">-- اختر --</option>--}}
                    @foreach($countries as $country)
                        <option value="{{$country->id}}" {{($user->countries_id == $country->id)?'selected':''}}>{{$country->name}} </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div id="govarea_div" class="form-group">
            <label id="govarea_lbl" class="col-md-2 control-label"></label>
            <div class="col-md-10 ls-group-input">
                <select class="form-control" name="govarea_id" id="govarea_id">
                    <option value="">-- اختر --</option>
                </select>
            </div>
        </div>

        <div id="city_div" class="form-group">
            <label id="cit_lbl" class="col-md-2 control-label"></label>
            <div class="col-md-10 ls-group-input">
                <select class="form-control" id="city_id" name="city_id">
                    <option value="">-- اختر --</option>
                </select>
            </div>
        </div>


        <div class="form-group ">
            <label class="col-md-2 control-label">الحالة</label>
            <div style="margin-bottom: 10px;" class="col-md-10">
                <input type="radio" name="status" value="1" {{($user->status == 1)?'checked':''}} > مفعل <br>
                <input type="radio" name="status" value="0" {{($user->status == 0)?'checked':''}} > محظور <br>

            </div>
        </div>

        <div class="form-group">
            <label class="col-md-2 control-label">نوع العضو</label>
            <div class="col-md-10 ls-group-input">
                <select id="drop" class="form-control" name="roles_id">
                    <option value="">-- اختر --</option>
                    @foreach($roles as $role)
                        <option value="{{$role->id}}" {{($user->roles_id == $role->id)?'selected':''}}>{{$role->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="col-md-2 control-label"></div>
        <div class="col-md-10 ls-group-input">
            <hr>
        </div>

        <div id="Membership_data">
            <div class="form-group">
                <label class="col-md-2 control-label">اثبات الشخصية</label>
                <div class="col-md-10 ls-group-input">
                    <div>
                        @if($user->personal_proof != NULL)
                            <div id="welcomeDiv2" class="file-input"><input type="hidden">
                                <div class="file-preview">
                                    <div class="file-preview-status text-center text-success"></div>
                                    <div class="close fileinput-remove text-right">×</div>
                                    <div class="file-preview-thumbnails">
                                        <div class="file-preview-frame"><img
                                                    src="{{asset('/'.$user->personal_proof)}}" name="userImg"
                                                    class="file-preview-image" title="Capture.PNG" alt="Capture.PNG">
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        @endif
                        <input type="file" name="personal_proof" class="file" value="{{old('personal_proof')}}"
                               onclick="showDiv2()" accept="image/gif, image/jpeg, image/png">

                    </div>
                </div>
            </div>

            <div class="form-group" style="text-align: center">
                <h1 style="margin-bottom: 5px" class="text-center"><i class="fa fa-thumbs-up"> بيانات الضامن </i></h1>
            </div>
            <div class="form-group">
                <label class="col-md-2 control-label">الاسم</label>
                <div class="col-md-10">
                    <input type="text" name="guarantor_name" class="form-control active"
                           value="{{$user->guarantor_name}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">البريد الالكترونى</label>
                <div class="col-md-10">
                    <input type="text" name="guarantor_email" class="form-control active"
                           value="{{$user->guarantor_email}}">
                </div>
            </div>

            <div class="form-group">
                <label class="col-md-2 control-label">رقم الجوال </label>
                <div class="col-md-10">
                    <input type="text" name="guarantor_phone" class="form-control active"
                           value="{{$user->guarantor_phone}}">
                </div>
            </div>
        </div>

        <div class="form-group" style="text-align: center">
            <input class="btn btn-primary" type="submit" value="تعديل" style="border-radius: 10px;">
        </div>

        </div>


        </div>
    </form>
    <input id="get_govarea_Url" type="hidden"
           value="{{url('admin/get/cities')}}">
    <input id="get_country_Url" type="hidden"
           value="{{url('admin/get/govareas')}}">
    <input id="us_id" type="hidden"
           value="{{$user->id}}">
@endsection

@section('js')
    <script type="text/javascript">
        function showDiv() {
            document.getElementById('welcomeDiv').style.display = "none";
        }

        function showDiv1() {
            document.getElementById('cvDiv').style.display = "none";
        }

        function showDiv2() {
            document.getElementById('welcomeDiv2').style.display = "none";
        }
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {
            $("#Membership_data").hide();

            $("#drop").change(function () {
                var role_id = this.value;
                if (role_id == 5) {
                    $('#Membership_data').fadeIn(2000);
                } else {
                    $('#Membership_data').fadeOut();
                }
            });

            // to remain Membership_data shown in case of role_id = 5 after page refresh

            var role_id = $("#drop").val();
            if (role_id == 5) {
                $('#Membership_data').fadeIn(2000);
            } else {
                $('#Membership_data').fadeOut();
            }


            /////////////////////////////////////
            $('#govarea_div').hide();
            $('#city_div').hide();
            /////////////////////////////////////
            $("#country_id").change(function () {

                var country_id = this.value;

                var url = $('#get_country_Url').val();
                var _token = $("input[name='_token']").val();

                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'post',
                    data: {_token: _token, countryID: country_id},
                    beforeSend: function () {
                        $("#govarea_id").empty();
                        $('#govarea_div').slideUp();
                    },
                    success: function (res) {

                        if (res[1] == 'area'){
                            $('#govarea_lbl').text('المنطقة');
                            $('#cit_lbl').text('المحافظة');
                        } else {
                            $('#govarea_lbl').text('المحافظة');
                            $('#cit_lbl').text('المدينة');
                        }

                        // $('#govarea_id').append($('<option>', {
                        //     value: '',
                        //     text: '--اختر--'
                        // }));
                        res[0].forEach(function (govarea) {

                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }));
                        });

                        $('#city_div').hide();
                        $('#govarea_div').slideDown();


                        var govarea_id = $('#govarea_id').val();
                        var url = $('#get_govarea_Url').val();
                        var _token = $("input[name='_token']").val();

                        $.ajax({
                            url: url,
                            dataType: 'json',
                            type: 'post',
                            data: {_token: _token, govareaID: govarea_id},
                            beforeSend: function () {
                                $("#city_id").empty();
                                $('#city_div').slideUp();
                            },
                            success: function (res) {
                                // alert(res[1])
                                // $('#city_id').append($('<option>', {
                                //     value: '',
                                //     text: '--اختر--'
                                // }));
                                res[0].forEach(function (city) {
                                    if (res[1] == city['id'] ){
                                        $('#city_id').append($('<option>', {
                                            value: city['id'],
                                            text: city['name']
                                        }).attr('selected',true));
                                    } else{
                                        $('#city_id').append($('<option>', {
                                            value: city['id'],
                                            text: city['name']
                                        }));
                                    }
                                });
                                $('#city_div').slideDown();
                            }, error: function (xhr) {
                                console.log(xhr.responseJSON);
                            },

                        });


                    }, error: function (xhr) {
                        console.log(xhr.responseJSON);
                    },

                });

            });

            var country_id = $('#country_id').val();
            var user_id = $('#us_id').val();

            var url = $('#get_country_Url').val();
            var _token = $("input[name='_token']").val();

            $.ajax({
                url: url,
                dataType: 'json',
                type: 'post',
                data: {_token: _token, countryID: country_id,user_id},
                beforeSend: function () {
                    $("#govarea_id").empty();
                    $('#govarea_div').slideUp();
                },
                success: function (res ) {

                    if (res[1] == 'area'){
                        $('#govarea_lbl').text('المنطقة');
                        $('#cit_lbl').text('المحافظة');
                    } else {
                        $('#govarea_lbl').text('المحافظة');
                        $('#cit_lbl').text('المدينة');
                    }

                    // $('#govarea_id').append($('<option>', {
                    //     value: '',
                    //     text: '--اختر--'
                    // }));
                    res[0].forEach(function (govarea) {

                        if (res[2] == govarea['id']){
                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }).attr('selected',true));
                        } else {
                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }));
                        }
                    });

                    $('#govarea_div').slideDown();
                    // var user_id = $('#us_id').val();

                    var govarea_id = $('#govarea_id').val();
                    var url = $('#get_govarea_Url').val();
                    var _token = $("input[name='_token']").val();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        type: 'post',
                        data: {_token: _token, govareaID: govarea_id,user_id},
                        beforeSend: function () {
                            $("#city_id").empty();
                            $('#city_div').slideUp();
                        },
                        success: function (res) {
                            // alert(res[1])
                            // $('#city_id').append($('<option>', {
                            //     value: '',
                            //     text: '--اختر--'
                            // }));
                            res[0].forEach(function (city) {
                                if (res[1] == city['id'] ){
                                    $('#city_id').append($('<option>', {
                                        value: city['id'],
                                        text: city['name']
                                    }).attr('selected',true));
                                } else{
                                    $('#city_id').append($('<option>', {
                                        value: city['id'],
                                        text: city['name']
                                    }));
                                }
                            });
                            $('#city_div').slideDown();
                        }, error: function (xhr) {
                            console.log(xhr.responseJSON);
                        },

                    });


                }, error: function (xhr) {
                    console.log(xhr.responseJSON);
                },

            });


            ////////////////////////////////////////////////////////
            $("#govarea_id").change(function () {

                var govarea_id = this.value;

                var url = $('#get_govarea_Url').val();
                var _token = $("input[name='_token']").val();

                $.ajax({
                    url: url,
                    dataType: 'json',
                    type: 'post',
                    data: {_token: _token, govareaID: govarea_id},
                    beforeSend: function () {
                        $("#city_id").empty();
                        $('#city_div').slideUp();
                    },
                    success: function (res) {
                        // $('#city_id').append($('<option>', {
                        //     value: '',
                        //     text: '--اختر--'
                        // }));
                        res[0].forEach(function (city) {
                            $('#city_id').append($('<option>', {
                                value: city['id'],
                                text: city['name']
                            }));
                        });
                        $('#city_div').slideDown();
                    }, error: function (xhr) {
                        console.log(xhr.responseJSON);
                    },

                });

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