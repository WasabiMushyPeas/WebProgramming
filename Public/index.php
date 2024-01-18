<html lang="en" data-theme="light">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/images/php.png">
    <link rel="stylesheet" href="CSS/style.css">
    <script src="JS/script.js"></script>
    <title>PHP</title>
</head>

<body>
    <div class="inputBox">
        <form action="logNameAndIP.php" method="post">
            <div>
                <input class="nameInput" type="text" name="name" value="Name"><br>
            </div>
            <div>
                <input class="submitButton" type="submit">
            </div>
        </form>
    </div>

    <div class="themeSwitcher" onclick="onThemeSwitch()">
        <img id="themeSwitcherIMG" src="images/moon.png" alt="light" onclick="switchTheme()">
    </div>
</body>

</html>