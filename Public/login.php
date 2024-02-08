<!-- Home page for users who are not logged in -->

<?php
// Setup Session variables
session_start();

// Log to the console
function consoleLog($data)
{
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('PHP Debug: " . $output . "' );</script>";
}


// Connect to the database
$serverName = "localhost";
$serverUsername = "Jack";
$serverPassword = "";
$conn;


// Create connection
function connect($serverName, $serverUsername, $serverPassword)
{
    $conn = new mysqli($serverName, $serverUsername, $serverPassword);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo ("Connected successfully");
}

// Create the database
function createDatabase($conn)
{
    $sql = "CREATE DATABASE Poster";
    if ($conn->query($sql) === TRUE) {
        echo "Database created successfully";
    } else {
        echo "Error creating database: " . $conn->error;
    }
}


// Create the table
function createTable($conn)
{
    $sql = "CREATE TABLE Users (
    id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(30) NOT NULL,
    password VARCHAR(30) NOT NULL,
    reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";
    if ($conn->query($sql) === TRUE) {
        echo "Table Users created successfully";
    } else {
        echo "Error creating table: " . $conn->error;
    }
}

// insert data into table
function insertData($conn, $username, $password)
{
    $sql = "INSERT INTO Users (username, password)
    VALUES ('$username', '$password')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}










if (isset($_POST['username']) && !empty($_POST['username'])) {
    // Clean the input
    $username = htmlspecialchars($_POST['username']);
    if ($username == $_POST['username']) {
        $_SESSION['username'] = $username;
        $_SESSION['loggedIn'] = true;
        header('Location: index.php');
        exit();
    } else {
        //  Alert the user to enter a valid username
        echo ('<script>alert("Please enter a valid username")</script>');
    }

} else if (isset($_POST['username']) && empty($_POST['username'])) {
    //  Alert the user to enter a username
    echo ('<script>alert("Please enter a username")</script>');
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



<!DOCTYPE html>

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
                <?php include 'header.php'; ?>

                <tr>
                    <td>
                        <h1>Login</h1>
                    </td>
                </tr>

                <tr>
                    <td>
                        <form method="post">
                            <input type="text" name="username" placeholder="Username">
                            <br><br>
                            <input type="text" name="password" placeholder="Password">
                            <br><br>
                            <input type="submit" value="Login">
                        </form>
                    </td>
                </tr>

            </tbody>
        </table>
    </center>

</body>

</html>