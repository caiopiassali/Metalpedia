<?php
/**
 * Created by PhpStorm.
 * User: caiop
 * Date: 27/10/2018
 * Time: 20:52
 */

namespace core\util;

class BBCode
{

    public static function replaceBBcode($text)
    {
        $text = strip_tags($text);
        // BBcode array
        $find = array(
            '~\[b\](.*?)\[/b\]~s',
            '~\[i\](.*?)\[/i\]~s',
            '~\[u\](.*?)\[/u\]~s',
            '~\[quote\]([^"><]*?)\[/quote\]~s',
            '~\[size=([^"><]*?)\](.*?)\[/size\]~s',
            '~\[color=([^"><]*?)\](.*?)\[/color\]~s',
            '~\[url\]((?:ftp|https?)://[^"><]*?)\[/url\]~s',
            '~\[img\](https?://[^"><]*?\.(?:jpg|jpeg|gif|png|bmp))\[/img\]~s'
        );
        // HTML tags to replace BBcode
        $replace = array(
            '<strong>$1</strong>',
            '<i>$1</i>',
            '<span style="text-decoration:underline;">$1</span>',
            '<pre>$1</'.'pre>',
            '<span style="font-size:$1px;">$2</span>',
            '<span style="color:$1;">$2</span>',
            '<a href="$1">$1</a>',
            '<img src="$1" alt="" />'
        );
        // Replacing the BBcodes with corresponding HTML tags
        return preg_replace($find, $replace, $text);
    }

}