@extends('frontEnd.master')

@section('css')

    <link rel="stylesheet" href="{{url('/')}}/assets/swal2/sweetalert2.min.css" type="text/css"/>


    <style>

        .pagination > .active > a, .pagination > .active > span, .pagination > .active > a:hover, .pagination > .active > span:hover, .pagination > .active > a:focus, .pagination > .active > span:focus {

            z-index: 3;
            color: #b01712;
            background-color: #337ab7;
            border-color: #337ab7;
            cursor: default;
        }
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
                <div class="row dir">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="header-page-locator">
                            <ul>
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i>
                                    </a>
                                    قائمة الطلبات
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>قائمة الطلبات </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Blog Single Start Here -->
    <div class="single-blog-page-area">
        <div class="container">
            <div id="scroll_tbl" class="row">

                <!--    join orders-->
                <div class="limiter">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> قائمة الطلبات </h3>
                        </div>
                    </div>
                    <div class="container-table100">

                        <div class="wrap-table100">
                            <div class="table100 ver1 m-b-110">
                                <div class="table100-head dir">
                                    <table>
                                        <thead>
                                        <tr class="row100 head">
                                            <th class="cell100 column1">#</th>
                                            <th class="cell100 column2">الصوره</th>
                                            <th class="cell100 column3">مجموعة/فريق/فاعلية</th>
                                            <th class="cell100 column3">اسم العضو</th>
                                            <th class="cell100 column4">الإجراء</th>
                                        </tr>
                                        </thead>
                                    </table>
                                </div>

                                <div  class="table100-body js-pscroll dir">
                                    <table>
                                        <tbody>
                                        @php($count = 0)
                                        @if(count($groups)>0)
                                            @foreach($groups as $admin_group)
                                                @foreach($admin_group->joinRequests as $request)
                                                    <tr class="row100 body">
                                                        <td class="cell100 column1">{{++$count}}</td>
                                                        <td class="cell100 column2"><img
                                                                    src="{{asset('/'.$admin_group->image_url)}}"
                                                                    class="table-img"></td>
                                                        <td class="cell100 column3"><i
                                                                    class="text-primary"> {{$admin_group->name}} </i>
                                                        </td>
                                                        <td class="cell100 column3 text-dark">{{App\User::find($request->user_id)->name}}</td>
                                                        <td class="cell100 column4"><a id="agree" class="confirmation_group"
                                                                        href="{{url('groups/approve/'.$admin_group->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-check ico-g "
                                                                        aria-hidden="true"></i></a>
                                                            <a  id="remove" class="confirmation_group"
                                                               href="{{url('groups/remove/'.$admin_group->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-times ico-r" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif

                                        @if(count($teams)>0)
                                            @foreach($teams as $admin_team)
                                                @foreach($admin_team->joinRequests as $request)
                                                    <tr class="row100 body">
                                                        <td class="cell100 column1">{{++$count}}</td>
                                                        <td class="cell100 column2"><img
                                                                    src="{{asset('/'.$admin_team->slogan)}}"
                                                                    class="table-img"></td>
                                                        <td class="cell100 column3"><i
                                                                    class="text-danger"> {{$admin_team->name}} </i>
                                                        </td>
                                                        <td class="cell100 column3 text-dark">{{App\User::find($request->user_id)->name}}</td>
                                                        <td class="cell100 column4"><a id="agree" class="confirmation_team"
                                                                                       href="{{url('teams/approve/'.$admin_team->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-check ico-g "
                                                                   aria-hidden="true"></i></a>
                                                            <a  id="remove" class="confirmation_team"
                                                                href="{{url('teams/remove/'.$admin_team->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-times ico-r" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif

                                        @if(count($events)>0)
                                            @foreach($events as $admin_event)
                                                @foreach($admin_event->joinRequests as $request)
                                                    <tr class="row100 body">
                                                        <td class="cell100 column1">{{++$count}}</td>
                                                        <td class="cell100 column2"><img
                                                                    src="{{asset('/'.$admin_event->image)}}"
                                                                    class="table-img"></td>
                                                        <td class="cell100 column3"><i
                                                                    class="text-success"> {{$admin_event->name}} </i>
                                                        </td>
                                                        <td class="cell100 column3 text-dark">{{App\User::find($request->user_id)->name}}</td>
                                                        <td class="cell100 column4"><a id="agree" class="confirmation_group"
                                                                                       href="{{url('events/approve/'.$admin_event->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-check ico-g "
                                                                   aria-hidden="true"></i></a>
                                                            <a  id="remove" class="confirmation_group"
                                                                href="{{url('events/remove/'.$admin_event->id.'/'.$request->user_id)}}">
                                                                <i class="fa fa-times ico-r" aria-hidden="true"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endforeach
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

    <script>

        $(document).ready(function () {

            if (window.location.hash != null && window.location.hash != '') {
                var type = window.location.hash.substr(1);
                var myTarget = document.querySelector('#' + type);
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop+20, 10)}, 1000);
            }
        });

    </script>

    <script type="text/javascript">
        $('.confirmation_group').on('click', function () {
            if (this.id == 'agree') {
                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الموافقة على انضمام هذا العضو للمجموعة ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الانضمام",
                        text: "تم انضمام العضو للمجموعة ",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    swal({
                        title: " الغاء !",
                        text: "تم الغاء طلب الانضمام :)",
                        type: "error",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        obj.attr("href",href);
                        // location.reload();
                    });

                });

            } else if (this.id == 'remove') {

                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا حذف طلب انضمام هذا العضو لتلك المجموعة ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الحذف !",
                        text: "تم حذف طلب الانضمام",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {
                    obj.attr("href",href);
                    // location.reload();

                });
            }
        });
    </script>

    <script type="text/javascript">
        $('.confirmation_team').on('click', function () {
            if (this.id == 'agree') {
                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الموافقة على انضمام هذا العضو للفريق ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الانضمام",
                        text: "تم انضمام العضو للفريق ",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    swal({
                        title: " الغاء !",
                        text: "تم الغاء طلب الانضمام :)",
                        type: "error",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        obj.attr("href",href);
                        // location.reload();
                    });

                });

            } else if (this.id == 'remove') {

                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا حذف طلب انضمام هذا العضو لهذا الفريق ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الحذف !",
                        text: "تم حذف طلب الانضمام",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {
                    obj.attr("href",href);
                    // location.reload();

                });
            }
        });
    </script>

    <script type="text/javascript">
        $('.confirmation_event').on('click', function () {
            if (this.id == 'agree') {
                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الموافقة على انضمام هذا العضو للفاعلية ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الانضمام",
                        text: "تم انضمام العضو للفاعلية ",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    swal({
                        title: " الغاء !",
                        text: "تم الغاء طلب الانضمام :)",
                        type: "error",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        obj.attr("href",href);
                        // location.reload();
                    });

                });

            } else if (this.id == 'remove') {

                var href = $(this).attr('href');
                var obj = $(this);
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا حذف طلب انضمام هذا العضو لتلك الفاعلية ',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الحذف !",
                        text: "تم حذف طلب الانضمام",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {
                    obj.attr("href",href);
                    // location.reload();

                });
            }
        });
    </script>

@endsection