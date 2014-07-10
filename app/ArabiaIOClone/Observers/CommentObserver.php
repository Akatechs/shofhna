<?php
/**
 * Description of CommentObserver
 *
 * @author mhamed
 */

namespace ArabiaIOClone\Observers;

use ArabiaIOClone\Repositories\CommentRepositoryInterface;
use ArabiaIOClone\Repositories\NotificationRepositoryInterface;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use ArabiaIOClone\Repositories\UserRepositoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;



class CommentObserver extends AbstractObserver 
{
    
    protected $users;
    protected $posts;
    protected $comments;
    protected $notifications;
    
    public function __construct(
                                UserRepositoryInterface $users,
                                CommentRepositoryInterface $comments,    
                                PostRepositoryInterface $posts,
                                NotificationRepositoryInterface $notifications
                                ) 
    {
        $this->users = $users;
        $this->posts = $posts;
        $this->comments = $comments;
        $this->notifications = $notifications;
        
        if(!Event::hasListeners('ArabiaIO.Events.CommentOnComment'))
        Event::listen('ArabiaIO.Events.CommentOnComment', function($comment){
            $this->commentOnCommentHandler($comment);
        });
        
        if(!Event::hasListeners('ArabiaIO.Events.CommentOnPost'))
        Event::listen('ArabiaIO.Events.CommentOnPost', function($comment){
            $this->commentOnPostHandler($comment);
        });
        
        
    }
    
    public function commentOnCommentHandler($comment)
    {
        
        if($comment->user_id != $comment->parent()->get()->first()->user_id)
        {
            $this->notifications->createCommentOnCommentNotification($comment);
            $this->createNotificationsForPostSubscribers($comment->post_id,$comment);
        }
    }
    
    public function createNotificationsForPostSubscribers($postId, $comment)
    {
        $subscribers = $this->users->findByFavoritePost($postId);
        foreach ($subscribers as $user)
        {
            $this->notifications->createNotificationForPostSubscribers($user->id, $postId,$comment);
        }
    }
    
    public function commentOnPostHandler($comment) 
    {   
        
        
        if ($comment->user_id != $comment->post()->user_id)
        {
            $this->notifications->createCommentOnPostNotification($comment);
            $this->createNotificationsForPostSubscribers($comment->post_id, $comment);
        }
    }          
}
