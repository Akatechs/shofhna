@extends('layouts.main')
@section('title',"الرئيسية ")
@section('content')
<!-- begin a partial: posts browse list  -->
<div id="home" class="page_sidebar">
    
	<div id="content_nav">
          
		<ul>
			<li class="{{Request::segment('3') == 'popular' || Request::segment('3') == null ? 'active': false}}"><a href="{{route('post-browse-popular')}}">الأكثر شيوعاً</a></li>
			<li class="{{Request::segment('3') == 'new' ? 'active': false}}"><a href="{{route('post-browse-new')}}">الأحدث</a></li>

			<li class="{{Request::segment('3') == 'top' ? 'active': false}}"><a href="{{route('post-browse-top')}}">الأفضل</a></li>
			@if(Auth::check())
                        <li  class="{{Request::segment('3') == 'discover' ? 'active': false}}"><a href="{{route('post-browse-discover')}}">اكتشف!</a></li>
                        <li  class="{{Request::segment('3') == 'favorites' ? 'active': false}}"><a href="{{route('post-browse-favorites')}}">مفضّلتي</a></li>
                        @endif
		</ul>
<!--		<ul class="left">
			<li><a href="/questions">أسئلة لك</a></li>
		</ul>-->
		<div class="clear">
		</div>
	</div>
	<!-- this changes from page to page, add section here -->
	<div id="posts">
            @foreach($posts as $post)
                @include('partials.post.listitem',compact($post))
            @endforeach
	</div>
	<div class="clear">
		<br/>
	</div>
	<div id="more_content">
		{{$posts->links()}}
	</div>
</div>
<div id="home_sidebar" class="sidebar">
	<!-- when not logged in -->
	@if(!Auth::check())
            @include('widgets.helloregister')
        @endif
        <div class="clear">
		
	
	@include('widgets.latestcomments')
	<div class="clear">
		<br/>
	</div>

</div>
<div class="clear">
</div>
@stop
