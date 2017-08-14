@extends('Blog::admin.layout.index')
@section('content')
<div class="content-wrapper right_col">
    <div class="row">
        <div  class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="main-content">
                <h2>
                    @if(session('mess'))
                        <div class="alert alert-warning" role="alert">
                            {{session('mess')}}
                        </div>
                    @endif
                    @if(session('thongbao'))
                        <div class="alert alert-success" role="alert">
                            {{session('thongbao')}}
                        </div>
                    @endif
                </h2>
                <div class="col-md-3">
                <a href="admin/user/add" title="" class="btn btn-primary"><i class="fa fa-plus-square" aria-hidden="true"></i>  Add Member</a>
                <a href="admin/user/list" title="" class="btn btn-primary">View All</a>
                </div>
                <div class="col-md-9">
                   <button type="button" id="btnSearch" id="btnSearch" class="btn btn-info pull-right"><span class="glyphicon glyphicon-search"></span></button>
                  <input class="form-control pull-right" style="width: 300px;" type="text" name="txtSearch" id="txtSearch" placeholder="Nhập từ khóa">
                </div>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Quyền</th>
                            <th class="text-center" colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach ($user as $us)
                        <tr>
                            <td>{{$us->id}}</td>
                            <td>{{$us->name}}</td>
                            <td>{{$us->email}}</td>
                            <td>
                                @if($us->quyen == 1)
                                    {{'Admin'}}
                                @else
                                    {{'Member'}}
                                @endif
                            </td>
                            <td><a href="admin/user/edit/{{$us->id}}" title="" class="btn btn-warning pull-right">Edit <i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
                            <td><a onclick="deleteData({{$us->id}})" title="" class="btn btn-danger">Delete <i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                {!!$user->links()!!}
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    function deleteData(id){
        if (confirm("Bạn có muốn xóa không")) {
            window.location.href = "admin/user/delete/"+id;
        }
    }

    $(document).ready(function() {
        $("#btnSearch").click(function(){
            var keyword = $.trim($("#txtSearch").val());
            window.location.href = "admin/user/search/"+keyword;
        });
    });
</script>
@endsection