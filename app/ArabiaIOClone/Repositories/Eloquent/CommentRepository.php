<?php

namespace ArabiaIOClone\Repositories\Eloquent;

use ArabiaIOClone\Repositories\CommentRepositoryInterface;
use ArabiaIOClone\Repositories\Eloquent\AbstractRepository;
use Comment;

use Illuminate\Support\Facades\Event;


/**
 * Description of CommentRepository
 *
 * @author Hichem MHAMED
 */
class CommentRepository extends AbstractRepository implements CommentRepositoryInterface 
{
    
    
    public function __construct(Comment $comment) 
    {
        parent::__construct($comment);
        $this->model =$comment;
        
    }
    
    public function findLatestComments($take = 10)
    {
        return $this->model->orderBy('created_at','desc')
                ->with('users')
                ->take($take)
                ->get();
        
    }
    
    public function findLatestCommentsByCommunity($community, $take = 10)
    {
        return $this->model->orderBy('comments.created_at','desc')
                ->join('posts','posts.id','=','comments.post_id')
                ->join('communities','communities.id','=','posts.community_id')
                ->where('communities.id','=',$community->id)
                //->with('users')
                ->take($take)
                ->get(['comments.*']);
    }
    
    public function findById($commentId)
    {
        return Comment::findOrFail($commentId);
        
    }
    
    public function findByUser($user,$perPage = 15)
    {
        return $this->model
                ->where('user_id','=',$user->id)
                ->orderBy('created_at','desc')
                ->paginate($perPage);     
    }
    
    public function findByUserWithEagerLoading($user,$perPage = 15)
    {
        return $this->model
                ->where('user_id','=',$user->id)
                ->with('posts')
                ->with('posts.communities')
                ->with('users')
                ->orderBy('created_at','desc')
                ->paginate($perPage);   
    }
    
    public function getPostSubmitForm() 
    {
        return  app('ArabiaIOClone\Services\Forms\CommentSubmitForm');
    }
    
    public function edit($comment,$data)
    {
        
        $comment->content = e($data['comment_content']);
        $comment->save();
        return $comment;
    }
    
    public function create($data,$parentId=null)
    {
        
        $comment =  Comment::create(array(
                'content' => e($data['comment_content']),
                'user_id' => $data['user_id'],
                'post_id' => $data['post_id']
                
            ));
        if ($parentId)
        {
            $parentComment = Comment::find($parentId);
            $comment->makeChildOf($parentComment);
            Event::fire('ArabiaIO.Events.CommentOnComment',[$comment]);
            
        }else
        {
            
            Event::fire('ArabiaIO.Events.CommentOnPost',[$comment]);
            
        }
        
        return $comment;
    }
    
    public function getSortedByPost($post)
    {
        $result = \Baum\Extensions\Eloquent\Collection::make(array());
            
        // we use post to make use of eager loading done while retrieving the $post record
        $comments = $post->comments()
                ->where('depth', '=', 0)
                ->get();

        $comments = $this->sortNodes($comments);
        foreach($comments as $node)
        {

            $tree = $this->getHierarchy($node);

            $result = $result->merge($tree);
        }
        return $result;
    }
    
    protected function sortNodes($nodesCollection)
    {
         return $nodesCollection->sortBy(function($comment)
        {
          return -$comment->sumvotes.$comment->created_at;
        });
    }
    
    protected function getHierarchy($node)
    {
        $result = \Baum\Extensions\Eloquent\Collection::make(array());
        $result->push($node);
        $children = $node->children()->get();
        $this->sortNodes($children);
        if($children->count())
        {
            foreach($children as $child)
            {
                $result = $result->merge($this->getHierarchy($child));
            }   
        }
        return $result;
    }
    
    public function updateVoteSum($comment)
    {
        $comment->sumvotes = $comment->votes()->sum('vote');
        $comment->save();
    }
}

?>
