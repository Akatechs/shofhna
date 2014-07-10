<?php



/**
 * Description of RepositoryServiceProvider
 *
 * @author Hichem MHAMED
 */

namespace ArabiaIOClone\Providers;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider 
{
    public function register()
    {
         $this->app->bind(
            'ArabiaIOClone\Repositories\CommunityRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\CommunityRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\UserRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\UserRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\PostRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\PostRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\VoteRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\VoteRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\CommentRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\CommentRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\NotificationRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\NotificationRepository'
        );
         
         $this->app->bind(
            'ArabiaIOClone\Repositories\FlagRepositoryInterface',
            'ArabiaIOClone\Repositories\Eloquent\FlagRepository'
        );
    }
}

?>
