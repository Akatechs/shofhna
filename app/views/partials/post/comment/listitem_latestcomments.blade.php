<li id="latest_comment-{{$latestComment->id}}" class="latest_comment">
<!--    <a href="/u/abszar">
        <img src="https://secure.gravatar.com/avatar/5a9733887382a2e24b4ab855295abb86?s=32&d=mm" width="32" height="32" align="right"/>
    </a>-->
    <span class="comment_content">
        <span class="comment_user">
            <a href="{{$latestComment->getRouteToUser()}}">{{$latestComment->user()->username}}:</a>&nbsp;
        </span>
        <a href="{{$latestComment->getLinkToComment()}}">{{$latestComment->getShortContent()}}</a>
    </span>
</li>

