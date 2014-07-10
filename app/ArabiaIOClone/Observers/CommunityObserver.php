<?php



/**
 * Description of CommunityObserver
 *
 * @author mhamed
 */
namespace ArabiaIOClone\Observers;

use ArabiaIOClone\Repositories\CommunityRepositoryInterface;
use ArabiaIOClone\Repositories\UserRepositoryInterface;

class CommunityObserver extends AbstractObserver
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
    
    public function created($community)
    {
        if(!$community->createdbyuser)
        {
            $this->users->subscribeAllToCommunity($community);
            
        }
    }
}
