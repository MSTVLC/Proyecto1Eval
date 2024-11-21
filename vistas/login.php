<?php
include "header.html";
?>

<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="text-center">
        <h1 class="p-4">Iniciar sesión</h1>
        <form id="loginForm" class="mx-auto" style="max-width: 400px;">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label text-dark">Email address</label>
                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                    placeholder="Email">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label text-dark">Password</label>
                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
            <a href="registrar.php" class="btn btn-primary">Register</a>

        </form>
        <div id="login-errors" class="text-danger mt-3"></div>
    </div>
</div>

<script>
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("exampleInputEmail1").value;
    const pass = document.getElementById("exampleInputPassword1").value;
    const loginErrors = document.getElementById("login-errors");

    loginErrors.innerHTML = "";

    if (!email || !pass) {
        loginErrors.innerHTML = "Both fields are required.";
        return;
    }

    fetch("http://localhost/web/controladores/validar.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `login=true&email=${encodeURIComponent(email)}&pwd=${encodeURIComponent(pass)}`,
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                window.location.href = "../controladores/vercarrito.php";
            } else {
                loginErrors.innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error("Error:", error);
            loginErrors.innerHTML = "Error during login.";
        });
});
</script>



<?php
include "footer.html";
?>