@extends('frontEnd.master')

@section('css')


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
                                    </a>
                                    من نحن
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>من نحن</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!-- Home About Start Here -->
    <div class="home-about-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
                    <h2 class="title2 text-right">من نحن  </h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <p class="text-right">موقع وتطبيق الكتروني يهدف لدعم و تطوبر الرياضة للسيدات والفتيات وجمع النخب الرياضة وتعزيز ثقتها وتواصلها معا وتوفير الاخبار الرياضية وصناعتها من خلال الفرق والعضوات المنتسبه لفريق العمل في المشروع حيث نحرص  على مواكبه تطلعات و رؤية أميرنا الشاب ولي العهد الأمين صاحب السمو الملكي الأمير محمد بن سلمان والذي حقق أمنيات الجميع، مما أتاح لنا فكرة نبعت من القلب حباً لهذه المملكة المباركة وحباً في ملكها وولي عهده الأمين وحباً في طرح ما يحقق طموحات الشباب من كلا الجنسين في الشأن الرياضي .
                        ومن هنا تأتي عزيمتنا بالتحدي من خلال طرح هذا الموقع والذي يُعتبر الأول في المملكة العربية السعودية والعالم  الذي يشجع كل أنواع الرياضات للسيدات و الفتيات حيث  كنا الشريك الرئيسي في عملية التصميم وتحديد اليات العمل بما يتناسب مع ثقافة وتطور الفكر الرياضي النسوي في المملكة حيث إننا نربط بين اللاعبات الموهوبات  الذين لديهم شغف لأنواع مختلفة من الرياضات مع المدربات والمدربين  والفرق و توصيلهم إلى الاحترافية. نحن نساهم في  بناء جيل صحي  رياضي واعي ومثقف وكما سنمكنهم من اقامة البطولات و الفعاليات على مدار العام.
                        ومن الاهداف والرؤيه التي يسعى لها الموقع توعية المجتمع النسوي باهمية الرياضة لهن  ولاسرهن انطلاقا  منهن كأم و أخت وزوجه ايمانا منا بأن يكون المجتمع واعي صحي مثقف ورياضي يثري فيما يقدم روح التعاون والعمل والنشاط

                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <p><img src="images/about/2.jpg" alt=""></p>
                </div>
            </div>
        </div>
    </div>
    <!-- Home About End Here -->

    <!-- Counter Up Section Start Here-->
    <div class="project-activation-area">
        <div class="container">
            <div class="row">
                <div class="ab-count">
                    <!-- ABOUT-COUNTER-LIST START -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6  wow fadeInUp flo-right" data-wow-duration=".3s" data-wow-delay="300ms" style="visibility: visible; animation-duration: .3s; animation-delay: .5s; animation-name: fadeInUp;">
                        <div class="about-counter-list">
                            <p class="icons"><i class="fa fa-user" aria-hidden="true"></i></p>
                            <h1 class="about-counter">{{ $belongplayer }}</h1>
                            <p>اللاعبين</p>
                        </div>
                    </div>
                    <!-- ABOUT-COUNTER-LIST END -->
                    <!-- ABOUT-COUNTER-LIST START -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp flo-right" data-wow-duration=".7s" data-wow-delay="300ms" style="visibility: visible; animation-duration: .7s; animation-delay: .7s; animation-name: fadeInUp;">
                        <div class="about-counter-list">
                            <p class="icons"><i class="fa fa-users" aria-hidden="true"></i></p>
                            <h1 class="about-counter">{{ $teams }}</h1>
                            <p>الفرق</p>
                        </div>
                    </div>
                    <!-- ABOUT-COUNTER-LIST END -->
                    <!-- ABOUT-COUNTER-LIST START -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp flo-right" data-wow-duration=".9s" data-wow-delay="300ms" style="visibility: visible; animation-duration: .9s; animation-delay: .9s; animation-name: fadeInUp;">
                        <div class="about-counter-list">
                            <p class="icons"><i class="fa fa-tag" aria-hidden="true"></i></p>
                            <h1 class="about-counter">{{ $events }}</h1>
                            <p>الفعاليات</p>
                        </div>
                    </div>
                    <!-- ABOUT-COUNTER-LIST END -->
                    <!-- ABOUT-COUNTER-LIST START -->
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 wow fadeInUp flo-right" data-wow-duration="1.2s" data-wow-delay="300ms" style="visibility: visible; animation-duration: 1.2s; animation-delay: 1.2s; animation-name: fadeInUp;">
                        <div class="about-counter-list">
                            <p class="icons"><i class="fa fa-star" aria-hidden="true"></i></p>
                            <h1 class="about-counter">{{ $matches }}</h1>
                            <p>المبارايات  </p>
                        </div>
                    </div>
                    <!-- ABOUT-COUNTER-LIST END -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')

@endsection