@extends('admin.master')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <!--Top header start-->
            <h3 class="ls-top-header">Dashboard</h3>
            <!--Top header end -->

            <!--Top breadcrumb start -->
            <ol class="breadcrumb">
                <li><i class="fa fa-home"></i></li>
                <li class="active">لوحة القيادة</li>
            </ol>
            <!--Top breadcrumb start -->
        </div>
    </div>
    <!-- Main Content Element  Start-->
    <div class="row">

        <div class="col-md-2"></div>
        <div class="col-md-4">
            <div class="current-status-widget">
                <ul>
                    <li>
                        <div class="status-box col">
                            <div class="status-box-icon label-lightBlue white">
                                <i class="fa fa-trophy"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $events }}</h5>
                            <a href="{{ url('admin/events')}}"><p class="lightGreen" style="font-size: 18px;">
                                    الفاعاليات</p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-light-green white">
                                <i class="fa fa-calendar"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $matches }}</h5>
                            <a href="{{url('admin/matchs')}}"><p class="lightGreen" style="font-size: 18px;">
                                    المباريات</p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-red white">
                                <i class="fa fa-futbol-o"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{$sports}}</h5>
                            <a href="{{url('admin/sports')}}"><p class="light-blue" style="font-size: 18px;">
                                    الرياضات</p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-lightBlue white">
                                <i class="fa fa-users"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $teams }}</h5>
                            <a href="{{url('admin/teams')}}"><p class="light-blue" style="font-size: 18px;">الفرق</p>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-red white">
                                <i class="fa fa-spinner"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $groups}}</h5>
                            <a href="{{url('admin/groups')}}"><p class="light-blue" style="font-size: 18px;">
                                    المجموعات</p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4">
            <div class="current-status-widget">
                <ul>

                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-light-green white">
                                <i class="fa fa-cogs"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $super }}</h5>
                            <a href="{{url('admin/users')}}"><p class="lightGreen" style="font-size: 18px;">سوبر
                                    ادمن </p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-success white">
                                <i class="fa fa-eye"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $fan }}</h5>
                            <a href="{{url('admin/users')}}"><p class="lightGreen" style="font-size: 18px;">
                                    المشجعين </p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-red white">
                                <i class="fa fa-dollar"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $investor }} </h5>
                            <a href="{{url('admin/users')}}"><p class="lightGreen" style="font-size: 18px;">
                                    المستثمرين </p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>


                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-light-green white">
                                <i class="fa fa-asterisk"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $belongplayer }} </h5>
                            <a href="{{url('admin/users')}}"><p class="lightGreen" style="font-size: 18px;">منتمي
                                    لاعب </p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                    <li>
                        <div class="status-box">
                            <div class="status-box-icon label-success white">
                                <i class="fa fa-cog"></i>
                            </div>
                        </div>
                        <div class="status-box-content">
                            <h5>{{ $belongadmin }} </h5>
                            <a href="{{url('admin/users')}}"><p class="lightGreen" style="font-size: 18px;">منتمي
                                    ادمن</p></a>
                        </div>
                        <div class="clearfix"></div>
                    </li>
                </ul>
            </div>

        </div>
        <div class="col-md-2"></div>
    </div>


    <!-- Main Content Element  End-->


@endsection
@section('js')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>
@endsection

@section('boot')
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/bootstrap.min.js"></script>
@endsection