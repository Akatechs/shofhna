<?php

/**
 * Description of HomeController
 *
 * @author mhamed
 */
class HomeController extends BaseController
{
    public function getAbout()
    {
        return View::make('home.about');
    }
    
    public function getPrivacy()
    {
        return View::make('home.privacy');
    }
    
    public function getFAQ()
    {
        return View::make('home.faq');
    }
    
    public function getShortLink($id)
    {
        
        try
        {
            $decryptedId = \ArabiaIOClone\Helpers\ShortLink::DecryptId($id);
        } catch (Exception $ex) 
        {
            return App::abort(404);
        }
        $post = $this->posts->findById($decryptedId);
        
        if($post)
        {
            return Redirect::route('post-view',['postId'=>$post->id,'postSlug'=>$post->slug]);
        }else
        {
            return App::abort(404);
        }
    }
    
    public function getError($code)
    {
        switch ($code)
            {
                case 403:
                    return View::make('errors.403', array());
    
                case 404:
                    return View::make('errors.404', array());
    
                case 500:
                    return View::make('errors.500', array());
    
                default:
                    return View::make('errors.default', array());
            }
    }
}
