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
                                    </a>
                                    تفاصيل الدوري
                                </li>
                            </ul>
                        </div>
                        <div class="header-page-title">
                            <h1>تفاصيل الدوري</h1>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Inner Page Header serction end here -->
    <!--    about sports start-->
    <div class="home-about-area">
        <div class="container">

            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">


                        @if (!empty(@$matchs))
                            <img src="{{asset('/'.$matchs[0]->image)}}" class="flo-right player-im">
                            <h2 class="title2 text-right mt-25">{{@$matchs[0]->title}} </h2>
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 text-right">

                        <div class="text-right">

                            <h3>{{$Leagues->name}}</h3>

                        </div>
                        <p>{{$Leagues->description}}
                        </p>


                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <p><img src="{{asset('/'.$Leagues->image)}}" alt="" class="hei-3"></p>
                    </div>
                </div>

            </div>
        </div>

    </div>
    <!--    about sports end-->
    <!-- Category Page Start Here -->
    <div class="blog-page-area gallery-page category-page">
        <div class="container">
            <!--             players start-->

            @if(count($Leagues->matches)>0)
                <div class="row">
                    <div class="view-area">
                        <div class="col-sm-12 text-right">
                            <h3 class="title-bg "> المبارايات </h3>
                        </div>
                    </div>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 recent-results flo-right">
                        <div class="inner dir">
                            <ul>

                                @foreach ($Leagues->matches as $league)
                                    <li class="mb-10 col-lg-6 col-md-6 col-sm-12 col-xs-12 flo-right">
                                        <table class="clo">
                                            <tr>
                                                <td class="td-width"><img src="{{asset('/'.$league->image)}}"
                                                                          class="event-im">{{$league->title}}</td>

                                                <td class="td-width"><a class="btn-send btnn padd-btn"
                                                                        style="border-radius: 0 !important"
                                                                        href="{{ route('match-details',['id'=>$league->id])}}">المزيد </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>


                </div>
        @endif
        <!--players ends-->
            <div class="single-blog-page-area">
                <div class="container">
                    <div class="row text-right">

                        <div class="author-comment">
                            {{--<a name="scroll"></a>--}}
                            <h3 id="scroll" class="title-bg"> التعليقات</h3>
                            <ul>
                                @foreach($Leagues->comments->where('parent','=',0) as $comment)
                                    <li>
                                        <div class="row">
                                            <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                                <div class="image-comments"><img
                                                            src="{{asset('/'.$comment->added_by->image)}}" alt=""></div>
                                            </div>

                                            <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">

                                            <span class="reply">
                                            @if(isset(Auth::user()->id))
                                                    @if($comment->added_by->id == Auth::user()->id)
                                                        <a href="" id="{{$comment->id}}" class="edit_btn"
                                                           aria-hidden="true" data-toggle="modal"
                                                           data-target="#exampleModalc"><i
                                                                    class="fa fa-pencil ico-r "></i></a>
                                                        <form id="{{'my_form'.$comment->id}}"
                                                              style="display: inline-block;"
                                                              method="post"
                                                              action="{{url('/league/delete/comment/'.$Leagues->id.'/'.$comment->id)}}">
                                                    {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                        <a><i class="fa fa-trash-o ico-r"
                                                              onclick="submit_form('{{'my_form'.$comment->id}}')"
                                                              style="cursor: pointer" aria-hidden="true"></i></a>
                                                        </form>
                                                    @endif
                                                @endif
                                        </span>

                                                <div class="dsc-comments">
                                                    <h4><a href="{{url('profile/preview/'.$comment->added_by->id)}}">
                                                            {{$comment->added_by->name}} </a></h4>
                                                    <span class="date"><i class="fa fa-calendar-check-o"
                                                                          aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$comment->created_at)))}}</span>
                                                    <p>{{$comment->comment}}</p> <b style="color: #1b4b72">اضف ردا</b>

                                                    <div class="add_comm">
                                                        <form method="post"
                                                              action="{{url('/league/add/reply/'.$Leagues->id.'/'.$comment->id)}}">
                                                            {!! csrf_field() !!}
                                                            <textarea cols="40" rows="10" name="reply"
                                                                      class="textarea form-control txtarea1-hi"></textarea>
                                                            <div class="form-group col-md-2">
                                                                <button style="margin-bottom: 10px"
                                                                        class="btn-send btnn "
                                                                        type="submit">تأكيد
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        @foreach($comment->replies as $reply)
                                            <div style="margin-bottom: 45px;" class="row">
                                                <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 flo-right">
                                                    <div style="padding: 0px 68px 7px 0px;" class="image-comments"><img
                                                                src="{{asset('/'.$reply->added_by->image)}}" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12 flo-right">
                                        <span class="reply">
                                            @if(isset(Auth::user()->id))
                                                @if($reply->added_by->id == Auth::user()->id)
                                                    <a href="" id="{{$reply->id}}" data-toggle="modal"
                                                       data-target="#exampleModalc" class="edit_btn"><i
                                                                class="fa fa-pencil ico-r"></i></a>
                                                    <form id="{{'my_form'.$reply->id}}" style="display: inline-block;"
                                                          method="post"
                                                          action="{{url('/league/delete/comment/'.$Leagues->id.'/'.$reply->id)}}">
                                                    {!! csrf_field() !!} {!! method_field('DELETE') !!}

