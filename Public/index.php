<!-- Home page for users who are not logged in -->

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
    <title>Poster</title>
</head>

<body>

    <center>
        <!-- Main Table -->
        <table id="mainTable">
            <tbody>
                <tr id="headerTableRow">
                    <td id="headerTableData">
                        <!-- Header Table -->
                        <table id="headerTable">
                            <tbody>
                                <tr>
                                    <td>
                                        <img src="./IMAGES/poster.png" width="38" height="38">
                                    </td>
                                    <td>
                                        <h1 style="transform: translateY(10px);">Poster</h1>
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
                                        <h2>Posts</h2>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>

    <a id="postButton" href="./post.php">
        <img id="postButtonIMG" src="./IMAGES/create.png">
    </a>
    <a id="userButton" href="./user.php">
        <img id="userButtonIMG" src="./IMAGES/user.png">
    </a>

</body>

</html>