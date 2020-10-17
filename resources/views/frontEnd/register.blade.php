@extends('frontEnd.master')

@section('css')
    <style>
        ul {
            list-style: circle;
            margin: 0;
            margin-bottom: 0px;
            margin-right: 10px;
            padding: 0;
        }

        input,a {
            position: relative;
            z-index: 1;
        }

        select {
            position: relative;
            z-index: 1;
        }
    </style>

@endsection

@section('content')
    <!-- Inner Page Header serction start here -->
    <div class="inner-page-header">
        <div class="banner">
            <img src="{{ asset('design/frontEnd/images/banner/3.jpg')}}" alt="Banner">
        </div>
        <div class="banner-text">
            <div class="container">
                <div class="row dir">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a>
                                    حساب جديد
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>حساب جديد</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Blog Page Start Here -->
    <div class="account-page-area">
        <div class="container">
            <div class="row dir">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
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
                        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="row clear">
                                    <h3>إنشاء حساب جديد</h3>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 clear flo-right">
                                        <label>الاسم بالكامل</label>
                                        <input class="form-control" required="" type="text" name="name"
                                               value="{{ old('name') }}" placeholder="الاسم بالكامل" required autofocus
                                               oninvalid="setCustomValidity('من فضلك قم بادخال اسمك كاملا')"
                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <label>البريد الإلكتروني </label>
                                        <input class="form-control" required="" type="text" name="email"
                                               value="{{ old('email') }}" placeholder="البريد الالكترونى" required
                                               oninvalid="setCustomValidity('من فضلك قم بادخال بريدك الالكترونى')"
                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label>أسم المستخدم </label>
                                        <input class="form-control" required="" type="text" name="username"
                                               value="{{ old('username') }}" placeholder="اسم المستخدم" required
                                               oninvalid="setCustomValidity('من فضلك قم بادخال اسم المستخدم الخاص بك')"
                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label>الدولة</label>
                                        <select name="country_id" id="country_id" class="form-control">
                                            <option value="">اختر...</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country->id}}" {{(old('country_id')==$country->id)?'selected':''}} >{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div id="govarea_div" class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label id="govarea_lbl"></label>
                                        <select name="govarea_id" id="govarea_id" class="form-control">
                                            <option value="">اختر...</option>

                                        </select>
                                    </div>

                                    <div id="city_div" class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label id="cit_lbl"></label>
                                        <select id="city_id" name="city_id" class="form-control">
                                            <option value="">اختر...</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label> كلمة المرور</label>
                                        <input class="form-control"
                                               placeholder="كلمة المرور" required="" type="password"
                                               name="password_confirmation"
                                               oninvalid="setCustomValidity('من فضلك قم بادخال كلمة المرور')"
                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label>تأكيد كلمة المرور</label>
                                        <input class="form-control" type="password" name="password"
                                               placeholder="تأكيد كلمة المرور" required
                                               oninvalid="setCustomValidity('من فضلك قم بتأكيد كلمة المرور')"
                                               oninput="this.setCustomValidity('')" autocomplete="off">
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12 flo-right">
                                        <label id="cit_lbl"> النوع </label>
                                        <select name="user_type" class="form-control">
                                            <option value="ذكر"> ذكر</option>
                                            <option value="انثى"> انثى</option>
                                        </select>
                                    </div>

                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">

                                        <label>نوع العضويه</label>
                                        <a class="" data-toggle="modal" data-target="#exampleModal2" class="example"><i class="fa fa-question-circle icon-edit" aria-hidden="true" ></i> </a>
                                        <select class="form-control" name="roles_id" id="roles_id">
                                            <option value="">اختر...</option>
                                            @foreach ($roles as $role)
                                                <option value="{{$role->id}}" {{(old('roles_id')==$role->id)?'selected':''}} >{{$role->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>


                                    <div style=" width: 688px;" id="sports" class="form-group">
                                        {{--@if(count($sports)>0)--}}
                                            {{--<div class="row">--}}
                                                {{--<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">الرياضات الفردية--}}
                                                    {{--:</label>--}}
                                                {{--@foreach($sports as $sport)--}}
                                                    {{--<span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right"><label>--}}
                                                      {{--<input type="checkbox" value="{{$sport->id}}"--}}
                                                             {{--name="sports[]"><span class="cr">--}}
                                                  {{--<i class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$sport->name}}--}}
                                            {{--</label>--}}

                                            {{--</span>--}}
                                                {{--@endforeach--}}

                                            {{--</div>--}}
                                        {{--@endif--}}

                                        {{--@if(count($team_sports)>0)--}}
                                            {{--<div class="row">--}}
                                                {{--<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">الرياضات الجماعية--}}
                                                    {{--:</label>--}}
                                                {{--@foreach($team_sports as $sport)--}}
                                                    {{--<span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right"><label>--}}
                                                      {{--<input type="checkbox" value="{{$sport->id}}"--}}
                                                             {{--name="teamsports[]"><span class="cr">--}}
                                                  {{--<i class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$sport->name}}--}}
                                            {{--</label>--}}

                                            {{--</span>--}}
                                                {{--@endforeach--}}

                                            {{--</div>--}}
                                        {{--@endif--}}

                                        {{--@if(count($teams)>0)--}}
                                        {{--<div class="row">--}}
                                        {{--<label class="col-lg-12 col-md-12 col-sm-12 col-xs-12">فرق الرياضات الجماعية :</label>--}}
                                        {{--@foreach($teams as $team)--}}
                                        {{--<span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right">--}}
                                        {{--<label>--}}
                                        {{--<input type="checkbox" value="{{$team->id}}" name="teams[]"><span--}}
                                        {{--class="cr">--}}
                                        {{--<i class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$team->name}}--}}
                                        {{--</label>--}}
                                        {{--</span>--}}
                                        {{--@endforeach--}}
                                        {{--</div>--}}
                                        {{--@endif--}}
                                    </div>

                                    {{--<div class="form-group col-md-6 flo-right">--}}
                                    {{--<div class="wrap-custom-file">--}}
                                    {{--<div class="wrap-custom-file">--}}
                                    {{--<input type="file" name="image1" id="image1" accept=".gif, .jpg, .png"--}}
                                    {{--required value="{{old('image1')}}"--}}
                                    {{--oninvalid="setCustomValidity('من فضلك قم بتعيين صورتك الشخصية')"--}}
                                    {{--oninput="this.setCustomValidity('')" autocomplete="off"/>--}}
                                    {{--<label for="image1">--}}
                                    {{--<span>تحميل صورة شخصية</span>--}}
                                    {{--<!--<i class="fa fa-plus-circle"></i>-->--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="form-group col-md-6">--}}
                                    {{--<div class="wrap-custom-file">--}}
                                    {{--<input type="file" name="Cv" id="image2" accept=".docx, .pdf, .pptx"/>--}}
                                    {{--<label for="image2">--}}
                                    {{--<span>تحميل سيرة ذاتية </span>--}}
                                    {{--<!--<i class="fa fa-plus-circle"></i>-->--}}
                                    {{--</label>--}}
                                    {{--</div>--}}
                                    {{--</div>--}}
                                    <div class="form-group btn-register text-center col-sm-12 col-xs-12">
                                        <span class="checkbox col-md-6 col-sm-12 col-xs-12 flo-right">
                                          <label class="flo-right">
                                            <input id="chk_id" type="checkbox" value=""><span class="cr"><i
                                                          class="fa cr-icon fa-check" aria-hidden="true"></i></span>أوافق علي الشروط والأحكام
                                        </label>
                                        <a href="{{url('conditions')}}"> <i class="fa fa-arrow-left fs"
                                                                            aria-hidden="true"></i></a>
                                        </span>
                                        <button id="register_btn" class="btn-send col-md-4 col-sm-12 col-xs-12  " type="submit" disabled>
                                            انشاء حساب
                                        </button>

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
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
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

            // $('#sports').hide();
            // $('#roles_id').on('change', function () {
            //     if (this.value == 4) {
            //         $('#sports').slideDown();
            //     } else {
            //         $('#sports').slideUp();
            //     }
            // });
            //
            // if ($('#roles_id').val() == 4) {
            //     $('#sports').slideDown();
            // } else {
            //     $('#sports').hide();
            // }

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

                        $('#govarea_id').append($('<option>', {
                            value: '',
                            text: '--اختر--'
                        }));
                        res[0].forEach(function (govarea) {

                            $('#govarea_id').append($('<option>', {
                                value: govarea['id'],
                                text: govarea['name']
                            }));
                        });

                        $('#city_div').hide();
                        $('#govarea_div').slideDown();

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

                    $('#govarea_id').append($('<option>', {
                        value: '',
                        text: '--اختر--'
                    }));
                    res[0].forEach(function (govarea) {

                        $('#govarea_id').append($('<option>', {
                            value: govarea['id'],
                            text: govarea['name']
                        }));
                    });

                    $('#govarea_div').slideDown();

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
                        $('#city_id').append($('<option>', {
                            value: '',
                            text: '--اختر--'
                        }));
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
            //
            //     var govarea_id = $('#govarea_id').val();
            //
            //     var url = $('#get_govarea_Url').val();
            //     var _token = $("input[name='_token']").val();
            //
            //     $.ajax({
            //         url: url,
            //         dataType: 'json',
            //         type: 'post',
            //         data: {_token: _token, govareaID: govarea_id},
            //         beforeSend: function () {
            //             $("#city_id").empty();
            //             $('#city_div').slideUp();
            //         },
            //         success: function (cities) {
            //             $('#city_id').append($('<option>', {
            //                 value: '',
            //                 text: '--اختر--'
            //             }));
            //             cities.forEach(function (city) {
            //                 $('#city_id').append($('<option>', {
            //                     value: city['id'],
            //                     text: city['name']
            //                 }));
            //             });
            //             $('#city_div').slideDown();
            //         }, error: function (xhr) {
            //             console.log(xhr.responseJSON);
            //         },
            //
            //     });
        });

    </script>

    <!-- help  Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                                تشجيع - معرفة كل جديد - الإنضمام والمشاركة بالفعاليات الرياضية - إمكانية ( الرعاية والإعلانات لمنشآتكم)</p>
                            <p class="text-right">
                                ٣-المنتميات والمنتميين رياضيا
                                هذا الخيار متاح فقط للاعبات والمسؤلات والمسؤلين  رياضيا وعند التسجيل يلزم المراسلة لتفعيل العضوية.</p>
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