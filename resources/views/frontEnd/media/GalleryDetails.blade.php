@extends('frontEnd.master')

@section('css')


@endsection
@section('content')
    <div class="single-blog-page-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 flo-right dir">
                    <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12 single-image flo-right">
                        @if($media->type == 'فيديو')
                            <iframe class="new-hei" src="http://www.youtube.com/embed/{{$media->media_link}}"
                                    frameborder="0" allowfullscreen></iframe>
                        @else
                            <img class="new-hei" src="{{asset('/'.$media->media_link)}}" alt="">
                        @endif
                    </div>
                    <div class="col-lg-6 col-md-4 col-sm-4 col-xs-12">
                        <h3>{{$media->title}}</h3>
                        <p>{{$media->description}}</p>
                    </div>


                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 life-style flo-right">
                                @if($media->added_user->roles_id == 1)
                                    <span class="date"> <i class="fa fa-user-o" aria-hidden="true"></i> {{$media->added_user->name}} </span>
                                @else
                                    <span class="admin"> <a href="{{url('profile/preview/'.$media->added_user->id)}}"><i
                                                    class="fa fa-user-o" aria-hidden="true"></i> {{$media->added_user->name}} </a></span>
                                @endif
                                <span class="date">
                                <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
                                {{ App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$media->created_at)))}} </span>
                                @if($media->comments->count()>0)
                                    <a style="color: #E92780; font-size: 15px"><i class="fa fa-comments"
                                                                                  aria-hidden="true"></i> {{App\Http\Controllers\ArticleController::convertArabicNumbers($media->comments->count())}}
                                    </a>
                                @endif
                            </div>

                        </div>
                    </div>


                    <div class="share-section">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 life-style flo-right">

                            </div>

                        </div>
                    </div>

                    <!--    <div class="share-section share-section2">
                           <div class="row">
                               <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 flo-right">
                                   <span> يمكنك المشاركة عن طريق :  </span>
                               </div>
                               <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                   <ul class="share-link">
                                       <li></li>
                                        <li class="hvr-bounce-to-right">
                                           <a href="#"> <i class="fa fa-facebook" aria-hidden="true"></i> فيسبوك</a>
                                       </li>
                                          <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-twitter"
                                                                                      aria-hidden="true"></i> تويتر</a>
                                       </li>


                                       <li class="hvr-bounce-to-right"><a href="#"><i class="fa fa-google"
                                                                                      aria-hidden="true"></i> جوجل</a></li>
                                   </ul>
                               </div>
                           </div>
                       </div> -->
                    <div class="row text-right">

                    <div class="author-comment">
                        {{--<a name="scroll"></a>--}}
                        <h3 id="scroll" class="title-bg"> التعليقات</h3>
                        <ul>
                            @foreach($media->comments->where('parent','=',0) as $comment)
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
                                                              action="{{url('/gallery/delete/comment/'.$media->id.'/'.$comment->id)}}">
                                                    {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                        <a><i class="fa fa-trash-o ico-r"
                                                              onclick="submit_form('{{'my_form'.$comment->id}}')"
                                                              style="cursor: pointer" aria-hidden="true"></i></a>
                                                        </form>
                                                    @elseif($media->added_user->id == auth()->user()->id)
                                                        <form id="{{'my_form'.$comment->id}}"
                                                              style="display: inline-block;"
                                                              method="post"
                                                              action="{{url('/gallery/delete/comment/'.$media->id.'/'.$comment->id)}}">
                                                    {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                        <a><i class="fa fa-trash-o ico-r"
                                                              onclick="submit_form('{{'my_form'.$comment->id}}')"
                                                              style="cursor: pointer" aria-hidden="true"></i></a>
                                                        </form>

                                                    @endif
                                                @endif
                                        </span>

                                            <div class="dsc-comments">
                                                <h4>
                                                    <a href="{{url('profile/preview/'.$comment->added_by->id)}}">{{$comment->added_by->name}}</a>
                                                </h4>
                                                <span class="date"><i class="fa fa-calendar-check-o"
                                                                      aria-hidden="true"></i>{{App\Http\Controllers\HomeController::ArabicDate(date('y-m-d', strtotime(@$comment->created_at)))}}</span>
                                                <p>{{$comment->comment}}</p> <b style="color: #1b4b72">اضف ردا</b>

                                                <div class="add_comm">
                                                    <form method="post"
                                                          action="{{url('/gallery/add/reply/'.$media->id.'/'.$comment->id)}}">
                                                        {!! csrf_field() !!}
                                                        <textarea cols="40" rows="10" name="reply"
                                                                  class="textarea form-control txtarea1-hi"></textarea>
                                                        <div class="form-group col-md-2">
                                                            <button style="margin-bottom: 10px" class="btn-send btnn "
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
                                                            src="{{asset('/'.$reply->added_by->image)}}" alt=""></div>
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
                                                          action="{{url('/gallery/delete/comment/'.$media->id.'/'.$reply->id)}}">
                                                    {!! csrf_field() !!} {!! method_field('DELETE') !!}
                                                        <input type="hidden" name="comment_id" value="{{$reply->id}}">
                                                    <a style="cursor: pointer"
                                                       onclick="submit_form('{{'my_form'.$reply->id}}')"><i
                                                                class="fa fa-trash-o ico-r"
                                                                aria-hidden="true"></i></a>
                                                    </form>
                                                @endif
                                            @endif

                                            <div  class="dsc-comments flo-right text-right">
                                                    <h4><a href="{{url('profile/preview/'.$comment->added_by->id)}}">{{$reply->added_by->name}}</a></h4>
                                                    <span class="date"><i class="fa fa-calendar-check-o"
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
                              action="{{url('/gallery/add/comment/'.$media->id)}}">
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
                <form id="edit_comment" method="post" action="{{url('/gallery/edit/comment/')}}">
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
                        <input type="hidden" id="customURL" value="{{url('gallary-details/'.$media->id.'/#scroll')}}">
                    </div>
                </form>
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