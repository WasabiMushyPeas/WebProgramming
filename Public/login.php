<!-- Home page for users who are not logged in -->

<?php
// Setup Session variables
session_start();
require 'database.php';

// --------------------------------- User Login ---------------------------------
$tempUsername;
$tempPassword;

// if (isset($_POST['username']) && !empty($_POST['username'])) {
//     // Check to see if input is clean
//     $username = htmlspecialchars($_POST['username']);
//     if ($username == $_POST['username']) {
//         $tempUsername = $username;
//         exit();
//     } else {
//         //  Alert the user to enter a valid username
//         echo ('<script>alert("Please enter a valid username")</script>');
//     }

// } else if (isset($_POST['username']) && empty($_POST['username'])) {
//     //  Alert the user to enter a username
//     echo ('<script>alert("Please enter a username")</script>');
// }

// if (isset($_POST['password']) && !empty($_POST['password'])) {
//     // Check to see if input is clean
//     $password = htmlspecialchars($_POST['password']);
//     if ($password == $_POST['password']) {
//         $tempPassword = $password;
//         exit();
//     } else {
//         //  Alert the user to enter a valid password
//         echo ('<script>alert("Please enter a valid password")</script>');
//     }

// } else if (isset($_POST['password']) && empty($_POST['password'])) {
//     //  Alert the user to enter a password
//     echo ('<script>alert("Please enter a password")</script>');
// }




// --------------------------------- Database ---------------------------------

$databaseConnection = connectToDatabase();




// --------------------------------- User Login ---------------------------------
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // clean input
    $tempUsername = htmlspecialchars($username);
    $tempPassword = htmlspecialchars($password);

    consoleLog("Hashed password: " . hashPassword($password));
    if ($tempUsername == $username && $tempPassword == $password) {
        if (loginUser($username, $password, $databaseConnection)) {
            $_SESSION['loggedIn'] = true;
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            consoleLog("Invalid username or password or user does not exist");
        }
    } else {
        consoleLog("Username and password are not clean");
    }

    if (!doesUserExist($username, $databaseConnection)) {
        createUser(uniqid(), $username, $password, $username, $databaseConnection);
    }
}






// $user = findUserByName('Jackson', $databaseConnection);
// consoleLog($user['username']);



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