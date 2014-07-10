<?php

/**
 * Description of VoteController
 *
 * @author Hichem MHAMED
 */
use ArabiaIOClone\Repositories\UserRepositoryInterface;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use ArabiaIOClone\Repositories\VoteRepositoryInterface;
use ArabiaIOClone\Repositories\CommentRepositoryInterface;



class VoteController  extends BaseController
{
    
    protected function __init()
    {
        parent::__init();
        $this->user = Auth::user();
    }
    
    
    public function postUpvoteComment($commentId)
    {
        if (Request::ajax())
        {
            if(!Auth::check())
            {
                return Response::json(['msg'=>Lang::get('errors.vote_auth')]);
            }
            
            $comment = $this->comments->findById($commentId);
            
            if($this->user->id == $comment->user()->id)
            {
                return Response::json(['msg'=>Lang::get('errors.vote_owner')]);
            }
            
//            if (Auth::user()->reputation < Config::get("user.enoughKarmaToVoteDown"))
//            {
//                return Response::json(['msg'=>Lang::get('errors.vote_not_enough_reputation')]);
//            }
            
            return Response::json(['points' => $this->votes->tryUpvoteComment($comment,$this->user)]);
            
            
        }
        
        return App::abort(404);
    }
    
    public function postDownvoteComment($commentId)
    {
        if (Request::ajax())
        {
            if(!Auth::check())
            {
                return Response::json(['msg'=>Lang::get('errors.vote_auth')]);
            }
            
            $comment = $this->comments->findById($commentId);
            
            if($this->user->id == $comment->user()->id)
            {
                return Response::json(['msg'=>Lang::get('errors.vote_owner')]);
            }
            
            if (Auth::user()->reputation < $this->config->get('config.user.enoughKarmaToVoteDown'))
            {
                return Response::json(['msg'=>Lang::get('errors.vote_not_enough_reputation')]);
            }
            
            return Response::json(['points' => $this->votes->tryDownvoteComment($comment,$this->user)]);
            
            
        }
        
        return App::abort(404);
    }
    
    
    public function postUpvotePost($postId)
    {
        if (Request::ajax())
        {
            if(!Auth::check())
            {
                return Response::json(['msg'=>Lang::get('errors.vote_auth')]);
            }
            
            $post = $this->posts->findById($postId);
            
            if($this->user->id == $post->user()->id)
            {
                return Response::json(['msg'=>Lang::get('errors.vote_owner')]);
            }
            
//            if (Auth::user()->reputation < Config::get("user.enoughKarmaToVoteDown"))
//            {
//                return Response::json(['msg'=>Lang::get('errors.vote_not_enough_reputation')]);
//            }
            
            return Response::json(['points' => $this->votes->tryUpvotePost($post,$this->user)]);
            
            
        }
        
        return App::abort(404);
    }
    
    public function postDownvotePost($postId)
    {
        if (Request::ajax())
        {
            if(!Auth::check())
            {
                return Response::json(['msg'=>Lang::get('errors.vote_auth')]);
            }
            
            $post = $this->posts->findById($postId);
            
            if($this->user->id == $post->user()->id)
            {
                return Response::json(['msg'=>Lang::get('errors.vote_owner')]);
            }
            
            if (Auth::user()->reputation < $this->config->get('config.user.enoughKarmaToVoteDown'))
            {
                return Response::json(['msg'=>Lang::get('errors.vote_not_enough_reputation')]);
            }
            
            return Response::json(['points' => $this->votes->tryDownvotePost($post,$this->user)]);
            
            
        }
        
        return App::abort(404);
    }
}

?>
