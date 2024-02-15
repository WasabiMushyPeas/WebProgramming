<?php
// Log to the console
// function consoleLog($data)
// {
//     $output = $data;
//     if (is_array($output))
//         $output = implode(',', $output);

//     echo "<script>console.log('PHP Debug: " . $output . "' );</script>";
// }

// --------------------------------- Database Functions ---------------------------------
function findUser($username, $dataBaseConnection)
{
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($dataBaseConnection, $sql);
    $user = mysqli_fetch_assoc($result);
    return $user;
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