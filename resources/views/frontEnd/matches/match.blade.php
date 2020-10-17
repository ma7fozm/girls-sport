@extends('frontEnd.master')

@section('css')

@section('search')
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="search">
            <div class="search-wrap">
                <div class="search-input-elm">
                    <input name="query" class="search-input" type="text" placeholder="ابحث هنا .."/>

                    {{--<input type='hidden' name='models[]' value='App\News'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Media'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    <input type='hidden' name='models[]' value='App\Match'>
                    <input type='hidden' name='col_name[]' value='title'>

                    <input type='hidden' name='models[]' value='App\Leagues'>
                    <input type='hidden' name='col_name[]' value='name'>

                    {{--<input type='hidden' name='models[]' value='App\Event'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Place'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Team'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Sport'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}


                </div>
                <a href="#search" data-toggle="collapse" class="search-btn"><i class="fa fa-search"
                                                                               aria-hidden="true"></i></a>
            </div>
        </div>
    </form>
@endsection

@endsection

@section('content')
    <div class="single-blog-page-area contact-page-area">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 col-md-4 col-sm-4 col-xs-12 flo-right">

                    <div class="sidebar-arean text-right">

                        @if($all_leagues->count() ==0 && $all_matchs->count() ==0)
                            <div style="text-align: center">
                            لا توجد دوريات او مباريات متوفرة الان
                            </div>
                            @else

                        @if ($all_leagues->count() >0)
                            <div class="recent-results">
                                <h3 class="title-bg"> الدوريات المؤكدة الجاهزة</h3>
                                <div class="inner dir">
                                    <ul>
                                        @foreach($all_leagues as $league)
                                            <li class="mb-10">
                                                <table class="clo">
                                                    <tr>
                                                        <td class="td-width"><img src="{{asset('/'.$league->image)}}"
                                                                                  class="event-im">{{$league->name}}
                                                        </td>

                                                        <td class="td-width"><a class="btn-send btnn padd-btn"
                                                                                href="{{ route('league-details',['id'=>$league->id])}}">المزيد </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                            </div>
                        @endif

                        @if ($all_matchs->count() >0)

                            <div class="recent-results">
                                <h3 class="title-bg"> المبارايات المؤكدة الجاهزة</h3>
                                <div class="inner dir">
                                    <ul>
                                        @foreach($all_matchs as $match)
                                            <li class="mb-10">
                                                <table class="clo">
                                                    <tr>
                                                        <td class="td-width"><img src="{{asset('/'.$match->image)}}"
                                                                                  class="event-im">{{$match->title}}
                                                        </td>

                                                        <td class="td-width"><a class="btn-send btnn padd-btn"
                                                                                href="{{ route('match-details',['id'=>$match->id])}}">المزيد </a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </li>
                                        @endforeach

                                    </ul>
                                </div>

                            </div>
                            @else
                                <h3 class="title-bg"> المبارايات المؤكدة الجاهزة</h3>
                                <div style="text-align: center">
                                لا توجد مباريات الان
                                </div>

                            @endif

                            {{--@else--}}
                            {{--<div style="text-align: center">--}}
                                {{--لا توجد دوريات او مباريات متوفرة الان--}}
                            {{--</div>--}}

                            @endif


                    </div>
                </div>


            </div>

            <div style="text-align: center">
                <?php
                if($max_length == "matches"){ ?>
                {{ $all_matchs->links() }}
                <?php }else{ ?>
                {{ $all_leagues->links() }}
                <?php } ?>
            </div>

        </div>

@endsection

@section('scripts')

@endsection