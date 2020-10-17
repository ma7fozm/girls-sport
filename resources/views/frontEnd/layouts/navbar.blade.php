<!--Header area start here-->
<header>
    <div class="header-top-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 ">
                    <div class="header-top-left">

                        @if (Auth::user())
                            <ul>
                                <li><a href="{{ url('personal/info') }}"><i class="fa fa-user fs flo-right ml-5"
                                                                            aria-hidden="true"></i>
                                        &nbsp; {{ Auth::user()->name }}</a></li>
                                <li>|</li>
                                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fs flo-right ml-5"
                                                                       aria-hidden="true"></i> &nbsp;
                                        تسجيل الخروج</a></li>
                                <li>|</li>
                                <li>
                                    <div class="dropdown" style="padding: 5px">
                                        <a onclick="markRead('{{url('/markAsRead')}}')" role="button"
                                           data-toggle="dropdown" id="dropdownMenu1" data-target="#"
                                           aria-expanded="true">الاشعارات
                                            <i onclick="markRead('{{url('/markAsRead')}}')"
                                               class="fa fa-bell ic flo-right ml-5">
                                            </i>
                                        </a> @if(count(auth()->user()->unreadNotifications))
                                            <span id="not_count"
                                                  class="badge badge-danger">{{count(auth()->user()->unreadNotifications)}}</span> @else
                                            <span id="not_count" class="badge badge-danger"></span> @endif
                                        <ul style="width: auto !important;"
                                            class="dropdown-menu dropdown-menu-left pull-right m-tr" role="menu"
                                            aria-labelledby="dropdownMenu1">
                                            <li role="presentation" style="margin-right: 0px !important; width: 100% ">
                                                <a class="dropdown-menu-header text-center">الإشعارات</a>
                                            </li>
                                            <ul style="width: auto !important;overflow-y: scroll; height: 300px"
                                                class="text-right m-w li-he">

                                                @foreach(auth()->user()->unreadNotifications as $notification)
                                                    <li {{(!$notification->clicked)? ' style=background-color:#efeded' : ''}} class="li-he"> @if($notification->type == 'App\Notifications\joinAccept') @if($notification->data['type'] == 'event')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/events/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لفعالية {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'team')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/teams/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لفريق {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'group')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/groups/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لمجموعة{{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>

                                                        @endif @elseif($notification->type == 'App\Notifications\joinRequest') @if($notification->data['type'] == 'event')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى فعالية {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'team')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى فريق {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'group')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى مجموعة {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>

                                                        @endif @endif @php $to = \Carbon\Carbon::now(); $from = $notification->created_at; $diff_in_minutes = $to->diffInMinutes($from); $diff_in_hours = $to->diffInHours($from); @endphp @if($diff_in_minutes
                                            < 60) <span class="spann-p"> منذ {{$diff_in_minutes}} دقيقة </span>
                                                        @else
                                                            <span class="spann-p"> منذ  {{$diff_in_hours}} ساعة </span> @endif
                                                    </li>
                                                    <br> @endforeach
                                                    @foreach(auth()->user()->readNotifications as $notification)
                                                    <li {{(!$notification->clicked)? ' style=background-color:#efeded' : ''}} class="li-he"> @if($notification->type == 'App\Notifications\joinAccept') @if($notification->data['type'] == 'event')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/events/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لفعالية {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'team')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/teams/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لفريق {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'group')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/groups/'.$notification->data['joined']['id'])}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i> تم الموافقة على
                                                                    انضمامك
                                                                    لمجموعة{{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>

                                                        @endif @elseif($notification->type == 'App\Notifications\joinRequest') @if($notification->data['type'] == 'event')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى فعالية {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'team')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى فريق {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>
                                                        @elseif($notification->data['type'] == 'group')
                                                            <p class="pp">
                                                                <a style="cursor: pointer"
                                                                   onclick="notClk('{{url('/requests')}}','{{url('/clicked/'.$notification->id)}}')">
                                                                    <i class="fa fa-bell-o fm"></i>
                                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                                    الى مجموعة {{$notification->data['joined']['name']}}
                                                                </a>
                                                            </p>

                                                        @endif @endif @php $to = \Carbon\Carbon::now(); $from = $notification->created_at; $diff_in_minutes = $to->diffInMinutes($from); $diff_in_hours = $to->diffInHours($from); @endphp @if($diff_in_minutes
                                            < 60) <span class="spann-p"> منذ {{$diff_in_minutes}} دقيقة </span>
                                                        @else
                                                            <span class="spann-p"> منذ  {{$diff_in_hours}} ساعة </span> @endif
                                                    </li>
                                                    <br> @endforeach
                                            </ul>
                                        </ul>
                                    </div>
                                </li>
                            </ul>
                        @else
                            <ul>
                                <li><a href="{{ route('login') }}"><i class="fa fa-user fs flo-right ml-5"
                                                                      aria-hidden="true"></i> تسجيل الدخول</a>
                                </li>
                                <li>|</li>
                                <li><a href="{{route('register')}}"><i class="fa fa-lock fs flo-right ml-5"
                                                                       aria-hidden="true"></i>إنشاء حساب
                                    </a>
                                </li>

                            </ul>
                        @endif
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                    <div class=" header-top-left text-right dir">

                        <ul>
                            <li><a href="https://www.facebook.com/Girlssp017-417329375761467" class="active"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="https://www.instagram.com/girlssp017/"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            <li><a href="https://twitter.com/Girlssp017"><i class="fa fa-twitter"></i></a></li>
                            {{--<li><a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a></li>--}}
                            {{--<li><a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a></li>--}}
                        </ul>
                    </div>

                    {{--
                    <div class=" header-top-left text-right dir">--}} {{--
                        <ul>--}} {{--@if (Auth::user())--}} {{--
                            <li><a href="#"><i class="fa fa-user" aria-hidden="true"></i> &nbsp; {{ Auth::user()->name }}</a></li>--}} {{--
                            <li>|</li>--}} {{--
                            <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out" aria-hidden="true"></i> &nbsp; تسجيل الخروج</a></li>--}} {{--@else--}} {{--
                            <li><a href="{{ route('login') }}"><i class="fa fa-user" aria-hidden="true"></i> &nbsp;تسجيل الدخول</a></li>--}} {{--
                            <li>|</li>--}} {{--
                            <li><a href="{{ route('register') }}"><i class="fa fa-lock" aria-hidden="true"></i> &nbsp;إنشاء حساب</a></li>--}} {{--@endif--}} {{--@if (Auth::user()->roles_id == 4)--}} {{--
                            <li><a href="{{ route('activation') }}"> &nbsp;ل تريد ان تصبح منتمي ادمن </a></li>--}} {{--@endif--}} {{--
                        </ul>--}} {{--
                    </div>--}}
                </div>
            </div>
        </div>
    </div>

@auth
    @if (auth()->user()->roles_id == 4 && auth()->user()->upgrade == 0)
        <!--activate account-->
            <div class="header-top-area">
                <div class="container">
                    <div class="row">
                        <div class=" col-lg-6 col-md-6 col-sm-12 col-xs-12 ">
                            <div class="header-top-left">
                                <a href="{{ route('activation') }}"><span
                                            class="date">لتفعيل أو ترقية العضوية  </span></a>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class=" header-top-left text-right dir">

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endauth

    <div class="header-middle-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-4 col-sm-5 col-xs-6 flo-right">
                    <div class="logo-area">
                        <a href="{{url('/')}}"><img src="{{asset('design/frontEnd')}}/images/LogoWhite2.png" alt="logo"></a>
                    </div>
                </div>
                <div class="col-lg-9 col-md-8 col-sm-7 col-xs-6">
                    <div class="flo-left dir">
                        <!--Header Search  here-->
                        @yield('search')
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-area dir" id="sticky">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="navbar-header">
                        <button class="navbar-toggle" type="button" data-toggle="collapse"
                                data-target=".navbar-collapse">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                    </div>
                    <div class="main-menu navbar-collapse collapse">
                        <nav>
                            <ul>

                                <li><a href="{{url('/index')}}" class="active">الرئيسية </a>

                                </li>

                                </li>
                                <li><a href="{{url('/news')}}" class="has">الأخبار والأحداث</a>

                                </li>
                                <li><a href="{{url('/gallary')}}" class="has">صور وفيديوهات</a>

                                </li>
                                <li><a href="{{url('events')}}">لا للفراغ </a></li>
                                <li><a href="{{url('sports')}}">رياضات وفرق </a></li>
                                <li><a href="{{url('/match')}}">مبارايات و دوريات</a></li>
                                <li><a href="{{url('/places')}}">أماكن المبارايات و  الفعاليات</a></li>
                                <li><a href="{{url('/health')}}"> الصحه </a></li>
                                <li><a href="{{url('/about')}}">من نحن </a></li>
                                <li><a href="{{url('contacts')}}" class="has">تواصل معنا </a>

                                </li>
                            </ul>
                        </nav>
                    </div>
                </div>

            </div>
        </div>
    </div>
</header>

<!--Header area end here-->