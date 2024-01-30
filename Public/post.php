<?php
// check theme cookie
if (isset($_COOKIE['mode']) && $_COOKIE['mode'] == 'dark') {
    echo ('<html lang="en" data-theme="dark">');
} else {
    echo ('<html lang="en" data-theme="light">');
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/style.css">
    <title>Create Post</title>
</head>

<body>
    <table>
        <tr>
            <td>
                <h1>Create Post</h1>
            </td>
        </tr>
        <tr>
            <td>
                <form action="createPost.php" method="post">
                    <textarea name="post" id="post" cols="30" rows="10" placeholder="What's on your mind?"></textarea>
                    <input type="submit" value="Post">
                </form>
            </td>
        </tr>
    </table>
</body>

</html>