<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
@require 'database.php';

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header('Location: login.php');
    exit();
}
?>

<?php include 'theme.php'; ?>

<?php
// check to see if the user posted
if (isset($_POST['post'])) {

    $databaseConnection = connectToDatabase();

    // Write the post to a text file
    $ip = $_SERVER['REMOTE_ADDR'];
    $header = $_POST['header'];
    $post = $_POST['post'];
    $username = $_SESSION['username'];

    // Limit the length of the header and post
    if (strlen($header) > 100) {
        $header = substr($header, 0, 100);
    }
    if (strlen($post) > 1000) {
        $post = substr($post, 0, 1000);
    }

    // Get current date and time year-month-day
    $date = date("Y-m-d");

    // Generate Unique ID
    $id = getNumberOfPosts($databaseConnection) + 1;

    // Clean the input
    $post = htmlspecialchars($post);
    $header = htmlspecialchars($header);
    // Clean input for sql injection
    $header = mysqli_real_escape_string($databaseConnection, $header);
    $post = mysqli_real_escape_string($databaseConnection, $post);

    createPost($_SESSION['userid'], $id, $header, $post, $date, $databaseConnection);

    // Redirect to index.php
    header('Location: index.php');
}
?>

<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <link rel="icon" type="image/x-icon" href="./IMAGES/poster.png">
    <title>Create Post</title>
</head>

<body>
    <center>
        <table id="mainTable">
            <?php include 'header.php'; ?>
            <tr>
                <td>
                    <h1>Create Post</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <form method="post">
                        <input type="text" name="header" id="header" placeholder="Title">
                        <br><br>
                        <textarea name="post" id="post" cols="30" rows="10"
                            placeholder="What's on your mind?"></textarea>
                        <br><br>
                        <input type="submit" value="Post">
                    </form>
                </td>
            </tr>
        </table>
    </center>
</body>

</html>