<?php

/**
 * Description of LoginForm
 *
 * @author Hichem MHAMED
 */

namespace ArabiaIOClone\Services\Forms;

use Illuminate\Config\Repository;

class LoginForm extends AbstractForm 
{
    /**
    * Config repository instance.
    *
    * @var \Illuminate\Config\Repository
    */
    protected $config;
    
    protected $rules = array(
            'username' => 'required',
            'password' => 'required'
        );
    
    public function __construct(Repository $config)
    {
        parent::__construct();

        $this->config = $config;
    }
}

?>
