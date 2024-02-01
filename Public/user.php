<!DOCTYPE html>

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
                                    <h1>Poster</h1>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>


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