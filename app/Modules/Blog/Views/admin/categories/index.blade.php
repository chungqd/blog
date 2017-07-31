@extends('Blog::admin.layout.index')
@section('content')
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
            <h2><?php //$msg->display(); ?></h2>
	            <div class="col-md-3">

	            <a href="admin/categories/add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Categories</a> 
	            <a href="admin/categories/list" title="" class="btn btn-primary">View All</a> 
	            </div>
	            <div class="col-md-9">
	            	<button type="button" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
	            	<input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa" value="<?php //echo $keyword; ?>">
	            </div>
		            @if(isset($mess))
							<div class="alert alert-success" role="alert">
								{{$mess}}
							</div>
					@endif        
	            @if(session('thongbao'))
						<div class="alert alert-success" role="alert">
							{{session('thongbao')}}
						</div>
					@endif 
				<table class="table table-hover">
					<thead>
						<tr>
							<th>#</th>
							<th>Tên Chuyên Mục</th>
							<th>Tên Không Dấu</th>
							<th class="text-center" colspan="2">Action</th>
						</tr>
					</thead>
					<tbody>
					@foreach ($categories as $cat)
						<tr>
							<td>{{$cat->id}}</td>
							<td>{{$cat->ten}}</td>
							<td>{{$cat->tenkhongdau}}</td>
							<td><a href="admin/categories/edit/{{$cat->id}}" title="" class="btn btn-warning pull-right">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
							<td><a onclick="deleteData({{$cat->id}})" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
						</tr>
					@endforeach
					</tbody>
				</table>
				{!!$categories->links()!!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
	function deleteData(id){
		if (confirm("Bạn có muốn xóa không")) {
			window.location.href = "admin/categories/delete/"+id;
		}
	}

	$(document).ready(function() {
		$("#btnSearch").click(function(){
			var keyword = $.trim($("#txtSearch").val());
			window.location.href = "?sk=typebook&m=index&page=1&keyword="+keyword;
		});
	});
</script>

@endsection