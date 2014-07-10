<?php



/**
 * Description of AbstractMediaPresenter
 *
 * @author mhamed
 */

namespace ArabiaIOClone\Presenters\Media;

abstract class AbstractMediaPresenter
{
    protected $url;
    protected $mediaId;
    
    public function __construct($url) 
    {
        $this->url = $url;
        $this->Init();
    }
    
    protected abstract function Init();
    
}
