<?php

/**
 * Description of VoteObserver
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Observers;
use \Vote;
use \ArabiaIOClone\Repositories\UserRepositoryInterface;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use ArabiaIOClone\Repositories\CommentRepositoryInterface;

class VoteObserver extends AbstractObserver
{
    protected $users;
    protected $posts;
    protected $comments;
    
    public function __construct(
            UserRepositoryInterface $users,
            CommentRepositoryInterface $comments,    
            PostRepositoryInterface $posts
            
            ) 
    {
        $this->users = $users;
        $this->posts = $posts;
        $this->comments = $comments;
    }
    
    protected function updateUserReputation( $vote)
    {
        $user = $vote->target()->first()->user();
        $this->users->updateReputation($user);
    }
    
    protected function updateTargetVoteSum( $vote)
    {
        $target = $vote->target()->first();
        if($vote->target_type == 'Post')
        {
            $this->posts->updateVoteSum($target);
        }elseif ($vote->target_type == 'Comment') {
            $this->comments->updateVoteSum($target);
        }
        
    }
    
    public function updated( $vote) {
        parent::updated($vote);
        
        $this->updateTargetVoteSum($vote);
        $this->updateUserReputation($vote);

    }
    
    public function saved( $vote) {
        parent::saved($vote);
        
        $this->updateTargetVoteSum($vote);
        $this->updateUserReputation($vote);

    }
    
    public function created( $vote) {
        parent::created($vote);

        $this->updateTargetVoteSum($vote);
        $this->updateUserReputation($vote);

    }
}

?>
