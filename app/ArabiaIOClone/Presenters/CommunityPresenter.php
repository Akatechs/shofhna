<?php

/**
 * Description of CommunityPresenter
 *
 * @author Hichem MHAMED
 */

namespace ArabiaIOClone\Presenters;

use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use Community;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

class CommunityPresenter extends BasePresenter
{
    public function __construct(Community $community)
    {
        $this->resource = $community;
    }
    
    public function getEditRoute()
    {
        return route('community-edit',['communitySlug'=>$this->resource->slug]);
    }
    
    public function canEdit()
    {
        if(Auth::check())
        {
            if(Auth::user()->id == $this->resource->creator_id)
            {
                return true;
            }
        }
        
        return false;
    }
    
    public function getMarkdownDescription()
    {
        return Markdown::render(e($this->resource->description));
    }


    public function name()
    {
        return $this->resource->name;
    }
    
    public function getRouteToCommunity()
    {
        return route('community-view',array('communitySlug'=>$this->resource->slug));
    }
    
    public function getSubscribersCount()
    {
        return $this->resource->subscribers()->count();
    }
    
    public function getPostsCount()
    {
        return $this->resource->posts()->count();
    }
    
    public function getLastActivityDiffForHumans()
    {
        
        $mostRecentPost = $this->resource->posts()->first();
        
        if ($mostRecentPost)
        {
            return ArabicDateDiffForHumans::translateFromEnglish($mostRecentPost->updated_at->diffForHumans());
        }else
        {
            return ArabicDateDiffForHumans::translateFromEnglish($this->resource->updated_at->diffForHumans());
        }
        
    }
    
    public function getCanSubscribe($user)
    {
        return $this->resource->subscribers()->where('user_id','=',$user->id)->count() > 0 ? 'hidden' : null ;
    }
    
    public function getCanUnsubscribe($user)
    {
        return $this->getCanSubscribe($user) == null ? 'hidden' : null;
    }
    
   
}

?>
