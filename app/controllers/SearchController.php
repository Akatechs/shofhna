<?php



/**
 * Description of SearchController
 *
 * @author mhamed
 */
class SearchController extends BaseController
{
    public function getSearchPosts($perPage = 12)
    {
       $term = e(Input::get('keyword'));
       $posts = null;

        if (! empty($term)) {
            $posts = $this->posts->searchByTermPaginated($term, $perPage);
        }

        return View::make('search.result.posts', compact('posts', 'term')); 
    }
}
