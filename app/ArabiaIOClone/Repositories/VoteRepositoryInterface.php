<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author Admin
 */

namespace ArabiaIOClone\Repositories;


interface VoteRepositoryInterface 
{
    

    public function tryUpvotePost($post, $user);
    public function tryDownvotePost($post, $user);
    
    public function tryUpvoteComment($comment, $user);
    public function tryDownvoteComment($comment, $user);
}

?>
