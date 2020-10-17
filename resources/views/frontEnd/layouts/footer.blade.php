<!-- Footer Area Section Start Here -->
<footer>
    <div class="footer-top-area">
        <div class="container">
            <div class="row dir">
                <!-- Footer About Section Start Here -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                    <div class="single-footer footer-one">
                        <h3>من نحن</h3>
                        <div class="footer-logo"><img  src="{{asset('design/frontEnd')}}/images/LogoWhite2.png" alt="footer-logo"></div>
                        <p>موقع وتطبيق الكتروني يهدف لدعم و تطوبر الرياضة للسيدات والفتيات وجمع النخب الرياضة وتعزيز ثقتها وتواصلها معا وتوفير الاخبار الرياضية وصناعتها من خلال الفرق والعضوات المنتسبه لفريق العمل في المشروع حيث نحرص على مواكبه تطلعات و رؤية أميرنا الشاب ولي العهد الأمين صاحب السمو الملكي الأمير محمد بن سلمان والذي حقق أمنيات الجميع</p>
                        <p class="font-w">تواصل معنا عن طريق : </p>
                        <div class="footer-social-media-area">
                            <nav>
                                <ul>
                                    <!-- Facebook Icon Here -->
                                    <li><a href="https://www.facebook.com/Girlssp017-417329375761467"><i class="fa fa-facebook"></i></a></li>
                                    <!-- Google Icon Here -->
                                    <li><a href="https://www.instagram.com/girlssp017/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                                    <!-- Twitter Icon Here -->
                                    <li><a href="https://twitter.com/Girlssp017"><i class="fa fa-twitter"></i></a></li>
                                    <!-- Vimeo Icon Here -->
                                {{--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>--}}
                                <!-- Pinterest Icon Here -->
                                    {{--<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>--}}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
                <!-- Footer About Section End Here -->

                <!-- Footer Popular Post Section Start Here -->
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                    <div class="single-footer footer-two">
                        <h3>أهم الأخبار</h3>
                        <nav>
                            <ul>
                                @foreach($news as $new)
                                    <li>
                                        <div class="col-lg-5 col-md-5 col-sm-5 col-xs-4 flo-right">
                                            <img style="width: 150px; height: 91px; cursor: default" src="{{asset('/'.$new->image)}}"
                                                 alt="post photo">
                                        </div>
                                        <div class="col-lg-7 col-md-7 col-sm-7 col-xs-8">
                                            <p><a href="{{url('/news/'.$new->id)}}">{!! Str::words($new->title,7, '...')!!}</a></p>
                                            <span style="color: #ffffff;"><i class="fa fa-calendar-check-o" aria-hidden="true"> </i>
                    {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$new->created_at)))}}
                                               </span>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- Footer Popular news Section End Here -->

                <!-- Footer categories Section Start Here -->
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="single-footer footer-two">
                        <h3>الأقسام </h3>
                        <nav>
                            <ul>
                                <li>

                                    <p class="ma-0"><a href="{{url('/news')}}"><i class="fa fa-chevron-left"
                                                                                  aria-hidden="true"></i>الأخبار والأحداث</a>
                                    </p>

                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('/gallary')}}"><i class="fa fa-chevron-left" aria-hidden="true"></i>صور وفيديوهات </a></p>

                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('events')}}"><i class="fa fa-chevron-left"
                                                                                   aria-hidden="true"></i> لا للفراغ
                                        </a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('sports')}}"><i class="fa fa-chevron-left"
                                                                                   aria-hidden="true"></i> رياضات وفرق
                                            أعضاء </a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('match')}}"><i class="fa fa-chevron-left"
                                                                                  aria-hidden="true"></i> مبارايات
                                            و دوريات </a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('/places')}}"><i class="fa fa-chevron-left"
                                                                                    aria-hidden="true"></i> أماكن
                                            المبارايات والفعاليات </a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{url('/health')}}"><i class="fa fa-chevron-left"
                                                                                    aria-hidden="true"></i> الصحة</a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{ route('conditions') }}"><i class="fa fa-chevron-left"
                                                                                           aria-hidden="true"></i> الشروط
                                            والأحكام</a></p>
                                </li>
                                <li>
                                    <p class="ma-0"><a href="{{ route('fqa') }}"><i class="fa fa-chevron-left"
                                                                                    aria-hidden="true"></i> الأسئلة
                                            الشائعة</a></p>
                                </li>

                            </ul>
                        </nav>
                    </div>

                </div>
                <!-- Footer categories Section End Here -->
            </div>
        </div>
    </div>
    <!-- Footer Copyright Area Start Here -->
    <div class="footer-bottom-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer-bottom">
                        <p> 2019 جميع الحقوق محفوظة &copy;</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer Copyright Area End Here -->
</footer>

<!-- Start scrollUp  -->
<div id="return-to-top">
    <span></span>
</div>
<!-- End scrollUp  -->
<!-- Footer Area Section End Here -->

<!-- all js here -->
<!-- jquery latest version -->
<script src="{{asset('design/frontEnd')}}/js/jquery.min.js"></script>
<!-- jquery-ui js -->
<script src="{{asset('design/frontEnd')}}/js/jquery-ui.min.js"></script>
<!-- bootstrap js -->
<script src="{{asset('design/frontEnd')}}/js/bootstrap.min.js"></script>
<!-- meanmenu js -->
<script src="{{asset('design/frontEnd')}}/js/jquery.meanmenu.js"></script>
<!-- wow js -->
<script src="{{asset('design/frontEnd')}}/js/wow.min.js"></script>
<!-- Slick js -->
<script src="{{asset('design/frontEnd')}}/js/slick.min.js"></script>
<!-- magnific-popup js -->
<!-- owl.carousel js -->
<script src="{{asset('design/frontEnd')}}/js/owl.carousel.min.js"></script>
<!-- magnific-popup js -->
<script src="{{asset('design/frontEnd')}}/js/jquery.magnific-popup.js"></script>
<!-- jquery.counterup js -->
<script src="{{asset('design/frontEnd')}}/js/jquery.counterup.min.js"></script>
<script src="{{asset('design/frontEnd')}}/js/waypoints.min.js"></script>
<!-- jquery light box -->
<script src="{{asset('design/frontEnd')}}/js/lightbox.min.js"></script>
<!-- main js -->
<script src="{{asset('design/frontEnd')}}/js/main.js"></script>

<!-- toaster notifications -->
<script src="{{asset('assets/js/jquery.datetimepicker.full.js')}}"></script>
<script src="{{asset('assets/js/jquery.datetimepicker.full.min.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


<script type="text/javascript">
    function markRead(url) {
        // window.location.href = url;
        $.ajax({
            type: 'GET',
            url: url,
            success: function (data) {
                $("#not_count").slideUp();
                // $("#not_count").css('visibility', 'hidden');
            },
            error: function() {
                console.log(data);
            }
        });
    }

    function notClk(url,url_clicked) {
        $.ajax({
            type: 'GET',
            url: url_clicked,
            success: function (data) {
                window.location.href = url;
            },
            error: function() {
                console.log(data);
            }
        });
    }

</script>


@yield('scripts')

</body>

</html>