<div id="category_follow" class="widget text">
    <h3>عدد المتابعين: {{$community->subscribers()->count()}}</h3>
<!--    <a href="http://notedn.com" target="_blank" rel="nofollow">
        <img src="/uploads/community_logos/30-01-14-9cace0db80.png" class="category_logo" alt="Notedn.com">
    </a>-->
<p class="category_description">{{$community->getMarkdownDescription()}}</p>
    @if(Auth::check())
        
        <a href="#" id="category_follow_btn" class="{{$community->getCanSubscribe(Auth::user()) }}"> <i class="fa fa-thumbs-up"></i> تابع هذا المجتمع</a>

        <a href="#" id="category_unfollow_btn" class="{{$community->getCanUnsubscribe(Auth::user()) }}">الغاء المتابعة</a>
        @if($community->canEdit())
        <br>
            <i class="{{$config->get('config.icons.editPost')}}"></i> 
            <a  href="{{$community->getEditRoute()}}"> تعديل المجتمع </a>
        @endif
    @endif
</div>