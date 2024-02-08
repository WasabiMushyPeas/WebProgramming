<?php
session_start();

// If the user is not logged in, redirect to the login page
if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] == false) {
    header('Location: login.php');
    exit();
}


// check if form checkbox is checked
if (isset($_POST['mode'])) {
    if ($_POST['mode'] == 'dark') {
        $_SESSION['mode'] = 'dark';
    } else {
        $_SESSION['mode'] = 'light';
    }
}

?>

<?php include 'theme.php'; ?>

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
                    <h1>User Settings</h1>
                </td>
            </tr>
            <tr>
                <td>
                    <form method="post">
                        <?php
                        if (isset($_SESSION['mode']) && $_SESSION['mode'] == 'dark') {
                            echo ('<input type="radio" name="mode" value="dark" checked> Dark Mode');
                            echo ('<br>');
                            echo ('<input type="radio" name="mode" value="light"> Light Mode');
                            echo ('<br>');
                        } else {
                            echo ('<input type="radio" name="mode" value="dark"> Dark Mode');
                            echo ('<br>');
                            echo ('<input type="radio" name="mode" value="light" checked> Light Mode');
                            echo ('<br>');
                        }
                        ?>
                        <input type="submit" value="Save">
                    </form>
                </td>
            </tr>

        </table>
    </center>
</body>

</html>