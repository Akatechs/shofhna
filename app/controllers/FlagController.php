<?php



/**
 * Description of FlagController
 *
 * @author mhamed
 */
class FlagController extends BaseController
{
    public function postReportPostAsSpam()
    {
        if (Request::ajax())
        {
            $postId = e(Input::get('post_id'));
            if ($this->flags->reportPostAsSpam(Auth::user()->id,$postId))
            {
                return Response::json([
                    'msg'=>Lang::get('success.flag_spam'),
                    'success'=>true
                    ]);
            }else
            {
                return Response::json([
                    'msg'=>Lang::get('errors.flag_spam'),
                    'error'=>true
                    ]);
            }
        }
        
    }
    
    public function postReportCommentAsSpam()
    {
        if (Request::ajax())
        {
            $commentId = e(Input::get('comment_id'));
            if ($this->flags->reportCommentAsSpam(Auth::user()->id,$commentId))
            {
                return Response::json([
                    'msg'=>Lang::get('success.flag_spam'),
                    'success'=>true
                    ]);
            }else
            {
                return Response::json([
                    'msg'=>Lang::get('errors.flag_spam'),
                    'error'=>true
                    ]);
            }
        }
        
    }
}
