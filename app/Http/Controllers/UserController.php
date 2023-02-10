<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\LienHe;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function getList()
    {
        // code to handle the GET request to the /user/list URL
        $user = User::paginate(5);
        $sobanghi =count($user);
        return view('admin.user.list', ['user' => $user],['sobanghi'=>$sobanghi]);
    }

    public function getAdd()
    {
        // code to handle the GET request to the /user/add URL
        return view('admin.user.add');
    }

    public function postAdd(Request $request)
    {
        // code to handle the POST request to the /user/add URL
        $this->validate($request,
        [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6|max:32',
            'passwordAgain' => 'required|same:password',
            'hinhdaidien' => 'max:10000|mimes:jpg,png,jpeg,JPG,PNG,JPEG'
        ],
        [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'email.unique' => 'Email đã tồn tại',
            'password.required' => 'Bạn chưa nhập mật khẩu',
            'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
            'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
            'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
            'hinhdaidien.max' => 'Hình đại diện không được quá 10MB',
            'hinhdaidien.mimes' => 'Hình đại diện phải có định dạng jpg,png,jpeg'
        ]);
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = $request->level;
        if($request->phone == null){
            $user->phone = "Chưa cập nhập";
        }else{
            $this->validate($request,
            [
                'phone' => 'numeric',
            ],
            [
                'phone.numeric' => 'Số điện thoại phải là số',
            ]);
            $user->phone = $request->phone;
        }
        // upload hinh dai dien
        if($request->hasFile('hinhdaidien'))
        {
            $file = $request->file('hinhdaidien');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/hinhdaidien",$hinhanh);
            $user -> hinhdaidien = $hinhanh;
        }
        else{
            $user -> hinhdaidien = "hinhdaidien.png";
        }
        $user->save();
        return redirect('admin/thanhvien/themthanhvien')->with('thongbao','Thêm người dùng thành công');
    }

    public function getEdit($id, Request $request)
    {
        // code to handle the GET request to the /user/edit/{id} URL
        $user = User::find($id);
        return view('admin.user.edit', ['user' => User::find($id)]);
    }

    public function postEdit($id, Request $request)
    {
        // code to handle the POST request to the /user/edit/{id} URL
        $user = User::find($id);
        $this->validate($request,
        [
            'name' => 'required|min:3',
        ],
        [
            'name.required' => 'Bạn chưa nhập tên người dùng',
            'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
        ]);
        $user->name = $request->name;
        if($request->changepassword == "on"){
            $this->validate(
                $request,
                [
                    'password' => [
                        'required',
                        'min:6',
                        'max:32',
                        function ($attribute, $value, $fail) use ($request) {
                            $user1 = Auth::user();
                            if (Hash::check($value, $user1->password)) {
                                return $fail('Mật khẩu mới phải khác mật khẩu cũ');
                            }
                        },
                    ],
                    'passwordAgain' => 'required|same:password',
                ],
                [
                    'password.required' => 'Bạn chưa nhập mật khẩu',
                    'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                    'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
                    'passwordAgain.required' => 'Bạn chưa nhập lại mật khẩu',
                    'passwordAgain.same' => 'Mật khẩu nhập lại chưa khớp',
                ]
            );
            $user->password = bcrypt($request->password);
        }
        $user->level = $request->level;
        if($request->phone == null){
            $user->phone = "Chưa cập nhập";
        }else{
            $this->validate($request,
            [
                'phone' => 'numeric',
            ],
            [
                'phone.numeric' => 'Số điện thoại phải là số',
            ]);
            $user->phone = $request->phone;
        }
        // upload hinhdaidien
        if($request->hasFile('hinhdaidien')){
            $this->validate($request,
            [
                'hinhdaidien' => 'max:10000|mimes:jpg,png,jpeg',
            ],
            [
                'hinhdaidien.max' => 'Hình đại diện không được quá 10MB',
                'hinhdaidien.mimes' => 'Hình đại diện phải có định dạng jpg,png,jpeg'
            ]);
            if($user->hinhdaidien != "hinhdaidien.png"){
                unlink("upload/hinhdaidien/".$user->hinhdaidien);
            }
            $file = $request->file('hinhdaidien');        
            $name = $file->getClientOriginalName();
            $hinhanh =  $name."_".time();
            $file->move("upload/hinhdaidien",$hinhanh);
            $user -> hinhdaidien = $hinhanh;
        }  
        $user->save();
        return redirect('admin/thanhvien/danhsachthanhvien')->with('thongbao','Sửa người dùng thành công');
    }

    public function getDelete($id)
    {
        // code to handle the GET request to the /user/delete/{id} URL
        $user = User::find($id);
        $user->delete();
        return redirect('admin/thanhvien/danhsachthanhvien')->with('thongbao','Xóa người dùng thành công');
    }
    //Tìm kiếm

   public function postSearch(Request $request)
   {
       // code to handle the POST request to the /loailinhvuc/list URL
       $user = User::where('name', 'like', '%'.$request->keyword.'%')->paginate(5);
       $sobanghi = User::where('name', 'like', '%'.$request->keyword.'%')->count();
       if($sobanghi==0){
           return redirect('admin/thanhvien/danhsachthanhvien')->with('thongbao', 'Không tìm thấy kết quả nào');
       }
       return view('admin.user.list',['user'=>$user], ['sobanghi' => $sobanghi]);
   }
   public function getLienhe()
   {
       // code to handle the GET request to the /user/lienhe URL
         $lienhe = LienHe::paginate(5);
         $sobanghi = LienHe::count();
       return view('admin.user.lienhe',['lienhe'=>$lienhe],['sobanghi'=>$sobanghi]);
   }
   public function deleteLienhe($id)
   {
       // code to handle the GET request to the /user/delete/{id} URL
       $lienhe = LienHe::find($id);
       $lienhe->delete();
       return redirect('admin/lienhe/danhsachlienhe')->with('thongbao','Xóa liên hệ thành công');
   }
}
