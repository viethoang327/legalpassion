<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\ThuTuc;


class ThuTucController extends Controller
{
    public function getList()
    {
        $thutuc = ThuTuc::orderBy('created_at', 'DESC')->paginate(5);
        $sobanghi = ThuTuc::count();
        return view('admin.thutuc.list',['thutuc'=> $thutuc, 'sobanghi' => $sobanghi ]);
    }
    public function getAdd()
    {
        return view('admin.thutuc.add');
    }
    public function postAdd(Request $request)
    {
        $this -> validate($request,
        [
            'tieude' => 'required|min:5|unique:thutuc,tieude',
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
        $thutuc = new ThuTuc();
        $thutuc->tieude = $request->tieude;
        $thutuc->tieudekhongdau = Str::slug($request->tieude);
        $thutuc->tomtat = $request->tomtat;
        $thutuc->noidung = $request->noidung;
        $thutuc->noibat = $request->noibat;
        $thutuc->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            $file = $request->file('hinhanh');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/thutuc",$hinhanh);
            $thutuc -> hinhanh = $hinhanh;
        }
        else{
            $thutuc -> hinhanh = "";
        }

        $thutuc->save();
        return redirect('admin/thutuc/themthutuc')->with('thongbao', 'Thêm thủ tục thành công');
    }
    public function getEdit($id)
    {
        $thutuc = ThuTuc::find($id);
        return view('admin.thutuc.edit', ['thutuc' => $thutuc]);
    }
    public function postEdit(Request $request, $id)
    {
        $thutuc = ThuTuc::find($id);
        $this -> validate($request,
        [
            'tieude' => 'required|min:5|unique:thutuc,tieude,'.$id,
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
        $thutuc->tieude = $request->tieude;
        $thutuc->tieudekhongdau = Str::slug($request->tieude);
        $thutuc->tomtat = $request->tomtat;
        $thutuc->noidung = $request->noidung;
        $thutuc->noibat = $request->noibat;
        $thutuc->luotxem = 0;
        // upload hinh
        if($request->hasFile('hinhanh'))
        {
            unlink("upload/thutuc/".$thutuc->hinhanh);
            $file = $request->file('hinhanh');        
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/thutuc",$hinhanh);
            $thutuc -> hinhanh = $hinhanh;
        }     
        $thutuc->save();
        return redirect('admin/thutuc/danhsachthutuc')->with('thongbao', 'Bạn đã sửa thành công');
    }
    public function getDelete($id)
    {
        $thutuc = ThuTuc::find($id);
        unlink("upload/thutuc/".$thutuc->hinhanh);
        $thutuc->delete();
        return redirect('admin/thutuc/danhsachthutuc')->with('thongbao', 'Bạn đã xóa thành công');
    }
      //Tìm kiếm
   public function postSearch(Request $request)
   {
       // code to handle the POST request to the /loailinhvuc/list URL
       $thutuc = ThuTuc::where('tieude', 'like', '%'.$request->keyword.'%')->paginate(5);
       $sobanghi = ThuTuc::where('tieude', 'like', '%'.$request->keyword.'%')->count();
       if($sobanghi==0){
           return redirect('admin/thutuc/danhsachthutuc')->with('thongbao', 'Không tìm thấy kết quả nào');
       }
       return view('admin.thutuc.list',['thutuc'=>$thutuc], ['sobanghi' => $sobanghi]);
   }
}
