<?php



namespace ArabiaIOClone\Providers;

use ArabiaIOClone\Presenters\Media\ImgurImagePresenter;
use ArabiaIOClone\Presenters\Media\VimeoVideoPresenter;
use ArabiaIOClone\Presenters\Media\YoutubeVideoPresenter;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;



/**
 * Description of MediaPresenterServiceProvider
 *
 * @author mhamed
 */
class MediaPresenterServiceProvider extends ServiceProvider{
    
    public function register() 
    {
        
        App::bind('MediaPresenterInterface', function($app,$params) {
        
            if ($params['type'] == "YOUTUBE")
            {
                return new YoutubeVideoPresenter($params['url']);
            }else if ($params['type'] == "VIMEO")
            {
                return new VimeoVideoPresenter($params['url']);
            }
            else if ($params['type'] == "IMGUR")
            {
                return new ImgurImagePresenter($params['url']);
            }
                
                
            
        });
        
    }

//put your code here
}
