<?php


namespace ArabiaIOClone\Presenters\Media;

/**
 *
 * @author mhamed
 */
interface MediaPresenterInterface
{
    public function getMediaId();
    public function getMediaEmbedHtml();
    public function getMediaType();
    public function getMediaThumbnailUrl();
    public function getMediaShowInplaceButton();
}
