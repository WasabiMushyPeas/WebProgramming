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
                                                // // Read the posts from the file
                                                // $file = fopen("./POSTS/posts.txt", "r");
                                                
                                                // // Read the file line by line
                                                // while (!feof($file)) {
                                                //     $line = fgets($file);
                                                
                                                //     if ($line != "") {
                                                //         // Split the line into an array
                                                //         $lineContent = explode("|>|<|", $line);
                                                
                                                //         echo ('<tr class="postTable">');
                                                //         echo ('<td class="post">');
                                                //         echo ('<table style="width: 100%;">');
                                                //         echo ('<tbody style="width: 100%;">');
                                                

                                                //         // Display the post
                                                //         echo ('<tr class="postHeader">');
                                                //         echo ('<td>');
                                                //         echo ('<h2>' . $lineContent[0] . '</h2>');
                                                //         echo ('</td>');
                                                //         echo ('</tr>');
                                                //         echo ('<tr class="postContent">');
                                                //         echo ('<td>');
                                                //         echo ('<p>' . $lineContent[1] . '</p>');
                                                //         echo ('</td>');
                                                //         echo ('</tr>');
                                                //         echo ('<tr class="postFooter">');
                                                //         echo ('<td class="postFooter">');
                                                //         echo ('<p>Posted by: ' . $lineContent[2] . '</p>');
                                                //         echo ('<p class="infoText">' . $lineContent[3] . '</p>');
                                                //         echo ('</td>');
                                                //         echo ('</tr>');
                                                
                                                //         echo ('</tbody>');
                                                //         echo ('</table>');
                                                //         echo ('</td>');
                                                //         echo ('</tr>');
                                                
                                                //         echo ('<tr id="spacer" style="height: 40px;"></tr>');
                                                
                                                //     }
                                                // }
                                                
                                                // fclose($file);
                                                
                                                // Get posts from the database
                                                $databaseConnection = connectToDatabase();
                                                $posts = getPosts($databaseConnection);

                                                if (count($posts) > 0) {
                                                    for ($i = 0; $i < count($posts); $i++) {
                                                        echo ('<tr class="postTable">');
                                                        echo ('<td class="post">');
                                                        echo ('<table style="width: 100%;">');
                                                        echo ('<tbody style="width: 100%;">');

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

    <a id="postButton" class="bottomButton" href="./post.php">
        <img id="postButtonIMG" src="./IMAGES/create.png">
    </a>
    <a id="userButton" class="bottomButton2" href="./user.php">
        <img id="userButtonIMG" src="./IMAGES/user.png">
    </a>

</body>

</html>