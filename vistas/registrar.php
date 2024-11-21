<?php include "header.html"; ?>
<!-- Registrar con javascript -->
<h3 class="text-center my-4 text-dark">Registrar</h3>
<div class="d-flex justify-content-center">
    <form id="registerForm" method="post" action="registrarse.php">
        <div class="mb-3">
            <input id="nom" type="text" name="nom" placeholder="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">
            <input id="dni" type="text" name="dni" placeholder="DNI" class="form-control" required>
        </div>
        <div class="mb-3">
            <input id="direccion" type="text" name="direccion" placeholder="Direccion" class="form-control" required>
        </div>
        <div class="mb-3">
            <input id="email" type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">
            <input id="pass" type="password" name="pass" placeholder="Password" class="form-control" required>
        </div>
        <div class="mb-3">
            <input id="cpass" type="password" name="cpass" placeholder="Confirmar Password" class="form-control"
                required>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Registrar</button>
            <a href="login.php" class="btn btn-secondary">Login</a>
        </div>
    </form>
    <div id="form-errors" class="text-danger"></div>
</div>

<script>
document.getElementById("registerForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const nom = document.getElementById("nom").value;
    const dni = document.getElementById("dni").value;
    const direccion = document.getElementById("direccion").value;
    const email = document.getElementById("email").value;
    const pass = document.getElementById("pass").value;
    const cpass = document.getElementById("cpass").value;
    const formErrors = document.getElementById("form-errors");

    formErrors.innerHTML = "";

    // Simple field validation
    if (!nom || !dni || !direccion || !email || !pass || !cpass) {
        formErrors.innerHTML = "Todos los campos son obligatorios.";
        return;
    }

    if (pass !== cpass) {
        formErrors.innerHTML = "Las contraseñas no coinciden.";
        return;
    }

    // Send data to the server
    fetch("http://localhost/Proyecto1Eval/servicio_cliente/cliente_api.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded",
            },
            body: `register=true&nom=${encodeURIComponent(nom)}&dni=${encodeURIComponent(dni)}&direccion=${encodeURIComponent(direccion)}&email=${encodeURIComponent(email)}&pass=${encodeURIComponent(pass)}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("registration ok");
                window.location.href = "login.php";
            } else {
                formErrors.innerHTML = data.message;
            }
        })
        .catch(error => {
            console.error("Error:", error);
            formErrors.innerHTML = "Error al registrar el cliente.Volver a intentar";
        });
});
</script>

<?php include "footer.html"; ?>
</body>

</html>