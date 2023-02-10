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
            'ten' => 'required|min:3|max:100|unique:loailinhvuc,ten'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên lĩnh vực',
            'ten.min' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên lĩnh vực đã tồn tại'
        ]);
        $loailinhvuc = new LoaiLinhVuc;
        $loailinhvuc->ten = $request->ten;
        $loailinhvuc->tenkhongdau = Str::slug($request->ten, '-');
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
            'ten' => 'required|min:3|max:100|unique:loailinhvuc,ten'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên lĩnh vực',
            'ten.min' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên lĩnh vực phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên lĩnh vực đã tồn tại'
        ]);
        $loailinhvuc->ten = $request->ten;
        $loailinhvuc->tenkhongdau = Str::slug($request->ten, '-');
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
