<?php

namespace ArabiaIOClone\Providers;

use ArabiaIOClone\Observers\CommentObserver;
use ArabiaIOClone\Observers\CommunityObserver;
use ArabiaIOClone\Observers\PostObserver;
use ArabiaIOClone\Observers\UserObserver;
use ArabiaIOClone\Observers\VoteObserver;
use Comment;
use Community;
use Illuminate\Support\ServiceProvider;
use Post;
use User;
use Vote;

/**
 * Description of ObserverServiceProvider
 *
 * @author Hichem MHAMED
 */
class ObserverServiceProvider  extends ServiceProvider
{
    
    public function boot()
    {
        Vote::observe(new VoteObserver(
                app('ArabiaIOClone\Repositories\UserRepositoryInterface'),
                app('ArabiaIOClone\Repositories\CommentRepositoryInterface'),
                app('ArabiaIOClone\Repositories\PostRepositoryInterface')
                ));
        
        Comment::observe(new CommentObserver(
                app('ArabiaIOClone\Repositories\UserRepositoryInterface'),
                app('ArabiaIOClone\Repositories\CommentRepositoryInterface'),
                app('ArabiaIOClone\Repositories\PostRepositoryInterface'),
                app('ArabiaIOClone\Repositories\NotificationRepositoryInterface')
                ));
        
        Community::observe(new CommunityObserver(
                app('ArabiaIOClone\Repositories\UserRepositoryInterface'),
                app('ArabiaIOClone\Repositories\CommunityRepositoryInterface')
                ));
        
        User::observe(new UserObserver(
                app('ArabiaIOClone\Repositories\UserRepositoryInterface'),
                app('ArabiaIOClone\Repositories\CommunityRepositoryInterface')
                ));
        
        Post::observe(new PostObserver(
                app('ArabiaIOClone\Repositories\CommunityRepositoryInterface'),
                app('ArabiaIOClone\Repositories\PostRepositoryInterface'),
               app('ArabiaIOClone\Repositories\NotificationRepositoryInterface')
                ));
        
        
    }
    
    public function register()
    {
        
    }
}

?>
