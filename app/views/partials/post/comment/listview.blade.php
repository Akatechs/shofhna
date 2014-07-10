<div id="post_comments">
@foreach($comments as $comment)
    @include('partials.post.comment.listitem',compact('comment'))
@endforeach
</div>
