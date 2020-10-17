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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a> 404 خطأ</li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1> 404 خطأ</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Erroe 404 Page Start Here -->
    <div class="error-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="erroe-404">
                        <h2>404</h2>
                        <span>لم يتم العثور على هذة الصفحة</span>
                    </div>
                    <p>الصفحة التى تحاول الوصول اليها غير متاحة او انة قد تم حذفها.
                        اذهب الى الصفحة الرئيسية بالضغط على الزرار فى الاسفل.</p>
                    <a href="{{url('/')}}" class="wid">الذهاب للصفحة الرئيسية</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Erroe 404 Page End Here -->



@endsection
