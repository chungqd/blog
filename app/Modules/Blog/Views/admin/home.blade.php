@extends('Blog::admin.layout.index')
@section('content')
	<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h1 class="text-center">Chào mừng bạn đến với trang quản trị</h1>
                <img src="{{asset('images/homeadmin.jpg')}}" alt="" width="100%" height="100%">
            </div>
        </div>

        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <form action="<?php //echo site_url('dashboard/upload') ?>" method="POST" enctype="multipart/form-data">
                    <label for="txtFile">Chon File</label>
                    <input type="file" name="txtFile" id="txtFile"><br><br>
                    <button type="submit" name="btnSubmit" class="btn btn-primary">Upload</button>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection