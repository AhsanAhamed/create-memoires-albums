document.getElementById('loginForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    if (!username || !password) {
        alert("Both fields are required.");
        return;
    }

    const storedUser = JSON.parse(localStorage.getItem('user'));
    
    if (storedUser && storedUser.username === username && storedUser.password === password) {
        localStorage.setItem('loggedInUser', username);
        window.location.href = 'memories.html';
    } else {
        document.getElementById('loginError').style.display = "block";
    }
});

document.getElementById('showPassword').addEventListener('change', function() {
    const passwordField = document.getElementById('password');
    if (this.checked) {
        passwordField.type = 'text';
    } else {
        passwordField.type = 'password';
    }
});


document.getElementById('signupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const username = document.getElementById('username').value;
    const password = document.getElementById('password').value;
    
    if (!username || !password) {
        alert("Both fields are required.");
        return;
    }

    const newUser = {
        username: username,
        password: password
    };

    // Save new user to localStorage
    localStorage.setItem('user', JSON.stringify(newUser));
    
    alert('Sign-up successful! Now you can log in.');
    window.location.href = 'login.html';
});
