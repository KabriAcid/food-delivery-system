<?php
require __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../components/header.php';
?>

<body>
    <div class="container-fluid">
        <h1>Register Page</h1>
        <p>This is the registration page for the Food Delivery System.</p>
        <!-- Add your registration form or content here -->
        <form action="register.php" method="POST" class="registration-form">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="text" name="phone" placeholder="Phone Number" required>
            <textarea name="address" placeholder="Delivery Address" required></textarea>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit" name="register">Register</button>
        </form>
    </div>
</body>