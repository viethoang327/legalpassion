<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiLinhVuc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LoaiLinhVucController extends Controller
{
    public function getList()
    {
        // code to handle the GET request to the /loailinhvuc/list URL
        $danhsachdanhmuc = LoaiLinhVuc::paginate(5);
        $sobanghi = LoaiLinhVuc::count();
        return view('admin.loailinhvuc.list', ['danhsachdanhmuc' => $danhsachdanhmuc], ['sobanghi' => $sobanghi]);
    }
   
    public function getAdd()
    {
        // code to handle the GET request to the /loailinhvuc/add URL
        return view('admin.loailinhvuc.add');
    }

    public function postAdd(Request $request)
    {
        // code to handle the POST request to the /loailinhvuc/add URL
        $this->validate($request,
        [
            'ten' => 'required|min:3|max:100|unique:loailinhvuc,ten',
            'mota' => 'required|min:3|max:255',
            'hinhanh' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên lĩnh vực',
            'ten.min' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên lĩnh vực đã tồn tại',
            'mota.required' => 'Bạn chưa nhập mô tả',
            'mota.min' => 'Mô tả phải có độ dài từ 3 đến 255 ký tự',
            'mota.max' => 'Mô tả phải có độ dài từ 3 đến 255 ký tự',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.image' => 'File bạn chọn không phải là hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB'
        ]);
        $loailinhvuc = new LoaiLinhVuc;
        $loailinhvuc->ten = $request->ten;
        $loailinhvuc->tenkhongdau = Str::slug($request->ten, '-');
        $loailinhvuc->mota = $request->mota;
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/linhvuc", $hinh);
            $loailinhvuc->hinhanh = $hinh;
        }
        else
        {
            $loailinhvuc->hinhanh = "";
        }
        $loailinhvuc->save();
        return redirect('admin/danhmuclinhvuc/themdanhmuc')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
        // code to handle the GET request to the /loailinhvuc/edit/{id} URL
        $loailinhvuc = LoaiLinhVuc::find($id);
        return view('admin.loailinhvuc.edit', ['loailinhvuc' => $loailinhvuc]);
    }

    public function postEdit($id, Request $request)
    {
        // code to handle the POST request to the /loailinhvuc/edit/{id} URL
        $loailinhvuc = LoaiLinhVuc::find($id);
        $this->validate($request,
        [
            'ten' => 'required|min:3|max:100|unique:loailinhvuc,ten',
            'mota' => 'required|min:3|max:255',
            'hinhanh' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên lĩnh vực',
            'ten.min' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên lĩnh vực đã tồn tại',
            'mota.required' => 'Bạn chưa nhập mô tả',
            'mota.min' => 'Mô tả phải có độ dài từ 3 đến 255 ký tự',
            'mota.max' => 'Mô tả phải có độ dài từ 3 đến 255 ký tự',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpeg, png, jpg, gif, svg',
            'hinhanh.max' => 'Hình ảnh không được vượt quá 2MB'
        ]);
        $loailinhvuc->ten = $request->ten;
        $loailinhvuc->tenkhongdau = Str::slug($request->ten, '-');
        $loailinhvuc->mota = $request->mota;
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/linhvuc/".$loailinhvuc->hinhanh);
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinh = $name."_".time();
            $file->move("upload/linhvuc", $hinh);
            $loailinhvuc->hinhanh = $hinh;
        }
        $loailinhvuc->save();
        return redirect('admin/danhmuclinhvuc/suadanhmuc/'.$loailinhvuc->id)->with('thongbao', 'Sửa thành công');

    }

    public function getDelete($id)
    {
        // code to handle the GET request to the /loailinhvuc/delete/{id} URL
        $loailinhvuc = LoaiLinhVuc::find($id);
        $loailinhvuc->delete();
        return redirect('admin/danhmuclinhvuc/danhsachdanhmuc')->with('thongbao', 'Bạn đã xóa thành công');
    }

    //Tìm kiếm
    public function postSearch(Request $request)
    {
        // code to handle the POST request to the /loailinhvuc/list URL
        $danhsachdanhmuc = LoaiLinhVuc::where('ten', 'like', '%'.$request->keyword.'%')->paginate(5);
        $sobanghi = LoaiLinhVuc::where('ten', 'like', '%'.$request->keyword.'%')->count();
        if($sobanghi==0){
            return redirect('admin/danhmuclinhvuc/danhsachdanhmuc')->with('thongbao', 'Không tìm thấy kết quả nào');
        }
        return view('admin.loailinhvuc.list', ['danhsachdanhmuc' => $danhsachdanhmuc], ['sobanghi' => $sobanghi]);
    }

}
