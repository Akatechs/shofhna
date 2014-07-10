<?php



namespace ArabiaIOClone\Repositories\Eloquent;

use ArabiaIOClone\Repositories\FlagRepositoryInterface;
use Flag;

/**
 * Description of FlagRepository
 *
 * @author mhamed
 */
class FlagRepository extends AbstractRepository implements FlagRepositoryInterface
{
    public function __construct(Flag $vote)
    {
        parent::__construct($vote);
        
    }

    public function reportCommentAsSpam($userId,$commentId)
    {
        
        $flagExist = $this->model
                ->where('user_id','=',$userId)
                ->where('target_id','=',$commentId)
                ->where('target_type','=','Comment')
                ->where('type','=','Spam')
                ->first();
        if ($flagExist)
        {
            return true;
        }else
        {
            return $this->model
                    ->create([
                        'user_id' => $userId,
                        'type' => 'Spam',
                        'target_type'=>'Comment',
                        'target_id'=>$commentId
                            ]);
            
        }
    }

    public function reportPostAsSpam($userId,$postId) 
    {
        $flagExist = $this->model
                ->where('user_id','=',$userId)
                ->where('target_id','=',$postId)
                ->where('target_type','=','Post')
                ->where('type','=','Spam')
                ->first();
        if ($flagExist)
        {
            return true;
        }else
        {
            return $this->model
                    ->create([
                        'user_id' => $userId,
                        'type' => 'Spam',
                        'target_type'=>'Post',
                        'target_id'=>$postId
                            ]);
            
        }
    }

}
