<?php
include 'dbcon.php';

$errors = [
    'username' => '',
    'email' => '',
    'password' => '',
    'cpassword' => '',
    'mobile' => '',
];

if (isset($_POST['submit'])) {
    $uname = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $cpassword = trim($_POST['cpassword']);
    $mobile = trim($_POST['mobile']);
    $isValid = true;

    // Validate username uniqueness
    $usernameQuery = "SELECT * FROM users WHERE username='$uname'";
    $usernameResult = mysqli_query($con, $usernameQuery);
    if (mysqli_num_rows($usernameResult) > 0) {
        $errors['username'] = "Username already exists.";
        $isValid = false;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
        $isValid = false;
    } else {
        // Check if email already exists
        $emailQuery = "SELECT * FROM users WHERE email='$email'";
        $emailResult = mysqli_query($con, $emailQuery);
        if (mysqli_num_rows($emailResult) > 0) {
            $errors['email'] = "Email already exists.";
            $isValid = false;
        }
    }

    // Validate password
    if (strlen($password) < 8 || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        $errors['password'] = "Password must be at least 8 characters long and include at least one special character.";
        $isValid = false;
    }

    // Confirm password
    if ($password !== $cpassword) {
        $errors['cpassword'] = "Passwords do not match.";
        $isValid = false;
    }

    // Validate mobile number
    if (!preg_match('/^[0-9]{11}$/', $mobile)) {
        $errors['mobile'] = "Mobile number must be exactly 11 digits.";
        $isValid = false;
    }

    if ($isValid) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

        $insertQuery = "INSERT INTO `users` (`username`, `password`, `email`, `mobile_number`) 
                        VALUES ('$uname', '$hashedPassword', '$email', '$mobile')";

        if (mysqli_query($con, $insertQuery)) {
            // Redirect to login.php with success message
            header("Location: login.php?message=success");
            exit();
        } else {
            echo "<p class='error-message'>Error: Unable to register.</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="./CSS/signup.css">
</head>
<body>
    <div class="sign">
        <form action="" method="post">
            <h1>Sign Up</h1>
            <p>Create your account</p>
            
            <!-- Username -->
            <label for="username">Username</label>
            <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" required>
            <span class="error"><?php echo $errors['username']; ?></span>
            
            <!-- Email -->
            <label for="email">Email</label>
            <input type="text" name="email" id="email" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>" required>
            <span class="error"><?php echo $errors['email']; ?></span>
            
            <!-- Password -->
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
            <span class="error"><?php echo $errors['password']; ?></span>
            
            <!-- Confirm Password -->
            <label for="cpassword">Repeat Password</label>
            <input type="password" name="cpassword" id="cpassword" required>
            <span class="error"><?php echo $errors['cpassword']; ?></span>
            
            <!-- Mobile Number -->
            <label for="mobile">Mobile Number</label>
            <input type="text" name="mobile" id="mobile" value="<?php echo htmlspecialchars($_POST['mobile'] ?? ''); ?>" required>
            <span class="error"><?php echo $errors['mobile']; ?></span>
            
            <!-- Submit Button -->
            <input type="submit" class="btn" name="submit" value="Register">
            
            <p>Already have an account? <a href="login.php">Login Here</a></p>
        </form>
    </div>
</body>
</html>