<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LoaiLinhVuc;
use App\Models\LinhVuc;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class LinhVucController extends Controller
{
    public function getList()
    {
        // code to handle the GET request to the /linhvuc/list URL
        $vande = LinhVuc::paginate(5);
        $sobanghi = LinhVuc::count();
        return view('admin.linhvuc.list', ['vande' => $vande], ['sobanghi' => $sobanghi]);
    }

    public function getAdd()
    {
        // code to handle the GET request to the /linhvuc/add URL
        $loailinhvuc = LoaiLinhVuc::all();
        return view('admin.linhvuc.add', ['loailinhvuc' => $loailinhvuc]);
    }

    public function postAdd(Request $request)
    {
        // code to handle the POST request to the /linhvuc/add URL
        $this->validate($request,
        [
            'ten' => 'required|min:3|max:100|unique:linhvuc,ten',
            'linhvuc' => 'required'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên vấn đề',
            'ten.min' => 'Tên vấn đề phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên vấn đề phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên vấn đề đã tồn tại'
        ]);
        $vande = new LinhVuc;
        $vande->ten = $request->ten;
        $vande->tenkhongdau = Str::slug($request->ten, '-');
        $vande->id_loailinhvuc = $request->linhvuc;
        $vande->save();
        return redirect('admin/vande/themvande')->with('thongbao', 'Thêm thành công');
    }

    public function getEdit($id)
    {
        // code to handle the GET request to the /linhvuc/edit/{id} URL
        $loailinhvuc = LoaiLinhVuc::all();
        $vande = LinhVuc::find($id);
        return view('admin.linhvuc.edit', ['vande' => $vande, 'loailinhvuc' => $loailinhvuc]);
    }

    public function postEdit($id, Request $request)
    {
        // code to handle the POST request to the /linhvuc/edit/{id} URL
        $this->validate($request,
        [
            'ten' => 'required|min:3|max:100|unique:linhvuc,ten,'.$id,
            'linhvuc' => 'required'
        ],
        [
            'ten.required' => 'Bạn chưa nhập tên vấn đề',
            'ten.min' => 'Tên vấn đề phải có độ dài từ 3 đến 100 ký tự',
            'ten.max' => 'Tên vấn đề phải có độ dài từ 3 đến 100 ký tự',
            'ten.unique' => 'Tên vấn đề đã tồn tại'
        ]);
        $vande = LinhVuc::find($id) ;
        $vande->ten = $request->ten;
        $vande->tenkhongdau = Str::slug($request->ten, '-');
        $vande->id_loailinhvuc = $request->linhvuc;
        $vande->save();
        return redirect('admin/vande/danhsachvande')->with('thongbao', 'Bạn đã sửa thành công');
        
    }

    public function getDelete($id)
    {
        // code to handle the GET request to the /linhvuc/delete/{id} URL
        $vande = LinhVuc::find($id);
        $vande->delete();
        return redirect('admin/vande/danhsachvande')->with('thongbao', 'Bạn đã xóa thành công');
    }
    //Tìm kiếm
    public function postSearch(Request $request)
    {
        // code to handle the POST request to the /loailinhvuc/list URL
        $vande = LinhVuc::where('ten', 'like', '%'.$request->keyword.'%')->paginate(5);
        $sobanghi = LinhVuc::where('ten', 'like', '%'.$request->keyword.'%')->count();
        if($sobanghi==0){
            return redirect('admin/vande/danhsachvande')->with('thongbao', 'Không tìm thấy kết quả nào');
        }
        return view('admin.linhvuc.list',['vande'=>$vande], ['sobanghi' => $sobanghi]);
    }
}
