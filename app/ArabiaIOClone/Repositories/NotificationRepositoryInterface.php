<?php


/**
 * Description of NotificationRepositoryInterface
 *
 * @author mhamed
 */
namespace ArabiaIOClone\Repositories;



interface NotificationRepositoryInterface 
{
    public function findByUser($user, $perPage);
    
    
    public function create(array $data);
    public function createCommentOnCommentNotification( $comment);
    public function createCommentOnPostNotification($comment);
    public function createNotificationForPostSubscribers($subscriberId,$postId, $comment);
    public function createPostCommunityModified($post, $oldCommunity, $newCommunity);
    public function findUnreadNotificationsCount($user);
    public function updateRead($notification, $value);
    
}
