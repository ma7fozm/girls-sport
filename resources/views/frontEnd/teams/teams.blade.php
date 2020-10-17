@extends('frontEnd.master')

@section('css')

    <link rel="stylesheet" href="{{url('/')}}/assets/swal2/sweetalert2.min.css" type="text/css"/>

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
                                    </a> الفرق
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>الفرق</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- teams Start Here -->
    <div id="scroll" class="blog-page-area">
        <div class="container">
            <div class="row mt-20">

                @foreach($teams as $team)
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 flo-right">
                        <ul>
                            <li>
                                <div class="col-lg-2 col-md-6 col-sm-6 col-xs-12 flo-right">
                                    <div>
                                        <a href="team-details.html">
                                            <img src="{{asset('/'.$team->slogan)}}" alt=" photo" class="te-im">
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12 text-right">
                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                                        <div class="form-group">
                                            @guest
                                                <a href="{{url('/login')}}"
                                                   class="btn-send bt-plus" id="plus"> انضم </a>
                                            @else
                                                @if(count(@$team->authUser) == 0)
                                                    <a href="{{url('teams/join/'.$team->id)}}"
                                                       class="btn-send bt-plus confirmation" id="plus"> انضم </a>
                                                @elseif(count(@$team->authUser) >= 0 && @$team->authUser->first()->pivot->status == 0)
                                                    <a href="{{url('teams/disJoin/'.$team->id)}}"
                                                       class="btn-send bt-minus confirmation" id="minus"> الغاء </a>
                                                @else
                                                    <a href="{{url('teams/disJoin/'.$team->id)}}"
                                                       class="btn-send bt-minus confirmation" id="minus"> الغاء </a>
                                                @endif
                                            @endguest
                                        </div>
                                    </div>
                                    <h3 class="col-lg-8 col-md-8 col-sm-12 col-xs-12"><a
                                                href="{{url('teams/'.$team->id)}}">{{$team->name}}</a></h3>
                                    <p>{{$team->description}}</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                @endforeach

                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                        <div style="text-align: center">

                            {{ $teams->links('pagination.customPagination') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- Blog Page End Here -->

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
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="{{url('/')}}/assets/swal2/sweetalert2.min.js"></script>

    <script>

        $(document).ready(function () {
            if (window.location.hash != null && window.location.hash != '') {
                var myTarget = document.querySelector('#scroll');
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop - 70, 10)}, 1000);
            }
        });

    </script>

    <script type="text/javascript">
        $('.confirmation').on('click', function () {
            if (this.id == 'plus') {
                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الانضمام الى هذا الفريق ومشاركة جميع احداثه',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم ,أريد الانضمام !',
                    cancelButtonText: 'لا ,شكرا !',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم ارسال طلب الانضمام !",
                        text: "تم ارسال طلب انضمامكم للادمن وهو قيد الموافقة",
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
                        location.reload();
                    });

                });

            } else if (this.id == 'minus') {

                var href = $(this).attr('href');
                $(this).removeAttr("href");
                swal({
                    title: 'هل انت متأكد ؟',
                    text: '! هل تود حقا الغاء طلب المشاركة بتلك الفاعلية',
                    type: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'نعم',
                    cancelButtonText: 'لا',
                    allowOutsideClick: false,
                    allowEscapeKey: false,

                }).then(function () {

                    swal({
                        title: " تم الالغاء !",
                        text: "تم الغاء طلب انضمامكم للفاعلية",
                        type: "success",
                        allowOutsideClick: false,
                        allowEscapeKey: false,
                        closeOnEsc: false,
                    }).then(function () {
                        window.location.href = href;
                    });

                }).catch(function (reason) {

                    location.reload();

                });
            }
        });
    </script>

@endsection