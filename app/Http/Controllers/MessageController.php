<?php

namespace App\Http\Controllers;

use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{

    public function index()
    {
        $msgs = Message::where('parent','=',0)->get();
        return view('admin.messages.messagesManagment',compact('msgs'));
    }

    public function addReplyMessage($id)
    {
        return view('admin.messages.addMessageReply',compact('id'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'msgContent' => 'required',
            'msgImg' => 'sometimes|mimes:jpeg,jpg,png,gif|max:100000',
        ], [
            'title.required' => 'من فضلك ادخل  عنوان للرسالة',
            'msgContent.required' => 'من فضلك محتوى الرسالة',
            'msgImg.mimes' => ' هذة ليست بصورة , او انك قمت باختيار نوع غير مدعوم من الصور لهذا لن تتم اضافته ',
        ], [

        ]);

        if (request()->hasfile('msgImg')) {

            $img = request()->file('msgImg');
            $ext = strtolower($img->getClientOriginalExtension());

            $img->move(public_path('uploads/images/msgsImages/'), 'img_' . time() . "." . $ext);
            $msg_img_path = 'uploads/images/msgsImages/img_' . time() . "." . $ext;
        } else {
            $msg_img_path = NULL;
        }

        $msg = Message::find($request->msg_id);

         Message::create([
            'title' => $request->title,
            'content' => $request->msgContent,
            'parent' => $msg->id,
            'event_id' => $msg->event_id,
            'match_id' => $msg->match_id,
            'image' => $msg_img_path,
            'status' => $request->status,
            'superadmin_id' => Auth::user()->id,
        ]);

         session()->flash('message',' تم اضافة الرد بنجاخ');
         return redirect('admin/messages');
    }

    public function destroy($id)
    {
        Message::find($id)->delete();
        return back();
    }

    public function showReplyMessage($id){
        $msgs = Message::where('parent','=',$id)->get();
        $mesg = Message::find($id);
        return view('admin.messages.messageReplyManagment',compact('msgs','mesg'));
    }
}
