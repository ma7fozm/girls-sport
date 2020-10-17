@extends('frontEnd.master')

@section('css')


@endsection
@section('search')
    <form action="{{ route('search') }}" method="POST">
        @csrf
        <div class="search">
            <div class="search-wrap">
                <div class="search-input-elm">
                    <input name="query" class="search-input" type="text" placeholder="ابحث هنا .."/>

                    <input type='hidden' name='models[]' value='App\News'>
                    <input type='hidden' name='col_name[]' value='title'>

                    {{--<input type='hidden' name='models[]' value='App\Media'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Match'>--}}
                    {{--<input type='hidden' name='col_name[]' value='title'>--}}

                    {{--<input type='hidden' name='models[]' value='App\Leagues'>--}}
                    {{--<input type='hidden' name='col_name[]' value='name'>--}}

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
@section('content')
    <!-- Blog Page Start Here -->
    <div class="">
        <div class="container">
            <div class="all-news-area">

                <div class="container">
                    <!-- latest news Start Here -->
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 tab-home">


                            <div class="tab-content popular-tab">
                                <div id="tab-popular1" class="tab-pane fade in active">

                                    <div class="tab-bottom-content">
                                        <div class="row">

                                            @if ($health->count() >0)
                                                @foreach($health as $healthi)
                                                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                                        <div class="news-box">
                                                            <a href="{{ route('health-details',['id'=>$healthi->id])}}"><img src="{{asset('/'.$healthi->image)}}" alt="" class="health-hei"></a>
                                                            <div class="dsc">
                                                                <ul>
                                                                    <li class="txt-ri"><a href="" class="more-btn">{{$healthi->category->name}}</a></li>
                                                                </ul>
                                                                <span class="date"><i class="fa fa-calendar-check-o flo-right" aria-hidden="true"> </i>
{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$healthi->created_at))) }}

                                                </span>
                                                                <h4><a href="{{ route('health-details',['id'=>$healthi->id])}}">{!! Str::words($healthi->title,12, '...')!!}</a>
                                                                    <br/>
                                                                    <br/>
                                                                </h4>
                                                                <p>
                                                                    {!! Str::words($healthi->intro,10, '...')!!}
                                                                </p>
                                                                <ul class="author-all dir">
                                                                    <li class="flo-right txt-ri"><a >{{$healthi->user->name}}</a></li>
                                                                    <li>
                                                                        @if($healthi->comments->count()>0)
                                                                            <a class="comment"><i class="fa fa-comment-o" aria-hidden="true"></i>{{App\Http\Controllers\ArticleController::convertArabicNumbers($healthi->comments->count())}}</a>
                                                                        @endif
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @endif



                                        </div>
                                        <div style="text-align: center">
                                            {{ $health->links('pagination.customPagination') }}

                                        </div>
                                    </div>
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

@endsection