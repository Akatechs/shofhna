<?php



namespace ArabiaIOClone\Observers;

use ArabiaIOClone\Repositories\CommunityRepositoryInterface;
use ArabiaIOClone\Repositories\NotificationRepositoryInterface;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use ArabiaIOClone\Repositories\UserRepositoryInterface;
/**
 * Description of PostObserver
 *
 * @author mhamed
 */
class PostObserver extends AbstractObserver
{
    
    protected $posts;
    protected $communities;
    protected $notifications;
    
    public function __construct(
                               
                                CommunityRepositoryInterface $communities,   
                                PostRepositoryInterface $posts,
                                NotificationRepositoryInterface $notifications
                                ) 
    {
        
        $this->posts = $posts;
        $this->communities = $communities;
        $this->notifications = $notifications;
    }
    
    public function saving( $post)
    {
        $dirty = $post->getDirty();
        if(array_key_exists('community_id',$dirty))
        {
            $oldCommunity = $this->communities->findById($post->getOriginal('community_id'));
            if($oldCommunity)
            {
                // means the post was modified and not created
                $newCommunity = $this->communities->findById($dirty['community_id']);
                if($newCommunity != $oldCommunity)
                {
                  $this->notifications->createPostCommunityModified($post, $oldCommunity, $newCommunity);  
                }
                
            }
            
        }
        return true;
    }
}
