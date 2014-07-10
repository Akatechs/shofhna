<?php

/**
 * Description of CommunitiesController
 *
 * @author Hichem MHAMED
 */
use ArabiaIOClone\Repositories\CommunityRepositoryInterface;


class CommunityController extends BaseController
{
    
   public function getEditCommunity($communitySlug)
   {
       $community = $this->communities->findBySlug($communitySlug);
        return View::make('communities.edit')
                ->with(compact('community'));
   }
   
   public function postEditCommunity($communitySlug)
   {
       
       $community = $this->communities->findBySlug($communitySlug);
       $form  = $this->communities->getCommunityEditForm($communitySlug);
       
       if(!$form->isValid())
       {
           return Redirect::route('community-edit',['communitySlug'=>$communitySlug])
                    ->withInput()
                    ->withErrors($form->getErrors());
       }
       
       $data = $form->getInputData();
       $community = $this->communities->edit($community, $data);
       if($community)
        {
            return Redirect::route('community-edit',['communitySlug'=>$communitySlug])
                ->with('success',[Lang::get('success.community_edit')]);
        }else
        {
            return Redirect::route('community-edit',['communitySlug'=>$communitySlug])
                    ->withInput()
                    ->withErrors(Lang::get('errors.community_edit'));
        }
   }

   public function postSubscribe($id)
   {
       $community = $this->communities->findById($id);
       $user = Auth::user();
       $this->users->subscribeToCommunity($user, $community);
       return Response::json(['success'=>true]);
   }
   
   public function postUnsubscribe($id)
   {
       $community = $this->communities->findById($id);
       $user = Auth::user();
       $this->users->unsubscribeToCommunity($user, $community);
       return Response::json(['success'=>true]);
   }
    
   public function getViewCommunity($communitySlug)
   {
       if($communitySlug)
       {
           $community = $this->communities->findBySlug($communitySlug);
       
            if($community)
            {
                $posts = $this->posts->findMostPopularByCommunity($community);
                $latestComments = $this->comments->findLatestCommentsByCommunity($community);
                return View::make('communities.view')
                        ->with(compact('community','posts','latestComments'));
            }
       }

           return $this->getBrowse()
                   ->withErrors([Lang::get('errors.community_notfound')]);
       
   }
   
   public function getViewCommunityRecent($communitySlug)
   {
       $community = $this->communities->findBySlug($communitySlug);
       $latestComments = $this->comments->findLatestCommentsByCommunity($community);
       if($community)
       {
           $posts = $this->posts->findMostRecentByCommunity($community);
           return View::make('communities.view')
                   ->with(compact('community','posts','latestComments'));
       }else
       {
           return $this->getBrowse()
                   ->withErrors([Lang::get('errors.community_notfound')]);
       }
   }
   
   public function getViewCommunityTop($communitySlug)
   {
       $community = $this->communities->findBySlug($communitySlug);
       $latestComments = $this->comments->findLatestCommentsByCommunity($community);
       if($community)
       {
           $posts = $this->posts->findTopByCommunity($community);
           return View::make('communities.view')
                   ->with(compact('community','posts','latestComments'));
       }else
       {
           return $this->getBrowse()
                   ->withErrors([Lang::get('errors.community_notfound')]);
       }
   }
    
    public function getBrowse()
    {
        if(Auth::check())
        {
            $communities = $this->communities->findByUserPaginated(Auth::user(),$perPage = 10);
        }else
        {
            $communities = $this->communities->findMostActivePaginated($perPage = 10);
        }
        return View::make('communities.index')
                ->with(compact('communities'));
    }
    
    public function postCreate()
    {
        $user = Auth::user();
        if(!$user)
        {
            return Redirect::route('account-login');
                    
        }
        $form = $this->communities->getCommunityCreateForm();
        if(!$form->isValid())
        {
            return Redirect::route('communities-create')
                    ->withInput()
                    ->withErrors($form->getErrors());
        }
        $data = $form->getInputData();
        $data['createdbyuser'] = $user->is_admin == true ? false :true ;
        $data['creator_id'] = $user->id ;
        if($community = $this->communities->create($data))
        {
            $this->users->subscribeToCommunity($user,$community);
            
            return Redirect::route('communities-browse-recent')
                    ->with('success',[Lang::get('success.community_create')]);
        }else
        {
            return Redirect::route('communities-create')
                    ->withInput()
                    ->withErrors(Lang::get('errors.community_create'));
        }
    }
    
    public function  getCreate()
   {
       return View::make('communities.create');
   }
    
    public function getMostActive()
    {
        $communities = $this->communities->findMostActivePaginated($perPage = 10);
        return View::make('communities.index')
                ->with(compact('communities'));
    }
    
    public function getMostRecent()
    {
        $communities = $this->communities->findMostRecentPaginated($perPage = 10);
        return View::make('communities.index')
                ->with(compact('communities'));
    }
}

?>
