<li id="category-{{$community->id}}" class="category">
    <span class="category_title">
        <a href="{{$community->getRouteToCommunity()}}">{{$community->name}}</a>
    </span>
    <span class="followers_count"><i class="fa fa-user"></i> {{$community->getSubscribersCount()}}</span>
    <span class="posts_count"><i class="fa fa-comments"></i> {{$community->getPostsCount()}}</span>
    <span class="date"><i class="fa fa-clock-o"></i>{{$community->getLastActivityDiffForHumans()}}</span>
    @if(Auth::check())
    <span class="actions">
        <a href="#" id="category-{{$community->id}}" class="category_follow_btn {{$community->getCanSubscribe(Auth::user())}}">
            <i class="fa fa-thumbs-up"></i> تابع المجتمع</a>
        <a href="#" id="category-{{$community->id}}" class="category_unfollow_btn {{$community->getCanUnsubscribe(Auth::user())}}">
            <i class="fa fa-thumbs-down"></i>
            الغاء المتابعة
        </a>
    </span>
    @endif
</li>

