@extends('frontEnd.master')

@section('content')

    <div style="text-align: center;margin: 20px;">
        <h2 style="padding-bottom: 10px;"><i class="fa fa-bell">
                @if($role_id != 4)
                    <h4 style="color: #390986;margin-top: 10px;"> لقد تم انشاء الحساب بنجاح ولكنه غير مفعل </h4>
                    <h5 style="color: #1abc9c"> اذهب الى الايميل وقم بتفعيل الحساب الخاص بك </h5>
                @else
                    <h4 style="color: #390986;margin-top: 10px;"> لقد تم انشاء الحساب بنجاح ولكنه غير مفعل </h4>
                    <h5 style="color: #1abc9c"> اذهب الى الايميل وقم باستكمال تسجيلك ك منتمى لاعب حت يتم تفعيل الحساب </h5>
                @endif
            </i></h2>
    </div>

@endsection
@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if(session()->has('error'))
        toastr.error("{{session()->get('error')}}");
        @endif
    </script>
@endsection