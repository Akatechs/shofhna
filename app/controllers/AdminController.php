<?php

/**
 * Description of AdminController
 *
 * @author mhamed
 */
class AdminController extends BaseController
{
    public function getFlaggedPosts()
    {
        $posts = $this->posts->getFlaggedPaginated($perPage = 15);
        
        $latestComments = $this->comments->findLatestComments();
        
        return View::make('admin.flagged.posts')
                ->with(compact('posts'));
    }
    
    public function getFlaggedComments()
    {
        
    }
    
    public function getDefault()
    {
        return $this->getFlaggedPosts();
    }
}
