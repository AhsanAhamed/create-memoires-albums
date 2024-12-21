<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form data
    $username = filter_var(trim($_POST['username']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL);
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Invalid email format!";
        exit;
    }

    // Validate password match
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
        exit;
    }

    // Check password strength
    if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password) || !preg_match('/[!@#$%^&*(),.?":{}|<>]/', $password)) {
        echo "Password must contain at least one letter, one number, and one special character.";
        exit;
    }

    // Hash the password securely using bcrypt
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Set the email recipient and subject
    $to = "webengineeringstudent@gmail.com"; // Replace with your email address
    $subject = "New Sign Up Submission";

    // Compose the email message
    $message = "
    Username: $username\n
    Email: $email\n
    Date of Birth: $dob\n
    Gender: $gender\n
    Password: (hashed for security)\n
    ";

    // Set the email headers
    $headers = "From: webengineeringstudent@gmail.com"; // Replace with your email or domain

    // Send the email (this is just an example, consider using a more secure email sending method like PHPMailer)
    if (mail($to, $subject, $message, $headers)) {
        echo "Thank you for signing up! A confirmation email has been sent.";
    } else {
        echo "There was an error. Please try again.";
    }
}
?>
