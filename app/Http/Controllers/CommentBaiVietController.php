<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CommentLinhVuc;
use App\Models\BaiVietLinhVuc;
use Illuminate\Support\Facades\Auth;

class CommentBaiVietController extends Controller
{
    public function getList()
    {
        $comment = CommentLinhVuc::orderBy('created_at', 'DESC')->paginate(5);
        $sobanghi = CommentLinhVuc::count();
        return view('admin.baiviet.comment', ['comment' => $comment, 'sobanghi' => $sobanghi]);
    }
    public function getDelete($id)
    {
        $comment = CommentLinhVuc::find($id);
        $comment->delete();
        return redirect('admin/commentbaiviet/danhsachcomment')->with('thongbao', 'Xóa bình luận thành công');
    }
    public function postComment($id,Request $request){
        $this->validate($request,
        [
            'noidungcmt' => 'required|min:3|max:1000',
        ],
        [
            'noidungcmt.required' => 'Bạn chưa nhập nội dung bình luận',
            'noidungcmt.min' => 'Nội dung bình luận phải có độ dài từ 3 đến 1000 ký tự',
            'noidungcmt.max' => 'Nội dung bình luận phải có độ dài từ 3 đến 1000 ký tự',
        ]);
        $comment = new CommentLinhVuc;
        $comment->id_baivietlinhvuc = $id;
        $comment->id_user = Auth::user()->id;
        $comment->noidung = $request->noidungcmt;
        $comment->save();
        return redirect()->back()->with('thongbao', 'Thêm bình luận thành công');
    
    }
    public function like(Request $request)
{
    $user = Auth::user();
    $comment = CommentLinhVuc::find($request->comment_id);
    $like = CommentLinhVuc::where([
        ['user_id', '=', $user->id],
        ['comment_id', '=', $comment->id],
        ['like', '=', true],
        ['dislike', '=', false],
    ])->first();
    if (!$like) {
        $like = new CommentLinhVuc;
        $like->user_id = $user->id;
        $like->comment_id = $comment->id;
        $like->like = true;
        $like->save();

        $comment->like++;
        $comment->save();
    }
    return response()->json(['likes' => $comment->like]);
}

public function dislike(Request $request)
{
    $user = Auth::user();
    $comment = CommentLinhVuc::find($request->comment_id);
    $dislike = CommentLinhVuc::where([
        ['user_id', '=', $user->id],
        ['comment_id', '=', $comment->id],
        ['like', '=', false],
        ['dislike', '=', true],
    ])->first();
    if (!$dislike) {
        $dislike = new CommentLinhVuc;
        $dislike->user_id = $user->id;
        $dislike->comment_id = $comment->id;
        $dislike->dislike = true;
        $dislike->save();

        $comment->dislike++;
        $comment->save();
    }
    return response()->json(['dislikes' => $comment->dislike]);
}
   
}
