<?php

/**
 * Description of PostController
 *
 * @author Hichem MHAMED
 */

use Illuminate\Support\Facades\Event;


class PostController extends BaseController
{
    
    
   public function getEditPost($postId, $postSlug)
   {
       $communities = $this->communities->findAll('created_at','asc')->lists('name','id');
       $post = $this->posts->findByIdAndSlug($postId,$postSlug);
        return View::make('posts.edit')
                ->with(compact('communities','post'));
   }
   
   public function postEditPost($postId, $postSlug)
   {
       
       $post = $this->posts->findByIdAndSlug($postId,$postSlug);
       $form  = $this->posts->getPostEditForm();
       if(!$form->isValid())
       {
           return Redirect::route('post-edit',['postId'=>$postId,'postSlug'=>$postSlug])
                    ->withInput()
                    ->withErrors($form->getErrors());
       }
       
       $data = $form->getInputData();
       $post = $this->posts->edit($post, $data);
       if($post)
        {
            return Redirect::route('post-view',['postId'=>$postId,'postSlug'=>$postSlug])
                ->with('success',[Lang::get('success.post_edit')]);
        }else
        {
            return Redirect::route('post-edit',['postId'=>$postId,'postSlug'=>$postSlug])
                    ->withInput()
                    ->withErrors(Lang::get('errors.post_edit'));
        }
   }
    
   public function getDiscover()
   {
       $posts = $this->posts->findMostPopularFromUnsubscribedCommunities(Auth::user());
       $latestComments = $this->comments->findLatestComments();
        
        return View::make('posts.browse')
                 ->with(compact('posts','latestComments'))
                ->render();
   }
    
    public function getFavorites()
    {
        $posts = $this->posts->findFavoritesPaginated(Auth::user());
        $latestComments = $this->comments->findLatestComments();
        
        return View::make('posts.browse')
                 ->with(compact('posts','latestComments'))
                ->render();
    }
    
    public function getTop()
    {
        if(Auth::check())
        {
            $posts = $this->posts->findTopByUserSubscriptions(Auth::user());
        }else{
            $posts = $this->posts->findTop();
        }
        
        $latestComments = $this->comments->findLatestComments();
        
        return View::make('posts.browse')
                 ->with(compact('posts','latestComments'))
                ->render();
    }
    
    public function getMostRecent()
    {
        if(Auth::check())
        {
            $posts = $this->posts->findMostRecentByUserSubscriptions(Auth::user());
        }  
        else
        {
            $posts = $this->posts->findMostRecent();
        }
        $latestComments = $this->comments->findLatestComments();
        
        return View::make('posts.browse')
                 ->with(compact('posts','latestComments'))
                ->render();
    }
    
    public  function getMostPopular()
    {
        if(Auth::check())
        {
            $posts = $this->posts->findMostPopularByUserSubscriptions(Auth::user());
        }  else{
            $posts = $this->posts->findMostPopular();
        }
        
        $latestComments = $this->comments->findLatestComments();
        
        return View::make('posts.browse')
                ->with(compact('posts','latestComments'));
                
    }


    public function getDefault()
    {
        return $this->getMostPopular();
    }
    
    public function getSubmit()
    {
        $communities = $this->communities->findAll('created_at','asc')->lists('name','id');
        return View::make('posts.submit')
                ->with('communities',$communities);
    }
    
    public function postSubmit()
    {
        
        
        $form = $this->posts->getPostSubmitForm();
        if(!$form->isValid())
        {
            return Redirect::route('post-submit')
                    ->withInput()
                    ->withErrors($form->getErrors());
        }
        
        $data = $form->getInputData();
        $data['user_id'] = Auth::user()->id;

        $post = $this->posts->create($data);

        if($post)
        {
            return Redirect::route('default')
                ->with('success',[Lang::get('success.post_submit')]);
        }else
        {
            return Redirect::route('post-submit')
                    ->withInput()
                    ->withErrors(Lang::get('errors.post_submit'));
        }
        
    }
    
    
    public function getView($postId, $postSlug)
    {
        $post = $this->posts->findByIdAndSlug($postId,$postSlug);
        if($post)
        {
            $relatedPosts = $this->posts->findBySimilarTitle($post, 2);
            $comments = $this->comments->getSortedByPost($post);
            Event::fire('post.view', $post);
            return View::make('posts.view')
                    ->with(compact('post','comments','relatedPosts'))
                    ->render();
        }
        return App::abort(404);
        
    }
}

?>
