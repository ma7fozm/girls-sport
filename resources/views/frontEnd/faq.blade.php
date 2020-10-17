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
                                    الأسئلة الشائعة
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>الأسئلة الشائعة</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!-- conditions Start Here -->
    <div class="error-page-area">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-2 col-sm-2 col-xs-12 col-md-offset-2">
                    <div id="accordion1" class="panel-group accordion">
                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion11" data-toggle="collapse" href="#accordion11" aria-expanded="false"> <span class="open-sub"></span> <strong>أين المقر الرئيسي لصبايا</strong></a>
                            </div>
                            <div id="accordion11" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>المقر الرئيسي لصبايا  المملكة العربية السعودية - الرياض</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion12" data-toggle="collapse" href="#accordion12" aria-expanded="false"> <span class="open-sub"></span> <strong>ماهي الصفة الرسمية  لصبابا</strong></a>
                            </div>
                            <div id="accordion12" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>هو تطبيق رياضي واجتماعي يهتمموقع وتطبيق الكتروني يهدف لدعم و تطوبر الرياضة للسيدات والفتيات وجمع النخب الرياضة وتعزيز ثقتها وتواصلها معا وتوفير الاخبار الرياضية وصناعتها من خلال الفرق والعضوات المنتسبه لفريق العمل في المشروع حيث نحرص  على مواكبه تطلعات و رؤية أميرنا الشاب ولي العهد الأمين صاحب السمو الملكي الأمير محمد بن سلمان والذي حقق أمنيات الجميع، مما أتاح لنا فكرة نبعت من القلب حباً لهذه المملكة المباركة وحباً في ملكها وولي عهده الأمين وحباً في طرح ما يحقق طموحات الشباب من كلا الجنسين في الشأن الرياضي .
                                        ومن هنا تأتي عزيمتنا بالتحدي من خلال طرح هذا الموقع والذي يُعتبر الأول في المملكة العربية السعودية والعالم  الذي يشجع كل أنواع الرياضات للسيدات و الفتيات حيث  كنا الشريك الرئيسي في عملية التصميم وتحديد اليات العمل بما يتناسب مع ثقافة وتطور الفكر الرياضي النسوي في المملكة حيث إننا نربط بين اللاعبات الموهوبات  الذين لديهم شغف لأنواع مختلفة من الرياضات مع المدربات والمدربين  والفرق و توصيلهم إلى الاحترافية. نحن نساهم في  بناء جيل صحي  رياضي واعي ومثقف وكما سنمكنهم من اقامة البطولات والفعاليات على مدار العام.
                                    </p>
                                </div>
                            </div>
                        </div>


                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion13" data-toggle="collapse" href="#accordion13" aria-expanded="false"> <span class="open-sub"></span> <strong>ما معني الشعار</strong></a>
                            </div>
                            <div id="accordion13" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>لشعارنا مدلولات تواكب ما نتطلع إليه لدعم الرياضات النسائية حتى يصبحن متألقات يسعين للنجوميه، متمسكات بمبادئهن وبلا تحيز او قيود او عنصريه، يجتمعن بحريه تحت ظل مملكتنا الحبيبه</p>
                                </div>
                            </div>

                        </div>


                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion14" data-toggle="collapse" href="#accordion14" aria-expanded="false"> <span class="open-sub"></span> <strong>لماذا استخدم الشعار في كل انواع الالعاب المقدمه في المحتوي؟</strong></a>
                            </div>
                            <div id="accordion14" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>رمزية استخدام الشعار هي انه لا توجد رياضة عصية على المرأه  المبدعه في كثير من المجالات بل تأكيدا على انه لديها القدرة على وجودها في كل مضمار والابداع في جميع الرياضات الجسدية والفكرية وايضا وسمها بتميزها الذي ينطلق من عزيمتهن</p>
                                </div>
                            </div>
                        </div>

                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion15" data-toggle="collapse" href="#accordion15" aria-expanded="false"> <span class="open-sub"></span> <strong>. ما هي الرياضات التي يدعمها    ؟</strong></a>
                            </div>
                            <div id="accordion15" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>جميع انواع الرياضات المختلفة من حيث كيفيّة اللّعب وتصنيفها، وتُقسَّم إلى أقسامٍ عدّةٍ، منها:
                                        الرّياضات القتاليّة: تتمثَّل في مُبارزة شخصٍ لشخصٍ آخر ضمن قواعد وضوابط مُحدّدةٍ. ألعاب القوى: تُعدّ من الرّياضات الأساسيّة في الألعاب الأولمبيّة، وهي رياضات: الوثب، والعدو، والرّمي.
                                        الألعاب الجماعيّة: سُمّيت بهذا الاسم نظراً لأنّها تُلعَب من قِبَل شخصين أو أكثر، وبعضُها من قِبَل أفرقة، ومن الأمثلة عليها: رياضة كُرة القدم، ورياضة كُرة السّلّة، ورياضة كُرة القدم الأمريكيّة، ورياضة كُرة اليد، ورياضة الهوكي (بالإنجليزيّة: Hockey)، وغير ذلك.
                                        ألعاب القوّة: تشتمل على الرّياضات التي تتطلَّب قوّة العضلات لإتمامها، مثل: رياضة كمال الأجسام، ورياضة رفع الأوزان. رياضة التسلُّق: من أمثلتها: تسلُّق الجبال، وتسلُّق الجليد. رياضة ركوب الدّرّاجات: تشمل الدرّاجات الهوائيّة والناريّة، بالإضافة إلى أنواعٍ أُخرى من الدّراجات.
                                        الرّياضات المائيّة والتّجديف: تشمل تجديف القوارب، والكُرة المائيّة، والغوص، وغير ذلك.
                                        الرّياضة الإلكترونيّة هي رياضةٌ حديثةٌ غريبةٌ نسبيّاً، تختلف عن الرّياضات الأُخرى بأنّها لا تتطلَّب أيّ مجهودٍ بدنيٍّ من الإنسان، بل تُلعَب على الأجهزة الحاسوبيّة، ويكون التّحدّي عادةً بين أفرادٍ أو فِرَق تُنافِس بعضها البعض على الشّبكة، وأصبحت هذه الرّياضة مصدراً لكسب المال للمُحترفين؛ إذ قد تصل جائزة المُنافسات إلى ملايين الدّولارات.
                                    </p>
                                </div>
                            </div>
                        </div>



                        <div class="panel">
                            <div class="panel-title">
                                <a class="collapsed" data-parent="#accordion16" data-toggle="collapse" href="#accordion16" aria-expanded="false"> <span class="open-sub"></span> <strong>من يسمح له بالتسجيل؟</strong></a>
                            </div>
                            <div id="accordion16" class="panel-collapse collapse" role="tablist" aria-expanded="false" style="height: 0px;">
                                <div class="panel-content">
                                    <p>جميع الفئات النسائية الراغبين و المهتمين بمعرفة كل ما هو جديد و شيق في عالم الرياضة و الباحثان عن حياة صحية عن طريق الرياضة.</p>
                                </div>
                            </div>
                        </div>

                    </div>


                </div>
            </div>

        </div>
    </div>
    </div>
    <!-- conditions End Here -->

@endsection

@section('scripts')

@endsection