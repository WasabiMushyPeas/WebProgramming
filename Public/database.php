<?php
// Log to the console
function consoleLog($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP Debug: " . $output . "' );</script>";
}

// --------------------------------- Database Functions ---------------------------------
function findUserByName($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function doesUserExist($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        return true;
    } else {
        return false;
    }
}

function createUser($userid, $username, $password, $nickname, $dataBaseConnection)
{
    $sql = "INSERT INTO users (userid, username, password, nickname) VALUES ('$userid', '$username', '$password', '$nickname')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("New record created successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
    $sql = "INSERT INTO userSettings (userid, theme, postits, banned) VALUES ('$userid', 'light', '0', '0')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("New record created successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}

function getUserTheme($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM userSettings WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    $result = mysqli_query($dataBaseConnection, $sql);
    $userSettings = mysqli_fetch_assoc($result);
    return $userSettings['theme'];
}

function setUserTheme($username, $theme, $dataBaseConnection)
{
    $sql = "UPDATE userSettings SET theme = '$theme' WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("Record updated successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}

function getUserPostits($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM userSettings WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    $result = mysqli_query($dataBaseConnection, $sql);
    $userSettings = mysqli_fetch_assoc($result);
    return $userSettings['postits'];
}

function setUserPostits($username, $postits, $dataBaseConnection)
{
    $sql = "UPDATE userSettings SET postits = '$postits' WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("Record updated successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}

function getUserBanned($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM userSettings WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    $result = mysqli_query($dataBaseConnection, $sql);
    $userSettings = mysqli_fetch_assoc($result);
    return $userSettings['banned'];
}

function setUserBanned($username, $banned, $dataBaseConnection)
{
    $sql = "UPDATE userSettings SET banned = '$banned' WHERE userid = (SELECT userid FROM users WHERE username = '$username')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("Record updated successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}


// --------------------------------- Database ---------------------------------

function connectToDataBase()
{
    $dataBaseConnection = mysqli_connect('localhost', 'Jack', 'pass1234', 'poster');
    // Check the connection
    if (!$dataBaseConnection) {
        consoleLog('Connection error: ' . mysqli_connect_error());
        die('Connection error: ' . mysqli_connect_error());
    }
    return $dataBaseConnection;
}