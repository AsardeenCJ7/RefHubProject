<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Variables needed for database connection
    $host = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "refhubproject";

    // Create a connection
    $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Delete the user from the database
    $sql = "DELETE FROM registration WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

    exit();
}
?>
