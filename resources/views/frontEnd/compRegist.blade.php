@extends('frontEnd.master')

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
                                    </a> حساب جديد
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>حساب جديد</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->

    <!-- Blog Page Start Here -->
    <div class="account-page-area">
        <div class="container">
            <div class="row dir">
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">

                </div>
                <div class="col-lg-10 col-md-10 col-sm-8 col-xs-12">
                    <div class="border register margin-null">
                        @if ($errors->any())
                            <div style="border: dashed" class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{url('comp_regist')}}" enctype="multipart/form-data">
                            {!! csrf_field() !!}
                            <fieldset>
                                <div class="row">
                                    <input type="hidden" name="user_id" value="{{$user_id}}">

                                    <div class="form-group">
                                        <div class=" text-right">
                                            <h3 class="title-bg "> الرياضات الفردية </h3>
                                        </div>
                                        <div class="over-flow">
                                            <div class="row" style="padding: 15px">

                                                @if(count($sports)>0)
                                                    @foreach($sports as $sport)
                                                        <span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right">
                                          <label>
                                            <input type="checkbox" name="sports[]" value="{{$sport->id}}"><span class="cr"><i
                                                          class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$sport->name}}
                                                </label>
                                                </span>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>
                                        <div class=" text-right">
                                            <h3 class="title-bg mt-25"> الرياضات الجماعية </h3>
                                        </div>
                                        <div class="over-flow">
                                            <div class="row" style="padding: 15px">

                                                @if(count($team_sports)>0)
                                                    @foreach($team_sports as $sport)
                                                        <span class="col-lg-4 col-md-6 col-sm-6 col-xs-12 checkbox flo-right">
                                          <label>
                                            <input class="checkbox" id="{{$sport->id}}" type="checkbox" name="team_sports_chks[]" value="{{$sport->id}}">
                                              <span class="cr"><i class="fa cr-icon fa-check" aria-hidden="true"></i></span>{{$sport->name}}
                                                </label>

                                                    @if(count($sport->teams)>0)
                                                                <div id="spo{{$sport->id}}" class="tea_div">
                                                <select name="teams{{$sport->id}}" class="form-control he-input">
                                                    <option value=""> حدد الفريق ...</option>
                                                    @foreach($sport->teams as $team)
                                                        <option value="{{$team->id}}">{{$team->name}}</option>
                                                    @endforeach
                                                </select>
                                                        </div>
                                                            @else
                                                                <div id="spo{{$sport->id}}" class="tea_div">
                                                        <br><span>لم يتم اضافة فرق الى هذه اللعبة بعد </span>
                                                        <span> يمكنك <a href="{{url('contacts')}}">التواصل معنا</a> لاضافة فريقك </span>
                                                        </div>
                                                            @endif
                                                </span>
                                                    @endforeach
                                                @endif

                                            </div>

                                        </div>
                                        <button class="col-lg-2 col-md-2 col-sm-4 col-xs-12 btn-send btnn pa">تأكيد
                                        </button>
                                    </div>

                                </div>
                            </fieldset>
                        </form>

                    </div>
                </div>
                <div class="col-lg-1 col-md-1 col-sm-2 col-xs-12">

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    <script>

        $(document).ready(function () {

            $('.tea_div').hide();
            $(".checkbox").change(function() {
                if(this.checked) {
                    $('#spo'+this.id).slideDown();
                }else {
                    $('#spo'+this.id).slideUp();
                }
            });

            $('input[name="team_sports_chks[]"]:checked').each(function() {
                $('#spo'+this.id).slideDown();
            });

        });
    </script>
@endsection
