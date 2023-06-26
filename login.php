<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Checking if the email and password are provided
    if (!empty($email) && !empty($password)) {
        // Database connection variables
        $host = "localhost";
        $dbusername = "root";
        $dbpassword = "";
        $dbname = "refhubproject";

        // Create a connection
        $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Prepare the SQL query with variables
        $sql = "SELECT * FROM registration WHERE email = '$email' AND pwd1 = '$password'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // User credentials are valid
            $row = $result->fetch_assoc();
            $_SESSION['email'] = $email;
            $_SESSION['usertype'] = $row['usertype']; // Store the user type in the session
            header("Location: dashboard.php"); // Redirect to the dashboard page
            exit();
        } else {
            // Invalid login credentials
            echo "Invalid email or password.";
        }

        // Close the database connection
        $conn->close();
    } else {
        echo "Please enter email and password.";
    }
}
?>
