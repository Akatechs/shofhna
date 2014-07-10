<?php


/**
 * Description of UserObserver
 *
 * @author mhamed
 */
namespace ArabiaIOClone\Observers;

use ArabiaIOClone\Repositories\CommunityRepositoryInterface;
use ArabiaIOClone\Repositories\UserRepositoryInterface;

class UserObserver extends AbstractObserver
{
    protected $users;
    protected $communities;
    
    public function __construct(
                                UserRepositoryInterface $users,
                                CommunityRepositoryInterface $communities
                                ) 
    {
        $this->users = $users;
        $this->communities = $communities;
    
    }
    
    public function created($user)
    {
        $this->communities->subscribeToAllSuperCommunities($user);
        \ArabiaIOClone\Facades\MailService::sendNotificationToAdmin(['type'=>'new user registered',
            'username'=>$user->username]);
    }
            
}
