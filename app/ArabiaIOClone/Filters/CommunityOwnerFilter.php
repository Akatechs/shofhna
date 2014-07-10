<?php

namespace ArabiaIOClone\Filters;

namespace ArabiaIOClone\Filters;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Redirector;
use ArabiaIOClone\Repositories\CommunityRepositoryInterface;

/**
 * Description of CommunityOwnerFilter
 *
 * @author mhamed
 */
class CommunityOwnerFilter 
{
    /**
     * Auth manager instance.
     *
     * @var \Illuminate\Auth\AuthManager
     */
    private $auth;

   
    private $communities;

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
        CommunityRepositoryInterface $communities
    ) {
        $this->auth = $auth;
        $this->communities = $communities;
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

        if ( ! $this->isCommunityOwnedByUser($slug, $userId)) {
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

    /**
     * Get the slug of the post being edited / deleted.
     * @param  \Illuminate\Routing\Route  $route
     * @return string
     */
    protected function getSlug($route)
    {
        return $route->getParameter('communitySlug');
    }

    /**
     * Determine whether the user owns the post.
     *
     * @param  string  $slug
     * @param  int     $userId
     * @return bool
     */
    protected function isCommunityOwnedByUser($slug, $userId)
    {
        return $this->communities->isCommunityOwnedByUser($slug, $userId);
    }
}
