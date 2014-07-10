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