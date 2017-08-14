<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{asset('images/admin.jpg')}}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>admin</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                                </button>
                            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li>
                <a href="home"><i class="fa fa-home"></i>Trang chủ</a>
            </li>
            <li>
                <a href="admin/post/list"><i class="fa fa-book"></i>Quản lý bài viết</a>
            </li>
            @if(Auth::user()->quyen == 1)
                <li>
                    <a href="admin/categories/list"><i class="fa fa-th"></i>Quản lý chuyên mục</a>
                </li>
                <li>
                    <a href="admin/user/list"><i class="fa fa-th"></i>Quản lý thành viên</a>
                </li>
            @endif
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>