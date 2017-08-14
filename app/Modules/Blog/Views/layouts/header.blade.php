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

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="home">Blog - Tâm sự coder</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="about">Giới thiệu</a>
                    </li>
                    <li>
                        <a href="contact">Liên hệ</a>
                    </li>
                </ul>

                <form action="search" method="post" class="navbar-form navbar-left" role="search">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <div class="form-group">
                      <input type="text" name="keyword" class="form-control" placeholder="Search">
                    </div>
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    @if(!Auth::check())
                        <li><a href="login">Đăng Nhập</a></li>
                        <li><a href="register">Đăng Ký</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class ="glyphicon glyphicon-user"></span>  {{Auth::user()->name}} <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                            <li><a href="admin/post/list">Quản lý bài viết</a></li>
                            @if(Auth::user()->quyen == 1)
                                <li><a href="admin/user/list">Quản lý thành viên</a></li>
                                <li><a href="admin/categories/list">Quản lý chuyên mục</a></li>
                            @endif
                            <li><a href="user">Thông tin người dùng</a></li>
                            <li role="separator" class="divider"></li>
                            {{-- <li><a href="#">Thay đổi mật khẩu</a></li> --}}
                            <li><a href="logout">Đăng xuất</a></li>
                          </ul>
                        </li>
                    @endif
                </ul>

            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>