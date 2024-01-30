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
                    <form action="createPost.php" method="post">
                        <input type="text" name="post" id="header" placeholder="Title">
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