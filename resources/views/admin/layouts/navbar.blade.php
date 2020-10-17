<!--Navigation Top Bar Start-->
<nav class="navigation">
    <div class="container-fluid">
        <!--Logo text start-->
        <div class="header-logo">
            <a href="{{url('admin')}}" title="">
                <img style="width: 170px;height: 43px;" src="{{asset('/')}}/design/frontEnd/images/Logo-head.png" alt="logo"></a>
        </div>
        <!--Logo text End-->
        <div class="top-navigation">
            <!--Collapse navigation menu icon start -->
            <div class="menu-control hidden-xs">
                <a href="javascript:void(0)">
                    <i class="fa fa-bars"></i>
                </a>
            </div>
            <!--Collapse navigation menu icon end -->
            <!--Top Navigation Start-->

            <ul>
                <li class="dropdown">
                    <!--Notification drop down start-->
                    <a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
                        <span onclick="markRead('{{url('admin/markAsRead')}}')" class="fa fa-bell-o"></span>
                        @if(count(auth()->user()->unreadNotifications))
                            <span id="not_count"
                                  class="badge badge-red">{{count(auth()->user()->unreadNotifications)}}</span>
                        @endif
                    </a>

                    <div class="dropdown-menu right top-notification" >
                        <h4>الاشعارات</h4>
                        <ul style="width: 320px; overflow-y: scroll; height: 220px" class="ls-feed">

                            @foreach(auth()->user()->unreadNotifications as $notification)
                                <li {{(!$notification->clicked)? ' style=background-color:#efeded;padding-right:10px;' : ''}} >
                                    @if($notification->type == 'App\Notifications\eventMessage')

                                        @if($notification->data['type'] == 'message')
                                            <a class="flo-right" style="cursor: pointer"
                                               onclick="notClk('{{url('admin/messages')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                                <i class="fa fa-bell-o fm"></i>
                                                ارسل {{$notification->data['user']['name']}}
                                                طلب اضافة رعاة
                                                لفاعلية {{$notification->data['event']['name']}}
                                            </a>
                                        @endif
                                    @elseif($notification->type == 'App\Notifications\upgradeProfile')

                                        <a class="flo-right" style="cursor: pointer"
                                           onclick="notClk('{{url('admin/users/'.$notification->data['user']['id'].'/edit')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                            <i class="fa fa-bell-o fm"></i>
                                            ارسل {{$notification->data['user']['name']}}
                                            طلب لترقية حسابه لمنتمى ادمن
                                        </a>

                                    @elseif($notification->type == 'App\Notifications\joinRequest')
                                        @if($notification->data['type'] == 'event')
                                            <p class="pp">
                                                <a style="cursor: pointer"
                                                   onclick="notClk('{{url('admin/request')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                                    <i class="fa fa-bell-o fm"></i>
                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                    الى فاعلية {{$notification->data['joined']['name']}}
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

                                        @endif
                                    @endif
                                    @php
                                        $to = \Carbon\Carbon::now();
                                        $from =  $notification->created_at;
                                         $diff_in_minutes = $to->diffInMinutes($from);
                                         $diff_in_hours = $to->diffInHours($from);
                                         $diff_in_days = $to->diffInDays($from);
                                    @endphp
                                    @if($diff_in_minutes < 60)
                                        <span class="spann-p"> منذ  {{$diff_in_minutes}} دقيقة </span>
                                    @elseif($diff_in_hours < 24)
                                        <span class="spann-p"> منذ  {{$diff_in_hours}} ساعة </span>
                                    @else
                                        <span class="spann-p"> منذ  {{$diff_in_days}} يوم </span>
                                    @endif
                                </li> <br>

                            @endforeach

                            @foreach(auth()->user()->readNotifications as $notification)
                                <li {{(!$notification->clicked)? ' style=background-color:#efeded;padding-right:10px;' : ''}} >
                                    @if($notification->type == 'App\Notifications\eventMessage')

                                        @if($notification->data['type'] == 'message')
                                            <a class="flo-right" style="cursor: pointer"
                                               onclick="notClk('{{url('admin/messages')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                                <i class="fa fa-bell-o fm"></i>
                                                ارسل {{$notification->data['user']['name']}}
                                                طلب اضافة رعاة
                                                لفاعلية {{$notification->data['event']['name']}}
                                            </a>
                                        @endif
                                    @elseif($notification->type == 'App\Notifications\upgradeProfile')

                                        <a class="flo-right" style="cursor: pointer"
                                           onclick="notClk('{{url('admin/users/'.$notification->data['user']['id'].'/edit')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                            <i class="fa fa-bell-o fm"></i>
                                            ارسل {{$notification->data['user']['name']}}
                                            طلب لترقية حسابه لمنتمى ادمن
                                        </a>

                                    @elseif($notification->type == 'App\Notifications\joinRequest')
                                        @if($notification->data['type'] == 'event')
                                            <p class="pp">
                                                <a style="cursor: pointer"
                                                   onclick="notClk('{{url('admin/request')}}','{{url('admin/clicked/'.$notification->id)}}')">
                                                    <i class="fa fa-bell-o fm"></i>
                                                    طلب {{$notification->data['user']['name']}} الانضمام
                                                    الى فاعلية {{$notification->data['joined']['name']}}
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

                                        @endif


                                    @endif
                                    @php
                                        $to = \Carbon\Carbon::now();
                                        $from =  $notification->created_at;
                                         $diff_in_minutes = $to->diffInMinutes($from);
                                         $diff_in_hours = $to->diffInHours($from);
                                         $diff_in_days = $to->diffInDays($from);
                                    @endphp
                                    @if($diff_in_minutes < 60)
                                        <span class="spann-p"> منذ  {{$diff_in_minutes}} دقيقة </span>
                                    @elseif($diff_in_hours < 24)
                                        <span class="spann-p"> منذ  {{$diff_in_hours}} ساعة </span>
                                    @else
                                        <span class="spann-p"> منذ  {{$diff_in_days}} يوم </span>
                                    @endif
                                </li> <br>

                            @endforeach


                        </ul>
                    </div>
                    <!--Notification drop down end-->
                </li>
                <li>
                    <a href="{{ route('logout') }}">
                        <i class="fa fa-power-off"></i>
                    </a>
                </li>

            </ul>
            <!--Top Navigation End-->
        </div>
    </div>
</nav>
<!--Navigation Top Bar End-->