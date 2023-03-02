<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLinhVuc;
use App\Models\ReplyComment;

use Illuminate\Support\Facades\Auth;

class ReplyCommentController extends Controller
{
    //
   
    public function postReply($id,Request $request){
        $replycomment = new ReplyComment;
        $replycomment->id_comment= $id;
        $replycomment->id_user = Auth::user()->id;
        $replycomment->noidung = $request->noidungcmt;
        $replycomment->save();
        return redirect()->back()->with('thongbao', 'Thêm phản hồi thành công');
    }
}
