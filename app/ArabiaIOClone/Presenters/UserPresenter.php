<?php

/**
 * Description of UserPresenter
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Presenters;

use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use GrahamCampbell\Markdown\Facades\Markdown;
use McCool\LaravelAutoPresenter\BasePresenter;
use User;

class UserPresenter extends BasePresenter 
{
    public function __construct(User $user)
    {
        $this->resource = $user;
    }
    
    public function getMarkdownBio()
    {
        return Markdown::render(e($this->resource->bio));
    }
    
    public function getFullName()
    {
        if($this->resource->fullname)
        {
            return "(".$this->resource->fullname.')';
        }else
        {
            return '';
        }
    }
    
    public function getCreationDateDiffForHumans()
    {
        
        return ArabicDateDiffForHumans::translateFromEnglish($this->resource->created_at->diffForHumans());
    }
    
    public function getIsTwitterUser()
    {
        return $this->resource->twitter_id != null;
    }
}

?>
