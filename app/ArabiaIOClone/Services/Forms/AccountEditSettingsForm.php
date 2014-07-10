<?php
/**
 * Description of AccountEditSettingsForm
 *
 * @author mhamed
 */

namespace ArabiaIOClone\Services\Forms;

use Illuminate\Support\Facades\Auth;
class AccountEditSettingsForm extends AbstractForm
{
    protected $rules = array(
        'email'=>'required|max:50|email|unique:users,email',
        
        'oldPassword'=>'required_with:newPassword|min:6|different:newPassword',
        'newPassword' => 'required_with:oldPassword|min:6|confirmed',
        'newPassword_confirmation'=>'required_with:newPassword|same:newPassword'
        );
    
    protected function getPreparedRules()
    {
        $this->rules['email'] .= ',' . Auth::user()->email.',email';

        return $this->rules;
    }
}
