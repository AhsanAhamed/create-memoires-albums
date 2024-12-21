<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect and sanitize user input
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $dob = htmlspecialchars(trim($_POST['dob']));
    $gender = htmlspecialchars(trim($_POST['gender']));
    $password = password_hash(trim($_POST['password']), PASSWORD_BCRYPT);

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'your_database_name');

    // Check connection
    if ($conn->connect_error) {
        die('Database Connection Failed: ' . $conn->connect_error);
    }

    // Prepare SQL statement to prevent SQL injection
    $stmt = $conn->prepare("INSERT INTO users (username, email, phone, dob, gender, password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $username, $email, $phone, $dob, $gender, $password);

    // Execute and check for success
    if ($stmt->execute()) {
        // Redirect to memories.html after successful registration
        header("Location: memories.html");
        exit();
    } else {
        echo "Error: Unable to register user. Please try again.<br>" . $conn->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid Request Method. Please use the signup form.";
}
?>