<input type="hidden" name="comment_id" value="{{$reply->id}}">
                                                    <a style="cursor: pointer"
                                                       onclick="submit_form('{{'my_form'.$reply->id}}')"><i
                                                                class="fa fa-trash-o ico-r"
                                                                aria-hidden="true"></i></a>
                                                </form>
                                                @endif
                                            @endif

                                                <div class="dsc-comments flo-right text-right">
                                                    <a href="{{url('profile/preview/'.$comment->added_by->id)}}"> <h4>
                                                            {{$reply->added_by->name}}</h4></a>
                                                    <span class="date"><i class="fa fa-calendar-check-o flo-right"
                                                                          aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$comment->created_at)))}}</span>
                                                    <p>{{$reply->comment}}</p>
                                                </div>
                                            </span>
                                                </div>
                                            </div>

                                        @endforeach

                                    </li>
                                @endforeach

                            </ul>
                        </div>
                        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-12 flo-right leave-comments-area">
                            <h4 id="scroll_comm" class="title-bg"> اترك تعليقك</h4>
                            <form method="post"
                                  action="{{url('/league/add/comment/'.$Leagues->id)}}">
                                {!! csrf_field() !!}
                                <fieldset>

                                    <div class="form-group">
                                        <label>اكتب تعليقك هنا </label>

                                        <textarea style="direction:rtl;" cols="40" rows="10" name="comment"
                                                  class="textarea form-control txtarea1-hi"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn-send" type="submit"> تأكيد</button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    </div>
                </div>
            </div>
        </div>

        <!-- Blog Details Page end here -->
        <!-- edit Modal -->
        <div class="modal fade" id="exampleModalc" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title flo-right" id="exampleModalLabel">تعديل التعليق </h5>
                        <button type="button" class="close flo-left" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form id="edit_comment" method="post" action="{{url('/league/edit/comment/')}}">
                        {!! csrf_field() !!}
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <div style="text-align: center" id="validation-errors"></div>
                                    <label for="exampleFormControlTextarea1" style="float: right"> تعليقك </label>
                                    <textarea style="direction:rtl;" class="form-control hei-85"
                                              id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">إغلاق</button>
                            <button class="btn btn-primary"> حفظ</button>
                            <input type="hidden" id="comm_id">
                            <input type="hidden" id="customURL"
                                   value="{{url('league-details/'.$Leagues->id.'/#scroll')}}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        @if(session()->has('message'))
        toastr.success("{{session()->get('message')}}");
        @endif
        @if ($errors->any())

        @foreach ($errors->all() as $error)
        toastr.error("{{$error}}");
        @endforeach
        @endif
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script>

        function submit_form($frm_id) {
            var res = confirm('هل انت متأكد من حذف هذا التعليق ؟ ');
            if (res) {
                document.getElementById($frm_id).submit()
            }
        }

        $(document).ready(function () {

            // $('.add_comm').hide();

            $('.edit_btn').click(function () {
                $('#comm_id').val(this.id);
            });

            if (window.location.hash != null && window.location.hash != '') {
                var myTarget = document.querySelector('#scroll');
                jQuery("html, body").animate({scrollTop: parseInt(myTarget.offsetTop + 400, 10)}, 1000);
            }

            $("form#edit_comment").submit(function (e) {
                e.preventDefault();
                var formData = new FormData(this);
                formData.append('commentID', $('#comm_id').val());
                var url = $('#edit_comment').attr('action');
                $.ajax({
                    url: url,
                    // dataType: 'JSON',
                    type: 'post',
                    data: formData,
                    success: function (data) {
                        $('#validation-errors').html('<div class="alert alert-success"> تمت التعديل بنجاح </div>');
                        $('#edit_comment')[0].reset();

                        setTimeout(function () {
                            window.location.href = $('#customURL').val();
                        }, 1000);

                    }, error: function (xhr) {

                        var err = xhr.responseJSON.error;
                        // $('#validation-errors').html('<div class="alert alert-danger">' + err + '</div>');

                        $('#validation-errors').html('');
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                        });

                        $("#exampleModal2").animate({scrollTop: 0}, "slow");

                    },
                    cache: false,
                    contentType: false,
                    processData: false
                });
            });
        });
    </script>
@endsection