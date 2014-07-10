<?php

/**
 * Description of PostRepositoryInterface
 *
 * @author Hichem MHAMED
 */

namespace ArabiaIOClone\Repositories;


interface  PostRepositoryInterface 
{
    public function edit($post, $data);
    public function isPostOwnedByUser($slug, $userId);
    
    public function getFlaggedPaginated($perPage);
    
    public function incrementViews($post);
    
    public function getPostSubmitForm();
    public function getPostEditForm();
    
    public function create($data);
    
    public function findMostPopular($perPage);
    
    public function findMostRecent($perPage);
    
    public function findTop($perPage);
    
    public function findByUser($user,$perPage);
    
    public function findById($postId);
    
    public function findByIdAndSlug($postId, $postSlug);
    
    public function updateVoteSum($post);
    
    //by community
    public function findTopByCommunity($community, $perPage );
    public function findMostRecentByCommunity($community, $perPage );
    public function findMostPopularByCommunity($perPage);
    
    //by subscriptions
    public function findTopByUserSubscriptions($user, $perPage );
    public function findMostRecentByUserSubscriptions($user, $perPage );
    public function findMostPopularByUserSubscriptions($usern,$perPage); 
    
    
    public function searchByTermPaginated($term, $perPage = 15 );
    public function findBySimilarTitle($post, $take);
    
    
    public function findFavoritesPaginated($user, $perPage);
    public function findMostPopularFromUnsubscribedCommunities($user, $perPage);
    
    
}

?>
