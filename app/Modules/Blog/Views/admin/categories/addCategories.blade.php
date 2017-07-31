@extends('Blog::admin.layout.index')
@section('content')
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Add Categories</h2>
					<a href="admin/categories/list" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>

					@if(isset($errors))
						<div class="alert alert-danger" role="alert">
							@foreach ($errors->all() as $error)
						    	<strong>Warning!</strong> {{$error}}
							@endforeach
						</div>
					@endif

					@if(session('thongbao'))
						<div class="alert alert-success" role="alert">
							<strong>Well done!</strong> {{session('thongbao')}}
						</div>
					@endif
						<form action="admin/categories/add" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
						  <div class="form-group">
						    <label for="txtName">Tên danh mục</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên chuyên mục">
						  </div>
						  <button type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Thêm</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>
@endsection