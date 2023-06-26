<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $pwd1 = $_POST['pwd1'];
    $pwd2 = $_POST['pwd1'];
    $userType = $_POST['usertype'];

    // Perform necessary operations to add the user to the database
    // Replace the following code with your database interaction code

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

    // Perform the database insert operation
    $sql = "INSERT INTO registration (email, pwd1,pwd2, usertype) VALUES ('$email', '$pwd1', '$pwd2', '$userType')";
    if ($conn->query($sql) === TRUE) {
        echo "User added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();

    // Redirect back to the admin dashboard or any other page
    //header("Location: admin_dashboard.php");
    exit();
}
?>
