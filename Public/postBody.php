<?php

echo ('<tr class="postTable">');
echo ('<td class="post">');
echo ('<table style="width: 100%;">');
echo ('<tbody style="width: 100%;">');

echo ('<tr class="postVotes">');
echo ('<td class="postVotes">');
echo ('<form method="post" style="display: inline;"><input name="postidUpvote" hidden
                                type="text" value="' . $posts[$i]['postid'] . '"><input title="upvote" type="image"
                                name="upvote" src="./IMAGES/arrow.png" class="upvoteArrow"></form>
                        <p class="upvoteP">' . $posts[$i]['upvotes'] . '</p>
                        <form method="post" style="display: inline;"><input hidden name="postidDownvote" type="text"
                                value="' . $posts[$i]['postid'] . '"><input title="downvote" type="image"
                                name="downvote" src="./IMAGES/arrow.png" class="downvoteArrow"></form>
                        <p class="upvoteP">' . $posts[$i]['downvotes'] . '</p>');
// Display the post
echo ('
                <tr class="postHeader">');
echo ('<td>');
echo ('<h2>' . $posts[$i]['title'] . '</h2>');
echo ('</td>');
echo ('</tr>');
echo ('<tr class="postContent">');
echo ('<td>');
echo ('<p>' . $posts[$i]['body'] . '</p>');
echo ('</td>');
echo ('</tr>');

echo ('<tr class="postFooter">');
echo ('<td class="postFooter">');
echo ('<p>Posted by: ' . getUsername($posts[$i]['userid'], $databaseConnection) . '</p>');
echo ('<p class="infoText">' . $posts[$i]['date'] . '</p>');
echo ('</td>');
echo ('</tr>');

echo ('
            </tbody>');
echo ('</table>');
echo ('</td>');
echo ('</tr>');

echo ('<tr id="spacer" style="height: 40px;"></tr>');