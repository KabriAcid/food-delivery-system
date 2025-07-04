<?php
session_start();
require __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../components/header.php';

if (isset($_POST['register'])) {
    try {
        $name = htmlspecialchars(trim($_POST['name']));
        $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
        $phone = htmlspecialchars(trim($_POST['phone']));
        $address = htmlspecialchars(trim($_POST['address']));
        $password = trim($_POST['password']);
        $confirm_password = trim($_POST['confirm_password']);

        if (empty($name) || empty($email) || empty($phone) || empty($address) || empty($password) || empty($confirm_password)) {
            throw new Exception("All fields are required.");
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email address.");
        }

        if ($password !== $confirm_password) {
            throw new Exception("Passwords do not match.");
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO users (name, email, password, phone, address, role) VALUES (?, ?, ?, ?, ?, 'user')");
        $stmt->execute([$name, $email, $hashedPassword, $phone, $address]);

        $_SESSION['success'] = "Registration successful. You can now log in.";
        header('Location: login.php');
        exit();
    } catch (Exception $e) {
        $_SESSION['error'] = $e->getMessage();
        header('Location: register.php');
        exit();
    }
}
?>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Register Page</h1>
        <p class="text-center">This is the registration page for the Food Delivery System.</p>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="" method="POST" class="registration-form border p-4 rounded shadow-lg bg-light">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" name="name" id="name" class="input-custom" placeholder="Full Name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" name="email" id="email" class="input-custom" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone Number</label>
                        <input type="text" name="phone" id="phone" class="input-custom" placeholder="Phone Number" required>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">Delivery Address</label>
                        <textarea name="address" id="address" class="textarea-custom" placeholder="Delivery Address" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="input-custom" placeholder="Password" required>
                    </div>
                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" class="input-custom" placeholder="Confirm Password" required>
                    </div>
                    <button type="submit" name="register" class="btn-custom w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
</body>