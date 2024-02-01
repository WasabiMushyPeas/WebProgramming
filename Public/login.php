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


            </tbody>
        </table>
    </center>

</body>

</html>