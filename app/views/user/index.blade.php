@extends('layouts.main')
@section('title',"$user->username")
@section('content')

<div id="user">
	<div id="user_profile">
		<div class="right_col">
<!--			<img id="user_image" src="https://secure.gravatar.com/avatar/a677aa78851c756b324af91bf2a59695?s=240&amp;d=mm" height="120" width="120">-->
			<h2 id="user_name">
                            <a href="{{route('user-index',['username'=>$user->username])}}" title="{{$user->username}}">
			<span class="inblock username">{{$user->username}}</span>
			<span class="inblock full_name">{{$user->getFullName()}}</span>
			</a>
			</h2>
			<p>
                            {{$user->getMarkdownBio()}}
			</p>
			<div class="clear">
			</div>
		</div>
		<div class="left_col">
			<p class="points">
				<i class="icon-star"></i> نقاط السمعة: <span class="inblock ltr">{{$user->reputation}}</span>
			</p>
			<p class="created">
				<i class="icon-calendar"></i> سجّل: {{$user->getCreationDateDiffForHumans()}}
			</p>
		</div>
		<div class="clear">
		</div>
	</div>
	<div id="content_nav">
		<ul>
<!--			<li class="{{Request::segment('3') == null ? 'active': false}}"><a href="{{route('user-index',['username'=>$user->username])}}">
			@if($isSelf)
			مجتمعات أتابعها
			@else
			مجتمعات يتابعها
			@endif
			</a></li>-->
			<li  class="{{Request::segment('3') == 'posts' || Request::segment('3') == null? 'active': false}}"><a href="{{route('user-posts',['username'=>$user->username])}}">المساهمات</a></li>
			<li  class="{{Request::segment('3') == 'comments' ? 'active': false}}"><a href="{{route('user-comments',['username'=>$user->username])}}">التعليقات</a></li>
<!--			<li><a href="/u/hichem/favorites">المفضّلة</a></li>-->
<!--			<li><a href="/u/hichem/ask">اسألني!</a></li>-->
                        
                        @if($isSelf)
                        <li class="{{Request::segment('3') == 'settings' ? 'active': false}}"><a href="{{route('user-settings',['username'=>$user->username])}}">الملف الشخصي</a></li>
                        @endif
		</ul>
		<div class="clear">
		</div>
	</div>
	{{$lists}}
</div>
<input id="current_user_id" value="{{$user->id}}" type="hidden">

@stop
