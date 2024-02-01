<!DOCTYPE html>

<?php
// check theme cookie
if (isset($_COOKIE['mode']) && $_COOKIE['mode'] == 'dark') {
    echo ('<html lang="en" data-theme="dark">');
} else {
    echo ('<html lang="en" data-theme="light">');
}
?>

<?php
// check to see if the user posted
if (isset($_POST['post'])) {
    // Write the post to a text file
    $ip = $_SERVER['REMOTE_ADDR'];
    $file = fopen("./POSTS/posts.txt", "a");
    $header = $_POST['header'];
    $post = $_POST['post'];

    // Limit the length of the header and post
    if (strlen($header) > 100) {
        $header = substr($header, 0, 100);
    }
    if (strlen($post) > 10000) {
        $post = substr($post, 0, 10000);
    }

    // Get current date and time
    $date = date('m/d/Y h:i a', time());

    // Generate a random ID
    $id = date('YmdHis', time()) . rand(1000, 9999);

    // Remove newlines from the post
    $post = str_replace("\n", "", $post);
    $header = str_replace("\n", "", $header);
    $post = str_replace("|>|<|", "", $post);
    $header = str_replace("|>|<|", "", $header);

    // Clean the input
    $post = htmlspecialchars($post);
    $header = htmlspecialchars($header);

    fwrite($file, $header . " |>|<| " . $post . " |>|<| " . $ip . "|>|<|" . $date . "|>|<|" . $id . "\n");
    fclose($file);

    // Redirect to index.php
    header('Location: index.php');
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Create Post</title>
</head>

<body>
    <center>
        <table id="mainTable">
            <tr id="headerTableRow">
                <td id="headerTableData">
                    <!-- Header Table -->
                    <table id="headerTable">
                        <tbody>
                            <tr>
                                <td>
                                    <a href="./index.php"><img src="./IMAGES/poster.png" width="38" height="38"></a>
                                </td>
                                <td>
                                    <h1 style="transform: translateY(10px);">Poster</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
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