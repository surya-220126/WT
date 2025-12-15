// Register
const registerForm = document.getElementById("registerForm");
if (registerForm) {
    registerForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const user = {
            name: document.getElementById("name").value,
            email: document.getElementById("email").value,
            password: document.getElementById("password").value
        };

        localStorage.setItem("user", JSON.stringify(user));
        alert("Registration successful!");
        window.location.href = "login.html";
    });
}

// Login
const loginForm = document.getElementById("loginForm");
if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
        e.preventDefault();

        const storedUser = JSON.parse(localStorage.getItem("user"));

        const email = document.getElementById("loginEmail").value;
        const password = document.getElementById("loginPassword").value;

        if (storedUser && email === storedUser.email && password === storedUser.password) {
            alert("Login successful!");
            window.location.href = "dashboard.html";
        } else {
            alert("Invalid credentials!");
        }
    });
}
