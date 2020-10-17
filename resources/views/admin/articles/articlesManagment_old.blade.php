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
                    <h1 class="panel-title">قائمة المقالات  لهذا الموقع</h1>
                </div>
                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="ls-editable-table table-responsive ls-table">
                        <table class="table table-bordered table-striped" id="ls-editable-table">
                            <div style="text-align:center;">
                                <a href="{{url('admin/articles/create ')}}" class="btn btn-default"
                                   style="border-radius:10px; font-size: 16px ">
                                    <i style="color: #8B8986" class="fa fa-plus"></i> اضافة مقال جديد </a>
                            </div>
                            <thead>
                            <tr class="active">
                                <th class="text-center">#</th>
                                <th class="text-center"> عنوان المقال</th>
                                <th class="text-center">مقدمة المقال</th>
                              
                                <th class="text-center">صورة المقال</th>
                                <th class="text-center">الفئة</th>
                                 <th class="text-center">التعليقات</th>
<!--                                 <th class="text-center">العضو</th>
 -->                                <th class="text-center">الحالة</th>
                                <th class="text-center">التحكم</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($articles as $article)
                                <tr>
                                    <td class="text-center">{{$article->id}}</td>
                                    <td class="text-center">{{$article->title}}</td>
                                    <td class="text-center">{{$article->intro}}</td>
                                   
                                      <td style="width:90px ;" ><img style="display:block;width:100% ; height:60px"
                                                                   src="{{asset($article->image)}}"
                                                                   alt="{{$article->image}}"></td>
                                    <td class="text-center">{{$article->category->name}}</td>
<!--                                     <td class="text-center">{{$article->user->name}}</td>
 -->                             
                                  <td style="vertical-align: middle" class="text-center"><a href="{{url('admin/articles/show/comments/'.$article->id)}}"> تعليقات </a></td>
                                    <td class="text-center">{{($article->status == 0)?'غير مفعل': 'مفعل'}}</td>
                                    <td style="width: 170px; vertical-align: middle" class="text-center">

                                        <form method="post" action="{{url('admin/articles/'.$article->id)}}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button style="border-radius:5px;" onclick="return confirm('هل انت متأكد من حذف بيانات هذا المقال')" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash-o"></i>
                                                حذف
                                            </button>
                                        </form>

                                        <a href="{{url('admin/articles/'.$article->id.'/edit')}}" style="border-radius:5px;"
                                           class="btn btn-xs btn-warning"><i
                                                    class="fa fa-pencil-square-o"> تعديل </i></a>
                                        @if($article->status == 0)
                                            <a href="#" style="border-radius:5px;"
                                               class="btn btn-xs btn-success" onclick="unblockRedirect({{$article->id}})"><i
                                                        class="fa fa-check"> تفعيل </i></a>
                                        @elseif($article->status == 1)
                                            <a href="#" style="border-radius:5px;"
                                               class="btn btn-xs btn-danger" onclick="blockRedirect({{$article->id}})"><i
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
                path = "articles/block/"
                window.location.href = path.concat(user_id);
            }
        }

        function unblockRedirect(user_id) {
            if (unblockFunction()) {
                path = "articles/unblock/"
                window.location.href = path.concat(user_id);
            }
        }

        function blockFunction() {
            return confirm("هل انت متأكد من الغاء تفعيل هذا المقال ؟");
        }

        function unblockFunction() {
            return confirm("هل تريد تفعيل هذا المقال ؟");
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