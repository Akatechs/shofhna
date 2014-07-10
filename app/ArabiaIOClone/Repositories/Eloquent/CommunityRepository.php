<?php

/**
 * Description of CommunityRepository
 *
 * @author Hichem MHAMED
 */
namespace ArabiaIOClone\Repositories\Eloquent;

use ArabiaIOClone\Repositories\CommunityRepositoryInterface;
use Community;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Paginator;

class CommunityRepository extends AbstractRepository implements CommunityRepositoryInterface
{
    public function __construct(Community $community)
    {
        parent::__construct($community);
        
        $this->model = $community;
        
    }
    
    public function isCommunityOwnedByUser($slug, $userId)
    {
        return $this->model->whereSlug($slug)->where('creator_id','=',$userId)->exists();
    }
    
    public function subscribeToAllSuperCommunities($user)
    {
        $superCommunities = $this->model->where('createdbyuser','=',0)->get();
        foreach($superCommunities as $community)
        {
            if(!$community->subscribers->contains($user->id))
            {
                $community->subscribers()->attach($user->id);
            }
            
        }
                
    }
    public function unsubscribeFromAllSuperCommunities($user)
    {
        $superCommunities = $this->model->where('createdbyuser','=',0)->get();
        foreach($superCommunities as $community)
        {
            if($community->subscribers->contains($user->id))
            {
                $community->subscribers()->detach($user->id);
            }
            
        }
    }
    
    public function findBySlug($slug) 
    {
        return $this->model
                ->whereSlug($slug)
                ->first();
        
    }
    
    public function findById($id)
    {
        return $this->model->find($id);
    }
    
    public function findAll($orderColumn = 'created_at', $orderDir='desc')
    {
        return  $this->model
                           ->orderBy($orderColumn, $orderDir)
                           ->get();

        
    }
    
    public function findMostRecent($take = 8)
    {
        return $this->model->orderBy('created_at', 'desc')
                           ->take($take)
                           ->get();
    }
    
    public function findByUserPaginated($user, $perPage)
    {
        return $this->model->with('subscribers')
                ->with('posts')
                ->whereHas('subscribers',function  ($subscriber) use ($user){$subscriber->where('id','=',$user->id);})
                ->paginate($perPage);
    }
    
    public function findMostRecentPaginated($perPage)
    {
        return $this->model->with('subscribers')
                
                ->with('posts')
                ->orderBy('created_at', 'desc')
                ->paginate($perPage);
    }
    
    public function findMostActive($take=16)
    {
        return $this->model->leftJoin('posts', 'posts.community_id', '=', 'communities.id')
                           ->groupBy('communities.slug')
                           ->orderBy('post_count', 'desc')
                            ->take($take)
                           ->get([
                               'communities.*',
                               DB::raw('COUNT(posts.id) as post_count')
                           ]);
    }
    
    public function findMostActivePaginated($perPage)
    {
        $items= $this->model->leftJoin('posts', 'posts.community_id', '=', 'communities.id')
                           ->groupBy('communities.slug')
                           ->orderBy('post_count', 'desc')
                           ->get([
                               'communities.*',
                               DB::raw('COUNT(posts.id) as post_count')
                           ]);
        
        $paginator = Paginator::make($items->all(), count($items),$perPage);
        return $paginator;
    }
    
    public function create(array $data)
    {
        return Community::create([
            'name'=>$data['community_title'],
            'slug'=>$data['community_slug'],
            'description'=>e($data['community_description']),
            'creator_id'=>$data['creator_id'],
            'createdbyuser'=>$data['createdbyuser']
        ]);
    }
    
    public function edit($community, $data)
    {
        $community->slug = $data['community_slug'];
        $community->name = $data['community_title'];
        $community->description = e($data['community_description']);
        return $community->save();
    }
    
    public function getCommunityEditForm($slug)
    {
        return  App::make('ArabiaIOClone\Services\Forms\CommunityEditForm',[$slug]);
    }
    
    public function getCommunityCreateForm() 
    {
        return  App::make('ArabiaIOClone\Services\Forms\CommunityCreateForm');
    }
}

?>
