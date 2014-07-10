<?php



/**
 *
 * @author Hichem MHAMED
 */

namespace ArabiaIOClone\Repositories;

interface UserRepositoryInterface 
{
    /**
     * get forms
     */
    public function getLoginForm();
    public function getAccountCreateForm();
    public function getRecoverPasswordForm();
    
    public function updateReputation($user);
    
    public function updateSettings($user, array $data);
    
    public function findByUsername($username);
    public function findByEmail($email);
    public function findByTwitterId($twitterId);
    public function findByActivationCode($code);
    public function findByActivationCodeAndTempPassword($code);
    
    public function findAll();

//    
//    public function findByEmail($email);
//    
    public function create(array $data);
    public function setActivated($user);
    public function setRecoverPasswordRequestState($user);
    public function setRecoverPasswordCompleteState($user);
    
    public function subscribeAllToCommunity($community);
    public function unsubscribeAllFromCommunity($community);
    public function subscribeToCommunity($user,$community);
    public function unsubscribeToCommunity($user,$community);
    
    public function addPostToFavorites($user, $postId);
    public function removePostFromFavorites($user, $postId);
    public function findByFavoritePost($postId);
    public function createFromTwitter($twitterData);
    
}

?>
