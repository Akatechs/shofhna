<?php

/**
 * Description of Post
 *
 * @author Hichem MHAMED
 */

use Cviebrock\EloquentSluggable\SluggableInterface;
use Cviebrock\EloquentSluggable\SluggableTrait;

class Post extends Eloquent implements SluggableInterface
{
    use SluggableTrait;
    
    protected $table = 'posts';
    
    public $presenter = 'ArabiaIOClone\Presenters\PostPresenter';
    
    protected $fillable = array('title','slug', 'user_id','community_id', 'content', 'link','sumvotes');
    protected $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );
    
    public function users() 
    {
        return $this->belongsTo('User','user_id');
    }
    
    public function user()
    {
        return $this->users()->get()->first();
    }
    
    public function communities() 
    {
        return $this->belongsTo('Community','community_id');
    }
    
    public function community()
    {
        return $this->communities()->get()->first();
    }
    
    
    
    public function votes()
    {
       return $this->morphMany('Vote', 'target');
    }
    
    public function flags()
    {
        return $this->morphMany('Flag', 'target');
    }
    
    public function comments()
    {
       return $this->hasMany('Comment','post_id');
    }
    
    public function favoredByUsers()
    {
        return $this->belongsToMany('User','favorites');
    }
}

?>
