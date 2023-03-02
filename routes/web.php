<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
// Lĩnh vực controller
use App\Http\Controllers\LoaiLinhVucController;
use App\Http\Controllers\LinhVucController;
use App\Http\Controllers\BaiVietLinhVucController;
use App\Http\Controllers\CommentBaiVietController;
use App\Http\Controllers\ReplyCommentController;
// Thủ tục controller
use App\Http\Controllers\ThuTucController;
// Tin tức controller
use App\Http\Controllers\TinTucController;
// User controller
use App\Http\Controllers\UserController;
// Slide controller
use App\Http\Controllers\SlideController;
// Page controller
use App\Http\Controllers\PageController;
// Gioi thieu controller
use App\Http\Controllers\GioiThieuController;
// Khach hang controller
use App\Http\Controllers\KhachHangController;





/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// HOME ROUTE
Route::get('/', [PageController::class, 'home'])->name('legalpassion.home');
Route::get('/gioithieu/{id}/{tieude}.html', [PageController::class, 'gioithieuchung'])->name('legalpassion.home.gioithieuchung');
//LĨNH VỰC ROUTE
Route::get('/linhvuc', [PageController::class, 'linhvuc'])->name('legalpassion.home.linhvuc');
Route::get('/linhvuc/{tenkhongdau}/{id}', [PageController::class, 'vande'])->name('legalpassion.home.linhvuc.vande');
Route::get('/{tenkhongdau}/{id}', [PageController::class, 'danhsachbaiviet'])->name('legalpassion.home.linhvuc.danhsachbaiviet');
Route::get('linhvuc/baiviet/{id}/{tieude}.html', [PageController::class, 'baiviet'])->name('legalpassion.linhvuc.baiviet');
// THỦ TỤC ROUTE
Route::get('/thutuc', [PageController::class, 'thutuc'])->name('legalpassion.home.thutuc');
Route::get('thutuc/{id}/{tieude}.html', [PageController::class, 'baivietthutuc'])->name('legalpassion.home.thutuc.baiviet');
// TIN TỨC ROUTE
Route::get('tintuc', [PageController::class, 'tintuc'])->name('legalpassion.home.tintuc');
Route::get('tintuc/{id}/{tieude}.html', [PageController::class, 'baiviettintuc'])->name('legalpassion.home.tintuc.baiviet');
// KHÁCH HÀNG ROUTE
Route::get('khachhang', [PageController::class, 'khachhang'])->name('legalpassion.home.khachhang');
// ADMIN ROUTE
Route::get('/admin', [GioiThieuController::class, 'admin'])->name('legalpassion.admin')->middleware('adminLogin');

