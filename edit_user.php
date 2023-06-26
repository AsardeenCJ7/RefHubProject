<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $usertype = $_POST['usertype'];

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

    // Update the user's password in the database
    $sql = "UPDATE registration SET usertype = '$usertype' WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

    exit();
}
?>
