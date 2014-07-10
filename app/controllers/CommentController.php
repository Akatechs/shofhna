<?php

/**
 * Description of CommentController
 *
 * @author Hichem MHAMED
 */
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use ArabiaIOClone\Repositories\CommentRepositoryInterface;

class CommentController extends BaseController
{
    
    
    
    
    public function postEdit($commentId)
    {
        if(!Auth::check())
        {
            return  Redirect::back()
                    ->withInput()
                    ->withErrors(array(Lang::get('errors.comment_auth')));
        }
        
        
        
        $form = $this->comments->getPostSubmitForm();
        if(!$form->isValid())
        {
            return Redirect::back()
                    ->withInput()
                    ->withErrors($form->getErrors());
        }
        
        $comment = $this->comments->findById($commentId);
        
        if(Auth::user()->id != $comment->user()->id)
        {
            return Redirect::back()
                    ->withInput()
                    ->withErrors(Lang::get('errors.comment_submit'));
        }
        
        $data = $form->getInputData();
        
        $comment = $this->comments->edit($comment,$data);

        if($comment)
        {
            return Redirect::back()
                ->with('success',[Lang::get('success.comment_submit')]);
        }else
        {
            return Redirect::back()
                    ->withInput()
                    ->withErrors(Lang::get('errors.comment_submit'));
        }
        
        
    }


    public function postSubmit($postId)
    {
        if(!Auth::check())
        {
            return  Redirect::back()
                    ->withInput()
                    ->withErrors(array(Lang::get('errors.comment_auth')));
        }
        
        if (Auth::user()->reputation < Config::get("user.enoughKarmaToComment"))
        {
            return  Redirect::back()
                    ->withInput()
                    ->withErrors(array(Lang::get('errors.comment_not_enough_reputation')));
        }
        
        $form = $this->comments->getPostSubmitForm();
        if(!$form->isValid())
        {
            return Redirect::back()
                    ->withInput()
                    ->withErrors($form->getErrors());
        }
        
        $data = $form->getInputData();
        $parentId = $data['parent_id'];
        $data['user_id'] = Auth::user()->id;
        $data['post_id'] = $postId;

        $comment = $this->comments->create($data,$parentId);

        if($comment)
        {
            return Redirect::back()
                ->with('success',[Lang::get('success.comment_submit')]);
        }else
        {
            return Redirect::back()
                    ->withInput()
                    ->withErrors(Lang::get('errors.comment_submit'));
        }
    }
}

?>
