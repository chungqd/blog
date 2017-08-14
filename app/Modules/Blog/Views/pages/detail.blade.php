@extends('Blog::layouts.index')
@section('content')
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.8&appId=292576250831357";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
    <!-- Page Content -->
    <div class="container">
        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-9">

                <!-- Blog Post -->

                <!-- Title -->
                <h1>{{$post->tieude}}</h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="user/{{$user->id}}">{{$user->name}}</a>
                </p>
                
                <!-- Preview Image -->
                <img class="img-responsive" src="uploads/{{$post->HinhAnh}}" alt="">

                <!-- Date/Time -->
                <br>
                <p><span class="glyphicon glyphicon-time"></span> Posted on {{$post->created_at}}</p>
                <hr>

                <!-- Post Content -->
                <p class="lead">{{$post->tieude}}</p>
                {!!$post->noidung!!}

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <figure>
                  <div>
                    <div class="fb-comments" data-numposts="5"></div>
                  </div>
                </figure

                <hr>
            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-3">
                <div class="panel panel-default">
                    <div class="panel-heading"><b>Tin nổi bật</b></div>
                    <div class="panel-body">
                        <!-- item -->
                        @foreach($hotNews as $news)
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-5">
                                <a href="detail/{{$news->id}}/{{$news->tieudekhongdau}}.html">
                                    <img class="img-responsive" src="uploads/{{$news->HinhAnh}}" alt="">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <a href="detail/{{$news->id}}/{{$news->tieudekhongdau}}.html" style="color: blue;">{{$news->tieude}}</a>
                            </div>
                            <div class="break"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                    </div>
                </div>
                
            </div>

        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection