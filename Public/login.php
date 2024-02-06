<!-- Home page for users who are not logged in -->

<!DOCTYPE html>



<?php
// Setup Session variables
session_start();

if (isset($_POST['username']) && !empty($_POST['username'])) {
    // Clean the input
    $username = htmlspecialchars($_POST['username']);
    if ($username == $_POST['username']) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    } else {
        //  Alert the user to enter a valid username
        echo ('<script>alert("Please enter a valid username")</script>');
    }

} else if (isset($_POST['username']) && empty($_POST['username'])) {
    //  Alert the user to enter a username
    echo ('<script>alert("Please enter a username")</script>');
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

                <tr>
                    <td>
                        <h1>Login</h1>
                    </td>
                </tr>

                <tr>
                    <td>
                        <form method="post">
                            <input type="text" name="username" placeholder="Username">
                            <br><br>
                            <input type="text" name="password" placeholder="Password">
                            <br><br>
                            <input type="submit" value="Login">
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>
    </center>

</body>

</html>