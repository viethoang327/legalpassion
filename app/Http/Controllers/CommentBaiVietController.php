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
    public function getAdd()
    {
        return view('admin.baiviet.comment');
    }
    public function postAdd(Request $request)
    {
        $this->validate($request,
        [
            'noidung' => 'required',
        ],
        [
            'noidung.required' => 'Bạn chưa nhập nội dung bình luận',
        ]);
        $comment = new CommentLinhVuc;
        $comment->id_baiviet = $request->id_baiviet;
        $comment->id_user = $request->id_user;
        $comment->noidung = $request->txtComment;
        $comment->save();
        return redirect('admin/commentbaiviet/danhsachcomment')->with('thongbao', 'Thêm bình luận thành công');
    }
    public function getDelete($id)
    {
        $comment = CommentLinhVuc::find($id);
        $comment->delete();
        return redirect('admin/commentbaiviet/danhsachcomment')->with('thongbao', 'Xóa bình luận thành công');
    }
    public function postComment($id,Request $request){
        $baiviet = BaiVietLinhVuc::find($id);
        $comment = new CommentLinhVuc;
        $comment->id_baivietlinhvuc = $id;
        $comment->id_user = Auth::user()->id;
        $comment->noidung = $request->noidungcmt;
        $comment->save();
        return redirect('linhvuc/baiviet/'.$baiviet->tieudekhongdau."/".$id)->with('thongbao', 'Thêm bình luận thành công');
    }
}
