<?php

namespace ArabiaIOClone\Repositories;

/**
 *
 * @author mhamed
 */
interface FlagRepositoryInterface
{
    public function reportPostAsSpam($userId,$postId);
    public function reportCommentAsSpam($userId,$commentId);
}
