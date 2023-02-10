<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\TinTuc;


class TinTucController extends Controller
{
    public function getList()
    {
        $tintuc = TinTuc::orderBy('created_at', 'DESC')->paginate(5);
        $sobanghi = TinTuc::count();
        return view('admin.tintuc.list',['tintuc'=> $tintuc, 'sobanghi' => $sobanghi ]);
    }
    public function getAdd()
    {
        return view('admin.tintuc.add');
    }
    public function postAdd(Request $request)
    {
        $this -> validate($request,
        [
            'tieude' => 'required|min:5|unique:tintuc,tieude',
            'tomtat' => 'required|min:3',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'required|mimes:jpg,jpeg,png,gif|max:2048',
        ],
        [
            'tieude.required' => 'Bạn chưa nhập tiêu đề',
            'tieude.min' => 'Tiêu đề phải có độ dài tối thiểu 5 ký tự',
            'tieude.unique' => 'Tiêu đề đã tồn tại',
            'tomtat.required' => 'Bạn chưa nhập tóm tắt',
            'tomtat.min' => 'Tóm tắt phải có độ dài tối thiểu 10 ký tự',
            'noidung.required' => 'Bạn chưa nhập nội dung',
            'noidung.min' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'noidung.max' => 'Nội dung phải có độ dài từ 10 đến 20000 ký tự',
            'hinhanh.required' => 'Bạn chưa chọn hình ảnh',
            'hinhanh.mimes' => 'Hình ảnh phải có định dạng jpg, jpeg, png, gif'
        ]);
        $tintuc = new TinTuc();
        $tintuc->tieude = $request->tieude;
        $tintuc->tieudekhongdau = Str::slug($request->tieude);
        $tintuc->tomtat = $request->tomtat;
        $tintuc->noidung = $request->noidung;
        $tintuc->noibat = $request->noibat;
        $tintuc->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/tintuc",$hinhanh);
            $tintuc -> hinhanh = $hinhanh;
        }
        else{
            $tintuc -> hinhanh = "";
        }

        $tintuc->save();
        return redirect('admin/tintuc/themtintuc')->with('thongbao', 'Thêm bản tin thành công');
    }
    public function getEdit($id)
    {
        $tintuc = TinTuc::find($id);
        return view('admin.tintuc.edit', ['tintuc' => $tintuc]);
    }
    public function postEdit(Request $request, $id)
    {
        $tintuc = TinTuc::find($id);
        $this -> validate($request,
        [
            'tieude' => 'required|min:5|unique:tintuc,tieude,'.$id,
            'tomtat' => 'required|min:3',
            'noidung' => 'required|min:10|max:20000',
            'hinhanh' => 'mimes:jpg,png,jpeg,JPG,PNG,JPEG'
        ],
        [
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
        $tintuc->tieude = $request->tieude;
        $tintuc->tieudekhongdau = Str::slug($request->tieude);
        $tintuc->tomtat = $request->tomtat;
        $tintuc->noidung = $request->noidung;
        $tintuc->noibat = $request->noibat;
        $tintuc->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/tintuc/".$tintuc->hinhanh);
            $file = $request->file('hinhanh');        
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/tintuc",$hinhanh);
            $tintuc -> hinhanh = $hinhanh;
        }     
        $tintuc->save();
        return redirect('admin/tintuc/danhsachtintuc')->with('thongbao', 'Bạn đã sửa thành công');
    }
    public function getDelete($id)
    {
        $tintuc = TinTuc::find($id);
        unlink("upload/tintuc/".$tintuc->hinhanh);
        $tintuc->delete();
        return redirect('admin/tintuc/danhsachtintuc')->with('thongbao', 'Bạn đã xóa thành công');
    }
          //Tìm kiếm
   public function postSearch(Request $request)
   {
       // code to handle the POST request to the /loailinhvuc/list URL
       $tintuc = TinTuc::where('tieude', 'like', '%'.$request->keyword.'%')->paginate(5);
       $sobanghi = TinTuc::where('tieude', 'like', '%'.$request->keyword.'%')->count();
       if($sobanghi==0){
           return redirect('admin/tintuc/danhsachtintuc')->with('thongbao', 'Không tìm thấy kết quả nào');
       }
       return view('admin.tintuc.list',['tintuc'=>$tintuc], ['sobanghi' => $sobanghi]);
   }
}
