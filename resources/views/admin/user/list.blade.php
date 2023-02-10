@extends('admin.layout.index')

@section('content')
<div class="main">
  <h1 class="main-title">Danh sách thành viên</h1>
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
      <form action="admin/thanhvien/timkiem" method="POST">
        @csrf
        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Tìm </button>
        <input class="sml-search" type="text" name="keyword" class="form-control" placeholder=" search ...">
      </form>
    </div>
  </div>
  <div class="main-content">
    <div class="main-content__table">
      <table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên thành viên</th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Cấp bậc</th>
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0 ?>
          @foreach ($user as $ur)
          <?php $i++ ?>
          <tr>
            <th scope="row"><?php echo $i ?></th>
            <td>{{ $ur->name }}</td>
            <td>{{ $ur->email }}</td>
            <td>{{ $ur->phone }}</td>
            <td>
              @if ($ur->level == 1)
              {{ "Admin" }}
              @else
              {{ "Thường" }}
              @endif
            </td>
            <td>
              <div class="table-button">
                <a href="admin/thanhvien/suathanhvien/{{ $ur->id }}" class="btn btn-primary"><i class="fa fa-edit"></i> Sửa</a>
                <a href="admin/thanhvien/xoathanhvien/{{ $ur->id }}" class="btn btn-danger" onclick="return confirm('Bạn có chắc muốn xóa người dùng này?')"><i class="fa fa-trash"></i> Xóa</a>
              </div>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <!-- Phân trang -->
    <div class="mx-auto pb-10 w-4/5">
      {{ $user->links("pagination::bootstrap-5") }}
    </div>

  </div>
</div>

@endsection