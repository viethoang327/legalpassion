<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\GioiThieu;

use App\Models\BaiVietLinhVuc;
use App\Models\ThuTuc;
use App\Models\TinTuc;
use App\Models\User;
use App\Models\CommentLinhVuc;
class GioiThieuController extends Controller
{
    public function admin(){
        $tongluotxem = BaiVietLinhVuc::sum('luotxem') + ThuTuc::sum('luotxem') + TinTuc::sum('luotxem');
        $tongnguoidung = User::where('level', 0)->count();
        $tongbinhluan = CommentLinhVuc::count();
        $tongsobaiviet = BaiVietLinhVuc::count() + ThuTuc::count() + TinTuc::count();
        
        return view('admin.layout.welcome',  ['tongluotxem'=>$tongluotxem, 'tongnguoidung'=>$tongnguoidung, 'tongbinhluan'=>$tongbinhluan, 'tongsobaiviet'=>$tongsobaiviet]);
    }
   public function getList()
   {
       $gioithieu = GioiThieu::orderBy('id', 'ASC')->paginate(3);
       $sobanghi = GioiThieu::count();
       return view('admin.gioithieu.list', ['gioithieu' => $gioithieu], ['sobanghi' => $sobanghi]);
   }
    public function getAdd()
    {
         return view('admin.gioithieu.add');
    }
    public function postAdd(Request $request){
        $this -> validate($request,
        [
            'tieude' => 'required|min:5|unique:gioithieu,tieude',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ],
        [
            'tieude.required' => 'Bạn chưa nhập tiêu đề',
            'tieude.min' => 'Tiêu đề phải có độ dài tối thiểu 5 ký tự',
            'tieude.unique' => 'Tiêu đề đã tồn tại',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'noidung.min' => 'Nội dung phải có độ dài tối thiểu 10 ký tự',
            'noidung.max' => 'Nội dung phải có độ dài tối đa 20000 ký tự',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png, gif',
            'hinhanh.max' => 'Hình ảnh phải có kích thước tối đa 2048 KB',
        ]);
        $gioithieu = new GioiThieu;
        $gioithieu->tieude = $request->tieude;
        $gioithieu->noidung = $request->noidung;
        $gioithieu->tieudekhongdau = Str::slug($request->tieude);
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/gioithieu",$hinhanh);
            $gioithieu -> hinhanh = $hinhanh;
        }
        else{
            $gioithieu -> hinhanh = "";
        }

        $gioithieu->save();

        return redirect('admin/gioithieu/themgioithieu')->with('thongbao', 'Thêm bài giới thiệu thành công');
    }
    public function getEdit($id)
    {
        $gioithieu = GioiThieu::find($id);
        return view('admin.gioithieu.edit', ['gioithieu' => $gioithieu]);
    }
    public function postEdit(Request $request, $id){
        
        $this -> validate($request,
        [
            'tieude' => 'required|min:5',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ],
        [
            'tieude.required' => 'Bạn chưa nhập tiêu đề',
            'tieude.min' => 'Tiêu đề phải có độ dài tối thiểu 5 ký tự',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'noidung.min' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'noidung.max' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png, gif'
        ]);
        $gioithieu = GioiThieu::find($id);
        $gioithieu->tieude = $request->tieude;
        $gioithieu->noidung = $request->noidung;
        $gioithieu->tieudekhongdau = Str::slug($request->tieude);
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/gioithieu/".$gioithieu->hinhanh);
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/gioithieu",$hinhanh);
            $gioithieu -> hinhanh = $hinhanh;
        }
        
        $gioithieu->save();

        return redirect('admin/gioithieu/danhsachgioithieu')->with('thongbao', 'Sửa bài giới thiệu thành công');
    }
    public function getDelete($id){
        $gioithieu = GioiThieu::find($id);
        unlink("upload/gioithieu/".$gioithieu->hinhanh);
        $gioithieu->delete();
        return redirect('admin/gioithieu/danhsachgioithieu')->with('thongbao', 'Xóa bài giới thiệu thành công');
    }
}
