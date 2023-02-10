<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiLinhVuc;
use App\Models\LinhVuc;
use App\Models\BaiVietLinhVuc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;


class BaiVietLinhVucController extends Controller
{
    public function getList()
    {
        $baiviet = BaiVietLinhVuc::orderBy('updated_at', 'DESC')->paginate(5);
        $sobanghi = BaiVietLinhVuc::count();
        return view('admin.baiviet.list',['baiviet'=> $baiviet, 'sobanghi' => $sobanghi ]);
    }
    public function getAdd()
    {
        $loailinhvuc = LoaiLinhVuc::all();
        $vande = LinhVuc::all();
        return view('admin.baiviet.add', ['loailinhvuc' => $loailinhvuc, 'vande' => $vande]);
    }
    public function postAdd(Request $request)
    {
        $this -> validate($request,
        [
            'linhvuc' => 'required',
            'tieude' => 'required|min:5|unique:baivietlinhvuc,tieude',
            'tomtat' => 'required|min:3',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'linhvuc.required' => 'Bạn chưa chọn vấn đề',
            'tieude.required' => 'Bạn chưa nhập tiêu đề',
            'tieude.min' => 'Tiêu đề phải có độ dài tối thiểu 5 ký tự',
            'tieude.unique' => 'Tiêu đề đã tồn tại',
            'tomtat.required' => 'Bạn chưa nhập tóm tắt',
            'tomtat.min' => 'Tóm tắt phải có độ dài tối thiểu 10 ký tự',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'noidung.min' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'noidung.max' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpg, png, jpeg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB'
        ]);
        $baiviet = new BaiVietLinhVuc;
        $baiviet->id_linhvuc = $request->vande;
        $baiviet->tieude = $request->tieude;
        $baiviet->tieudekhongdau = Str::slug($request->tieude);
        $baiviet->tomtat = $request->tomtat;
        $baiviet->noidung = $request->noidung;
        $baiviet->noibat = $request->noibat;
        $baiviet->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/baiviet",$hinhanh);
            $baiviet -> hinhanh = $hinhanh;
        }
        else{
            $baiviet -> hinhanh = "";
        }

        $baiviet->save();
        return redirect('admin/baiviet/thembaiviet')->with('thongbao', 'Thêm thành công');
    }
    public function getEdit($id)
    {
        $loailinhvuc = LoaiLinhVuc::all();
        $vande = LinhVuc::all();
        $baiviet = BaiVietLinhVuc::find($id);
        return view('admin.baiviet.edit', ['baiviet' => $baiviet], ['loailinhvuc' => $loailinhvuc, 'vande' => $vande]);
    }
    public function postEdit(Request $request, $id)
    {
        $baiviet = BaiVietLinhVuc::find($id);
        $this -> validate($request,
        [
            'linhvuc' => 'required',
            'tieude' => 'required|min:5|unique:baivietlinhvuc,tieude,'.$id,
            'tomtat' => 'required|min:3',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG'
        ],
        [
            'linhvuc.required' => 'Bạn chưa chọn vấn đề',
            'tieude.required' => 'Bạn chưa nhập tiêu đề',
            'tieude.min' => 'Tiêu đề phải có độ dài tối thiểu 5 ký tự',
            'tieude.unique' => 'Tiêu đề đã tồn tại',
            'tomtat.required' => 'Bạn chưa nhập tóm tắt',
            'tomtat.min' => 'Tóm tắt phải có độ dài tối thiểu 10 ký tự',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'noidung.min' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'noidung.max' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự', 
            'hinhanh.mimes' => 'Bạn chỉ được chọn file có đuôi jpg, png, jpeg'
        ]);
        $baiviet->id_linhvuc = $request->vande;
        $baiviet->tieude = $request->tieude;
        $baiviet->tieudekhongdau = Str::slug($request->tieude);
        $baiviet->tomtat = $request->tomtat;
        $baiviet->noidung = $request->noidung;
        $baiviet->noibat = $request->noibat;
        $baiviet->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/baiviet/".$baiviet->hinhanh);
            $file = $request->file('hinhanh');        
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/baiviet",$hinhanh);
            $baiviet -> hinhanh = $hinhanh;
        }
            
        $baiviet->save();
        return redirect('admin/baiviet/danhsachbaiviet')->with('thongbao', 'Bạn đã sửa thành công');
    }
    public function getDelete($id)
    {
        $baiviet = BaiVietLinhVuc::find($id);
        unlink("upload/baiviet/".$baiviet->hinhanh);
        $baiviet->delete();
        return redirect('admin/baiviet/danhsachbaiviet')->with('thongbao', 'Bạn đã xóa thành công');
    }
   //Tìm kiếm
   public function postSearch(Request $request)
   {
       // code to handle the POST request to the /loailinhvuc/list URL
       $baiviet = BaiVietLinhVuc::where('tieude', 'like', '%'.$request->keyword.'%')->paginate(5);
       $sobanghi = BaiVietLinhVuc::where('tieude', 'like', '%'.$request->keyword.'%')->count();
       if($sobanghi==0){
           return redirect('admin/baiviet/danhsachbaiviet')->with('thongbao', 'Không tìm thấy kết quả nào');
       }
       return view('admin.baiviet.list',['baiviet'=>$baiviet], ['sobanghi' => $sobanghi]);
   }
}
