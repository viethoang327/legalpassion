<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GioiThieu;
use App\Models\LienHe;

use App\Models\LoaiLinhVuc;
use App\Models\LinhVuc;
use App\Models\BaiVietLinhVuc;
use App\Models\CommentLinhVuc;

use App\Models\ThuTuc;
use App\Models\TinTuc;

use App\Models\Slide;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    function __construct()
    {
        $gioithieu = GioiThieu::all();
        view()->share('gioithieu', $gioithieu);
        $loailinhvuc = LoaiLinhVuc::all();
        $randomPost = BaiVietLinhVuc::inRandomOrder()->limit(5)->get();
        $randomThuTuc = ThuTuc::inRandomOrder()->limit(5)->get();
        $randomTinTuc = TinTuc::inRandomOrder()->limit(5)->get();
        view()->share('loailinhvuc', $loailinhvuc);
        view()->share('randomPost', $randomPost);
        view()->share('randomThuTuc', $randomThuTuc);
        view()->share('randomTinTuc', $randomTinTuc);
        // Thu tuc noi bat
        $thutucnoibat = ThuTuc::where('noibat', 1)->limit(3)->get();
        view()->share('thutucnoibat', $thutucnoibat);
        // Tin tuc noi bat
        $tintucnoibat = TinTuc::where('noibat', 1)->limit(6)->get();
        view()->share('tintucnoibat', $tintucnoibat);
        // Bai viet noi bat
        $baivietnoibat = BaiVietLinhVuc::where('noibat', 1)->limit(4)->get();
        view()->share('baivietnoibat', $baivietnoibat);
    }
    public function home()
    {
        $slide = Slide::inRandomOrder()->limit(5)->get();
        return view('home', ['slide' => $slide]);
    }
    public function gioithieuchung($id, $tieude)
    {
        $baiviet = GioiThieu::find($id);
        return view('pages.gioithieu', ['baiviet' => $baiviet]);
    }
    // LIEN HE
    public function getLienhe()
    {
        return view('pages.lienhe');
    }
    public function postLienhe(Request $request){
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'message' => 'required'
        ], [
            'name.required' => 'Bạn chưa nhập tên',
            'email.required' => 'Bạn chưa nhập email',
            'email.email' => 'Bạn chưa nhập đúng định dạng email',
            'phone.required' => 'Bạn chưa nhập số điện thoại',
            'phone.numeric' => 'Số điện thoại phải là số',
            'message.required' => 'Bạn chưa nhập nội dung'
        ]);
        $lienhe = new LienHe;
        $lienhe->name = $request->name;
        $lienhe->email = $request->email;
        $lienhe->phone = $request->phone;
        $lienhe->message = $request->message;
        $lienhe->save();
        return redirect('/lienhe')->with('thongbao', 'Gửi liên hệ thành công');
    }
    // LĨNH VỰC
    public function linhvuc()
    {
        return view('pages.linhvuc.linhvuc');
    }
    public function vande($tenkhongdau, $id)
    {
        $vande = LinhVuc::with('loailinhvuc')->whereHas('loailinhvuc', function ($query) use ($id) {
            $query->where('id', $id);
        })->get();
        return view('pages.linhvuc.chitiet', ['vande' => $vande]);
    }
    public function danhsachbaiviet($tenkhongdau, $id)
    {
        $danhsachbaiviet = BaiVietLinhVuc::with('linhvuc')->whereHas('linhvuc', function ($query) use ($id) {
            $query->where('id', $id);
        })->paginate(3);
        return view('pages.linhvuc.dachsachbaiviet', ['danhsachbaiviet' => $danhsachbaiviet, 'id' => $id, 'tenkhongdau' => $tenkhongdau]);
    }
    public function baiviet($id,$tieude)
    {
        $baiviet = BaiVietLinhVuc::find($id);
        $comment = CommentLinhVuc::where('id_baivietlinhvuc', $id)->get();
        DB::table('baivietlinhvuc')->where('id', $id)->increment('luotxem');
        return view('pages.linhvuc.baiviet', ['baiviet' => $baiviet], ['comment' => $comment]);
    }
    // THỦ TỤC
    public function thutuc()
    {
        $danhsachthutuc = ThuTuc::orderBy('created_at', 'DESC')->paginate(3);
        return view('pages.thutuc.thutuc', ['danhsachthutuc' => $danhsachthutuc]);
    }
    public function baivietthutuc($id,$tieude)
    {
        $baivietthutuc = ThuTuc::find($id);
        DB::table('thutuc')->where('id', $id)->increment('luotxem');
        return view('pages.thutuc.baiviet', ['baivietthutuc' => $baivietthutuc]);
    }
    // TIN TỨC
    public function tintuc()
    {
        $danhsachtintuc = TinTuc::orderBy('created_at', 'DESC')->paginate(3);
        return view('pages.bantin.bantin', ['danhsachtintuc' => $danhsachtintuc]);
    }
    public function baiviettintuc($id,$tieude)
    {
        $baiviettintuc = TinTuc::find($id);
        DB::table('tintuc')->where('id', $id)->increment('luotxem');
        return view('pages.bantin.baiviet', ['baiviettintuc' => $baiviettintuc]);
    }
    // TÀI KHOẢN
    public function getDangnhap()
    {
        return view('pages.dangnhap');
    }
    public function postDangnhap(Request $request)
    {
        $this->validate(
            $request,
            [
                'email' => 'required',
                'password' => 'required|min:6|max:32'
            ],
            [
                'email.required' => 'Bạn chưa nhập email',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu phải có ít nhất 6 ký tự',
                'password.max' => 'Mật khẩu chỉ được tối đa 32 ký tự',
            ]
        );
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route('legalpassion.home');
        } else {
            return redirect()->route('legalpassion.user.login')->with('thongbao', 'Bạn đã nhập sai email hoặc mật khẩu');
        }
        return view('dangnhap');
    }
    public function getDangxuat()
    {
        Auth::logout();
        return redirect()->route('legalpassion.home');
    }
    public function getNguoidung()
    {
        return view('pages.nguoidung');
    }
    public function getQuanlynguoidung()
    {
        return view('pages.quanlynguoidung');
    }
    public function postQuanlynguoidung(Request $request)
    {
        $idUser = Auth::user()->id;
        $userLevel = User::find($idUser)->level;
        $user = Auth::user();
        $this->validate(
            $request,
            [
                'name' => 'required|min:3',
            ],
            [
                'name.required' => 'Bạn chưa nhập tên người dùng',
                'name.min' => 'Tên người dùng phải có ít nhất 3 ký tự',
            ]
        );
        $user->name = $request->name;

        if ($request->changepassword == "on") {
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
        if ($request->phone == null) {
            $user->phone = "Chưa cập nhập";
        } else {
            $this->validate(
                $request,
                [
                    'phone' => 'numeric',
                ],
                [
                    'phone.numeric' => 'Số điện thoại phải là số',
                ]
            );
            $user->phone = $request->phone;
        }
        // upload hinhdaidien
        if ($request->hasFile('hinhdaidien')) {
            $this->validate(
                $request,
                [
                    'hinhdaidien' => 'max:10000|mimes:jpg,png,jpeg',
                ],
                [
                    'hinhdaidien.max' => 'Hình đại diện không được quá 10MB',
                    'hinhdaidien.mimes' => 'Hình đại diện phải có định dạng jpg,png,jpeg'
                ]
            );
            if ($user->hinhdaidien != "hinhdaidien.png") {
                unlink("upload/hinhdaidien/" . $user->hinhdaidien);
            }
            $file = $request->file('hinhdaidien');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name . "_" . time();
            $file->move("upload/hinhdaidien", $hinhanh);
            $user->hinhdaidien = $hinhanh;
        }
        $user->level = $userLevel;
        $user->save();
        return redirect('/quanlynguoidung')->with('thongbao', 'Sửa thông tin thành công');
    }
    public function getDangky()
    {
        return view('pages.dangky');
    }
    public function postDangky(Request $request)
    {
        $this->validate(
            $request,
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
            ]
        );
        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->level = 0;
        if ($request->phone == null) {
            $user->phone = "Chưa cập nhập";
        } else {
            $this->validate(
                $request,
                [
                    'phone' => 'numeric',
                ],
                [
                    'phone.numeric' => 'Số điện thoại phải là số',
                ]
            );
            $user->phone = $request->phone;
        }
        // upload hinh dai dien
        if ($request->hasFile('hinhdaidien')) {
            $file = $request->file('hinhdaidien');
            $name = $file->getClientOriginalName();
            $hinhanh =  $name . "_" . time();
            $file->move("upload/hinhdaidien", $hinhanh);
            $user->hinhdaidien = $hinhanh;
        } else {
            $user->hinhdaidien = "hinhdaidien.png";
        }
        $user->save();
        return redirect('/dangnhap')->with('thongbao', 'Chúc mừng bạn đã đăng ký thành công');
    }
    // Tìm kiếm  - Search
    public function getSearch(Request $request)
    {
        $tukhoa = $request->keyword;
        $danhsachketqua = BaiVietLinhVuc::where ('tieude', 'like', "%$tukhoa%")->orWhere('noidung', 'like', "%$tukhoa%")->orWhere('tomtat', 'like', "%$tukhoa%")->paginate(3);
        $count = BaiVietLinhVuc::where ('tieude', 'like', "%$tukhoa%")->orWhere('noidung', 'like', "%$tukhoa%")->orWhere('tomtat', 'like', "%$tukhoa%")->count();
        return view('pages.timkiem', ['danhsachketqua' => $danhsachketqua, 'tukhoa' => $tukhoa, 'count' => $count]);
    }
    public function getChuacapnhap()
    {
        return view('pages.chuacapnhap');
    }
}
