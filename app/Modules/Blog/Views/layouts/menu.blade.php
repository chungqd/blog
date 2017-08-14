<div class="col-md-3 ">
    <ul class="list-group" id="menu">
        <li href="#" class="list-group-item menu1 active">
        	Menu
        </li>
		@foreach($categories as $category)
        <li class="list-group-item menu1">
        	<a href="category/{{$category->id}}/{{$category->tenkhongdau}}.html" title="" >{{$category->ten}}</a>
        </li>
        @endforeach
    </ul>
</div>