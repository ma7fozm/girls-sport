@extends('admin.master')
@section('content')

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title">طلبات الانضمام للفاعليات</h1>
                </div>
                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="table-responsive ls-table">
                        <table class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">صورة الفاعلية</th>
                                <th class="text-center">اسم الفاعلية</th>
                                <th class="text-center">صورة الشخص</th>
                                <th class="text-center">اسم الشخص</th>
                                <th class="text-center">الاجراء</th>
                            </tr>
                            </thead>
                            <tbody>

                            @php($count=0)
                            @if(count($events)>0)
                                @foreach($events as $admin_event)
                                    @foreach($admin_event->joinRequests as $request)
                                        <tr>
                                            <td style="vertical-align: middle" class="text-center">{{++$count}}</td>
                                            <td style="vertical-align: middle;width:90px ;" class="text-center"><img style="display:block;width:100% ; height:60px"
                                                                         src="{{asset('/'.$admin_event->image)}}"></td>
                                            <td style="vertical-align: middle" class="text-center">{{$admin_event->name}}</td>
                                            <td style="vertical-align: middle;width:90px ;" class="text-center"><img style="display:block;width:100% ; height:60px"
                                                                         src="{{asset('/'.App\User::find($request->user_id)->image)}}"></td>
                                            <td style="vertical-align: middle" class="text-center">{{App\User::find($request->user_id)->name}}</td>
                                            <td style="vertical-align: middle" class="text-center">
                                                <a class="btn btn-xs btn-success" href="{{url('admin/events/approve/'.$admin_event->id.'/'.$request->user_id)}}" ><i class="fa fa-check"></i></a>
                                                <a class="btn btn-xs btn-danger" href="{{url('admin/events/remove/'.$admin_event->id.'/'.$request->user_id)}}"><i class="fa fa-times"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                    </div>
                    <!--Table Wrapper Finish-->
                </div>
            </div>
        </div>
    </div>

@endsection
@section('js')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>
@endsection

@section('boot')
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/bootstrap.min.js"></script>
@endsection