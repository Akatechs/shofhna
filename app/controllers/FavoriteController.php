<?php

/**
 * Description of FavoriteController
 *
 * @author mhamed
 */
class FavoriteController  extends BaseController
{
    public function postAdd()
    {
       if (Request::ajax())
        {
            $postId = e(Input::get('post_id'));
            $user = Auth::user();
            $this->users->addPostToFavorites($user, $postId);
            return Response::json(['success'=>true]);
       }
    }
    
    public function postRemove()
    {
        if (Request::ajax())
        {
            $postId = e(Input::get('post_id'));
            $user = Auth::user();
            $this->users->removePostFromFavorites($user, $postId);
            return Response::json(['success'=>true]);
        }
    }
}
