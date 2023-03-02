<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\KhachHang;

class KhachHangController extends Controller
{
    //
    public function getList()
    {
        $khachhang = KhachHang::orderBy('id', 'DESC')->paginate(3);
        $sobanghi = KhachHang::count();
        return view('admin.khachhang.list', ['khachhang' => $khachhang], ['sobanghi' => $sobanghi]);
    }
    public function getAdd()
    {
        return view('admin.khachhang.add');
    }
     public function postAdd(Request $request)
    {
        $this->validate($request,
        [
            'ten' => 'required',
            'noidung'=>'required',
            'hinhanh' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên khách hàng',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có đuôi jpg, png, jpeg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được quá 2MB'
        ]);
        $khachhang = new KhachHang;
        $khachhang->ten = $request->ten;
        $khachhang->noidung = $request->noidung;
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/khachhang", $hinh);
            $khachhang->hinhanh = $hinh;
        }
        else
        {
            $khachhang->hinhanh = "";
        }
        $khachhang->save();
        return redirect('admin/khachhang/themkhachhang')->with('thongbao', 'Thêm khách hàng thành công');
    }
    public function getEdit($id)
    {
        $khachhang = KhachHang::find($id);
        return view('admin.khachhang.edit', ['khachhang' => $khachhang]);
    }
    public function postEdit(Request $request, $id)
    {
        $khachhang = KhachHang::find($id);
        $this->validate($request,
        [
            'ten' => 'required',
            'noidung'=>'required',
            'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên khách hàng',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có đuôi jpg, png, jpeg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được quá 2MB'
        ]);
        $khachhang->ten = $request->ten;
        $khachhang->noidung = $request->noidung;
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/khachhang/".$khachhang->hinhanh);
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/khachhang", $hinh);
            $khachhang->hinhanh = $hinh;
        }
        $khachhang->save();
        return redirect('admin/khachhang/suakhachhang/'.$id)->with('thongbao', 'Sửa khách hàng thành công');
    }
    public function getDelete($id)
    {
        $khachhang = KhachHang::find($id);
        unlink("upload/khachhang/".$khachhang->hinhanh);
        $khachhang->delete();
        return redirect('admin/khachhang/danhsachkhachhang')->with('thongbao', 'Xóa khách hàng thành công');
    }
     
}
