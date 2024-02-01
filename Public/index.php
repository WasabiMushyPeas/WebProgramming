<!-- Home page for users who are not logged in -->

<!DOCTYPE html>



<?php
// Setup Session variables
session_start();

if (!isset($_SESSION['username'])) {
    $_SESSION['username'] = "Guest";
}
if (!isset($_SESSION['mode'])) {
    $_SESSION['mode'] = "light";
}
if (!isset($_SESSION['loggedIn'])) {
    $_SESSION['loggedIn'] = false;
}
?>

<?php
// check theme cookie
if (isset($_SESSION['mode']) && $_SESSION['mode'] == 'dark') {
    echo ('<html lang="en" data-theme="dark">');
} else {
    echo ('<html lang="en" data-theme="light">');
}
?>

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
                                        <h1>Poster</h1>
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
                                        <table>
                                            <tbody>
                                                <?php
                                                // Read the posts from the file
                                                $file = fopen("./POSTS/posts.txt", "r");

                                                // Read the file line by line
                                                while (!feof($file)) {
                                                    $line = fgets($file);

                                                    if ($line != "") {
                                                        // Split the line into an array
                                                        $lineContent = explode("|>|<|", $line);

                                                        echo ('<tr>');
                                                        echo ('<td class="post">');
                                                        echo ('<table>');
                                                        echo ('<tbody>');


                                                        // Display the post
                                                        echo ('<tr class="postHeader">');
                                                        echo ('<td>');
                                                        echo ('<h2>' . $lineContent[0] . '</h2>');
                                                        echo ('</td>');
                                                        echo ('</tr>');
                                                        echo ('<tr class="postContent">');
                                                        echo ('<td>');
                                                        echo ('<p>' . $lineContent[1] . '</p>');
                                                        echo ('</td>');
                                                        echo ('</tr>');
                                                        echo ('<tr class="postFooter">');
                                                        echo ('<td>');
                                                        echo ('<p>Posted by: ' . $lineContent[2] . ' on ' . $lineContent[3] . '</p>');
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

    <a id="postButton" href="./post.php">
        <img id="postButtonIMG" src="./IMAGES/create.png">
    </a>
    <a id="userButton" href="./user.php">
        <img id="userButtonIMG" src="./IMAGES/user.png">
    </a>

</body>

</html>