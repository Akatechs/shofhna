<?php

/**
 * Description of Community
 *
 * @author Hichem MHAMED
 */
class Community extends Eloquent
{
    protected $table = 'communities';
    
    public $presenter = 'ArabiaIOClone\Presenters\CommunityPresenter';
    
    protected $fillable = array('name', 'slug','description','creator_id','createdbyuser');
    
    
    public function creator()
    {
        return $this->belongsTo('User','creator_id');
    }
    
    public function posts() 
    {
        return $this->hasMany('Post','community_id');
    }
    
    public function subscribers()
    {
        return $this->belongsToMany('User');
    }
}

?>
