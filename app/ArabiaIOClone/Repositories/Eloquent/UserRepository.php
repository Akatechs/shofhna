<?php

/*
 
 */

namespace ArabiaIOClone\Repositories\Eloquent;
use Illuminate\Support\Facades\Hash;

use ArabiaIOClone\Repositories\UserRepositoryInterface;
use User;

/**
 * Description of UserRepository
 *
 * @author Hichem MHAMED
 */
class UserRepository extends AbstractRepository implements UserRepositoryInterface 
{
    public function __construct(User $user)
    {
        parent::__construct($user);
        $this->model = $user;
    }
    
    public function addPostToFavorites($user, $postId)
    {
        if(!$user->favorites->contains($postId))
        {
            $user->favorites()->attach($postId);
        }
    }
    public function removePostFromFavorites($user, $postId)
    {
        if($user->favorites->contains($postId))
        {
           $user->favorites()->detach($postId); 
        }
    }
    
    public function findByFavoritePost($postId) {
        return $this->model->whereHas('favorites',function($post) use ($postId){
                        $post->where('id',$postId);
                    })->get();
    }
    
    public function subscribeToCommunity($user,$community)
    {
        if(!$user->communities->contains($community->id))
        {
            $user->communities()->attach($community->id);
        }
        
    }
    
    public function unsubscribeToCommunity($user, $community)
    {
        if($user->communities->contains($community->id))
        {
           $user->communities()->detach($community->id); 
        }
         
    }
    
    
    
    public function subscribeAllToCommunity($community)
    {
        $users =  User::all();
        foreach($users as $user)
        {
            if(!$user->communities->contains($community->id))
            {
                $user->communities()->attach($community);
            }
            
        }
    }
    public function unsubscribeAllFromCommunity($community)
    {
        $users =  User::all();
        foreach($users as $user)
        {
            if($user->communities->contains($community->id))
            {
                $user->communities()->detach($community);
            }
            
        }
    }
    
    public function updateReputation($user)
    {
        //$user = $this->model->find($userId);
        $postVotes = 0;
        foreach($user->posts()->get() as $post)
        {
            $postVotes +=  $post->sumvotes;
        }

        $commentVotes = 0;
        foreach($user->comments()->get() as $comment)
        {
            $commentVotes += $comment->sumvotes;
        }

        $reputation = $postVotes + $commentVotes; 

        $user->reputation = $reputation;
        //$user->reputation = 150;
        $user->save();
        
        
    }
    
    public function updateSettings($user, array $data)
    {
        
        $user->fullname = trim($data['fullname']) ;
        $user->email = $data['email'] != '' ? trim($data['email']) : $user->email;
        $user->bio = $data['bio'] != '' ? $data['bio'] : $user->bio;
        if(array_key_exists('oldPassword',$data) && array_key_exists('newPassword',$data))
        {
            $oldPassword = trim($data['oldPassword']);
            $newPassword = trim($data['newPassword']);
            if(Hash::check($oldPassword,$user->getAuthPassword()))
            {
                $user->password = Hash::make($newPassword);
            }
        }
        
        return $user->save();
        
    }
    
    public function getLoginForm()
    {
        return app('ArabiaIOClone\Services\Forms\LoginForm');
    }
    
    public function getAccountCreateForm()
    {
        return app('ArabiaIOClone\Services\Forms\AccountCreateForm');
    }
    
    public function getAccountEditSettingsForm()
    {
        return app('ArabiaIOClone\Services\Forms\AccountEditSettingsForm');
    }
    
    public function getRecoverPasswordForm() 
    {
        return app('ArabiaIOClone\Services\Forms\RecoverPasswordForm');
    }
    
    public function findByUsername($username)
    {
        return $this->model->whereUsername($username)->first();
    }
    
    public function findByEmail($email) 
    {
        return $this->model->whereEmail($email)->first();
    }
    
     public function findByActivationCode($code)
     {
         return $this->model
                 ->where('code','=',$code)
                 ->where('active','=',0)
                 ->first();
     }
     
    public function findByActivationCodeAndTempPassword($code)
    {
        return $this->model->where('code','=',$code)
                ->where('password_temp','!=','')
                ->first();
    }
     
    public function setActivated($user)
    {
        $user->active = 1;
        $user->code = '';
        return $user->save();
    }
    
    public function setRecoverPasswordCompleteState($user) 
    {
        $user->password = $user->password_temp;
        $user->password_temp = '';
        $user->code = '';

        return $user->save();
    }
    
    public function setRecoverPasswordRequestState($user) 
    {
        $code = str_random(60);
        $generatedPassword = str_random(10);
        $user->code = $code;
        $user->password_temp = Hash::make($generatedPassword);
        return $user->save();
    }
    
    public function findAll()
    {
        return User::all();
    }
    
    public function create(array $data)
    {
        $user = User::create(array(
            'email'=> e($data['email']),
            'username' => e($data['username']),
            'password' => Hash::make($data['password']),
            'code' => str_random(60),
            'active' => 0
        ));
        return $user;
    }
    
    public function createFromTwitter($twitterData)
    {
        $username = $twitterData->screen_name;
        $exist = $this->findByUsername($username);
        if($exist)
        {
            $username = $username."_".str_random(4);
        }
        
        $user = User::create([
                'fullname' => $twitterData->name,
                'username' => $username,
                'email'=> $username."@shofhna.com",
                'twitter_id' => $twitterData->id,
                'active' => 1
                ]);
         return $user;
    }
    
    public function findByTwitterId($twitterId)
    {
        return $this->model
                 ->where('twitter_id','=',$twitterId)
                 ->first();
    }
            
    
    
}

?>
