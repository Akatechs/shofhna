<?php

namespace ArabiaIOClone\Filters;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Redirector;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
/**
 * Description of PostOwnerFilter
 *
 * @author mhamed
 */
class PostOwnerFilter
{
    /**
     * Auth manager instance.
     *
     * @var \Illuminate\Auth\AuthManager
     */
    private $auth;

   
    private $posts;

    /**
     * Redirector instance.
     *
     * @var \Illuminate\Routing\Redirector
     */
    private $redirect;

    /**
     * Create a new trick owner filter instance.
     *
     * @param  \Illuminate\Auth\AuthManager                   $auth
     * @param  \Illuminate\Routing\Redirector                 $redirect
    
     * @return void
     */
    public function __construct(
        AuthManager $auth,
        Redirector $redirect,
        PostRepositoryInterface $posts
    ) {
        $this->auth = $auth;
        $this->posts = $posts;
        $this->redirect = $redirect;
    }

    /**
     * Execute the route filter.
     *
     * @param  \Illuminate\Routing\Route  $route
     * @return void|\Illuminate\Http\RedirectResponse
     */
    public function filter($route)
    {
        $slug = $this->getSlug($route);
        $userId = $this->getUserId();
        //if(!$this->getUserIsAdmin()){
        if ( !$this->isPostOwnedByUser($slug, $userId) && !$this->getUserIsAdmin() ) {
           
            return $this->redirect->route('default');
        }
    }

    /**
     * Get the id of the currently authenticated user.
     *
     * @return int
     */
    protected function getUserId()
    {
        return $this->auth->user()->id;
    }
    
    protected function getUserIsAdmin()
    {
        return $this->auth->user()->is_admin;
    }
    
    

    /**
     * Get the slug of the post being edited / deleted.
     * @param  \Illuminate\Routing\Route  $route
     * @return string
     */
    protected function getSlug($route)
    {
        return $route->getParameter('postSlug');
    }

    /**
     * Determine whether the user owns the post.
     *
     * @param  string  $slug
     * @param  int     $userId
     * @return bool
     */
    protected function isPostOwnedByUser($slug, $userId)
    {
        return $this->posts->isPostOwnedByUser($slug, $userId);
    }
}
