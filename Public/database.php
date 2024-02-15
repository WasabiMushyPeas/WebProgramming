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