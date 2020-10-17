<!--Left navigation section start-->
<section id="left-navigation">
    <!--Left navigation user details start-->
    <div class="user-image">
        <img style="max-width: 80px;max-height: 80px;" src="{{asset('/'.Auth::user()->image)}}" alt=""/>
        <div class="user-online-status"><span class="user-status is-online  "></span></div>
    </div>
    <ul class="social-icon">
        <a href="{{url('admin/users/'.Auth::user()->id.'/edit')}}"><h4 style="color: #ffffff;">{{Auth::user()->username}}</h4></a>
    </ul>
    <!--Left navigation user details end-->

    <!--Phone Navigation Menu icon start-->
    <div class="phone-nav-box visible-xs">
        <a class="phone-logo" href="index.html" title="">
            <h1>Fickle</h1>
        </a>
        <a class="phone-nav-control" href="javascript:void(0)">
            <span class="fa fa-bars"></span>
        </a>
        <div class="clearfix"></div>
    </div>
    <!--Phone Navigation Menu icon start-->

    <!--Left navigation start-->
    <ul class="mainNav">
        <li class="active">
            <a  href="{{url('admin/')}}">
                <i class="fa fa-dashboard"></i> <span>لوحة القيادة</span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/users')}}">
                <i class="fa fa-user"></i> <span>ادراة الاعضاء</span>
            </a>
        </li>

        <li>
            <a href="{{url('admin/teams')}}">
                <i class="fa fa-group"></i> <span>ادارة الفرق</span>
            </a>
        </li>
      
              <li>

            <a href="#">
                <i class="fa fa-image"></i> <span>ميديا</span>
            </a>
            <ul>
                <li><a href="{{url('admin/gallary/')}}"> <i class="fa fa-globe"></i>   ميديا الموقع</a></li>
                <li><a href="{{url('admin/media/')}}"><i class="fa fa-user"></i>الاعضاء</a></li>
                <li><a href="{{url('admin/teams/show/media')}}"><i class="fa fa-users"></i>الفرق</a></li>
                <li><a href="{{url('admin/groups/show/media')}}"><i class="fa fa-users"></i>المجموعات</a></li>
                <li><a href="#">
                        <i class="fa fa-calendar"></i> <span>الفعاليات</span>
                    </a>
                    <ul>
                        <li><a href="{{url('admin/event/album')}}"> <i class="fa fa-folder"></i> الالبومات</a></li>
                        <li><a href="{{url('admin/eventMedia/create')}}"><i class="fa fa-image"></i>الميديا</a></li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="{{url('admin/groups')}}">
                <i class="fa fa-group"></i> <span>ادارة المجموعات</span>
            </a>
        </li>

         <li>
            <a href="{{url('admin/Categories')}}">
                <i class="fa fa-list-alt"></i> <span>اداره الاقسام</span>
            </a>
        </li>
        <li>
            <a href="{{url('admin/news')}}">
                <i class="fa fa-newspaper-o"></i> <span>ادارة الاخبار</span>
            </a>
        </li>

        <li>
            <a href="{{url('admin/articles')}}">
                <i class="fa fa-book"></i> <span>ادارة المقالات</span>
            </a>
        </li>

         <li>
            <a href="{{url('admin/Sponsors')}}">
                <i class="fa fa-group"></i> <span>ادارة الرعاه</span>
            </a>
        </li>
 <li>
            <a href="{{url('admin/places')}}">
                <i class="fa fa-newspaper-o"></i> <span>ادارة الاماكن</span>
            </a>
        </li>


  <li>
            <a href="{{ url('admin/events')}}">
                <i class="fa fa-calendar"></i> <span>ادارة الفعاليات</span>
            </a>
        </li>

        <li>
            <a href="{{url('admin/matchs')}}">
                <i class="fa fa-futbol-o"></i> <span>ادارة المباريات</span>
            </a>
        </li>

        <li>
            <a href="{{url('admin/sports')}}">
                <i class="fa fa-gamepad"></i> <span>ادارة الرياضات</span>
            </a>
        </li>

          <li>
            <a href="{{url('admin/Leagues')}}">
                <i class="fa fa-spinner"></i> <span>اداره الدوريات </span>
            </a>
        </li>

        <li>
            <a href="{{url('admin/messages')}}">
                <i class="fa fa-envelope"></i> <span>ادارة الرسايل</span>
            </a>
        </li>

    </ul>
    <!--Left navigation end-->
</section>
<!--Left navigation section end-->
