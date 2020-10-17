@extends('admin.master')
@section('css')
    <style>
        form {
            display: inline-block;
        }
    </style>
@endsection
@section('content')

    @if(session()->has('message'))
        <div class="alert alert-success">
            {{session()->get('message')}}
        </div>
    @endif
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h1 class="panel-title"> جميع التعليقات الخاصة بفاعلية <bold>{{$event->name}}</bold> </h1>
                </div>
                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="ls-editable-table table-responsive ls-table">
                        <table class="table table-bordered table-striped" id="ls-editable-table">

                            <thead>
                            <tr class="active">
                                <th class="text-center">#</th>
                                <th class="text-center"> التعليق</th>
                                <th class="text-center">تم بواسطة</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">الردود</th>
                                <th class="text-center">التحكم</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($comments as $comment)
                                <tr>
                                    <td class="text-center">{{$comment->id}}</td>
                                    <td style="vertical-align: middle" class="text-center">{{$comment->comment}}</td>
                                    <td style="vertical-align: middle"
                                        class="text-center">{{$comment->added_by->name}}</td>
                                    <td style="vertical-align: middle"
                                        class="text-center">{{($event->status == 0)?'محظور': 'مفعل'}}</td>
                                    <td style="vertical-align: middle" class="text-center"><a href="{{url('admin/events/comments/replies/'.$comment->id)}}"> الردود </a></td>
                                    <td style="vertical-align: middle" class="text-center">
                                        <form method="post" action="{{url('admin/events/comment/'.$comment->id)}}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button onclick="return confirm('هل انت متأكد من حذف هذا التعليق ؟ ')"
                                                    style="border-radius:5px;"
                                                    class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash-o"> حذف </i></button>
                                        </form>

                                        @if($comment->status == 0)
                                            <a onclick="return confirm('هل تريد تفعيل هذا التعليق  ؟ ')"
                                               href="{{url('admin/events/comment/unblock/'.$comment->id)}}" style="border-radius:5px;" class="btn btn-xs btn-success" >
                                                <i class="fa fa-check"> تفعيل </i></a>
                                        @elseif($comment->status == 1)
                                            <a onclick="return confirm('هل انت متأكد من حظر هذا التعليق ؟ ')"
                                               href="{{url('admin/events/comment/block/'.$comment->id)}}" style="border-radius:5px;" class="btn btn-xs btn-danger" >
                                                <i class="fa fa-lock"> حظر </i></a>
                                        @endif

                                    </td>
                            @endforeach
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

    <script>
        function blockRedirect(user_id) {
            if (blockFunction()) {
                path = "events/comment/block/";
                window.location.href = path.concat(user_id);
            }
        }

        function unblockRedirect(user_id) {
            if (unblockFunction()) {
                path = "events/comment/unblock/";
                window.location.href = path.concat(user_id);
            }
        }

        function blockFunction() {
            return confirm("هل انت متأكد من حظر هذا التعليق ؟");
        }

        function unblockFunction() {
            return confirm("هل تريد تفعيل هذا التعليق ؟");
        }

    </script>

    <!--Layout Script start -->
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/color.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/lib/jquery-1.11.min.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/multipleAccordion.js"></script>
    <!--jqueryui for table start-->
    <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.2/jquery-ui.min.js"></script>
    <!--jqueryui for table end-->


    <!--easing Library Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/lib/jquery.easing.js"></script>
    <!--easing Library Script End -->

    <!--Nano Scroll Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/jquery.nanoscroller.min.js"></script>
    <!--Nano Scroll Script End -->

    <!--switchery Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/switchery.min.js"></script>
    <!--switchery Script End -->

    <!--bootstrap switch Button Script Start-->
    <script src="{{asset('design/admin')}}/assets/js/bootstrap-switch.js"></script>
    <!--bootstrap switch Button Script End-->

    <!--easypie Library Script Start -->
    <script src="{{asset('design/admin')}}/assets/js/jquery.easypiechart.min.js"></script>
    <!--easypie Library Script Start -->

    <!--bootstrap-progressbar Library script Start-->
    <script src="{{asset('design/admin')}}/assets/js/bootstrap-progressbar.min.js"></script>
    <!--bootstrap-progressbar Library script End-->

    <script type="text/javascript" src="{{asset('design/admin')}}/assets/js/pages/layout.js"></script>
    <!--Layout Script End -->



    <!--Drag & Drop & Sort  table start-->
    <script src="{{asset('design/admin')}}/assets/js/tsort.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/jquery.tablednd.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/jquery.dragtable.js"></script>
    <!--Drag & Drop & Sort table end-->

    <!--Editable-table Start-->
    <script src="{{asset('design/admin')}}/assets/js/editable-table/jquery.dataTables.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/editable-table/jquery.validate.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/editable-table/jquery.jeditable.js"></script>
    <script src="{{asset('design/admin')}}/assets/js/editable-table/jquery.dataTables.editable.js"></script>
    <!--Editable-table Finish -->

    <script src="{{asset('design/admin')}}/assets/js/bootstrap-progressbar.min.js"></script>

    <!--Demo table script start-->
    <script src="{{asset('design/admin')}}/assets/js/pages/table.js"></script>
    <!--Demo table script end-->

@endsection