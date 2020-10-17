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
                    <h1 class="panel-title">قائمة الالعاب  لهذا الموقع</h1>
                </div>
                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="ls-editable-table table-responsive ls-table">
                        <table class="table table-bordered table-striped" id="ls-editable-table">
                            <div style="text-align:center;">
                                <a href="{{url('admin/sports/create ')}}" class="btn btn-default"
                                   style="border-radius:10px; font-size: 16px ">
                                    <i style="color: #8B8986" class="fa fa-gamepad"></i> اضافة لعبة جديدة </a>
                            </div>
                            <thead>
                            <tr class="active">
                                <th class="text-center">#</th>
                                <th class="text-center">اسم اللعبة</th>
                                <th class="text-center">وصف اللعبة</th>
                                <th class="text-center"> نوع اللعبة </th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">صورة اللعبة</th>
                                <th class="text-center">التحكم</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($sports as $sport)
                                <tr>
                                    <td style="vertical-align: middle" class="text-center">{{$sport->id}}</td>
                                    <td style="vertical-align: middle" class="text-center">{{$sport->name}}</td>
                                    <td style="vertical-align: middle" class="text-center">{{$sport->description}}</td>
                                    <td style="vertical-align: middle" class="text-center">{{($sport->type == 'جماعيه')?'جماعية':'فردية'}}</td>
                                    <td style="vertical-align: middle" class="text-center">{{($sport->status == 0)?'غير مفعل': 'مفعل'}}</td>
                                    @if($sport->image != NULL)
                                        <td style="width:60px ;"><img style="display:block;width:100% ; height:40px"
                                                                      src="{{asset('/'.$sport->image)}}"
                                                                      alt="{{$sport->image}}"></td>
                                    @else
                                        <td style="width:60px ;"><img style="display:block;width:100% ; height:40px"
                                                                      src="{{asset('design/admin/assets/images/noImage.jpg')}}"
                                                                      alt="{{$sport->image}}"></td>
                                    @endif
                                    <td style="vertical-align: middle" class="text-center">
                                        <form style="margin-bottom: 3px;" method="post" action="{{url('admin/sports/'.$sport->id)}}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button onclick="return confirm('هل انت متأكد من حذف بيانات هذة اللعبة ؟ ')"
                                                    style="border-radius:5px;" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash-o"></i>
                                                حذف
                                            </button>
                                        </form>

                                        <a href="{{url('admin/sports/'.$sport->id.'/edit')}}" style="margin-bottom: 3px;border-radius:5px;"
                                           class="btn btn-xs btn-warning"><i
                                                    class="fa fa-pencil-square-o"> تعديل </i></a>
                                        @if($sport->status == 0)
                                            <a onclick="return confirm('هل انت متأكد من تفعيل تلك اللعبة ؟ ')" href="{{url('admin/sports/unblock/'.$sport->id)}}" style="border-radius:5px;margin-bottom: 5px;"
                                               class="btn btn-xs btn-success" ><i
                                                        class="fa fa-check"> تفعيل </i></a>
                                        @elseif($sport->status == 1)
                                            <a onclick="return confirm('هل انت متأكد من الغاء تفعيل هذة اللعبة ؟ ')" href="{{url('admin/sports/block/'.$sport->id)}}" style="border-radius:5px;margin-bottom: 5px;"
                                               class="btn btn-xs btn-danger"><i
                                                        class="fa fa-lock"> الغاء التفعيل </i></a>
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
                path = "sports/block/"
                window.location.href = path.concat(user_id);
            }
        }

        function unblockRedirect(user_id) {
            if (unblockFunction()) {
                path = "sports/unblock/"
                window.location.href = path.concat(user_id);
            }
        }

        function blockFunction() {
            return confirm("هل انت متأكد من الغاء تفعيل هذا الفريق ؟");
        }

        function unblockFunction() {
            return confirm("هل تريد تفعيل هذا الفريق ؟");
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