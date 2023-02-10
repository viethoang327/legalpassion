<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slide;

class SlideController extends Controller
{
    public function getList()
    {
        $slide = Slide::orderBy('id', 'DESC')->paginate(3);
        $sobanghi = Slide::count();
        return view('admin.slide.list', ['slide' => $slide], ['sobanghi' => $sobanghi]);
    }
    public function getAdd()
    {
        return view('admin.slide.add');
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
            'ten.required' => 'Bạn chưa nhập tên slide',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có đuôi jpg, png, jpeg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được quá 2MB'
        ]);
        $slide = new Slide;
        $slide->ten = $request->ten;
        $slide->noidung = $request->noidung;
        $slide->link = $request->link;
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/slide", $hinh);
            $slide->hinhslide = $hinh;
        }
        else
        {
            $slide->hinh = "";
        }
        $slide->save();
        return redirect('admin/slide/add')->with('thongbao', 'Thêm slide thành công');
    }
    public function getEdit($id)
    {
        $slide = Slide::find($id);
        return view('admin.slide.edit', ['slide' => $slide]);
    }
    public function postEdit(Request $request, $id)
    {
        $slide = Slide::find($id);
        $this->validate($request,
        [
            'ten' => 'required',
            'noidung'=>'required',
            'hinhanh' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên slide',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có đuôi jpg, png, jpeg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được quá 2MB'
        ]);
        $slide->ten = $request->ten;
        $slide->noidung = $request->noidung;
        $slide->link = $request->link;
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/slide/".$slide->hinhslide);
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/slide", $hinh);
            $slide->hinhslide = $hinh;
        }
        $slide->save();
        return redirect('admin/slide/list')->with('thongbao', 'Sửa slide thành công');
    }
    public function getDelete($id)
    {
        $slide = Slide::find($id);
        unlink("upload/slide/".$slide->hinhslide);
        $slide->delete();
        return redirect('admin/slide/list')->with('thongbao', 'Xóa slide thành công');
    }
}
