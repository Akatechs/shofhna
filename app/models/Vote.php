<?php

/**
 * Description of Vote
 *
 * @author Hichem MHAMED
 */
class Vote  extends Eloquent
{
    protected $table = 'votes';
    
    protected $fillable = array('vote', 'user_id', 'target_type', 'target_id');
    
    public function users() 
    {
        return $this->belongsTo('User','user_id');
    }
    
    public function user()
    {
        return $this->users()->get()->first();
    }
    
   
    
    public function target()
    {
        return $this->morphTo('target');
    }
}

?>
