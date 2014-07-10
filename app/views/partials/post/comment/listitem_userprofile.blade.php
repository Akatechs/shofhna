<div id="comment-{{$comment->id}}" class="comment">
    <div class="comment_title">
        <h2><a href="{{$comment->getLinkToComment()}}">{{{Str::limit( $comment->content,100)}}}</a></h2>
    </div>
    <div class="comment_meta">على <a class="comment_post" href="{{$comment->getRouteToPost()}}">{{$comment->post()->title}}</a> في <a class="post_category" href="{{$comment->getRouteToCommunity()}}">{{$comment->post()->community()->name}}</a> 
        <span
        class="comment_date">{{$comment->getCreationDateDiffForHumans()}}</span>| <span class="post_comments"><a href="{{$comment->getRouteToPost()}}">{{$comment->getPostCommentsCountLiteral()}}</a></span>
    </div>
    <div class="clear"></div>
</div>