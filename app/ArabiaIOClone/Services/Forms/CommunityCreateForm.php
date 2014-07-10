<?php


/**
 * Description of CommunityCreateForm
 *
 * @author mhamed
 */
namespace ArabiaIOClone\Services\Forms;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Lang;

class CommunityCreateForm extends AbstractForm
{
    
    protected $config;
    
    protected $rules = array(
        'community_title'=>'required|max:50',
        'community_slug'=>'required|max:50|min:3|alpha_num|unique:communities,slug',
        'community_description'=>'required|min:4|max:500'
        );
    
    public function __construct(Repository $config)
    {
        parent::__construct();
        
        $this->messages['not_in'] = Lang::get('errors.forbidden_community_name');

        $this->config = $config;
    }
    
    protected $messages = [
        'not_in' => ''
    ];
    
    protected function getPreparedRules()
    {
        $forbidden = $this->config->get('config.forbidden_community_names');
        $forbidden = implode(',', $forbidden);

        $this->rules['community_slug'] .= '|not_in:' . $forbidden;

        return $this->rules;
    }
}
