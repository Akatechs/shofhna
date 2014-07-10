<?php



namespace ArabiaIOClone\Presenters\Notifications;
use McCool\LaravelAutoPresenter\BasePresenter;
use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use Notification;

/**
 * Description of PostCommunityModifiedNotificationPresenter
 *
 * @author mhamed
 */
class PostCommunityModifiedNotificationPresenter extends  BasePresenter implements NotificationPresenterInterface
{
    protected $properties ;
    
    public function __construct(Notification $resource)
    {
        
        parent::__construct($resource);
        
        
        
    }
    
    public function getHTML()
    {
        $this->properties = json_decode($this->resource->properties);
        
        return '  موضوعك: <a href="'.
                route('post-view',['postId'=>$this->properties->post_id,'postSlug' => $this->properties->post_slug]).
                '">'.
                $this->properties->post_title.
                '</a> تم نقله من مجتمع '.$this->properties->old_community_name.' '.
				'إلى مجتمع '. $this->properties->new_community_name.
                ArabicDateDiffForHumans::translateFromEnglish($this->resource->created_at->diffForHumans());
    }
}
