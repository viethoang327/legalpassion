@extends('admin.layout.index')

@section('content')
<div class="main">
  <h1 class="main-title">Khách Hàng - Đối Tác</h1>
  @if(session('thongbao'))
      <div class="alert alert-success alert-disappear">
          {{ session('thongbao') }}
      </div>
      <script>
        setTimeout(function() {
          var alert = document.querySelector('.alert-disappear');
          alert.style.display = 'none';
        }, 3000);
      </script>
  @endif
  <div class="main-notation">
    <div>Hiển thị <span class="entries-number">{{$sobanghi}}</span> bản ghi</div>
    <div class="main-notation-search">
      <button class="btn btn-primary"><i class="fa fa-search"></i> Tìm </button>
      <input class="sml-search" type="text" class="form-control" placeholder=" search ...">
    </div>
  </div>
  <div class="main-content">
    <div class="main-content__table">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Nội dung</th>
            <th scope="col">Hình ảnh</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0 ?>
          @foreach ($khachhang as $kh)
            <?php $i++ ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>            
              <td>{{ $kh->ten }}</td>
              <td>{!!$kh->noidung!!}</td>
              <td>
                <p>
                    <img width="400px" src="upload/khachhang/{{ $kh->hinhanh }}">
                </p>
              </td>
              <td>
                <div class="table-button">
                <a href="admin/khachhang/suakhachhang/{{ $kh->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                <a href="admin/khachhang/xoakhachhang/{{ $kh->id }}" class="btn btn-danger" 
                onclick="return confirm('Bạn có chắc muốn xóa khách hàng này?')"><i class="fa fa-trash"></i> Xóa</a>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  <!-- Phân trang -->
    <div class="mx-auto pb-10 w-4/5">
      {{ $khachhang->links("pagination::bootstrap-5") }}
    </div>

  </div>
</div>

@endsection
