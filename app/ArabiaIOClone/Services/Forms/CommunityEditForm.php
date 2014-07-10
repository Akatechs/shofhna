<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace ArabiaIOClone\Services\Forms;

use Illuminate\Config\Repository;
use Illuminate\Support\Facades\Lang;

/**
 * Description of CommunityEditForm
 *
 * @author mhamed
 */
class CommunityEditForm extends AbstractForm
{
    protected $config;
    protected $slug;
    
    protected $rules = array(
        'community_title'=>'required|max:50',
        'community_slug'=>'required|max:50|min:3|alpha_num|unique:communities,slug',
        'community_description'=>'required|min:4|max:500'
        );
    
    public function __construct($slug,Repository $config)
    {
        parent::__construct();
        $this->slug = $slug;
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
        $this->rules['community_slug'] .= ',' . $this->slug.',slug';
        $this->rules['community_slug'] .= '|not_in:' . $forbidden;
        

        return $this->rules;
    }
}
