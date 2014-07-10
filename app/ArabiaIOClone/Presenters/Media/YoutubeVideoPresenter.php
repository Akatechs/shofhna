<?php



/**
 * Description of YoutubeVideoPresenter
 *
 * @author mhamed
 */
namespace ArabiaIOClone\Presenters\Media;

use ArabiaIOClone\Helpers\RegEx;

class YoutubeVideoPresenter extends AbstractMediaPresenter implements MediaPresenterInterface
{
    
    protected function Init()
    {
        preg_match(RegEx::YoutubeLink, $this->url,$videoIsMatch );
        $this->mediaId =  $videoIsMatch[1];  
    }
    
    public function getMediaEmbedHtml() {
        return '<iframe id="iframe-youtube"  width="600" height="350" src="//www.youtube.com/embed/' . $this->getMediaId() . '" frameborder="0" allowfullscreen></iframe>';
    }

    public function getMediaId() {
        return $this->mediaId;
    }

    public function getMediaThumbnailUrl() {
        return 'http://img.youtube.com/vi/' . $this->getMediaId() . '/1.jpg';
    }

    public function getMediaType() 
    {
        return "VIDEO.YOUTUBE";
    }
    
    public function getMediaShowInplaceButton()
    {
        
        return '<span id="media_show_button-' . $this->getMediaId() .
                '" class="media_show_button"><a  href="#" class="fa fa-youtube-play fa-2x" media-id="' .
                $this->getMediaId() .
                '" media-type="' .
                $this->getMediaType().'"></a></span>';
    }

    

//put your code here
}
