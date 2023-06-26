<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="./CSS/dashboard.css">
</head>
<body>
    <div class="container">
        <?php
        session_start();

        if (!isset($_SESSION['email'])) {
            header("Location: login.php");
            exit();
        }

        $email = $_SESSION['email'];
        $userType = $_SESSION['usertype'];

        $host = "localhost";
        $dbUsername = "root";
        $dbPassword = "";
        $dbName = "refhubproject";

        $conn = new mysqli($host, $dbUsername, $dbPassword, $dbName);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM registration";
        $result = $conn->query($sql);
        ?>

        <div class="container">
            <?php
            if ($userType == "admin") {
                echo "<h1>Welcome Admin!</h1>";
                echo "<p>You have complete control. You can add, edit, and delete all information provided by users.</p>";

                if ($result->num_rows > 0) {
                    echo "<h2>User Data</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Email</th>";
                    echo "<th>User Type</th>";
                    echo "<th>User Password</th>";
                    echo "</tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['usertype']."</td>";
                        echo "<td>".$row['pwd1']."</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No user data found.";
                }

                echo "<h2>Add User</h2>";
                echo "<form action='add_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<label>Password:</label>";
                echo "<input type='password' name='pwd1'>";
                echo "<label>User Type:</label>";
                echo "<select name='usertype'>";
                echo "<option value='admin'>Admin</option>";
                echo "<option value='staff'>Staff</option>";
                echo "<option value='user'>User</option>";
                echo "</select>";

                echo "<input type='submit' value='Add User'>";
                echo "</form>";

                echo "<h2>Edit User</h2>";
                echo "<form action='edit_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<label>New User Type:</label>";
                echo "<select name='usertype'>";
                echo "<option value='admin'>Admin</option>";
                echo "<option value='staff'>Staff</option>";
                echo "<option value='user'>User</option>";
                echo "</select>";
                echo "<input type='submit' value='Edit User'>";
                echo "</form>";

                echo "<h2>Delete User</h2>";
                echo "<form action='delete_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<input type='submit' value='Delete User'>";
                echo "</form>";

            } elseif ($userType == "staff") {
                echo "<h1>Welcome Staff!</h1>";
                echo "<p>You have limited access. You can add and edit information provided by users.</p>";

                if ($result->num_rows > 0) {
                    echo "<h2>User Data</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Email</th>";
                    echo "<th>User Type</th>";
                    echo "</tr>";

                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>".$row['email']."</td>";
                        echo "<td>".$row['usertype']."</td>";
                        echo "</tr>";
                    }

                    echo "</table>";
                } else {
                    echo "No user data found.";
                }

                echo "<h2>Add User</h2>";
                echo "<form action='add_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<label>Password:</label>";
                echo "<input type='password' name='pwd1'>";
                echo "<label>User Type:</label>";
                echo "<select name='usertype'>";
                echo "<option value='staff'>Staff</option>";
                echo "<option value='user'>User</option>";
                echo "</select>";
                echo "<input type='submit' value='Add User'>";
                echo "</form>";

                echo "<h2>Edit User</h2>";
                echo "<form action='edit_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<label>New User Type:</label>";
                echo "<select name='usertype'>";
                echo "<option value='staff'>Staff</option>";
                echo "<option value='user'>User</option>";
                echo "</select>";
                echo "<input type='submit' value='Edit User'>";
                echo "</form>";

            } elseif ($userType == "user") {
                echo "<h1>Welcome User!</h1>";
                echo "<p>You have limited access. You can add and change only your own information.</p>";

                $userSql = "SELECT * FROM registration WHERE email='$email'";
                $userResult = $conn->query($userSql);

                if ($userResult->num_rows > 0) {
                    $userRow = $userResult->fetch_assoc();
                    echo "<h2>Your User Data</h2>";
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Email</th>";
                    echo "<th>User Type</th>";
                    echo "</tr>";
                    echo "<tr>";
                    echo "<td>".$userRow['email']."</td>";
                    echo "<td>".$userRow['usertype']."</td>";
                    echo "</tr>";
                    echo "</table>";
                } else {
                    echo "No user data found.";
                }

                echo "<h2>Edit User</h2>";
                echo "<form action='edit_normal_user.php' method='POST'>";
                echo "<label>Email:</label>";
                echo "<input type='email' name='email'>";
                echo "<label>Password:</label>";
                echo "<input type='Password' name='pwd1'>";
                echo "<input type='submit' value='Edit User'>";
                echo "</form>";

            } else {
                echo "Invalid user role.";
            }

            $conn->close();
            ?>

            <a href='index.html'>Logout</a>
        </div>
    </div>
</body>
</html>
