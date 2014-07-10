<?php


/**
 * Description of VimeoVideoPresenter
 *
 * @author mhamed
 */

namespace ArabiaIOClone\Presenters\Media;

use ArabiaIOClone\Helpers\RegEx;
use Illuminate\Support\Facades\App;

class VimeoVideoPresenter extends AbstractMediaPresenter implements MediaPresenterInterface
{
    protected function Init()
    {
        preg_match(RegEx::VimeoLink, $this->url,$videoIsMatch );
        $this->mediaId =  $videoIsMatch[3];
        
    }

    public function getMediaEmbedHtml() {
        return '<iframe src="//player.vimeo.com/video/'.$this->mediaId.'" width="600" height="350" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    public function getMediaId() {
        return $this->mediaId;
    }

    public function getMediaShowInplaceButton() {
        return '<span id="media_show_button-' . $this->getMediaId() .
                '" class="media_show_button"><a  href="#" class="fa fa-youtube-play fa-2x" media-id="' .
                $this->getMediaId() .
                '" media-type="' .
                $this->getMediaType().'"></a></span>';
    }

    public function getMediaThumbnailUrl() 
    {
        if (!App::environment('a2ia'))
        {
            return $this->getVimeoInfo($this->getMediaId());
        }
        else
        {
            return "";
        }
            
    }

    public function getMediaType() {
        return "VIDEO.VIMEO";
    }
    
    
    
    protected function  getVimeoInfo($id, $info = 'thumbnail_small')
    {
        //return "";
       
        if (!function_exists('curl_init')) die('CURL is not installed!');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "http://vimeo.com/api/v2/video/$id.php");
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 10);
        $curlResult = curl_exec($ch);
        if($curlResult)
        {
            $output = unserialize($curlResult);
            $output = $output[0][$info];
            curl_close($ch);
            return $output;
        }else
        {
            return "";
        }
        
     
}

//put your code here
}
