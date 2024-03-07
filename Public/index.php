<!-- Home page for users who are not logged in -->



<?php
// Setup Session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
@require 'database.php';

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Guest";
}
if (!isset($_SESSION['mode'])) {
    $_SESSION['mode'] = "light";
}
if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}



if (isset($_POST["postidUpvote"])) {
    if ($_SESSION['loggedIn'] == false) {
        header('Location: login.php');
    } else {
        consoleLog("upvote");
        $databaseConnection = connectToDatabase();
        upvotePost($_POST["postidUpvote"], $_SESSION['userid'], $databaseConnection);
        header('Location: index.php');
    }
}
if (isset($_POST["postidDownvote"])) {
    if ($_SESSION['loggedIn'] == false) {
        header('Location: login.php');
    } else {
        consoleLog("downvote");
        $databaseConnection = connectToDatabase();
        downvotePost($_POST["postidDownvote"], $_SESSION['userid'], $databaseConnection);
        header('Location: index.php');
    }

}
?>

<?php include 'theme.php'; ?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="icon" type="image/x-icon" href="./IMAGES/poster.png">
    <script src="./JS/script.js"></script>
    <title>Poster</title>
</head>

<body>

    <center>
        <!-- Main Table -->
        <table id="mainTable">
            <tbody>

                <?php include 'header.php'; ?>

                <tr id="spacer" style="height: 5px;"></tr>

                <tr id="filterTableRow">
                    <td id="filterTableData">
                        <table id="filterTable">
                            <tbody>
                                <tr>
                                    <td>
                                        <!-- Filter Form -->
                                        <form method="post" id="filterForm">
                                            <select name="filter" id="filter" class="filter">
                                                <?php
                                                if (isset($_POST['filter'])) {
                                                    if ($_POST['filter'] == "new") {
                                                        echo ('<option value="new" selected>New</option>');
                                                        echo ('<option value="top">Top</option>');
                                                    } else {
                                                        echo ('<option value="new">New</option>');
                                                        echo ('<option value="top" selected>Top</option>');
                                                    }
                                                } else {
                                                    echo ('<option value="new" selected>New</option>');
                                                    echo ('<option value="top">Top</option>');
                                                }
                                                ?>
                                            </select>
                                            <input type="submit" name="submit" src="./IMAGES/filter.png"
                                                class="filterButton">
                                        </form>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>

                <tr id="spacer" style="height: 20px;"></tr>

                <tr>
                    <td>
                        <table id="posts">
                            <tbody>
                                <tr>
                                    <td>
                                        <table class="postsTable">
                                            <tbody>
                                                <?php
                                                // Get posts from the database
                                                $databaseConnection = connectToDatabase();
                                                $posts = getPosts($databaseConnection);

                                                if (count($posts) > 0) {
                                                    for ($i = 0; $i < count($posts); $i++) {
                                                        echo ('<tr class="postTable">');
                                                        echo ('<td class="post">');
                                                        echo ('<table style="width: 100%;">');
                                                        echo ('<tbody style="width: 100%;">');

                                                        echo ('<tr class="postVotes">');
                                                        echo ('<td class="postVotes">');
                                                        echo ('<form method="post" style="display: inline;"><input name="postidUpvote" hidden type="text" value="' . $posts[$i]['postid'] . '"><input title="upvote" type="image" name="upvote" src="./IMAGES/arrow.png" class="upvoteArrow"></form><p class="upvoteP">' . $posts[$i]['upvotes'] . '</p><form method="post" style="display: inline;"><input hidden name="postidDownvote" type="text" value="' . $posts[$i]['postid'] . '"><input title="downvote" type="image" name="downvote" src="./IMAGES/arrow.png" class="downvoteArrow"></form><p class="upvoteP">' . $posts[$i]['downvotes'] . '</p>');
                                                        // Display the post
                                                        echo ('<tr class="postHeader">');
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

                                                        echo ('</tbody>');
                                                        echo ('</table>');
                                                        echo ('</td>');
                                                        echo ('</tr>');

                                                        echo ('<tr id="spacer" style="height: 40px;"></tr>');
                                                    }
                                                }

                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>

    <a id="postButton" class="bottomButton" href="./post.php" title="post">
        <img class="postButtonIMG" src="./IMAGES/create.png">
    </a>
    <a id="userButton" class="bottomButton2" href="./user.php" title="user settings">
        <img class="userButtonIMG" src="./IMAGES/user.png">
    </a>

</body>

</html>