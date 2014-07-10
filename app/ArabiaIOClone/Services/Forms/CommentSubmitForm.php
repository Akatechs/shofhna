<?php

namespace ArabiaIOClone\Services\Forms;
use ArabiaIOClone\Services\Forms\AbstractForm;

/**
 * Description of CommentSubmitForm
 *
 * @author Hichem MHAMED
 */
class CommentSubmitForm extends AbstractForm
{
    protected $rules = array(
        'comment_content'=>'required|min:5'
        
            
        
        );
    
    public function __construct() {
        parent::__construct();
    }
}

?>
