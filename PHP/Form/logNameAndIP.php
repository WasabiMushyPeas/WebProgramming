<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/php.png">
    <link rel="stylesheet" href="style.css">
    <title>PHP</title>
</head>

<body>

    Name:
    <?php
    // Check if name is set
    if (isset($_POST["name"])) {
        echo $_POST["name"];
    } else {
        echo "No name set";
    }
    ?><br>


    IP:
    <?php
    // Check if ip is set
    if (isset($_SERVER['REMOTE_ADDR'])) {
        echo $_SERVER['REMOTE_ADDR'];
    } else {
        echo "No ip set";
    }
    ?><br>

    <?php
    if (isset($_POST["name"])) {
        $name = $_POST["name"];
    } else {
        $name = "UNKNOWN";
    }
    $ip = $_SERVER['REMOTE_ADDR'];
    $file = fopen("log.txt", "a");
    fwrite($file, $name . " | " . $ip . "\n");
    fclose($file);

    // make a file for each user
    $users = fopen("users.txt", "r+");

    // check if user exists
    $userExists = false;
    while (!feof($users)) {
        $line = fgets($users);
        $line = explode(" | ", $line);
        if ($line[0] == $name && $line[0] != "UNKNOWN") {
            $userExists = true;
        }
    }
    // check if ip exists
    while (!feof($users)) {
        $line = fgets($users);
        $line = explode(" | ", $line);
        if ($line[1] == $ip) {
            $userExists = true;
        }
    }
    if (!$userExists) {
        fwrite($users, $name . " | " . $ip . "\n");
    } else {
        echo "Welcome back!";
    }
    fclose($users);
    ?>

    </form>
</body>

</html>