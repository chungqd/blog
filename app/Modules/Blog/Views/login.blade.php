<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <title>Đăng nhập</title>
    <base href="{{asset('')}}" >
    <link rel="stylesheet" href="css/animate.css">
    <!-- Custom Stylesheet -->
    <link rel="stylesheet" href="css/style2.css">
    <script src="js/jquery-1.12.0.min.js"></script>
</head>
<body>
<div class="container">
    <div class="login-box animated fadeInUp" style="max-width:340px">
        <form role="form" action="login" method="post">
            {{csrf_field()}}
            <div class="box-header">
                <h2>Đăng nhập</h2>
            </div>
            @if(count($errors) > 0)
                <div class="alert alert-danger">
                    <ul style="list-style: none;">
                        @foreach ($errors->all() as $error)
                            <li style="color: red;">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if(session('error'))
                <ul style="list-style: none;">
                        <li style="color: red;">{{session('error') }}</li>
                </ul>
            @endif
            <label for="username">Tên đăng nhập</label>
            <br/>
            <input type="text" name="txtTenDangNhap" id="username">
            <br/>
            <label for="password">Mật khẩu</label>
            <br/>
            <input type="password" name="txtMatKhau" id="password">
            <br/>
            <input id="btnLogin" type="submit" name="btnSubmit" value="Đăng nhập"/>
            <input id="btnReset" type="reset" name="btnReset" value="reset"/>
            <br/>
            <a href="register.php" title="">Đăng ký</a>
            <span>|</span>
            <a href="index.php" title="">Trang chủ</a>
        </form>
    </div>
</div>
</body>
</html>