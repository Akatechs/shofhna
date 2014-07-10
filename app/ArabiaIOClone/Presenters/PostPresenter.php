<?php

namespace ArabiaIOClone\Presenters;

use ArabiaIOClone\Helpers\ArabicDateDiffForHumans;
use ArabiaIOClone\Helpers\RegEx;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use McCool\LaravelAutoPresenter\BasePresenter;

/**
 * Description of PostPresenter
 *
 * @author Hichem MHAMED
 */
class PostPresenter extends BasePresenter {

    protected $mediaPresenter;

    public function __construct( $post) {
        $this->resource = $post;
        $this->initMediaPresenter();
    }
    
    public function getShortLink()
    {
        return route('shortlink',['id'=>  \ArabiaIOClone\Helpers\ShortLink::EncryptId($this->resource->id)]);
    }

    protected function initMediaPresenter() {
        if ($this->resource->link) {
            
            if (preg_match(RegEx::YoutubeLink, $this->resource->link,$match)) 
                {
                $this->mediaPresenter = App::make('MediaPresenterInterface',['type'=>'YOUTUBE','url'=>$this->resource->link]);
            }else if(preg_match(RegEx::VimeoLink, $this->resource->link,$match)) 
            {
                $this->mediaPresenter = App::make('MediaPresenterInterface',['type'=>'VIMEO','url'=>$this->resource->link]);
            }
            else if(preg_match(RegEx::ImgurLink, $this->resource->link,$match)) 
            {
                $this->mediaPresenter = App::make('MediaPresenterInterface',['type'=>'IMGUR','url'=>$this->resource->link]);
            }
        }
    }
    
    public function canEdit()
    {
        if(Auth::check())
        {
            if(Auth::user()->id == $this->resource->user_id || Auth::user()->is_admin )
            {
                return true;
            }
        }
        
        return false;
    }

    public function content() {
        return  nl2br(e($this->resource->content));
    }
    
    public function getMarkDownContent()
    {
        return Markdown::render(e($this->resource->content));
    }
    
    public function getRawContent()
    {
        return $this->resource->content;
    }

    public function getCreationDateDiffForHumans() {
        
        return ArabicDateDiffForHumans::translateFromEnglish($this->resource->created_at->diffForHumans());
    }

    public function getRouteToPost() {
        return route('post-view', ['postId' => $this->resource->id, 'postSlug' => $this->resource->slug]);
    }
    
    public function getEditRoute ()
    {
        return route('post-edit', ['postId' => $this->resource->id, 'postSlug' => $this->resource->slug]);
    }

    public function getRouteToCommunity() {
        return route('community-view', array('communitySlug' => $this->resource->community()->slug));
    }

    public function getIsMediaLink() {
        
        return $this->mediaPresenter != null;
    }

//    public function getVimeoVideoId() {
//        preg_match(RegEx::VimeoLink, $this->resource->link, $videoIsMatch);
//        return $videoIsMatch[3];
//    }

//    public function getYoutubeVideoId() {
//        preg_match(RegEx::YoutubeLink, $this->resource->link, $videoIsMatch);
//        return $videoIsMatch[1];
//    }

    public function getMediaShowInplaceButton() {
        return $this->mediaPresenter->getMediaShowInplaceButton();
    }

    public function getMediaEmbedHtml() {

        return $this->mediaPresenter->getMediaEmbedHtml();
    }
    public function getMediaThumbnailUrl() {
        
        return $this->mediaPresenter->getMediaThumbnailUrl();
    }

    public function getTitleHTMLTag() {
        if ($this->resource->link ) 
        {
            $url = parse_url($this->resource->link);
            $targetUrl = $this->getIsMediaLink() ? $this->getRouteToPost() : $this->resource->link;
            $openNewWindow = $this->getIsMediaLink() ? "":" target='_blank' ";
            $url = "(" . $url['host'] . ")";

            $result = "<a href='" . $targetUrl . "' ".$openNewWindow."  rel='nofollow' >";
            $result .= e($this->resource->title);
            $result .= '</a>';
            $result .= "<span class='post_domain'>$url</span>";
            return $result;
        } else {
            $result = "<a href='" . $this->getRouteToPost() . "'>" . e($this->resource->title) . "</a>";
            return $result;
        }
    }

    public function getDivId() {
        return 'post-' . $this->resource->id;
    }

    public function getPositiveVoteSum() {
        $result = $this->resource->votes()->where('vote', '>', 0)->sum('vote');
        return $result == null ? 0 : $result;
    }

    public function getNegativeVoteSum() {
        $result = $this->resource->votes()->where('vote', '<', 0)->sum('vote');
        return $result == null ? 0 : $result;
    }

    public function getCommentsCountLiteral() {
        $commentsCount = $this->resource->comments()->count();
        if ($commentsCount == 0) {
            return "ابدأ النقاش";
        } else {
            return "عدد التعليقات " . $commentsCount;
        }
    }

    public function getCanAddToFavorites($user) {
        return $this->resource->favoredByUsers()->where('user_id', '=', $user->id)->count() > 0 ? 'hidden' : null;
    }

    public function getCanRemoveFromFavorites($user) {
        return $this->getCanAddToFavorites($user) == null ? 'hidden' : null;
    }

}

?>
