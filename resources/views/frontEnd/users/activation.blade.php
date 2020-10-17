@extends('frontEnd.master')

@section('css')
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
                                    </a>تفعيل العضوية
                              </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>
تفعيل العضوية

                             </h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
      <div class="account-page-area">
        <div class="container">
            <div class="row dir">
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
         
                </div>
                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                    <div class="border register margin-null">
                        <form role="form" enctype="multipart/form-data" method="post" action="{{url('activation/add')}}">
                           {!! csrf_field() !!}
                            <fieldset>
                                <div class="row">
                                    <h3>تفعيل العضوية</h3>
                                                      
         
               
                                            @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                                    <div class="form-group col-md-6 flo-right">
                                        <label>الاسم بالكامل</label>
                                        <input class="form-control" value="{{Auth::user()->name}}" readonly type="text">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>البريد الإلكتروني </label>
                                        <input class="form-control" value="{{Auth::user()->email}}" readonly  type="text">
                                    </div>
                                 
                                    <div class="form-group col-md-6">

                                        <label >المدينه</label>
                                         <input class="form-control" value="{{Auth::user()->city->name}}" readonly  type="text">

                                    </div>
                                  <div class="form-group col-md-6 flo-right">
                                        <label>الفريق الذي تنتمي اليه</label>
                                      
                                      @if(count($teams)>0)
                                                            
                                     <select id="team_id" name="team_id" class="form-control">
                                                                @foreach($teams as $team)
                                                                    <option value="{{$team->id}}">{{$team->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else
                                                        <br/>
                                                            <span style="color: #4c110f;">انت غير مشترك فى اى فريق</span>
                                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 flo-right">

                                        <label >الرياضة المنتمي لها </label>
                                       <br/>

                                      @if(count($sports)>0)
                                                            
                                     <select id="team_id" name="team_id" class="form-control">
                                                                @foreach($sports as $sport)
                                                                    <option value="{{$sport->id}}">{{$sport->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        @else

                                                            <span style="color: #4c110f;">انت غير منتمي لأي رياضه</span>
                                                        @endif

                                    </div>
                                         <div class="form-group col-md-12 flo-right">
                                        <div class="wrap-custom-file">
                                            <input type="file" name="personal_proof" value="{{old('personal_proof')}}" id="image1" accept=".gif, .jpg, .png" />
                                            <label for="image1">
                                                <span>تحميل إثبات شخصية</span>
                                                <i class="fa fa-plus-circle"></i>
                                            </label>
                                        </div>
                                    </div>
                                  <h3 class="title-bg mvp flo-right"> بيانات الشخص الموثوق</h3>
                                 <div class="form-group col-md-12 flo-right">
                                        <label>الاسم   </label>
                                        <input class="form-control"  name="guarantor_name" value="{{old('guarantor_name')}}"  type="text">
                                    </div>
                                    <div class="form-group col-md-6">

                                        <label >البريد الإلكتروني</label>
                                         <input class="form-control"  name="guarantor_email" value="{{old('guarantor_email')}}" type="text">

                                    </div> 
                                    <div class="form-group col-md-6">

                                        <label >رقم الجوال</label>
                                         <input class="form-control"  name="guarantor_phone" value="{{old('guarantor_phone')}}" type="text">

                                    </div>
                               
                                    <div class="form-group btn-register col-md-3" style="margin-left: 6px;">

                                        <button class="btn-send" type="submit">تفعيل </button>
                                      
                                   
                                    </div>
                                                      </div>
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">

                </div>
            </div>
        </div>
    </div>
 
                  

               
@endsection

@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}")
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}")
        @endif
    </script>
@endsection