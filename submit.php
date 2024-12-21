<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Database Connection
    $conn = new mysqli('localhost', 'root', '', 'your_database_name');
    if ($conn->connect_error) {
        die('Connection Failed: ' . $conn->connect_error);
    }

    // Insert User Data
    $sql = "INSERT INTO users (username, email, phone, dob, gender, password) 
            VALUES ('$username', '$email', '$phone', '$dob', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to memories.html
        header("Location: memories.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
