<?php

/**
 * Description of Notification
 *
 * @author mhamed
 */
class Notification extends Eloquent
{
    protected $table = 'notifications';
    public $presenter = 'ArabiaIOClone\Presenters\Notifications\NotificationPresenterProxy';
    protected $fillable = array('user_id',
                                'event_type', 
                                'read',
                                'properties'
                                );
    
    public function users() 
    {
        return $this->belongsTo('User','user_id');
    }
    
    public function user()
    {
        return $this->users()->get()->first();
    }
    
    
}
