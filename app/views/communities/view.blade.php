@extends('layouts.main')
@section('title',"$community->name")
@section('content')
<!-- begin a partial: posts browse list  -->
<div id="home" class="page_sidebar">
    
	<div id="content_nav">
           
            <h2 id="nav_title"><a href="#" title="{{$community->name}}">{{$community->name}}</a></h2>
            
		<ul>
			<li class="{{Request::segment('3') == 'popular' || Request::segment('3') == null ? 'active': false}}"><a href="{{route('community-view',['communitySlug'=>$community->slug])}}">الأكثر شيوعاً</a></li>
			<li class="{{Request::segment('3') == 'new' ? 'active': false}}"><a href="{{route('community-view-new',['communitySlug'=>$community->slug])}}">الأحدث</a></li>
<!--			<li><a href="/discover">اكتشف!</a></li>-->
			<li class="{{Request::segment('3') == 'top' ? 'active': false}}"><a href="{{route('community-view-top',['communitySlug'=>$community->slug])}}">الأفضل</a></li>
<!--			<li><a href="/favorites">مفضّلتي</a></li>-->
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
<div id="cateogry_sidebar" class="sidebar">
	<!-- when not logged in -->
        
        @include('partials.community.community_info')
        <div class="clear">
		<br/>
        
	@if(!Auth::check())
            @include('widgets.helloregister')
            <div class="clear">
		<br/>
        @endif
        
        
	</div>
	@include('widgets.latestcomments')
	<div class="clear">
		<br/>
	</div>
</div>
<div class="clear">
</div>
<input id="community_id" type='hidden' name='community_id' value='{{$community->id}}' />
@stop
