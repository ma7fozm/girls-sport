@extends('frontEnd.master')

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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a>  تواصل معنا</li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>تواصل معنا</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Contact Us Page Start Here -->
    <div class="single-blog-page-area contact-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right dir">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="leave-comments-area">
                        <h3> تواصل معنا</h3>
                        <div id="form-messages"></div>
                        <form method="post"  action="{{ route('SendToMail') }}" enctype="multipart/form-data" >
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 flo-right">
                                        <div class="form-group">
                                            <input type="text" name="fname" id="fname" class="form-control" required placeholder="الاسم الاول"
                                                   value="{{old('fname')}}"
                                                   oninvalid="setCustomValidity('من فضلك قم ادخل اسمك ')"
                                                   oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12 ">
                                        <div class="form-group">
                                            <input type="text" name="lname" id="lname" class="form-control" required placeholder="الاسم الاخير"
                                                   value="{{old('lname')}}"
                                                   oninvalid="setCustomValidity('من فضلك ادخل اسم العائلة ')"
                                                   oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 col-sm-12 col-xs-12 flo-right">
                                        <div class="form-group">
                                            <input type="text" name="email" id="email" class="form-control" placeholder="البريد الالكتروني" required

                                                   oninvalid="setCustomValidity('من فضلك قم بادخال البريد الالكترونى الخاص بك ')"
                                                   oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            <input type="text" name="phone" id="phone" class="form-control" required placeholder="رقم الجوال"
                                                   value="{{old('phone')}}"
                                                   oninvalid="setCustomValidity('من فضلك قم بادخال رقم هاتفك ')"
                                                   oninput="this.setCustomValidity('')">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <textarea cols="40" id="message" name="message" rows="10" class="textarea form-control txtarea1-hi"
                                                      placeholder="رسالتك ..."
                                                      required oninvalid="setCustomValidity('من فضلك اكتب رسالتك..... ')"
                                                      oninput="this.setCustomValidity('')">{{old('message')}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn-send" type="submit">إرسال </button>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>

                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 dir">
                    <div class="location-area">

                        <h3>بيانات التواصل </h3>

                        <ul>

                            <li><i class="fa fa-twitter" aria-hidden="true"></i> تويتر :<a target="_blank" href="https://twitter.com/Girlssp017"> Girlssp017 </a></li>
                            <li><i class="fa fa-instagram" aria-hidden="true"></i> إنستغرام :<a target="_blank" href="https://www.instagram.com/girlssp017"> Girlssp017 </a></li>
                            <li><i class="fa fa-facebook" aria-hidden="true"></i> فيس بوك:<a target="_blank" href="https://www.facebook.com/Girlssp017-417329375761467"> Girlssp017 </a></li>
                            <li><i class="fa fa-google" aria-hidden="true"></i>  الميل : Girlssp017@gmail.com</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog Details Page end here -->

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
@endsection