<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blog - Tâm sự coder</title>
    <base href="{{asset('')}}" >
    <!-- Bootstrap Core CSS -->
    <link href="front/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="front/css/shop-homepage.css" rel="stylesheet">
    <link href="front/css/my.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
<p>Dear {{$name}},</p>
<p>Vui lòng click vào link bên dưới kích hoạt tài khoản. Nếu bạn không đăng kí tài khoản tại Blog, chúng tôi xin lỗi vì đã làm phiền</p>
{{ URL::to('active/' . $link) }}.<br/>
<p>Xin cảm ơn!</p>
</body>

</html>