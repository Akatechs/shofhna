<?php

/**
 * Description of NotificationPresenterFactory
 *
 * @author mhamed
 */

namespace ArabiaIOClone\Presenters\Notifications;

use McCool\LaravelAutoPresenter\BasePresenter;
use Notification;

class NotificationPresenterProxy extends BasePresenter implements NotificationPresenterInterface
{
    public $presenter = null;
    protected $notifications;
    
    
    public function __construct(Notification $resource)
    {
        parent::__construct($resource);
        
        $this->presenter =  App('ArabiaIOClone.Notification.'.$resource->event_type);
        $this->presenter->resource = $this->resource;
        
        $this->notifications = App('ArabiaIOClone\Repositories\NotificationRepositoryInterface');
        
    }
    
    public function getHTML()
    {
        $html =  $this->presenter->getHTML();
        if (!$this->resource->read)
        {
            $html = '<b>'.$html.'</b>';
            $this->notifications->updateRead($this->resource, true);
        }
        
        return $html;
    }
    
    
}
