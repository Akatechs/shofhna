<div id="post_sidebar" class="sidebar">
	<!-- partial post votes -->
	<div id="sidebar_post_votes" class="widget">
		<div class="post_vote">
			<div class="post_upvote">
				<a id="post_upvote-{{$post->id}}" href="#" class="upvote_btn"><i class="fa fa-angle-up"></i></a>
			</div>
			<div class="post_points ltr">
				{{$post->sumvotes}}
			</div>
			<div class="post_downvote">
				<a id="post_downvote-{{$post->id}}" href="#" class="downvote_btn"><i class="fa fa-angle-down"></i></a>
			</div>
		</div>
		<div id="sidebar_votes_count">
			<div class="s_upvotes">
				{{$post->getPositiveVoteSum()}} نقطة ايجابية
			</div>
			<div class="s_downvotes">
				{{$post->getNegativeVoteSum()}} نقطة سلبية
			</div>
		</div>
	</div>
	<!-- end partial post votes -->
	<div class="clear">
	</div>
	<!-- partial post meta -->
	<div id="post_meta" class="widget sidebar_menu">
		<ul>
			<li><i class="{{$config->get('config.icons.createdat')}}"></i>{{$post->getCreationDateDiffForHumans()}}</li>
			<li><i class="{{$config->get('config.icons.user')}}"></i>
                            <a href="{{route('user-index',['username'=>$post->user()->username])}}"><span class="inblock username">{{ $post->user()->username }}</span>
                                @if($post->user()->fullname)
                                <span class="inblock full_name">({{$post->user()->fullname}})</span>
                                @endif
                            </a></li>
			<li><span class="block"><i class="{{$config->get('config.icons.communities_sidebar')}}"></i><a href="{{$post->getRouteToCommunity()}}">{{$post->community()->name}}</a></span></li>
			@if(Auth::check())
                        <li id="fp-{{$post->id}}"><i class="{{$config->get('config.icons.favorites')}}"></i>
                            <a href="#" class="add_favorite {{$post->getCanAddToFavorites(Auth::user())}}">أضف الى المفضّلة</a>
                            <a href="#" class="remove_favorite {{$post->getCanRemoveFromFavorites(Auth::user())}}">أزل من المفضّلة</a>
                        </li>
                        
			<li>
                            <i class="{{$config->get('config.icons.report')}}"></i> 
                            <a class="post_report_spam" href="#">أبلغ عن مخالفة</a>
                        </li>
                        @endif
                        <li><i class="{{$config->get('config.icons.views')}}"></i> عدد المشاهدات {{$post->views}}</li>
                        @if($post->canEdit())
                            <i class="{{$config->get('config.icons.editPost')}}"></i> 
                            <a  href="{{$post->getEditRoute()}}"> تعديل</a>
                        @endif
<!--			<li><a href="/topic/%D9%86%D8%B5%D8%A7%D8%A6%D8%AD" class="topic"><i class="icon-tag"></i> نصائح</a><a href="/topic/%D9%86%D8%B5%D9%8A%D8%AD%D8%A9" class="topic"><i class="icon-tag"></i> نصيحة</a><a href="/topic/%D9%86%D8%B5%D8%A7%D8%A6%D8%AD-%D8%AA%D9%82%D9%86%D9%8A%D8%A9" class="topic"><i class="icon-tag"></i> نصائح-تقنية</a></li>-->
		</ul>
	</div>
	<!-- end partial post meta -->
	<div class="clear">
		<br>
	</div>
	<!-- partial post share button -->
	<!--<div id="share_post_btns" class="widget">
		<h3>شارك الموضوع. شكراً!</h3>
		<div class="tcenter">
			<span st_processed="yes" class="st_facebook_vcount" st_url="https://arabia.io/go/5153" displaytext="Facebook"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;">
			<div>
				<div style="display: block;" class="stBubble">
					<div class="stBubble_count">
						0
					</div>
				</div>
				<span style="background-image: url(&quot;https://ws.sharethis.com/images/facebook_counter.png&quot;);" class="stMainServices st-facebook-counter">&nbsp;<img style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;" src="https://ws.sharethis.com/images/check-big.png"></span>
			</div>
			</span></span><span st_processed="yes" class="st_twitter_vcount" st_url="https://arabia.io/go/5153" displaytext="Tweet" st_via="ArabiaIO" st_username="ArabiaIO"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;">
			<div>
				<div style="display: block;" class="stBubble">
					<div class="stBubble_count">
						2
					</div>
				</div>
				<span style="background-image: url(&quot;https://ws.sharethis.com/images/twitter_counter.png&quot;);" class="stMainServices st-twitter-counter">&nbsp;<img style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;" src="https://ws.sharethis.com/images/check-big.png"></span>
			</div>
			</span></span><span st_processed="yes" class="st_linkedin_vcount" st_url="https://arabia.io/go/5153" displaytext="LinkedIn"><span class="stButton" style="text-decoration:none;color:#000000;display:inline-block;cursor:pointer;">
			<div>
				<div style="display: block;" class="stBubble">
					<div class="stBubble_count">
						0
					</div>
				</div>
				<span style="background-image: url(&quot;https://ws.sharethis.com/images/linkedin_counter.png&quot;);" class="stMainServices st-linkedin-counter">&nbsp;<img style="position: absolute; top: -7px; right: -7px; width: 19px; height: 19px; max-width: 19px; max-height: 19px; display: none;" src="https://ws.sharethis.com/images/check-big.png"></span>
			</div>
			</span></span>
		</div>
	</div>-->
	<!-- end partial post share button -->
	<div class="clear">
	</div>
        <div id="short_link" class="widget"><h3 class="no_underline">رابط مختصر</h3><input value="{{$post->getShortLink()}}" class="short_url inputtext" readonly="readonly" type="text"></div>
	<!-- partial short link-->
<!--	<div id="short_link" class="widget">
		<input value="https://arabia.io/go/5153" class="short_url inputtext" readonly="readonly" type="text">
	</div>
	 end partial short link
	<div class="clear">
	</div>-->
</div>