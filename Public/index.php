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

if (isset($_POST['filter'])) {
    $_SESSION['filter'] = $_POST['filter'];
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
                                    <td id="filterTableData">
                                        <!-- Filter Form -->
                                        <form method="post" id="filterForm">
                                            <select name="filter" id="filter" class="filter">
                                                <?php
                                                if (isset($_SESSION['filter'])) {
                                                    if ($_SESSION['filter'] == "new") {
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
                                                @require 'filters.php';
                                                // Get posts from the database
                                                $databaseConnection = connectToDatabase();
                                                $posts = getPosts($databaseConnection);

                                                if (isset($_SESSION['filter'])) {
                                                    if ($_SESSION['filter'] == "top") {
                                                        $posts = sortPostsTop($posts);
                                                    }
                                                }

                                                if (count($posts) > 0) {
                                                    for ($i = count($posts) - 1; $i > 0; $i--) {
                                                        @require 'postBody.php';
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