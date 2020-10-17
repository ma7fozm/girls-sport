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
                    <h1 class="panel-title">قائمة اعضاء الموقع</h1>
                </div>
                <div class="panel-body">
                    <!--Table Wrapper Start-->
                    <div class="ls-editable-table table-responsive ls-table">
                        <table class="table table-bordered table-striped" id="ls-editable-table">
                            <div style="text-align:center;">
                                <a href="{{url('admin/users/create ')}}" class="btn btn-default"
                                   style="border-radius:10px; font-size: 16px ">
                                    <i style="color: #8B8986" class="fa fa-user"></i> اضافة عضو جديد </a>
                            </div>
                            <thead>
                            <tr class="active">
                                <th class="text-center">#</th>
                                <th class="text-center">الاسم</th>
                                <th class="text-center">اسم المستخدم</th>
                                <th class="text-center">البريد الالكترونى</th>
                                <th class="text-center">صورة</th>
                                <th class="text-center">الدولة</th>
                                <th class="text-center">المدينة</th>
                                <th class="text-center">الحالة</th>
                                <th class="text-center">نوع العضو</th>
                                <th class="text-center">ميديا</th>
                                <th class="text-center">التحكم</th>

                            </tr>
                            </thead>
                            <tbody>
                            @foreach($users as $user)
                                <tr>
                                    <td class="text-center">{{$user->id}}</td>
                                    <td class="text-center">{{$user->name}}</td>
                                    <td class="text-center">{{$user->username}}</td>

                                    <td class="text-center">{{$user->email}}</td>
                                    @if($user->image != NULL)
                                        <td style="width:60px ;"><img style="display:block;width:100% ; height:40px"
                                                                      src="{{asset('/'.$user->image)}}"
                                                                      alt="{{$user->image}}"></td>
                                    @else
                                        <td style="width:60px ;"><img style="display:block;width:100% ; height:40px"
                                                                      src="{{asset('design/admin/assets/images/no_profile_pic.gif')}}"
                                                                      alt="{{$user->image}}"></td>
                                    @endif
                                    <td class="text-center">{{$user->countries->name}}</td>
                                    <td class="text-center">{{$user->city->name}}</td>
                                    <td class="text-center">{{($user->status == 0)?'محظور':'مفعل'}}</td>

                                    @if($user->roles_id == 1)
                                        <td class="text-center">سوبر ادمن</td>
                                    @elseif($user->roles_id == 2)
                                        <td class="text-center">مشجع</td>
                                    @elseif($user->roles_id == 3)
                                        <td class="text-center">مستثمر</td>
                                    @elseif($user->roles_id == 4)
                                        <td class="text-center">منتمى لاعب</td>
                                    @elseif($user->roles_id == 5)
                                        <td class="text-center">منتمى ادمن</td>
                                    @endif

                                    <td class="text-center"><a href="{{url('admin/users/show/media/'.$user->id)}}">
                                            ميديا </a></td>
                                    <td class="text-center">

                                        <form method="post" action="{{url('admin/users/'.$user->id)}}">
                                            {!! csrf_field() !!}
                                            {!! method_field('DELETE') !!}
                                            <button onclick="return confirm('هل انت متأكد من حذف بيانات هذا العضو ؟ ')"
                                                    style="border-radius:5px;" class="btn btn-xs btn-danger"><i
                                                        class="fa fa-trash-o"></i>
                                                حذف
                                            </button>
                                        </form>

                                        <a href="{{url('admin/users/'.$user->id.'/edit')}}" style="border-radius:5px;"
                                           class="btn btn-xs btn-warning"><i
                                                    class="fa fa-pencil-square-o"> تعديل </i></a>
                                        @if($user->status == 0)
                                            <a href="#" style="border-radius:5px;"
                                               class="btn btn-xs btn-success"
                                               onclick="unblockRedirect({{$user->id}})"><i
                                                        class="fa fa-check"> الغاء الحظر </i></a>
                                        @elseif($user->status == 1)
                                            <a href="#" style="border-radius:5px;"
                                               class="btn btn-xs btn-danger" onclick="blockRedirect({{$user->id}})"><i
                                                        class="fa fa-lock"> حظر </i></a>
                                        @endif

                                    </td>
                                </tr>
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
                path = "users/block/";
                window.location.href = path.concat(user_id);
            }
        }

        function unblockRedirect(user_id) {
            if (unblockFunction()) {
                path = "users/unblock/";
                window.location.href = path.concat(user_id);
            }
        }

        function blockFunction() {
            return confirm("هل انت متأكد من حظر هذا العضو ؟");
        }

        function unblockFunction() {
            return confirm("هل تريد الغاء حظر هذا العضو بالفعل ؟");
        }

        function notificationCall(){
            'use strict';

            $.amaran({
                content:{
                    message:'New Mail Arrived',
                    size:'4 new mail in inbox',
                    file:'',
                    icon:'fa fa-envelope-o'
                },
                theme:'default ok',
                position:'bottom right',
                inEffect:'slideRight',
                outEffect:'slideBottom',
                closeButton:true,
                delay: 5000
            });
            setTimeout(function(){
                $.amaran({
                    content:{
                        img:'assets/images/demo/avatar-80.png',
                        user:'New Chat Message',
                        message:'Hi, How are you ? please knock me when you arrived <i class="fa fa-smile-o"></i>'
                    },
                    theme:'user',
                    position:'bottom left',
                    inEffect:'slideRight',
                    outEffect:'slideBottom',
                    closeButton:true,
                    delay: 5000
                });
                setTimeout(function(){
                    $.amaran({
                        content:{
                            message:'Can\'t deliver the product',
                            size:'32 Kg',
                            file:'H: 32 Road: 21, Chicago, NY 3210',
                            icon:'fa fa fa-truck'
                        },
                        theme:'default error',
                        position:'top right',
                        inEffect:'slideRight',
                        outEffect:'slideTop',
                        closeButton:true,
                        delay: 5000
                    });
                }, 5000)
            }, 5000);
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
