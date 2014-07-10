@extends('layouts.main')
@section('title',"نتائج البحث ")
@section('content')
<div id="search" class="page_sidebar">
    <div id="content_nav">
        <h2 id="nav_title">نتائج البحث: {{$term}}</h2>
        <div class="clear"></div>
    </div>
    <div id="posts">
        @foreach($posts as $post)
            @include('partials.post.listitem',compact('post'))
        @endforeach
    </div>
    <div class="clear">
        <br>
    </div>
    <div id="more_content">
        {{$posts->appends(array('keyword' => $term))->links()}}
    </div>
</div>

@stop

