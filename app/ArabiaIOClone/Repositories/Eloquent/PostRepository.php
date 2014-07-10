<?php


namespace ArabiaIOClone\Repositories\Eloquent;
use ArabiaIOClone\Repositories\Eloquent\AbstractRepository;
use ArabiaIOClone\Repositories\PostRepositoryInterface;
use Post;
use Slug\Slugifier;
/**
 * Description of PostRepository
 *
 * @author Hichem MHAMED
 */
class PostRepository extends AbstractRepository implements PostRepositoryInterface 
{
    public function __construct(Post $post) 
    {
        parent::__construct($post);
        $this->model =$post;
    }
    
    
    
    public function isPostOwnedByUser($slug, $userId)
    {
        return $this->model->whereSlug($slug)->whereUserId($userId)->exists();
    }
    
    public function getFlaggedPaginated($perPage = 15)
    {
        return $this->model
                    ->whereHas('flags',function($flag){
                        $flag->where('id' ,'>',-1);
                    })
                    ->orderBy('created_at','desc')
                    ->with('flags')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function incrementViews($post)
    {
        $post->views = $post->views + 1;
        $post->save();

        return $post;
    }
    
    public function findById($postId)
    {
        return $this->model->find($postId);
    }
    
    public function findByIdAndSlug($postId, $postSlug)
    {
        return $this->model->whereSlug($postSlug)
                ->whereId($postId)
                ->with('users')
                ->with('votes')
                ->with('comments')
                ->first();
    }
    
    public function findTopByCommunity($community, $perPage = 15)
    {
        return $this->model
                    ->where('community_id','=',$community->id)
                    ->orderBy('sumvotes','desc')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function findTop($perPage = 15)
    {
        return $this->model
                    ->orderBy('sumvotes','desc')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function findMostRecentByCommunity($community, $perPage = 15 )
    {
        return $this->model
                ->where('community_id','=',$community->id)
                ->orderBy('created_at','desc')
                ->with('users')
                ->with('comments')
                ->with('communities')
                ->paginate($perPage);
    }
    
    public function findMostRecent($perPage = 15 )
    {
        return $this->model
                    ->orderBy('created_at','desc')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function findByUser($user,$perPage = 15)
    {
        return $this->model
                ->where('user_id','=',$user->id)
                ->orderBy('created_at','desc')
                ->with('users')
                ->with('comments')
                ->with('communities')
                ->paginate($perPage);
                
    }
    
    public function findMostPopularByCommunity($community, $perPage = 15)
    {
        return $this->model
                ->where('community_id','=',$community->id)
                ->orderByRaw('(sumvotes) / POW(((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at))/3600)+2, 1.8) DESC')
                ->with('users')
                ->with('comments')
                ->with('communities')
                ->paginate($perPage);
    }
    
    public function findMostPopular($perPage = 15)
    {
        return $this->model
                    ->orderByRaw('(sumvotes) / POW(((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at))/3600)+2, 1.8) DESC')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function findTopByUserSubscriptions($user, $perPage = 15 )
    {
        return $this->model
                    ->whereHas('communities',function( $community) use ($user){
                        $community->whereHas('subscribers',function($subscriber) use($user){
                            $subscriber->where('id','=',$user->id);
                        });
                    })
                    ->orderBy('sumvotes','desc')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    public function findMostRecentByUserSubscriptions($user, $perPage = 15 )
    {
        return $this->model
                    ->whereHas('communities',function( $community) use ($user){
                        $community->whereHas('subscribers',function($subscriber) use($user){
                            $subscriber->where('id','=',$user->id);
                        });
                    })
                    ->orderBy('created_at','desc')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    
                    ->paginate($perPage);
        
    }
    
    public function findFavoritesPaginated($user, $perPage = 15)
    {
        return $this->model->whereHas('favoredByUsers',function($favorite) use($user){
                            $favorite->where('user_id','=',$user->id);
                        })->with('users')
                        ->with('comments')
                        ->with('communities')
                        ->paginate($perPage);
    }
    
    public function findMostPopularFromUnsubscribedCommunities($user, $perPage = 15)
    {
        return $this->model->whereNotIn('id',
                $this->model->whereHas('communities',function( $community) use ($user){
                        $community->whereHas('subscribers',function($subscriber) use($user){
                            $subscriber->where('id','=',$user->id);
                        });
                    })->lists('id')
                    )
                    ->orderByRaw('(sumvotes) / POW(((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at))/3600)+2, 1.8) DESC')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
    }
    
    public function findMostPopularByUserSubscriptions($user,$perPage = 15)
    {
        return $this->model
                ->whereHas('communities',function( $community) use ($user){
                        $community->whereHas('subscribers',function($subscriber) use($user){
                            $subscriber->where('id','=',$user->id);
                        });
                    })
                    ->orderByRaw('(sumvotes) / POW(((UNIX_TIMESTAMP(NOW()) - UNIX_TIMESTAMP(created_at))/3600)+2, 1.8) DESC')
                    ->with('users')
                    ->with('comments')
                    ->with('communities')
                    ->paginate($perPage);
        
    }
    
    public function getPostSubmitForm() 
    {
        return  app('ArabiaIOClone\Services\Forms\PostSubmitForm');
    }
    
    public function getPostEditForm() 
    {
        return  app('ArabiaIOClone\Services\Forms\PostEditForm');
    }
    
    public function edit($post, $data)
    {
        $post->link = $data['link'];
        $post->content = $data['content'];
        $post->community_id = $data['community_id'];
        return $post->save();
    }
    
    public function create($data)
    {
        //$slugifier = new Slugifier;
        //$slug = $slugifier->slugify($data['title']);
        $post =  Post::create(array(
                'title' => $data['title'],
                //'slug' => $slug,
                'link' => $data['link'],
                'content'=>$data['content'],
                'user_id' => $data['user_id'],
                'community_id' => $data['community_id']
                
            ));
        return $post;
    }
    
    public function updateVoteSum($post)
    {
        $post->sumvotes = $post->votes()->sum('vote');
        $post->save();
    }
    
    public function findBySimilarTitle($post, $take)
    {
        $posts = $this->model
                //->where('title','LIKE','%'.$post->title.'%')
                ->whereRaw(" levenshtein(`title`, '".$post->title."') BETWEEN 0 AND 12")
                ->where('community_id','=',$post->community_id)
                ->where('id','!=',$post->id)
                ->with('users')
                ->with('comments')
                ->with('communities')
                ->orderBy('created_at', 'desc')
                ->take($take)
                ->get();
        return $posts;
    }
    
    public function searchByTermPaginated($term, $perPage = 12 )
    {
        $posts = $this->model->orWhere('title','LIKE','%'.$term.'%')
                ->orWhere('content','LIKE','%'.$term.'%')
                ->orWhere('link','LIKE','%'.$term.'%')
                ->with('users')
                ->with('comments')
                ->with('communities')
                ->orderBy('created_at', 'desc')
                ->orderBy('title', 'asc')
                ->paginate($perPage);
        return $posts;
    }
}

?>
