<?php



/**
 * Description of Flag
 *
 * @author mhamed
 */
class Flag extends Eloquent
{
    protected $table = 'flags';
    
    protected $fillable = array('type', 'user_id', 'target_type', 'target_id');
    
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
