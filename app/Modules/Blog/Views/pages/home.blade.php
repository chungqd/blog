@extends('Blog::layouts.index')
@section('content')
    <!-- Page Content -->
    <div class="container">

        <!-- slider -->
        <div class="row carousel-holder">
            <div class="col-md-12">
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="item active">
                            <img  class="slide-image" src="front/image/slide5.jpg" alt="">
                        </div>
                        <div class="item">
                            <img width="300" class="slide-image" src="front/image/slide4.jpg" alt="">
                        </div>
                        <div class="item">
                            <img class="slide-image" src="front/image/slide6.png" alt="">
                        </div>
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left"></span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right"></span>
                    </a>
                </div>
            </div>
        </div>
        <!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('Blog::layouts.menu')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color:#337AB7; color:white;" >
                        <h2 style="margin-top:0px; margin-bottom:0px;">Tin Tức</h2>
                    </div>

                    <div class="panel-body">
                        <!-- item -->
                        @foreach($posts as $post)
                        <div class="row-item row">
                            {{-- <h3>
                                <a href="category.html">Category</a> |
                            </h3> --}}
                            <div class="border-right">
                                <div class="col-md-4">
                                    <a href="detail/{{$post->id}}/{{$post->tieudekhongdau}}.html">
                                        <img class="img-responsive" src="uploads/{{$post->HinhAnh}}" alt="">
                                    </a>
                                </div>

                                <div class="col-md-8">
                                <h3><a href="detail/{{$post->id}}/{{$post->tieudekhongdau}}.html">{{$post->tieude}}</a></h3>
                                    <p>{{$post->tomtat}}</p>
                                    <a class="btn btn-primary" href="detail/{{$post->id}}/{{$post->tieudekhongdau}}.html">Read more <span class="glyphicon glyphicon-chevron-right"></span></a>
                                </div>
                            </div>
                            <div class="break"></div>
                            <div class="space20"></div>
                        </div>
                        @endforeach
                        <!-- end item -->
                        <div class="row text-center">
                            <div class="col-lg-12">
                                {!!$posts->links()!!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection