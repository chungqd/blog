@extends('Blog::admin.layout.index')
@section('content')
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h2 class="text-center">Danh sách bài đăng</h2>
                <div class="col-md-3">
                @if(session('thongbao'))
                    <div class="alert alert-success" role="alert">
                        {{session('thongbao')}}
                    </div>
                @endif
                @if(session('mess'))
                    <div class="alert alert-warning" role="alert">
                        {{session('mess')}}
                    </div>
                @endif
                <a href="admin/post/add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Post</a>
                <a href="admin/post/list" title="" class="btn btn-primary">View All</a>
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Tóm tắt</th>
                            <th>Thể loại</th>
                            <th>Số lượt xem</th>
                            <th class="text-center" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($posts as $post)
                        <tr>
                            <td>{{$post->id}}</td>
                            <td width="300">
                                <p><b>{{$post->tieude}}</b></p>
                                <img height="100" width="100" src="uploads/{{$post->HinhAnh}}" alt="">
                            </td>
                            <td width="350">{{$post->tomtat}}</td>
                            <td>
                                @foreach($post->categories as $category)
                                    {{$category->ten}}
                                    {!!'<br/>'!!}
                                @endforeach
                            </td>
                            <td>{{$post->soluotxem}}</td>
                            <td><a href="admin/post/edit/{{$post->id}}" title="" class="btn btn-warning pull-right">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteData({{$post->id}})" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!$posts->links()!!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteData(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "admin/post/delete/"+id;
        }
    }
</script>

@endsection