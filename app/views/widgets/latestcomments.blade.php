@if ($latestComments->count())
<div id="latest_comments" class="widget sidebar_menu">
    <h3>آخر التعليقات</h3>
    <ul>
            @foreach($latestComments as $latestComment)
                @include('partials.post.comment.listitem_latestcomments')
            @endforeach
    </ul>
</div>
@endif