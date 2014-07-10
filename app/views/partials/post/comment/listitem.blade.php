<div style="width: {{$comment->getNestedWidth()}}px;" id="comment-{{$comment->id}}" class="post_comment index{{$comment->getLevel()}} {{$comment->subcomment()}}">
	<div class="comment_wrapper">
		<div class="comment_vote">
			<div class="comment_upvote">
				<a id="comment_upvote-{{$comment->id}}" href="#" class="comment_upvote_btn"><i class="fa fa-angle-up"></i></a>
			</div>
			<div class="comment_points ltr">
				{{$comment->sumvotes}}
			</div>
			<div class="comment_downvote ">
				<a id="comment_downvote-{{$comment->id}}" href="#" class="comment_downvote_btn"><i class="fa fa-angle-down"></i></a>
			</div>
		</div>
<!--		<a href="{{route('user-index',array('username'=>$post->user()->username))}}"><img class="comment_user_image" src="https://secure.gravatar.com/avatar/b5dfe5d85f1215cc65655d23332f996a?s=26&amp;d=mm" height="26" align="right" width="26"></a>-->
		<div class="comment_meta">
			<span class="comment_user">
                            <a href="{{route('user-index',array('username'=>$comment->user()->username))}}">{{$comment->user()->username}}</a>
                        </span>
                    <span class="comment_date">{{$comment->getCreationDateDiffForHumans()}}</span>
                    @if(Auth::check())
                        @if($comment->canEdit())
                    <span class="comment_edit"> 
                        <a href="#" class="comment_edit_btn"><i class="fa fa-edit"></i> تعديل التعليق </a>
                        <a href="#" class="comment_unedit_btn hidden"><i class="fa fa-times"></i> إلغاء التعديل </a>
                    </span>
                        @endif
                    @endif
                    <span class="comment_reply">
                        <a href="#" class="comment_reply_btn"><i class="fa fa-reply"></i> اكتب رد</a>
                        <a href="#" class="comment_unreply_btn hidden"><i class="fa fa-times"></i> الغاء الرد</a>
                    </span>
                    @if(Auth::check())
                    <span class="comment_reply">
                        <a href="#" class="comment_report_spam"><i class="fa fa-ban">&nbsp;</i>أبلغ عن مخالفة </a>
                    </span>
                    @endif
                    <span class="comment_short_url"><a href="{{$comment->getRouteToComment()}}"><i class="fa fa-link"></i> رابط التعليق</a></span>
                    
<!--                    <span class="comment_share hidden"><a href="https://twitter.com/share?text=%D9%85%D9%85%D9%83%D9%86+%D8%AA%D8%B3%D8%AA%D8%AE%D8%AF%D9%85+%D8%A7%D9%84%D9%81%D9%84%D8%A7%D8%B4%D8%8C+%D9%85%D9%84%D9%81%D8%A7%D8%AA+swf+%D8%AA%D9%82%D8%AF%D8%B1+%D8%AA%D8%B4%D8%BA%D9%84%D9%87%D8%A7+%D8%B9%D9%84%D9%89+%D8%A7%D9%8A+%D9%86%D8%B8%D8%A7%D9%85+%D9%88%D8%B9%D9%84%D9%89+%D8%A7%D9%84%D9%88%D9%8A%D8%A8+%D8%A7%D9%8A%D8%B6%D8%A7+&amp;via=ArabiaIO&amp;url=https%3A%2F%2Farabia.io%2Fgo%2F5136%2F18524" target="_blank"><i class="icon-twitter"></i> تويتر</a></span><span class="comment_share hidden"><a href="https://www.facebook.com/sharer/sharer.php?u=https%3A%2F%2Farabia.io%2Fgo%2F5136%2F18524&amp;t=%D9%85%D9%85%D9%83%D9%86+%D8%AA%D8%B3%D8%AA%D8%AE%D8%AF%D9%85+%D8%A7%D9%84%D9%81%D9%84%D8%A7%D8%B4%D8%8C+%D9%85%D9%84%D9%81%D8%A7%D8%AA+swf+%D8%AA%D9%82%D8%AF%D8%B1+%D8%AA%D8%B4%D8%BA%D9%84%D9%87%D8%A7+%D8%B9%D9%84%D9%89+%D8%A7%D9%8A+%D9%86%D8%B8%D8%A7%D9%85+%D9%88%D8%B9%D9%84%D9%89+%D8%A7%D9%84%D9%88%D9%8A%D8%A8+%D8%A7%D9%8A%D8%B6%D8%A7+" target="_blank"><i class="icon-facebook"></i> فيسبوك</a></span><span class="comment_short_url hidden"><a href="https://arabia.io/go/5136/18524"><i class="icon-link"></i> رابط التعليق</a></span>-->
		</div>
		<div class="post_content comment_content replace_urls">
                    <p>{{$comment->content}}</p>
		</div>
		<div class="clear">
		</div>
	</div>
    
</div>