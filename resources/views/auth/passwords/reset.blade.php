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
                                <li><a href="/">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>تعيين كلمة المرور</li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>تعيين كلمة المرور</h1>
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
                    <form method="POST" action="{{ route('password.update') }}">

                        @csrf
                     <fieldset>
                                <div class="row dir">
                                    <h3 class="mb-20">إعادة تعيين كلمة المرور</h3>

                        <input type="hidden" name="token" value="{{ $token }}">

                                       <div class="form-group">
                                        <label>البريد الالكتروني</label>

                            
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                         </div>
                                  <div class="form-group">
                                        <label> كلمة المرور الجديدة</label>
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                         </div>
                         <div class="form-group">
                                <label>تأكيد كلمة المرور</label>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                     
                                <div class="col-md-3 col-sm-3 col-xs-6 form-group btn-register">
                                        
                                        <button class="btn-send" type="submit">تأكيد</button>
                                    
                                        
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
