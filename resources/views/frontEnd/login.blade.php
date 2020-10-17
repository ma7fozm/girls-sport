@extends('frontEnd.master')


@section('content')
    <!-- Inner Page Header serction start here -->
    <div class="inner-page-header">
        <div class="banner">
            <img src="{{ asset('design/frontEnd')}}/images/banner/3.jpg" alt="Banner">
        </div>
        <div class="banner-text">
            <div class="container">
                <div class="row dir">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="/">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a> تسجيل الدخول</li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1 >تسجيل الدخول </h1>
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
            <div class="row">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="border">
                        <form id="form-login" method="POST" action="{{ route('login') }}" class="form-horizontal ls_form">
                            {{ csrf_field() }}
                            <fieldset>
                                <div class="row dir">
                                    <h3 style="margin-right: -12px">تسجيل الدخول</h3>
                                    <div class="form-group">
                                        <label>البريد الإلكتروني</label>
                                        <input id="username" placeholder="البريد الالكتروني " type="text" class="form-control{{ $errors->has('username') || $errors->has('email') ? ' is-invalid' : '' }}"
                                               name="username"   autofocus >                                    </div>

                                    {{-- validating username or email --}}
                                    @if ($errors->has('username'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong style="color:red;">{{ $errors->first('username') }}</strong>
                                            </span>
                                    @endif
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong style="color:red;">{{ $errors->first('email') }}</strong>
                                            </span>
                                    @endif

                                    <div class="form-group">
                                        <label>كلمة المرور</label>
                                        <input id="password" type="password" placeholder="كلمة المرور" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">
                                    </div>

                                    {{-- validating password --}}
                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                                <strong style="color:red;">{{ $errors->first('password') }}</strong>
                                            </span>
                                    @endif

                                    <div class="form-group btn-register text-center">
                                        <span class="lost-pass text-right  col-md-12 col-sm-6 col-xs-6"><a href="{{ route('password.request') }}">نسيت كلمة المرور ؟</a></span>
                                        <span class="checkbox col-md-6 col-sm-6 col-xs-6 flo-right">
                                          <label class="flo-right">
                                            <input type="checkbox" value="" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}><span class="cr"><i class="fa cr-icon fa-check" aria-hidden="true"></i></span>تذكرني
                                          </label>
                                        </span>
                                        <button class="btn-send col-md-4 col-sm-12 col-xs-12" type="submit">تسجيل الدخول</button>

                                        <!--         <span class="login">أو يمكنك تسجيل الدخول عن طريق :</span>
                                                <ul class="share-link">
                                                    <li><a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> فيسبوك</a></li>
                                                    <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i> تويتر</a></li>
                                                    <li><a href="#"><i class="fa fa-google" aria-hidden="true"></i> جوجل</a></li>
                                                </ul> -->
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}")
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}")
        @endif
    </script>
@endsection