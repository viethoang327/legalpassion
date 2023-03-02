<!-- TOP-BAR -->
<div class="top-bar">

  <div class="admin-info">
    @if(Auth::user())
    <img src="upload/hinhdaidien/{{Auth::user()->hinhdaidien}}" class="admin-picture">
    <div class="admin-name">{{Auth::user()->name}}</div>
    @endif
    <div class="admin-status">
      <i class="fa fa-circle"></i>
      <span>Online</span>
    </div>
  </div>
  <div>
    <form id="search-form" onsubmit="handleSearch()">
      <input type="text" id="search-input" placeholder="Search ..." name="query">
      <button type="submit">
        <i class="fa fa-search"></i>
    </form>
  </div>
  <div class="admin-menu">
    <button class="dropdown-btn">Cá nhân</button>
    <div class="dropdown-container">
      <a href="admin/thanhvien/suathanhvien/{{Auth::user()->id}}">Chỉnh sửa thông tin cá nhân</a>
    </div>
    <div>
      <a href="{{ route('legalpassion.admin') }}">
        <i class="fa fa-envelope"></i>
      </a>
    </div>
    <div>
      <a href="{{ route('legalpassion.admin') }}">
        <i class="fa fa-bell"></i>
      </a>
    </div>
  </div>

</div>
<!-- SIDE-BAR -->
<div class="sidenav">
  <button>
    <a href="{{ route('legalpassion.admin') }}">
      <i class="fa fa-home"></i>
      <span> Trang chủ</span>
    </a>
  </button>
  <button class="dropdown-btn">
    <i class="fa fa-users"></i>
    <span>Thành viên</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.user.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.user.add') }}">Thêm thành viên</a>
    <a href="{{ route('legalpassion.lienhe.list') }}">Liên hệ</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-filter"></i>
    <span>Lĩnh vực</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.loailinhvuc.list') }}"> Danh sách</a>
    <a href="{{ route('legalpassion.loailinhvuc.add') }}">Thêm lĩnh vực</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-rocket"></i>
    <span>Vấn đề</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.linhvuc.list') }}"> Danh sách</a>
    <a href="{{ route('legalpassion.linhvuc.add') }}">Thêm vấn đề</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-file"></i>
    <span>Bài viết</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.baiviet.list') }}"> Danh sách</a>
    <a href="{{ route('legalpassion.baiviet.add') }}">Thêm bài viết</a>
    <a href="{{ route('legalpassion.commentbaiviet.list') }}">Bình luận</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-refresh"></i>
    <span>Thủ tục</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.thutuc.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.thutuc.add') }}">Thêm thủ tục</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-newspaper-o"></i>
    <span>Bản tin</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.tintuc.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.tintuc.add') }}">Thêm bản tin</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-image"></i>
    <span>Silde</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.slide.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.slide.add') }}">Thêm Slide</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-book"></i>
    <span>Giới thiệu</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.gioithieu.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.gioithieu.add') }}">Thêm bài giới thiệu</a>
  </div>
  <button class="dropdown-btn">
    <i class="fa fa-user"></i>
    <span>Khách hàng</span>
  </button>
  <div class="dropdown-container">
    <a href="{{ route('legalpassion.khachhang.list') }}">Danh sách</a>
    <a href="{{ route('legalpassion.khachhang.add') }}">Thêm khách hàng</a>
  </div>
  <button>
    <a href="{{ route('legalpassion.admin') }}">
      <i class="fa fa-cog"></i>
      <span> Cài đặt</span>
    </a>
  </button>
  <button>
    <a href="{{ route('legalpassion.user.logout') }}">
      <i class="fa fa-sign-out"></i>
      <span>Đăng xuất</span>
    </a>
  </button>
</div>