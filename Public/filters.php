<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

function sortPostsTop($posts)
{
    $sortedPosts = $posts;
    if (count($posts) > 1) {
        for ($i = 0; $i < count($posts); $i++) {
            for ($j = 0; $j < count($posts); $j++) {
                if ($sortedPosts[$i]['upvotes'] - $sortedPosts[$i]['downvotes'] > $sortedPosts[$j]['upvotes'] - $sortedPosts[$j]['downvotes']) {
                    $temp = $sortedPosts[$i];
                    $sortedPosts[$i] = $sortedPosts[$j];
                    $sortedPosts[$j] = $temp;
                }
            }
        }

        // reverse the array to get the highest upvoted posts first
        $sortedPosts = array_reverse($sortedPosts);
    }
    return $sortedPosts;
}
