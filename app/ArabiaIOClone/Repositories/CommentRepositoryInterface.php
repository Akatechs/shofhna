<?php

/**
 *
 * @author Hichem Mhamed
 */
namespace ArabiaIOClone\Repositories;

interface CommentRepositoryInterface 
{
    public function getPostSubmitForm();
    
    public function create($data,$parentId=null);
    
    public function edit($comment, $data);
    
    public function getSortedByPost($post);
    
    public function updateVoteSum($comment);
    
    public function findByUser($user,$perPage);
    
    public function findLatestComments($take = 10);
    public function findLatestCommentsByCommunity($community, $take = 10);
}

?>
