<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/img/Untitled-1.png">
    <link rel="stylesheet" href="/css/login.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('/css/login.css') }}">
    <title>Admin | Đăng nhập </title>

</head>

<body>
    <div class="wrapper">
        <form role="form" action="dangnhap" method="POST">
            @csrf
            <div class="login">
                <h2 id="txt">Đăng nhập</h2>
                @if(count($errors) > 0)
                    <span class="alert alert-disappear" style="color:red">
                        @foreach($errors->all() as $err)
                            {{ $err }}<br>
                        @endforeach
                    </span>
                @endif
                @if(session('thongbao'))
                    <span class="alert alert-disappear" style="color:red">
                        {{ session('thongbao') }}
                    </span>
                @endif
                <div class="inputBox">
                    <input type="text" placeholder="Email" name="email">
                </div>
    
                <div class="inputBox">
                    <input type="password" name="password" placeholder="Mật khẩu">
                </div>
    
                <div class="inputBox">
                    <input type="submit" value="Đăng nhập" id="btn">
                </div>
    
                <div class="group">
                    <a href="#">Quên mật khẩu</a>
                    <a href="#">Đăng kí</a>
                </div>
            </div>
        </form>
    </div>

    
    <script>
        setTimeout(function() {
          var alert = document.querySelector('.alert-disappear');
          alert.style.display = 'none';
        }, 3000);
      </script>
</body>

</html>