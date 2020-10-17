@extends('frontEnd.master')

@section('css')
    <style>
    </style>

@endsection

@section('content')

    <!-- Inner Page Header serction start here -->
    <div class="inner-page-header">
        <div class="banner">
            <img src="{{asset('design/frontEnd')}}/images/banner/3.jpg" alt="Banner">
        </div>
        <div class="banner-text">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a> الملف الشخصي
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>{{Auth::user()->name}} </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                    <div class="sidebar-area pa-50">
                        <figure><img style="width: 360px;height: 295px" class="img-responsive"
                                     src="{{asset('/'.$user->image)}}" alt=""></figure>

                        <div class="like-box-area">
                            <ul>
                                <li><a href="{{url('personal/info/')}}"><i class="fa fa-user-circle-o faa flo-right"
                                                                           aria-hidden="true"></i> <span
                                                class="like-page">البيانات الشخصية</span></a></li>
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="{{url('articles')}}"><i class="fa fa-book faa flo-right"
                                                                         aria-hidden="true"></i> <span
                                                    class="like-page">المقالات</span></a>
                                    </li>
                                @endif
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)

                                    <li><a href="{{url('teams_profile')}}"><i class="fa fa-users faa flo-right"
                                                                              aria-hidden="true"></i> <span
                                                    class="like-page">الفرق</span></a>
                                    </li>
                                @endif
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="{{url('media')}}"><i class="fa fa-picture-o faa flo-right"
                                                                      aria-hidden="true"></i> <span
                                                    class="like-page">الميديا</span></a></li>
                                @endif

                                @if(auth()->user()->roles_id == 3)
                                    <li><a href="{{url('messages')}}"><i class="fa fa-comments-o faa flo-right"
                                                                         aria-hidden="true"></i> <span
                                                    class="like-page">الرسائل</span></a>
                                    </li>
                                @endif
                                <li><a href="{{url('events_profile')}}"><i class="fa fa-calendar faa flo-right"
                                                                           aria-hidden="true"></i> <span
                                                class="like-page">الفعاليات</span></a>
                                </li>
                                @if(auth()->user()->roles_id == 4 || auth()->user()->roles_id == 5)
                                    <li><a href="groups"><i class="fa fa-tags faa flo-right"
                                                            aria-hidden="true"></i> <span
                                                    class="like-page">المجموعات</span></a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="account-page-area">
                        <div class="">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 dir">
                                    <div class="border register margin-null">
                                        @if ($errors->any())
                                            <div style="border: dashed" class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form method="POST" action="{{ url('update/profile/'.$user->id) }}"
                                              enctype="multipart/form-data">
                                            {!! csrf_field() !!}
                                            {!! method_field('PUT') !!}
                                            <fieldset>
                                                <div class="row clear">
                                                    <h3>تحديث البيانات الشخصية</h3>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 clear flo-right">
                                                        <label>الاسم بالكامل</label>
                                                        <input class="form-control" required="" type="text" name="name"
                                                               value="{{ $user->name }}" required autofocus
                                                               oninvalid="setCustomValidity('من فضلك قم بادخال اسمك كاملا')"
                                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>البريد الإلكتروني </label>
                                                        <input class="form-control" type="text" name="email"
                                                               value="{{  $user->email }}" disabled>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                                        <label>أسم المستخدم </label>
                                                        <input class="form-control" type="text" name="username"
                                                               value="{{ $user->username}}" disabled/>
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                                        <label>الدولة</label>
                                                        <select name="country_id" id="country_id" class="form-control">
                                                            @foreach($countries as $country)
                                                                <option value="{{$country->id}}" {{($user->countries_id ==$country->id)?'selected':''}} >{{$country->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div id="govarea_div"
                                                         class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                                        <label id="govarea_lbl"></label>
                                                        <select name="govarea_id" id="govarea_id" class="form-control">
                                                            {{--<option value="">اختر...</option>--}}

                                                        </select>
                                                    </div>

                                                    <div id="city_div"
                                                         class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                                        <label id="cit_lbl"></label>
                                                        <select id="city_id" name="city_id" class="form-control">
                                                            {{--<option value="">اختر...</option>--}}

                                                        </select>
                                                    </div>

                                                    {{--<div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">--}}
                                                    {{--<label>المدينة</label>--}}
                                                    {{--<select name="city_name" id="city_id" class="form-control">--}}
                                                    {{--@foreach($countries as $country)--}}
                                                    {{--<option value="{{$country->id}}" {{($user->countries_id ==$country->id)?'selected':''}} >{{$country->name}}</option>--}}
                                                    {{--@endforeach--}}
                                                    {{--</select>--}}
                                                    {{--</div>--}}


                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                                        <label> كلمة المرور</label>
                                                        <input class="form-control" required="" type="password"
                                                               name="password"
                                                               value="{{$user->plain_password}}"
                                                               oninvalid="setCustomValidity('من فضلك قم بادخال كلمة المرور')"
                                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                                    </div>
                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                                        <label>تأكيد كلمة المرور</label>
                                                        <input class="form-control" type="password"
                                                               name="password_confirmation" required
                                                               value="{{$user->plain_password}}"
                                                               oninvalid="setCustomValidity('من فضلك قم بتأكيد كلمة المرور')"
                                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                                    </div>

                                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">

                                                        <label>نوع العضويه</label>
                                                        <a class="" data-toggle="modal" data-target="#exampleModal2"
                                                           class="example"><i class="fa fa-question-circle icon-edit"
                                                                              aria-hidden="true"></i> </a>
                                                        <select class="form-control" name="roles_id" id="roles_id">
                                                            @foreach ($roles as $role)
                                                                <option value="{{$role->id}}" {{($user->roles_id==$role->id)?'selected':''}} >{{$role->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div style=" width: 688px;" id="sports">

                                                        <div class="row">
                                                            <input type="hidden" name="user_id"
                                                                   value="{{$user_id}}">

                                                            <div class="form-group">
                                                                <div class=" text-right">
                                                                    <h3 class="title-bg "> الرياضات الفردية </h3>
                                                                </div>
                                                                <div class="over-flow">
                                                                    <div class="row" style="padding: 15px">

                                                                        @if(count($sports)>0)
                                                                            @foreach($sports as $sport)
                                                                                <span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right">
                                          <label>
                                            <input type="checkbox" name="sports[]" value="{{$sport->id}}" {{(in_array($sport->id,$sports_ids))?'checked':''}}><span
                                                      class="cr"><i
                                                          class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$sport->name}}
                                                </label>
                                                </span>
                                                                            @endforeach
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                                <div class=" text-right">
                                                                    <h3 class="title-bg mt-25"> الرياضات الجماعية </h3>
                                                                </div>
                                                                <div class="over-flow">
                                                                    <div class="row" style="padding: 15px">

                                                                        @if(count($team_sports)>0)
                                                                            @foreach($team_sports as $sport)
                                                                                <span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right">
                                          <label>
                                            <input class="checkbox" id="{{$sport->id}}" type="checkbox"
                                                   {{(in_array($sport->id,$sports_ids))?'checked':''}}
                                                   name="team_sports_chks[]" value="{{$sport->id}}">
                                              <span class="cr"><i class="fa cr-icon fa-check"
                                                                  aria-hidden="true"></i></span>{{$sport->name}}
                                                </label>

                                                    @if(count($sport->teams)>0)
                                                                                        <div id="spo{{$sport->id}}"
                                                                                             class="tea_div">
                                                <select name="teams{{$sport->id}}" class="form-control he-input">
                                                    <option value=""> حدد الفريق ...</option>
                                                    @foreach($sport->teams as $team)
                                                        <option value="{{$team->id}}" {{(in_array($team->id,$teams_ids))?'selected':''}}>{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                        </div>
                                                                                    @else
                                                                                        <div id="spo{{$sport->id}}"
                                                                                             class="tea_div">
                                                        <span>لم يتم اضافة فرق الى هذه اللعبة بعد </span>
                                                        <span> يمكنك <a href="{{url('contacts')}}">التواصل معنا</a> لاضافة فريقك </span>
                                                        </div>
                                                                                    @endif
                                                </span>
                                                                            @endforeach
                                                                        @endif

                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>


                                                    <div class="form-group col-md-6 flo-right">
                                                        <div class="wrap-custom-file">
                                                            <input type="file" name="image1" id="image1"
                                                                   accept=".gif, .jpg, .png"/>
                                                            <label for="image1">
                                                                <span>تحميل صورة شخصية</span>
                                                                <i class="fa fa-plus-circle"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <div class="wrap-custom-file">
                                                            <input type="file" name="Cv" id="image2"
                                                                   accept=".docx, .pdf, .pptx"/>
                                                            <label for="image2">
                                                                <span>تحميل سيرة ذاتية </span>
                                                                <i class="fa fa-plus-circle"></i>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div class="form-group btn-register col-md-3">
                                                        <button class="btn-send" type="submit"> تأكيد</button>
                                                    </div>
                                                </div>
                                            </fieldset>
                                        </form>
                                        <input id="get_govarea_Url" type="hidden"
                                               value="{{url('get/cities')}}">
                                        <input id="get_country_Url" type="hidden"
                                               value="{{url('get/govareas')}}">
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                    <input id="get_city_Url" type="hidden"
                           value="{{url('get/cities')}}">
                    <input id="cit_id" type="hidden"
                           value="{{$user->city}}">

                </div>
            </div>
        </div>
    </div>

    <!-- help  Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title flo-right" id="exampleModalLabel">أنواع العضويات </h5>
                    <button type="button" class="close flo-left" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div style="padding: 15px">
                            <p class="text-right">
                                ١-المشجعات و المشجعين
                                تشجيع - معرفة كل جديد - الإنضمام والمشاركة بالفعاليات الرياضية


                            </p>
                            <p class="text-right">
                                ٢-سيدات ورجال الأعمال
                                تشجيع - معرفة كل جديد - الإنضمام والمشاركة بالفعاليات الرياضية - إمكانية ( الرعاية
                                والإعلانات لمنشآتكم)</p>
                            <p class="text-right">
                                ٣-المنتميات والمنتميين رياضيا
                                هذا الخيار متاح فقط للاعبات والمسؤلات والمسؤلين رياضيا وعند التسجيل يلزم المراسلة لتفعيل
                                العضوية.</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>
    <script>

        $(document).ready(function () {

            $('#register_btn').css('opacity', '0.2');
            $('#chk_id').on('change', function () {
                if ($('#chk_id').is(":checked")) {
                    $('#register_btn').css('opacity', '1');
                    $('#register_btn').prop('disabled', false);
                } else {
                    $('#register_btn').prop('disabled', true);
                    $('#register_btn').css('opacity', '0.2');
                }
            });
            if ($('#chk_id').is(":checked")) {
                $('#register_btn').css('opacity', '1');
                $('#register_btn').prop('disabled', false);
            } else {
                $('#register_btn').prop('disabled', true);
                $('#register_btn').css('opacity', '0.2');
            }

            $('#sports').hide();
            $('#roles_id').on('change', function () {
                if (this.value == 4) {
                    $('#sports').slideDown();
                } else {
                    $('#sports').slideUp();
                }
            });

            if ($('#roles_id').val() == 4 || $('#roles_id').val() == 5) {
                $('#sports').slideDown();
            } else {
                $('#sports').hide();
            }


            $('.tea_div').hide();
            $(".checkbox").change(function () {
                if (this.checked) {
                    $('#spo' + this.id).slideDown();
                } else {
                    $('#spo' + this.id).slideUp();
                }
            });

            $('input[name="team_sports_chks[]"]:checked').each(function () {
                $('#spo' + this.id).slideDown();
            });


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

                        if (res[1] == 'area') {
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
                                    if (res[1] == city['id']) {
                                        $('#city_id').append($('<option>', {
                                            value: city['id'],
                                            text: city['name']
                                        }).attr('selected', true));
                                    } else {
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

                    if (res[1] == 'area') {
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

                        if (res[2] == govarea['id']) {
                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }).attr('selected', true));
                        } else {
                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }));
                        }
                    });

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
                                if (res[1] == city['id']) {
                                    $('#city_id').append($('<option>', {
                                        value: city['id'],
                                        text: city['name']
                                    }).attr('selected', true));
                                } else {
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
@endsection