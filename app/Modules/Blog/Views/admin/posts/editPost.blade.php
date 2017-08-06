@extends('Blog::admin.layout.index')
@section('content')
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php //$msg->display(); ?></h2>
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Edit Categories</h2>
					@if(session('mess'))
						<div class="alert alert-success" role="alert">
							{{session('mess')}}
						</div>
					@endif
					<a href="admin/user/list" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
					
						<form action="admin/user/edit/{{$user->id}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}} 
						  	<div class="form-group">
							    <label for="txtName">Tên tài khoản</label>
							    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên thành viên" value="{{$user->name}}">
							    <input type="hidden" name="hddNameTB" value="{{$user->name}}">
							</div>

						 	<div class="form-group">
							    <label for="txtEmail">Email</label>
							    <input type="email" class="form-control" name="txtEmail" id="txtEmail" placeholder="Địa chỉ email" value="{{$user->email}}">
						  	</div>

							<div class="form-group">
								<input type="checkbox" name="changePass" id="changePass">
								<label for="txtPassword">Đổi mật khẩu</label>
								<input type="password" class="form-control password" name="txtPassword" id="txtPassword" placeholder="Nhập mật khẩu" disabled="">
							</div>

						  	<div class="form-group">
							    <label for="slcRole">Chọn quyền</label>
							    <select name="slcRole" class="form-control"> 
							    	<option {{$user->quyen == 1 ? 'selected' : ''}} value="1" >Admin</option> 
							    	<option {{$user->quyen == 0 ? 'selected' : ''}} value="0">Member</option> 
							    </select>
						  	</div>
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $("#changePass").change(function() {
            if($(this).is(":checked"))
            {
                $(".password").removeAttr('disabled');
            }
            else
            {
                $(".password").attr('disabled', '');
            }
        });
    });
</script>
@endsection