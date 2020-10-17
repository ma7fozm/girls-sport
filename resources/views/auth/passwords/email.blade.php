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
                                <li><a href="/">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>نسيت كلمة المرور</li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>نسيت كلمة المرور</h1>
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

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                           <fieldset>
                                <div class="row dir">
                                    <h3>تعيين كلمة المرور</h3>
                                       <h5>من فضلك قم بتعيين كلمة المرور</h5>
                                      <div class="form-group">
                                        <label> البريد الإلكتروني</label>

                           
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
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
