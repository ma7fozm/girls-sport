@extends('frontEnd.master')

@section('content')

    <!-- Inner Page Header Serction Start Here -->
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
                                <li><a href="{{url('/')}}">الرئيسية <i class="fa fa-compress" aria-hidden="true"></i> </a> نتائج البحث </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>نتائج البحث</h1>
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
            <div class="row">
                <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12"></div>
                <div class="col-lg-10 col-md-6 col-sm-6 col-xs-12">
                    <div class="border text-right" >
                        <h5 class="title2 span text-center">نتائج البحث</h5>


                        <div class="card">
                            @php($cnt = 0 )
                            @php($new_cnt = 0 )
                            @php($media_cnt = 0 )
                            @php($team_cnt = 0 )
                            @php($sport_cnt = 0 )
                            @php($event_cnt = 0 )
                            @php($place_cnt = 0 )
                            @php($match_cnt = 0 )
                            @php($leag_cnt = 0 )
                            @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                @foreach($modelSearchResults as $searchResult)
                                    @if($type == 'media')
                                        @if($searchResult->searchable->status == 1 && $searchResult->searchable->public == 1)
                                            @php($cnt+=1)
                                            @php($media_cnt+=1)
                                        @endif
                                    @else
                                        @if($searchResult->searchable->status == 1)
                                            @php($cnt+=1)
                                            @if($type == 'news')
                                                @php($new_cnt+=1)
                                            @elseif($type == 'teams')
                                                @php($team_cnt+=1)
                                            @elseif($type == 'sports')
                                                @php($sport_cnt+=1)
                                            @elseif($type == 'events')
                                                @php($event_cnt+=1)
                                            @elseif($type == 'places')
                                                @php($place_cnt+=1)
                                            @elseif($type == 'matches')
                                                @php($match_cnt+=1)
                                            @elseif($type == 'leagues')
                                                @php($leag_cnt+=1)
                                            @endif
                                        @endif

                                    @endif
                                @endforeach
                            @endforeach
                            @if($cnt == 0)
                                <div style="direction: rtl" class="card-header"><b> لم يتم العثور
                                        على نتائج مطابقة لـ "{{ request('query') }}" </b></div>
                            @elseif($cnt == 1)
                                <div style="direction: rtl" class="card-header"><b> تم العثور
                                        على نتيجة وحيدة مطابقة لـ "{{ request('query') }}" </b></div>
                            @else
                                <div style="direction: rtl" class="card-header"><b> تم العثور
                                        على {{App\Http\Controllers\ArticleController::convertArabicNumbers($cnt)}} نتائج مطابقة
                                        لـ "{{ request('query') }}" </b></div>
                            @endif
                            {{--<div class="card-header"><b>{{ $cnt }} results found for "{{ request('query') }}"</b></div>--}}

                            <div class="card-body">

                                @if($cnt > 0)
                                    @foreach($searchResults->groupByType() as $type => $modelSearchResults)
                                        @if($type == 'media' && $media_cnt >0)
                                            <h2 class="text-right title-bg"> الميديا </h2>
                                        @elseif($type == 'news' &&  $new_cnt >0)
                                            <h2 class="text-right title-bg"> الأخبار </h2>
                                        @elseif($type == 'teams' &&  $team_cnt >0)
                                            <h2 class="text-right title-bg"> الفرق </h2>
                                        @elseif($type == 'sports' &&  $sport_cnt >0)
                                            <h2 class="text-right title-bg"> الرياضة </h2>
                                        @elseif($type == 'events' &&  $event_cnt >0)
                                            <h2 class="text-right title-bg"> الفعاليات </h2>
                                        @elseif($type == 'places' &&  $place_cnt >0)
                                            <h2 class="text-right title-bg"> الأماكن </h2>
                                        @elseif($type == 'matches' &&  $match_cnt >0)
                                            <h2 class="text-right title-bg"> المباريات </h2>
                                        @elseif($type == 'leagues' &&  $match_cnt >0)
                                            <h2 class="text-right title-bg"> الدوريات </h2>
                                        @endif

                                        @foreach($modelSearchResults as $searchResult)
                                            @if($type == 'media')
                                                @if($searchResult->searchable->status == 1 && $searchResult->searchable->public == 1)
                                                    <ul>
                                                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @elseif($type == 'news')
                                                @if($searchResult->searchable->news_type == 'صحه')
                                                    <ul>
                                                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}  </a>(صحة)
                                                        </li>
                                                    </ul>
                                                @else
                                                    <ul>
                                                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}  </a>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @else
                                                @if($searchResult->searchable->status == 1)
                                                    <ul>
                                                        <li><a href="{{ $searchResult->url }}">{{ $searchResult->title }}</a>
                                                        </li>
                                                    </ul>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endforeach
                                @else
                                    لا توجد نتائج للبحث
                                @endif
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-lg-1 col-md-6 col-sm-6 col-xs-12"></div>

            </div>
        </div>
    </div>
@endsection
