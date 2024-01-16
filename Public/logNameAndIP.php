<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/php.png">
    <title>PHP</title>
</head>
<body>
    
    Name: <?php echo $_POST["name"]; ?><br>
    IP: <?php echo $_SERVER['REMOTE_ADDR']; ?>

    <?php
        $name = $_POST["name"];
        $ip = $_SERVER['REMOTE_ADDR'];
        $file = fopen("log.txt", "a");
        fwrite($file, $name . " " . $ip . "\n");
        fclose($file);
    ?>

</form>
</body>
</html>
