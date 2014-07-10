<?php



namespace ArabiaIOClone\Presenters\Media;

use ArabiaIOClone\Helpers\RegEx;

/**
 * Description of ImgurImagePresenter
 *
 * @author mhamed
 */
class ImgurImagePresenter extends AbstractMediaPresenter implements MediaPresenterInterface
{
    protected $mediaWidth = 0;
    protected $mediaHeight = 0;
    protected $mediaExtension = "";
    protected $mediaEmbedUrl = "";
    
    
    protected function Init() {
        preg_match(RegEx::ImgurLink, $this->url,$imageIsMatch );
        $this->mediaId =  $imageIsMatch[1];
        $this->mediaExtension  = $imageIsMatch[2];
    }

    public function getMediaEmbedHtml() {
        $imgur_json = "http://api.imgur.com/oembed/?format=json&url=".$this->url;
        $json= $this->getJsonResponse($imgur_json);
        $this->mediaWidth = $json["width"];
        $this->mediaHeight = $json["height"];
        return '<br><iframe class="imgur-album"  width="100%" height="'.$this->mediaHeight.'" src="//i.imgur.com/'.$this->mediaId.'.'.$this->mediaExtension.'" frameborder="0"></iframe>';
        
    }
    
    
    
    protected function  getJsonResponse($url)
    {
	$json_response = $this->getUrlData($url);
	$res = json_decode($json_response, true);
	if(is_array($res) && !empty($res))
	{
		
		return $res;
	}
    }   

    protected function getUrlData($url)
    {
        if (!function_exists('curl_init')) die('CURL is not installed!');
	$curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US; rv:1.9.2.16) Gecko/20110319 Firefox/3.6.16");
        $curlData = curl_exec($curl);
        curl_close($curl);
        return $curlData;
    }

    public function getMediaId() {
        return $this->mediaId;
    }

    public function getMediaShowInplaceButton() {
        return '<span id="media_show_button-' . $this->getMediaId() .
                '" class="media_show_button"><a  href="#" class="fa fa-youtube-play fa-2x" media-id="' .
                $this->getMediaId() .
                '" media-ext="' .$this->mediaExtension.
                '" media-width="' .$this->mediaWidth.
                '" media-height="' .$this->mediaHeight.
                '" media-type="' .
                $this->getMediaType().'"></a></span>';
    }

    public function getMediaThumbnailUrl() {
        return  "http://i.imgur.com/".$this->mediaId."s.".$this->mediaExtension;
    }

    public function getMediaType() {
        return "IMAGE.IMGUR";
    }

//put your code here
}
