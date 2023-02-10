@extends('admin.layout.index')

@section('content')
<div class="main">
  <h1 class="main-title">Khách hàng</h1>
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
    <div>Tổng <span class="entries-number">{{$sobanghi}}</span> bản ghi</div>
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
            <th scope="col">Tên</th>
            <th scope="col">Email</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Lời nhắn</th>
            <th scope="col">Ngày gửi</th>            
            <th scope="col">Thao tác</th>
          </tr>
        </thead>
        <tbody>
          <?php $i = 0 ?>
          @foreach ($lienhe as $lh)
            <?php $i++ ?>
            <tr>
              <th scope="row"><?php echo $i ?></th>            
              <td>{{ $lh->name }}</td>
              <td>{{ $lh->email }}</td>
              <td>{{ $lh->phone }}</td>
              <td>{{ $lh->message }}</td>
              <td>{{ date("H:i A d/m/Y", strtotime($lh->created_at))}}</td>
              <td>
                <a href="admin/lienhe/xoalienhe/{{$lh->id}}" class="btn btn-danger" 
                onclick="return confirm('Bạn có chắc muốn xóa lời nhắn này?')"><i class="fa fa-trash"></i> Xóa</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
     <!-- Phân trang -->
     <div class="mx-auto pb-10 w-4/5">
      {{ $lienhe->links("pagination::bootstrap-5") }}
    </div>

  </div>
</div>

@endsection
