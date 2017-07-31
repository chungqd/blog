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
					@if(isset($errors)>0)
						<div class="alert alert-danger">
					        <ul>
					            @foreach ($errors->all() as $error)
					                <li>{{ $error }}</li>
					            @endforeach
					        </ul>
				    	</div>
					@endif
					@if(session('thongbao'))
						<div class="alert alert-success" role="alert">
							{{session('thongbao')}}
						</div>
					@endif
					<a href="admin/categories/list" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>
					
						<form action="admin/categories/edit/{{$categories->id}}" method="post" enctype="multipart/form-data">
						{{csrf_field()}} 
						  <div class="form-group">
						    <label for="txtName">Tên Danh Mục</label>
						    <input type="text" class="form-control" name="txtName" id="txtName" placeholder="Tên chuyên mục" value="{{$categories->ten}}">
						    <input type="hidden" name="hddNameTB" value="{{$categories->ten}}">
						  </div>
						  <button name="btnSubmit" type="submit" class="btn btn-success"><i class="fa fa-plus-circle" aria-hidden="true" ></i> Sửa</button>
						</form>
					</div>
				</div>

            </div>
        </div>
    </div>
</div>
@endsection