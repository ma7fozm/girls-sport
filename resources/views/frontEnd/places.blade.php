@extends('frontEnd.master')

@section('css')

@endsection

@section('content')
    <!-- Blog Page Start Here -->
    <div class="blog-page-area">
        <div class="container">
            <!--            individual sports places start-->
            <div class="row">
                <div class="view-area mt-20">
                    <div class="col-sm-12 text-right">
                        <h3 class="title-bg ">أماكن الفعاليات</h3>
                    </div>
                </div>

                @if ($events->count() >0)
                    @foreach($events as $event)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right dir">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="blog-image">
                                            <img src="{{asset('/'.$event->image)}}" alt="Blog photo" srcset="" style="height:170px">
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                        <h3 style="margin-bottom: 10px !important">{{$event->name}}</h3>
                                        <span class="admin"><i class="fa fa-user-o" aria-hidden="true"></i> {{$event->added_by->name}}  |
                                            
                                        <i class="fa fa-calendar-check-o" aria-hidden="true"> </i>  {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$event->created_at)))}}  </span><br>
                                        <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$event->address}}</span>
                                        <p>{{$event->events[0]->name}}</p>


                                    </div>
                                </li>
                            </ul>
                        </div>
                    @endforeach
            </div>
            @endif

            <div class="row">
                <div style="text-align: center">

                </div>
            </div>
            <!--            individual sports places end-->
            <!--            team sports places start-->
            @if ($matches->count() >0)
                <div class="row">
                    <div class="view-area mt-20">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg ">أماكن المباريات</h3>
                        </div>
                    </div>

                    @foreach($matches as $match)
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right dir">
                            <ul>
                                <li>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 flo-right">
                                        <div class="blog-image">
                                            <img src="{{asset('/'.$match->image)}}" alt="Blog photo" srcset="" style="height:170px">
                                        </div>
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

                                        <h3 style="margin-bottom: 10px !important">{{$match->name}}</h3>
                                        <span class="admin"><i class="fa fa-user-o" aria-hidden="true"></i> {{$match->added_by->name}} | <i
                                                    class="fa fa-calendar-check-o" aria-hidden="true"> </i> {{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$match->created_at)))}}</span> <br>
                                        <span><i class="fa fa-map-marker" aria-hidden="true"></i> {{$match->address}}</span>
                                        <p>{{$match->matches[0]->name}}</p>


                                    </div>
                                </li>
                            </ul>
                        </div>

                    @endforeach

                </div>
        @endif



        <!--            team sports end-->
        </div>
    </div>
    <!-- Blog Page End Here -->
    <div class="container">
        <div class="row">
            <div style="text-align: center">
                <?php
                if($max_length == "events"){ ?>
                {{ $events->links() }}
                <?php }else{ ?>
                {{ $matches->links() }}
                <?php } ?>
            </div>
        </div>
    </div>

@endsection

@section('scripts')

@endsection