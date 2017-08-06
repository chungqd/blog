@extends('Blog::admin.layout.index')
@section('content')
<style type="text/css" media="screen">
.checkbox {
  padding-left: 20px; }
  .checkbox label {
    display: inline-block;
    position: relative;
    padding-left: 5px; }
    .checkbox label::before {
      content: "";
      display: inline-block;
      position: absolute;
      width: 17px;
      height: 17px;
      left: 0;
      margin-left: -20px;
      border: 1px solid #cccccc;
      border-radius: 3px;
      background-color: #fff;
      -webkit-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      -o-transition: border 0.15s ease-in-out, color 0.15s ease-in-out;
      transition: border 0.15s ease-in-out, color 0.15s ease-in-out; }
    .checkbox label::after {
      display: inline-block;
      position: absolute;
      width: 16px;
      height: 16px;
      left: 0;
      top: 0;
      margin-left: -20px;
      padding-left: 3px;
      padding-top: 1px;
      font-size: 11px;
      color: #555555; }
  .checkbox input[type="checkbox"] {
    opacity: 0; }
    .checkbox input[type="checkbox"]:focus + label::before {
      outline: thin dotted;
      outline: 5px auto -webkit-focus-ring-color;
      outline-offset: -2px; }
    .checkbox input[type="checkbox"]:checked + label::after {
      font-family: 'FontAwesome';
      content: "\f00c"; }
    .checkbox input[type="checkbox"]:disabled + label {
      opacity: 0.65; }
      .checkbox input[type="checkbox"]:disabled + label::before {
        background-color: #eeeeee;
        cursor: not-allowed; }
  .checkbox.checkbox-circle label::before {
    border-radius: 50%; }
  .checkbox.checkbox-inline {
    margin-top: 0; }

.checkbox-success input[type="checkbox"]:checked + label::before {
  background-color: #5cb85c;
  border-color: #5cb85c; }
.checkbox-success input[type="checkbox"]:checked + label::after {
  color: #fff; }
.checkbox-info input[type="checkbox"]:checked + label::before {
  background-color: #5bc0de;
  border-color: #5bc0de; }
.checkbox-info input[type="checkbox"]:checked + label::after {
  color: #fff; }

</style>
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
					<h2 class="text-center">Add Post</h2>
					<a href="admin/user/list" title="" class="btn btn-primary"><i class="fa fa-chevron-left" aria-hidden="true"></i> Back</a>

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
						<form action="admin/post/add" method="post" enctype="multipart/form-data">
							<input type="hidden" name="_token" value="{{csrf_token()}}">

						  	<div class="form-group">
							    <label for="title">Tiêu đề</label>
							    <input type="text" class="form-control" name="title" id="title" placeholder="Nhập tiêu đề">
						  	</div>

						  	<div class="form-group">
							    <label for="tomtat">Tóm tắt</label>
							    <input type="text" class="form-control" name="tomtat" id="tomtat" placeholder="Nội dung tóm tắt">
						  	</div>

						  	<div class="form-group">
							    <label for="noidung">Nội dung</label>
							    <input type="text" class="form-control" name="txtPassword" id="txtPassword" placeholder="Nhập mật khẩu">
						  	</div>

							<div class="form-group">
							    <label for="slcRole">Chọn chuyên mục</label><br>
                                <div class="row" style="padding-left: 50px;">
                                @foreach($categories as $categories)
                                    
                                    @if(($categories->id)%2 == 0)
                                        <div class="col-md-6 checkbox checkbox-info">
                                            <input id="checkbox{{$categories->id}}" type="checkbox" value="{{$categories->id}}">
                                            <label for="checkbox{{$categories->id}}">
                                                {{$categories->ten}}
                                            </label>
                                        </div>
                                    @else
                                        <div class="col-md-6 checkbox checkbox-info">
                                            <input id="checkbox{{$categories->id}}" type="checkbox" value="{{$categories->id}}">
                                            <label for="checkbox{{$categories->id}}">
                                                {{$categories->ten}}
                                            </label>
                                        </div>
                                    @endif
                                    
                                @endforeach 
                                </div> 
						  	</div>
                            <div class="form-group">
                                <input type="file" name="txtFile"><br>
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