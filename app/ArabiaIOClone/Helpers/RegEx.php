<?php

namespace ArabiaIOClone\Helpers;

/**
 * Description of RegEx
 *
 * @author mhamed
 */
class RegEx {
    const YoutubeLink = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i';
    const VimeoLink ='/https?:\/\/(?:www\.)?vimeo.com\/(?:channels\/|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|)(\d+)(?:$|\/|\?)/';
    const ValidLink = "#((http|https|ftp)://(\S*?\.\S*?))(\s|\;|\)|\]|\[|\{|\}|,|\"|'|:|\<|$|\.\s)#ie";
    const ImgurLink = '(https?:\/\/i\.imgur\.com\/((?:\w{5,10}))\.(:gif|jpe?g|png))';
}
