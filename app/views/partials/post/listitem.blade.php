<div id="{{$post->getDivId()}}" class="post">
	<div class="post_vote">
		<div class="post_upvote">
			<a id="post_upvote-{{$post->id}}" href="#" class="upvote_btn"><i class="fa fa-angle-up"></i></a>
		</div>
		<div class="post_points ltr">
			 {{$post->sumvotes}}
		</div>
		<div class="post_downvote ">
			<a id="post_downvote-{{$post->id}}" href="#" class="downvote_btn"><i class="fa fa-angle-down"></i></a>
		</div>
	</div>
        @if($post->getIsMediaLink())
	<div style="overflow: hidden; padding: 0px; /*width: 50px; height: 50px;*/" class="post_image nailthumb-container square-thumb-s">
            <a href="#" rel="nofollow">
                <img class="nailthumb-image" style="position: relative; /*width: 88.75px;*/ height: 50px; top: 0px; /*left: -19.375px;*/ display: inline;" src="{{$post->getMediaThumbnailUrl()}}">
            </a>
	</div>
        @endif
	<div class="post_title">
		<h2>
                    {{$post->getTitleHTMLTag()}}
                    
                    
                </h2>
        
	</div>
        
	<div class="post_meta">
           @if($post->getIsMediaLink())
                {{$post->getMediaShowInplaceButton()}}
            @endif
            
		 نشر في <a class="post_category" href="{{$post->getRouteToCommunity()}}">{{$post->community()->name}}</a> بواسطة <a class="post_user" href="{{route('user-index',array('username'=>$post->user()->username))}}"> {{$post->user()->username}} </a><span class="post_date">{{$post->getCreationDateDiffForHumans()}}</span> | <span class="post_favorite" id="fp-5154"><a class="remove_favorite hidden" href="#"><i class="icon-star"></i> أزل من المفضّلة</a><a class="add_favorite " href="#">أضف الى المفضّلة</a></span> | <span class="post_comments"><a href="{{$post->getRouteToPost()}}" class="strong">{{$post->getCommentsCountLiteral()}}</a></span>
	</div>
<!--        <br>-->
        <div id="player_container-{{$post->id}}" style="display:none"></div>
        
</div>