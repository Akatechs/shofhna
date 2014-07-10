<?php

namespace ArabiaIOClone\Presenters;

use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use Auth;
use Comment;
use Illuminate\Support\Str;
use McCool\LaravelAutoPresenter\BasePresenter;
/**
 * Description of CommentPresenter
 *
 * @author Hichem MHAMED
 */
class CommentPresenter extends BasePresenter 
{
    public function __construct(Comment $comment)
    {
        $this->resource = $comment;
    }
    
    public function content()
    {
        return nl2br($this->resource->content);
        
    }
    
    public function getShortContent()
    {
        return Str::limit($this->resource->content,75);
    }
    
    public function subcomment()
    {
        return $this->resource->getLevel() > 0 ? 'subcomment' : '';
        
    }
    
    public function getNestedWidth()
    {
        return 940 - (21 * $this->resource->getLevel());
    }
    
    public function getCreationDateDiffForHumans()
    {
        return ArabicDateDiffForHumans::translateFromEnglish($this->resource->created_at->diffForHumans());
    }
    
    public function canEdit()
    {
        if($this->resource->user()->id == Auth::user()->id)
        {
            return true;
        }else
        {
            return false;
        }
    }
    
    public function getLinkToComment()
    {
        return route('post-view',[
            'postId'=>$this->resource->post_id,
            'postSlug' => $this->resource->post()->slug
                
                ]).'#comment_'.$this->resource->id;
    }
    
    public function getRouteToPost()
    {
        return route('post-view',[
            'postId'=>$this->resource->post_id,
            'postSlug' => $this->resource->post()->slug
                
                ]);
    }
    
    public function getRouteToComment()
    {
        return $this->getRouteToPost().'#comment_'.$this->resource->id;
                
    }
    
    public function getRouteToUser()
    {
        return route('user-index',[
            'username'=>$this->resource->user()->username
                ]);
    }
    
    public function getRouteToCommunity()
    {
        return route('community-view',array('communitySlug'=>$this->resource->post()->community()->slug));
    }
    
    public function getPostCommentsCountLiteral()
    {
        $commentsCount = $this->resource->post()->comments()->count();
        if ($commentsCount == 0)
        {
                return "ابدأ النقاش";
        }else
        {
                return "عدد التعليقات ".$commentsCount;
        }
    }
    
    
}

?>
