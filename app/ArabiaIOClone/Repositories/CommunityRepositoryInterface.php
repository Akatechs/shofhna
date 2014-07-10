<?php

/**
 * Description of CommunityRepositoryInterface
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Repositories;



interface CommunityRepositoryInterface  
{
    public function isCommunityOwnedByUser($slug, $userId);
    public function findById($id);
    public function findAll($orderColumn = 'created_at', $orderDir='desc');
    
    public function findMostRecent($take=8);
    public function findMostActive($take=8);
    
    public function findBySlug($slug);
    
    public function findByUserPaginated($user, $perPage);
    public function findMostRecentPaginated($perPage);
    public function findMostActivePaginated($perPage);
    
    public function getCommunityCreateForm();
    public function getCommunityEditForm($slug);
    public function create(array $data);
    
    public function subscribeToAllSuperCommunities($user);
    public function unsubscribeFromAllSuperCommunities($user);
    public function edit($community, $data);

}

?>
