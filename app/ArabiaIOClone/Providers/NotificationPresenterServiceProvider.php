<?php

namespace ArabiaIOClone\Providers;
use Illuminate\Support\ServiceProvider;

/**
 * Description of NotificationPresenterServiceProvider
 *
 * @author mhamed
 */
class NotificationPresenterServiceProvider extends ServiceProvider 
{
    public function boot()
    {
        
    }
    
    public function register()
    {
        $this->app->bind(
                'ArabiaIOClone.Notification.CommentOnPost',
                'ArabiaIOClone\Presenters\Notifications\CommentOnPostNotificationPresenter'
                );
        
        $this->app->bind(
                'ArabiaIOClone.Notification.CommentOnComment',
                'ArabiaIOClone\Presenters\Notifications\CommentOnCommentNotificationPresenter'
                );
        
        $this->app->bind(
                'ArabiaIOClone.Notification.PostCommunityModified',
                'ArabiaIOClone\Presenters\Notifications\PostCommunityModifiedNotificationPresenter'
                );
        
        $this->app->bind(
                'ArabiaIOClone.Notification.FavoritePostUpdated',
                'ArabiaIOClone\Presenters\Notifications\PostSubscribersNotificationPresenter'
                );
        
       
    }
}
