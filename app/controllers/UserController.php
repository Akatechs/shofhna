<?php
/**
 * Description of UserController
 *
 * @author Hichem MHAMED
 */

use ArabiaIOClone\Repositories\UserRepositoryInterface;
use ArabiaIOClone\Repositories\PostRepositoryInterface ;
use ArabiaIOClone\Repositories\CommentRepositoryInterface ;

class UserController extends BaseController 
{
  
    
    protected function __init()
    {
        parent::__init();
        $this->user = Auth::user();
    }
    
    public function  getComments($username)
    {
        $user = $this->users->findByUsername($username);
        if($user)
        {
            $isSelf = false;
            if(Auth::check())
            {
                $isSelf = $this->user->id == $user->id;
            }
            $comments = $this->comments->findByUserWithEagerLoading($user);
            return View::make('user.index')
                    ->with('lists',View::make('partials.user.comments')->with(compact('comments')))
                    ->with(compact('user'))
                    ->with('isSelf',$isSelf);
        } 
        return App::abort(404);
    }
    
    public function getPosts($username)
    {
        $user = $this->users->findByUsername($username);
        if($user)
        {
            $isSelf = false;
            if(Auth::check())
            {
                $isSelf = $this->user->id == $user->id;
            }
            
            $posts = $this->posts->findByUser($user);
            
            return View::make('user.index')
                    ->with('lists',View::make('partials.user.posts')->with(compact('posts')))
                    ->with(compact('user'))
                    
                    ->with('isSelf',$isSelf);
        } 
        return App::abort(404);
    }
    
    public function postUserSettings($username)
    {
        $editSettingsForm = $this->users->getAccountEditSettingsForm();
        if (!$editSettingsForm->isValid())
        {
            return  Redirect::back()
                    ->withInput()
                    ->withErrors($editSettingsForm->getErrors());
        }
        if($this->user)
        {
            $user = $this->users->findByUsername($username);
            if ($user->id == $this->user->id)
            {
                $isSelf = true;
                $data = $editSettingsForm->getInputData();
                if ($this->users->updateSettings($user,$data))
                {
                    $user = $this->users->findByUsername($username);
                    return View::make('user.index')
                        ->with('lists',View::make('partials.user.settings')->with(compact('user')))
                        ->with(compact('user','isSelf'));
                }else
                {
                    return  Redirect::back()
                            ->withInput()
                            ->withErrors([Lang::get('errors.user_update_settings')]);
                }
                
            }
        }
        return App::abort(404);
    }

    public function getUserSettings($username)
    {
        if($this->user)
        {
            $user = $this->users->findByUsername($username);
            if ($user->id == $this->user->id)
            {
                $isSelf = true;
                return View::make('user.index')
                    ->with('lists',View::make('partials.user.settings')->with(compact('user')))
                    ->with(compact('user','isSelf'));
                    
            }
        }
        
        return App::abort(404);
    }
    
    public function getIndex($username)
    {
        return $this->getPosts($username);
        
    }
    
    
}

?>
