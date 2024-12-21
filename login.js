// Simulating a user list stored in localStorage
const validUsers = {
    "user123": { password: "password123", fullName: "John Doe" }
};

function handleLogin(event) {
    event.preventDefault();  // Prevent form submission to handle login via JavaScript

    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;

    // Basic validation to check if the user exists and password matches
    if (validUsers[username] && validUsers[username].password === password) {
        // Store login status and user details in localStorage
        localStorage.setItem("loggedIn", "true");
        localStorage.setItem("loggedInUser", username); // Store the logged-in user

        // Redirect to the homepage or another page
        window.location.href = "home.html"; // Example redirect to home page
    } else {
        // Show a specific error message
        alert("Invalid username or password! Please try again.");
    }
}

window.onload = function() {
    // Check if the user is logged in
    if (localStorage.getItem("loggedIn") === "true") {
        // If logged in, redirect directly to the main content page
        window.location.href = "home.html"; // Redirect to home page if already logged in
    }
};

// Optional: To handle logouts and session clearing
function logout() {
    // Clear login data from localStorage
    localStorage.removeItem("loggedIn");
    localStorage.removeItem("loggedInUser");

    // Redirect back to login page
    window.location.href = "login.html";
}
