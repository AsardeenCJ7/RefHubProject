<?php
$email = $_POST['email'];
$pwd1 = $_POST['pwd1'];
$pwd2 = $_POST['pwd2'];

# Checking all inputs are given before registering to the database
if (!empty($email) && !empty($pwd1) && !empty($pwd2)) {
    # Variables needed for database connection
    $host = "localhost";
    $dbusername = "root";
    $dbpassword = "";
    $dbname = "refhubproject";

    // Create a connection
    $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if the email already exists in the database
    $existingEmailQuery = "SELECT * FROM registration WHERE email = '$email'";
    $existingEmailResult = mysqli_query($conn, $existingEmailQuery);

    if (mysqli_num_rows($existingEmailResult) > 0) {
        echo "This email is already registered. Please use a different email.";
    } else {
        // Validate password match
        if ($pwd1 !== $pwd2) {
            echo "Passwords do not match.";
        } else {
            $user = "user"; // Default user role
            $sql = "INSERT INTO registration (email, pwd1, pwd2, usertype) VALUES ('$email', '$pwd1', '$pwd2', '$user')";

            if ($conn->query($sql) === TRUE) {
                echo "Registration successful! Please proceed to login.";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    // Close the database connection
    $conn->close();
} else {
    echo "All fields are required.";
}
?>
