<?php



namespace ArabiaIOClone\Events;

use ArabiaIOClone\Repositories\PostRepositoryInterface;
use Illuminate\Session\Store;

/**
 * Description of ViewPostHandler
 *
 * @author mhamed
 */
class ViewPostHandler 
{
    protected $posts;
    protected $session;
    
    public function __construct(PostRepositoryInterface $posts,Store $session)
    {
        $this->posts = $posts;
        $this->session = $session;
    }
    
    
    public function handle($post)
    {
        if (! $this->hasViewedPost($post)) 
        {
            $post = $this->posts->incrementViews($post);

            $this->storeViewedTrick($post);
        }
    }


    protected function hasViewedPost($post)
    {
        return array_key_exists($post->id, $this->getViewedPosts());
    }

    /**
* Get the users viewed trick from the session.
*
* @return array
*/
    protected function getViewedPosts()
    {
        return $this->session->get('viewed_posts', []);
    }


    protected function storeViewedTrick($post)
    {
        $key = 'viewed_posts.' . $post->id;

        $this->session->put($key, time());
    }
}
