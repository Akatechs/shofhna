<?php


/**
 * Description of RecoverPasswordForm
 *
 * @author hichem mhamed
 */
namespace ArabiaIOClone\Services\Forms;
use Illuminate\Config\Repository;

class RecoverPasswordForm extends AbstractForm 
{
    protected $config;
    
    protected $rules = array(
        'email'=>'required|max:50|email'
        );
    
    public function __construct(Repository $config)
    {
        parent::__construct();

        $this->config = $config;
    }
}
