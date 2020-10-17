@extends('frontEnd.master')

@section('css')


@endsection

@section('content')
 
    <div class="single-blog-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 single-image flo-right">
                        <img src="{{asset('/'.$match->image)}}" alt="" class="hei-3">
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                    <h3>{{$match->title}}</h3>
                    <p>{{$match->description}}</p>
                </div>
                 <blockquote>
                      
                         <div class="row">
                    <div class="item col-lg-6 col-md-4 col-sm-4 col-xs-12 flo-right">
                    	            @foreach ($teams as $team)
                               
                                    @foreach ($match->teams as $t)
                                    @if ($team->id == $t->id)
                                        @if ($loop->first)
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                            <div class="inner">
                                                <img style="height: 95px !important;width: 130px !important;margin-bottom: 10px !important;" src="{{asset('/'.$t->slogan)}}" alt="">
                                                <h4>{{$t->name}}</h4>
                                            </div>
                                        </div>
                                             @endif
                                        @endif
                                           @endforeach
                                      @endforeach
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                            <span class="vs">Vs</span><br>
                                            <span class="radison">{{$match->start_time}} {{$match->place->name}}</span>
                                        </div>  
                                         @foreach ($teams as $team)
                               
                                    @foreach ($match->teams as $t)
                                    @if ($team->id == $t->id)
                                        @if ($loop->last)                                  
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                            <div class="inner">
                                                 <img style="height: 95px !important;width: 130px !important;margin-bottom: 10px !important;" src="{{asset('/'.$t->slogan)}}" alt="">
                                                <h4>{{$t->name}}</h4>
                                            </div>
                                        </div>

                                             @endif
                                        @endif
                                           @endforeach
                                      @endforeach
                                    </div>
                    </div>
                   
                    </blockquote>



                   
                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 life-style flo-right">
                                <span class="admin"> <a href="#"><i class="fa fa-user-o" aria-hidden="true"></i> {{$match->added_by->name}} </a> <a href="#"> <i class="fa fa-comment-o" aria-hidden="true"></i> {{$match->comments->count()}}</a></span>
                                <span class="date">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i> {{$match->created_at->format('Y-m-d')}} </span>
                                
                            </div>
                        
                        </div>
                    </div>

                
<!--                    sponsers-->
                   @if(count($match->sponsors)>0)
                        <div class="fetuered-videos team-page-area dir-r">
                            <div class="container">
                                <div class="row">
                                    <div class="view-area flo-right">
                                        <div class="col-sm-12">
                                            <h3 class="title-bg mr-10"> الرعاة </h3>
                                        </div>
                                    </div>
                                </div>
                                <div id="author-slider-section" class="owl-carousel">
                                    @foreach($match->sponsors as $sposor)
                                        <div class="item">
                                            <div class="single-videos">
                                                <div class="single-member-area spc-o">
                                                    <div class="cl-single-member">
                                                        <figure><img class="img-responsive slider-img owl-ims"
                                                                     src="{{asset('/'.$sposor->image)}}"
                                                                     alt=""></figure>

                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                 
                
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                </div>
                
        </div>
    </div>
    </div>
    <!-- Blog Details Page end here -->


@endsection

@section('scripts')

@endsection