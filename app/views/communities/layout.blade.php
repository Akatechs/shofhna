@extends('layouts.main')
@section('content')
<div id="communities">
    <div class="content_nav">
        <h2 class="nav_title">المجتمعات</h2>
        <ul>
            @if(Auth::check())
            <li class="{{Request::segment('3') == null ? 'active': false}}"><a href="{{route('communities-browse')}}">مجتمعات تتابعها</a>
            </li>
            <li class="{{Request::segment('3') == 'active' ? 'active': false}}"><a href="{{route('communities-browse-active')}}">الأكثر نشاطاً</a>
            </li>
            @else
            <li class="{{Request::segment('3') == 'active' || Request::segment('3') == null ? 'active': false}}"><a href="{{route('communities-browse-active')}}">الأكثر نشاطاً</a>
            </li>
            @endif
            
            <li class="{{Request::segment('3') == 'recent' ? 'active': false}}"><a href="{{route('communities-browse-recent')}}">الأحدث</a>
            </li>
        </ul>
        
        @if(Auth::check())
        <ul class="left"><li class="{{Request::segment('2') == 'create' ? 'active': false}}"><a href="{{route('communities-create')}}">أنشئ مجتمعاً جديداً</a></li></ul>
        @endif
        <div class="clear"></div>
    </div>
    <div id="page_content">
        @yield('pageContent')
        
        
    </div>
    <div class="clear">
		<br/>
	</div>
	<div id="more_content">
        @if(isset($communities))    
            {{$communities->links()}}
        @endif
	</div>
</div>
@stop

