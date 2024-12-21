<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the email
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);

    // Validate the email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Generate a unique token for password reset
    $token = bin2hex(random_bytes(32)); // This generates a random token

    // Store the token in your database with an expiration time and link it to the user’s email
    // Example: (You'll need a real database for this)
    // db_query("INSERT INTO password_resets (email, token, expiry) VALUES (?, ?, ?)", [$email, $token, time() + 3600]);

    // Create the password reset link (you should replace your domain)
    $resetLink = "https://yourwebsite.com/reset-password.php?token=$token";

    // Set up the email message
    $subject = "Password Reset Request";
    $message = "Please click the link below to reset your password:\n$resetLink";
    $headers = "From: no-reply@yourwebsite.com";

    // Send the password reset email
    if (mail($email, $subject, $message, $headers)) {
        echo "A password reset link has been sent to your email.";
    } else {
        echo "Failed to send reset email. Please try again later.";
    }
}
?>
