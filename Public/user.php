<?php
// check if form checkbox is checked
if (isset($_POST['mode'])) {
    if ($_POST['mode']) {
        // set cookie to dark mode
        setcookie('mode', 'dark', time() + (86400 * 30), "/");
    } else {
        // set cookie to light mode
        setcookie('mode', 'light', time() + (86400 * 30), "/");
    }
} else {
    setcookie('mode', 'light', time() + (86400 * 30), "/");
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./CSS/createPostStyle.css">
    <title>Create Post</title>
</head>

<body>
    <table>
        <tr>
            <td>
                <h1>User Settings</h1>
            </td>
        </tr>
        <tr>
            <td>
                <form method="post">
                    <?php if (isset($_COOKIE['mode']) && $_COOKIE['mode'] == 'dark') {
                        echo ('<input type="checkbox" name="mode" value="theme" checked> Dark Mode');
                    } else {
                        echo ('<input type="checkbox" name="mode" value="theme"> Dark Mode');
                    } ?>
                    <input type="submit" value="Save">
                </form>
            </td>
        </tr>
    </table>
</body>

</html>