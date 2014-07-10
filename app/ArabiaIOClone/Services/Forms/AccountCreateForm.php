<?php



/**
 * Description of AccountCreateForm
 *
 * @author hichem mhamed
 */

namespace ArabiaIOClone\Services\Forms;
use Illuminate\Config\Repository;

class AccountCreateForm extends AbstractForm 
{
    protected $config;
    
    protected $rules = array(
        'email'=>'required|max:50|email|unique:users',
        'username'=>'required|max:20|min:3|alpha_num|unique:users,username',
        'password'=>'required|min:6',
        'password_confirmation'=>'required|same:password'
        );
    
    public function __construct(Repository $config)
    {
        parent::__construct();

        $this->config = $config;
    }
}