Route::prefix('admin')->middleware('adminLogin')->group(function() {
    Route::prefix('danhmuclinhvuc')->group(function() {
        Route::get('danhsachdanhmuc', [LoaiLinhVucController::class, 'getList'])->name('legalpassion.loailinhvuc.list');
        Route::get('themdanhmuc', [LoaiLinhVucController::class, 'getAdd'])->name('legalpassion.loailinhvuc.add');
        Route::post('themdanhmuc', [LoaiLinhVucController::class, 'postAdd'])->name('legalpassion.loailinhvuc.add');
        Route::get('suadanhmuc/{id}', [LoaiLinhVucController::class, 'getEdit'])->name('legalpassion.loailinhvuc.edit');
        Route::post('suadanhmuc/{id}', [LoaiLinhVucController::class, 'postEdit'])->name('legalpassion.loailinhvuc.edit');
        Route::get('xoadanhmuc/{id}', [LoaiLinhVucController::class, 'getDelete'])->name('legalpassion.loailinhvuc.delete');
        Route::post('timkiem', [LoaiLinhVucController::class, 'postSearch'])->name('legalpassion.loailinhvuc.search');
    });
    
    Route::prefix('vande')->group(function() {
        Route::get('danhsachvande', [LinhVucController::class, 'getList'])->name('legalpassion.linhvuc.list');
        Route::get('themvande', [LinhVucController::class, 'getAdd'])->name('legalpassion.linhvuc.add');
        Route::post('themvande', [LinhVucController::class, 'postAdd'])->name('legalpassion.linhvuc.add');
        Route::get('suavande/{id}', [LinhVucController::class, 'getEdit'])->name('legalpassion.linhvuc.edit');
        Route::post('suavande/{id}', [LinhVucController::class, 'postEdit'])->name('legalpassion.linhvuc.edit');
        Route::get('xoavande/{id}', [LinhVucController::class, 'getDelete'])->name('legalpassion.linhvuc.delete');
        Route::post('timkiem', [LinhVucController::class, 'postSearch'])->name('legalpassion.linhvuc.search');
    });
    Route::prefix('baiviet')->group(function() {
        Route::get('danhsachbaiviet', [BaiVietLinhVucController::class, 'getList'])->name('legalpassion.baiviet.list');
        Route::get('thembaiviet', [BaiVietLinhVucController::class, 'getAdd'])->name('legalpassion.baiviet.add');
        Route::post('thembaiviet', [BaiVietLinhVucController::class, 'postAdd'])->name('legalpassion.baiviet.add');
        Route::get('suabaiviet/{id}', [BaiVietLinhVucController::class, 'getEdit'])->name('legalpassion.baiviet.edit');
        Route::post('suabaiviet/{id}', [BaiVietLinhVucController::class, 'postEdit'])->name('legalpassion.baiviet.edit');
        Route::get('xoabaiviet/{id}', [BaiVietLinhVucController::class, 'getDelete'])->name('legalpassion.baiviet.delete');
        Route::post('timkiem', [BaiVietLinhVucController::class, 'postSearch'])->name('legalpassion.baiviet.search');
    });
    Route::prefix('commentbaiviet')->group(function(){
        Route::get('danhsachcomment', [CommentBaiVietController::class, 'getList'])->name('legalpassion.commentbaiviet.list');
        Route::get('themcomment', [CommentBaiVietController::class, 'getAdd'])->name('legalpassion.commentbaiviet.add');
        Route::post('themcomment', [CommentBaiVietController::class, 'postAdd'])->name('legalpassion.commentbaiviet.add');
        Route::get('suacomment/{id}', [CommentBaiVietController::class, 'getEdit'])->name('legalpassion.commentbaiviet.edit');
        Route::post('suacomment/{id}', [CommentBaiVietController::class, 'postEdit'])->name('legalpassion.commentbaiviet.edit');
        Route::get('xoacomment/{id}', [CommentBaiVietController::class, 'getDelete'])->name('legalpassion.commentbaiviet.delete');
    });
    Route::prefix('replycomment')->group(function(){
        Route::get('danhsachreply', [ReplyCommentController::class, 'getList'])->name('legalpassion.replycomment.list');
        Route::get('themreply', [ReplyCommentController::class, 'getAdd'])->name('legalpassion.replycomment.add');
        Route::post('themreply', [ReplyCommentController::class, 'postAdd'])->name('legalpassion.replycomment.add');
        Route::get('suareply/{id}', [ReplyCommentController::class, 'getEdit'])->name('legalpassion.replycomment.edit');
        Route::post('suareply/{id}', [ReplyCommentController::class, 'postEdit'])->name('legalpassion.replycomment.edit');
        Route::get('xoareply/{id}', [ReplyCommentController::class, 'getDelete'])->name('legalpassion.replycomment.delete');
    });
    Route::prefix('ajax')->group(function() {
        Route::get('linhvuc/{id_loailinhvuc}', [AjaxController::class, 'getLinhVuc'])->name('legalpassion.ajax.linhvuc');
    });
    
    Route::prefix('tintuc')->group(function() {
        Route::get('danhsachtintuc', [TinTucController::class, 'getList'])->name('legalpassion.tintuc.list');
        Route::get('themtintuc', [TinTucController::class, 'getAdd'])->name('legalpassion.tintuc.add');
        Route::post('themtintuc', [TinTucController::class, 'postAdd'])->name('legalpassion.tintuc.add');
        Route::get('suatintuc/{id}', [TinTucController::class, 'getEdit'])->name('legalpassion.tintuc.edit');
        Route::post('suatintuc/{id}', [TinTucController::class, 'postEdit'])->name('legalpassion.tintuc.edit');
        Route::get('xoatintuc/{id}', [TinTucController::class, 'getDelete'])->name('legalpassion.tintuc.delete');
        Route::post('timkiem', [TinTucController::class, 'postSearch'])->name('legalpassion.tintuc.search');
    });
   
    Route::prefix('thutuc')->group(function() {
        Route::get('danhsachthutuc', [ThuTucController::class, 'getList'])->name('legalpassion.thutuc.list');
        Route::get('themthutuc', [ThuTucController::class, 'getAdd'])->name('legalpassion.thutuc.add');
        Route::post('themthutuc', [ThuTucController::class, 'postAdd'])->name('legalpassion.thutuc.add');
        Route::get('suathutuc/{id}', [ThuTucController::class, 'getEdit'])->name('legalpassion.thutuc.edit');
        Route::post('suathutuc/{id}', [ThuTucController::class, 'postEdit'])->name('legalpassion.thutuc.edit');
        Route::get('xoathutuc/{id}', [ThuTucController::class, 'getDelete'])->name('legalpassion.thutuc.delete');
        Route::post('timkiem', [ThuTucController::class, 'postSearch'])->name('legalpassion.thutuc.search');
    });
    
    Route::prefix('thanhvien')->group(function() {
        Route::get('danhsachthanhvien', [UserController::class, 'getList'])->name('legalpassion.user.list');
        Route::get('themthanhvien', [UserController::class, 'getAdd'])->name('legalpassion.user.add');
        Route::post('themthanhvien', [UserController::class, 'postAdd'])->name('legalpassion.user.add');
        Route::get('suathanhvien/{id}', [UserController::class, 'getEdit'])->name('legalpassion.user.edit');
        Route::post('suathanhvien/{id}', [UserController::class, 'postEdit'])->name('legalpassion.user.edit');
        Route::get('xoathanhvien/{id}', [UserController::class, 'getDelete'])->name('legalpassion.user.delete');
        Route::post('timkiem', [UserController::class, 'postSearch'])->name('legalpassion.user.search');
    });
    Route::prefix('slide')->group(function() {
        Route::get('list', [SlideController::class, 'getList'])->name('legalpassion.slide.list');
        Route::get('add', [SlideController::class, 'getAdd'])->name('legalpassion.slide.add');
        Route::post('add', [SlideController::class, 'postAdd'])->name('legalpassion.slide.add');
        Route::get('edit/{id}', [SlideController::class, 'getEdit'])->name('legalpassion.slide.edit');
        Route::post('edit/{id}', [SlideController::class, 'postEdit'])->name('legalpassion.slide.edit');
        Route::get('delete/{id}', [SlideController::class, 'getDelete'])->name('legalpassion.slide.delete');
    });
    Route::prefix('khachhang')->group(function() {
        Route::get('danhsachkhachhang', [KhachHangController::class, 'getList'])->name('legalpassion.khachhang.list');
        Route::get('themkhachhang', [KhachHangController::class, 'getAdd'])->name('legalpassion.khachhang.add');
        Route::post('themkhachhang', [KhachHangController::class, 'postAdd'])->name('legalpassion.khachhang.add');
        Route::get('suakhachhang/{id}', [KhachHangController::class, 'getEdit'])->name('legalpassion.khachhang.edit');
        Route::post('suakhachhang/{id}', [KhachHangController::class, 'postEdit'])->name('legalpassion.khachhang.edit');
        Route::get('xoakhachhang/{id}', [KhachHangController::class, 'getDelete'])->name('legalpassion.khachhang.delete');
        Route::post('timkiem', [KhachHangController::class, 'postSearch'])->name('legalpassion.khachhang.search');
    });
    Route::prefix('gioithieu')->group(function(){
        Route::get('danhsachgioithieu', [GioiThieuController::class, 'getList'])->name('legalpassion.gioithieu.list');
        Route::get('themgioithieu', [GioiThieuController::class, 'getAdd'])->name('legalpassion.gioithieu.add');
        Route::post('themgioithieu', [GioiThieuController::class, 'postAdd'])->name('legalpassion.gioithieu.add');
        Route::get('suagioithieu/{id}', [GioiThieuController::class, 'getEdit'])->name('legalpassion.gioithieu.edit');
        Route::post('suagioithieu/{id}', [GioiThieuController::class, 'postEdit'])->name('legalpassion.gioithieu.edit');
        Route::get('xoagioithieu/{id}', [GioiThieuController::class, 'getDelete'])->name('legalpassion.gioithieu.delete');
    });
    Route::prefix('lienhe')->group(function(){
        Route::get('danhsachlienhe', [UserController::class, 'getLienhe'])->name('legalpassion.lienhe.list');
        Route::get('xoalienhe/{id}', [UserController::class, 'deleteLienhe'])->name('legalpassion.lienhe.delete');
    });
});
// USER ROUTE
Route::get('dangnhap', [PageController::class, 'getDangnhap'])->name('legalpassion.user.login');
Route::post('dangnhap', [PageController::class, 'postDangnhap'])->name('legalpassion.user.login');
Route::get('dangxuat', [PageController::class, 'getDangxuat'])->name('legalpassion.user.logout');
Route::get('nguoidung', [PageController::class, 'getNguoidung'])->name('legalpassion.user.nguoidung');
Route::get('quanlynguoidung', [PageController::class, 'getQuanlynguoidung'])->name('legalpassion.user.quanlynguoidung');
Route::post('quanlynguoidung', [PageController::class, 'postQuanlynguoidung'])->name('legalpassion.user.quanlynguoidung');
Route::get('dangky', [PageController::class, 'getDangky'])->name('legalpassion.user.dangky');
Route::post('dangky', [PageController::class, 'postDangky'])->name('legalpassion.user.dangky');
// COMMENT ROUTE
Route::post('comment/{id}', [CommentBaiVietController::class, 'postComment'])->name('legalpassion.comment');

// Route::get('/comment/like', [CommentBaiVietController::class, 'like'])->name('comment.like');
// Route::get('/comment/dislike', [CommentBaiVietController::class, 'dislike'])->name('comment.dislike');
Route::post('reply/{id}', [ReplyCommentController::class, 'postReply'])->name('legalpassion.reply');
// SEARCH ROUTE
Route::get('timkiem', [PageController::class, 'getSearch'])->name('legalpassion.search');
// CONTACT ROUTE
Route::get('/lienhe', [PageController::class, 'getLienhe'])->name('legalpassion.home.lienhe');
Route::post('/lienhe', [PageController::class, 'postLienhe'])->name('legalpassion.home.lienhe');
// NOT UPDATED ROUTE
Route::get('chuacapnhap', [PageController::class, 'getChuacapnhap'])->name('legalpassion.chuacapnhap');
    
    