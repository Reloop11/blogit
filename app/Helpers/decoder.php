<?php

use App\Models\Post;

if (!function_exists("specialsDecode")) {
    function specialsDecode(string $data, bool $replaceBreaklines = true) {
        /* Decode Special database characters
         * The tags are converted from &{tag}& to <tag>
         * If $reaplaceBreaklines is true \r\n will be replaced with <br>
         */

        $tags = ['b', 'i', 'u'];
        $data = stripslashes($data);

        foreach($tags as $tag) {
            $data = preg_replace('/&{'.$tag.'}&/i', '<'.$tag.'>', $data);
            $data = preg_replace('#&{/'.$tag.'}&#i', '</'.$tag.'>', $data);
        }

        if ($replaceBreaklines) {
            $data = preg_replace('/\r\n/', '<br>', $data);
        }

        return $data;
    }
}

if (!function_exists("decodePost")) {
    function decodePost(Post $post) : Post {
        $post->title = specialsDecode($post->title);
        $post->body = specialsDecode($post->body);
        return $post;
    }
}