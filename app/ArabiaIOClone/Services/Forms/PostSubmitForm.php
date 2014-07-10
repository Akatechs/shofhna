<?php

/**
 * Description of PostSubmitForm
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Services\Forms;

use ArabiaIOClone\Helpers\RegEx;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\Validator;



class PostSubmitForm extends AbstractForm
{
    protected $rules = array(
        'title'=>'required|min:5',
        //'link'=>'required_without:content|url',
        'link'=>'validLink',
        'content'=>'required_without:link|min:5',
        'community_id'=>'required',
        'confirm'=>'required'
            
        
        );
    
    protected $messages = [
        'valid_link' => '',
    ];
    
    public function __construct() {
        parent::__construct();
        
        $this->messages['valid_link'] = Lang::get('errors.valid_link');
    }
    
    protected function getPreparedRules()
    {
        //$youtubeLinkRegex = '';
        
        Validator::extend('validLink', function($attribute, $value, $parameters)
        {       
            //if(preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $value))
            if(preg_match(RegEx::ValidLink, $value))
            {
              return true;
            }
   
            return false;
        });
        return $this->rules;
    }
}

?>
