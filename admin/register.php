<!DOCTYPE html>
<html lang="en">
<?php
require __DIR__ . '/../connection/connect.php';
session_start();
error_reporting(0);

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    // Check if fields are empty
    if (empty($username) || empty($email) || empty($password)) {
        $message = "All fields are required!";
    } else {
        // Check if username or email already exists
        $check_username = mysqli_query($db, "SELECT username FROM admin WHERE username = '$username'");
        $check_email = mysqli_query($db, "SELECT email FROM admin WHERE email = '$email'");

        if (mysqli_num_rows($check_username) > 0) {
            $message = "Username already exists!";
        } elseif (mysqli_num_rows($check_email) > 0) {
            $message = "Email already exists!";
        } else {
            // Insert new admin into the database
            $sql = "INSERT INTO admin (username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($db, $sql);
            $success = "Admin registered successfully!";
        }
    }
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Registration</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="card shadow-lg p-4" style="width: 400px; border-radius: 10px;">
            <h3 class="text-center mb-4">Admin Registration</h3>
            <?php if (isset($message)) {
                echo '<div class="alert alert-danger">' . $message . '</div>';
            } ?>
            <?php if (isset($success)) {
                echo '<div class="alert alert-success">' . $success . '</div>';
            } ?>
            <form action="" method="post">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" class="form-control" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder="Enter password">
                </div>
                <button type="submit" name="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
</body>

</html>