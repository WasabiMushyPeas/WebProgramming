<!-- Home page for users who are not logged in -->

<?php
// Setup Session variables
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require 'database.php';

// --------------------------------- User Login ---------------------------------
$tempUsername;
$tempPassword;



// --------------------------------- Database ---------------------------------

$databaseConnection = connectToDatabase();




// --------------------------------- User Login ---------------------------------
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // clean input
    $tempUsername = htmlspecialchars($username);
    $tempPassword = htmlspecialchars($password);
    // Clean input for sql injection
    $tempUsername = mysqli_real_escape_string($databaseConnection, $tempUsername);
    $tempPassword = mysqli_real_escape_string($databaseConnection, $tempPassword);

    consoleLog("Hashed password: " . hashPassword($password));

    if (!doesUserExist($username, $databaseConnection)) {
        $id = howManyUsers($databaseConnection) + 1;
        createUser($id, $username, $password, $username, $databaseConnection);
        if (loginUser($username, $password, $databaseConnection)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            $_SESSION['userid'] = getUserId($username, $databaseConnection);
            setSessionTheme($tempUsername, $databaseConnection);
            header('Location: index.php');
            exit();
        } else {
            consoleLog("Invalid username or password");
        }
    }

}


?>



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
                <tr>
                    <td>
                        <h1>Create Account</h1>
                    </td>
                </tr>
                <tr>
                    <td>
                        <form method="post">
                            <input type="text" name="username" placeholder="Username">
                            <br><br>
                            <input type="password" name="password" placeholder="Password">
                            <br><br>
                            <input type="submit" value="Create Account">
                        </form>
                    </td>
                </tr>
            </tbody>
        </table>
    </center>
</body>

</html>