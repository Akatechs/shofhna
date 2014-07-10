<div id="post" class="page_sidebar">
	<!-- section post vote title-->
<!--	<div id="post_vote_title" class="post_vote">
		<div class="post_upvote">
			<a id="title_post_upvote-5148" href="#" class="upvote_btn"><i class="fa fa-angle-up"></i></a>
		</div>
		<div class="post_points ltr">
			{{$post->sumvotes}}
		</div>
		<div class="post_downvote">
			<a id="title_post_upvote-5148" href="#" class="downvote_btn"><i class="fa fa-angle-down"></i></a>
		</div>
	</div>-->
	<!-- end section post vote title-->
	<div id="content_nav">
		<h2 id="nav_title">
                    <a href="{{$post->getRouteToPost()}}" 
                       title="{{$post->title}}">{{$post->title}}
                    </a>
                </h2>
		
                <div class="clear">
		</div>
	</div>
<!--	<div id="post_meta_title">
		<ul>
			<li><i class="fa fa-clock-o"></i>$post->getCreationDateDiffForHumans()</li>
			<li><i class="icon-user"></i><a href="/u/thamood">thamood</a></li>
			<li><i class="icon-reorder"></i><a href="/programming">برمجة عامة</a></li>
			<li id="title_fp-5148"><i class="icon-star"></i><a href="#" class="add_favorite ">أضف الى المفضّلة</a><a href="#" class="remove_favorite hidden">أزل من المفضّلة</a></li>
		</ul>
		<div class="clear">
		</div>
	</div>-->
@if($post->getIsMediaLink())
<div class="clear">
    <br><br>
</div>
<div>
    {{$post->getMediaEmbedHtml()}}
</div>
@endif
<div class="clear">
    <br>
</div>

	<!--section post content -->
	<div id="post-{{$post->id}}" class="post_content replace_urls">
	{{$post->getMarkDownContent()}}
	</div>
	<!--end section post content -->
	<div class="clear">
		<br>
	</div>
        <input type="hidden" id="post_id" value="{{$post->id}}" />
	<!-- partial add comment -->
	<div id="add_comment">
            {{ Form::open(array(
                'route'=>array('comment-submit',$post->id,null)
                )) }}
    
                <p>
                {{ Form::textarea('comment_content', null, array( 'id'=>'comment_content','class'=>'largearea largearea_tall fullwidth')) }}
                </p>
                <div class="clear"></div>
                <p>
                {{ Form::submit('أضف التعليق', array('class'=>'largebutton'))}}
                </p>
                <input type="hidden" value="" name="parent_id"></input>
            {{ Form::close() }}
<!--            <form action="/programming/5148-%D8%A7%D9%84%D8%A8%D8%B1%D9%85%D8%AC%D8%A9-%D9%84%D9%8A%D8%B3%D8%AA-%D9%84%D9%84%D8%AC%D9%85%D9%8A%D8%B9" method="post" class="comment_form">
                <p>
                    <textarea id="comment_content" name="comment_content" class="largearea largearea_tall fullwidth"></textarea>
                </p>
                <div class="clear">
                </div>

                <p>
                        <input class="largebutton" value="أضف التعليق" type="submit">
                </p>
            </form>-->
	</div>
        
	<!-- end partial add comment -->
	<div class="clear">
		<br>
	</div>
        @if(!Auth::check())
            @include('widgets.login')
        @endif
	<div class="clear">
	</div>
	<!-- begin comments  see post.singleview.comments-->
        @include('partials.post.comment.listview')
	<!-- end comment -->
        
        <div class="clear">
            <br>
	</div>
        @if($relatedPosts->count())
            <div id="relatedPosts" >
                <h2 id="related_posts_title" >مواضيع ذات صلة</h2>
                @foreach($relatedPosts as $relatedPost)    
                    @include('partials.post.listitem',['post'=>$relatedPost])
                @endforeach
            </div>
        @endif
</div>
