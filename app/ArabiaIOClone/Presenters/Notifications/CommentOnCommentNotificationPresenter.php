<?php


namespace ArabiaIOClone\Presenters\Notifications;

use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use ArabiaIOClone\Presenters\Notifications\NotificationPresenterInterface;
use McCool\LaravelAutoPresenter\BasePresenter;
use Notification;
/**
 * Description of CommentOnCommentNotificationPresenter
 *
 * @author Hichem MHAMED
 */
class CommentOnCommentNotificationPresenter extends BasePresenter implements NotificationPresenterInterface 
{
    protected $properties ;
    
    public function __construct(Notification $resource)
    {
        
        parent::__construct($resource);
        
        
        
    }
    
    public function getHTML() 
    {
        $this->properties = json_decode($this->resource->properties);
        
        return '<a href="'.
                route('user-index',['username'=> $this->properties->username]).
                '">'.
                $this->properties->username.
                '</a> ردّ على تعليقك: <a href="'.
                route('post-view',['postId'=>$this->properties->post_id,'postSlug' => $this->properties->post_slug]).'#comment_'.$this->properties->comment_id.
                '">'.
                $this->properties->post_title.
                '</a>'.
                ArabicDateDiffForHumans::translateFromEnglish($this->resource->created_at->diffForHumans());;
    }    
}

?>
