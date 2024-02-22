<?php
session_start();
// Log to the console
function consoleLog($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP Debug: " . $output . "' );</script>";
}

function consoleLogArray($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP Debug: " . $output . "' );</script>";
}

// --------------------------------- Database Hash and Salt ---------------------------------
function hashPassword($password)
{
    $salt = 'TfwGlrTWSC';
    $hashedPassword = hash('sha256', $password . $salt);
    return $hashedPassword;
}

// --------------------------------- Database User Functions ---------------------------------
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
    $password = hashPassword($password);
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

function setSessionTheme($username, $dataBaseConnection)
{
    $theme = getUserTheme($username, $dataBaseConnection);
    if ($theme == 1) {
        $_SESSION['mode'] = 'dark';
    } else {
        $_SESSION['mode'] = 'light';
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

function loginUser($username, $password, $dataBaseConnection)
{
    if (doesUserExist($username, $dataBaseConnection) == false) {
        return false;
    } else {
        $user = findUserByName($username, $dataBaseConnection);
        if ($user['password'] == hashPassword($password)) {
            return true;
        } else {
            return false;
        }
    }

}

function getUserId($username, $dataBaseConnection)
{
    $sql = "SELECT userid FROM users WHERE username = '$username'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user['userid'];
}

function getUsername($userid, $dataBaseConnection)
{
    $sql = "SELECT username FROM users WHERE userid = '$userid'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user['username'];
}


// --------------------------------- Database Post Functions ---------------------------------
function createPost($userid, $postid, $title, $body, $date, $dataBaseConnection)
{
    $sql = "INSERT INTO posts (userid, postid, title, body, upvotes, downvotes, date) VALUES ('$userid', '$postid', '$title', '$body', '0', '0', '$date')";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("New record created successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}

function getPost($postid, $dataBaseConnection)
{
    $sql = "SELECT * FROM posts WHERE postid = '$postid'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $post = mysqli_fetch_assoc($result);
    return $post;
}

function getPostsFromUser($userid, $dataBaseConnection)
{
    $sql = "SELECT * FROM posts WHERE userid = '$userid'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $posts = mysqli_fetch_assoc($result);
    return $posts;
}

function getPosts($dataBaseConnection)
{
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($dataBaseConnection, $sql);
    $posts = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $posts;
}


function setPostUpvotes($postid, $upvotes, $dataBaseConnection)
{
    $sql = "UPDATE posts SET upvotes = '$upvotes' WHERE postid = '$postid'";
    if (mysqli_query($dataBaseConnection, $sql)) {
        consoleLog("Record updated successfully");
    } else {
        consoleLog("Error: " . $sql . "<br>" . mysqli_error($dataBaseConnection));
    }
}

function setPostDownvotes($postid, $downvotes, $dataBaseConnection)
{
    $sql = "UPDATE posts SET downvotes = '$downvotes' WHERE postid = '$postid'";
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