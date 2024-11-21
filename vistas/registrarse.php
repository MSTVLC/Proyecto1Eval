<?php
session_start();
include "../modelo/config/autocarga.php";

$base = new Base();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nombre = $_POST['nom'];
    $dni = $_POST['dni'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $password = password_hash($_POST['pass'], PASSWORD_DEFAULT);

    // Insert new user into the clientes table
    $insertQuery = $base->link->prepare("INSERT INTO clientes (nombre, dniCliente, direccion, email, pwd) VALUES (?, ?, ?, ?, ?)");
    $insertQuery->execute([$nombre, $dni, $direccion, $email, $password]);

    // Create session variables
    $_SESSION['nombre'] = $nombre;
    $_SESSION['dniCliente'] = $dni;
    $_SESSION['direccion'] = $direccion;

    header("Location: ../controladores/principal.php");
    exit();
}
?>



<?php
include "header.html";
?>

<!--   <h2 class="text-center text-dark">Welcome to MZ-SHOP</h2> -->
<h3 class="text-center my-4 text-dark">Register </h3>
<div class="d-flex justify-content-center">

    <form id="registerForm" method="post" action="registrarse.php">
        <div class="mb-3">

            <input id="nom" type="text" name="nom" placeholder="Nombre" class="form-control" required>
        </div>
        <div class="mb-3">

            <input id="dni" type="text" name="dni" placeholder="DNI" class="form-control" required>
        </div>
        <div class="mb-3">

            <input id="direccion" type="text" name="direccion" placeholder="Direccion" class="form-control"
                required>
        </div>
        <div class="mb-3">

            <input id="email" type="email" name="email" placeholder="Email" class="form-control" required>
        </div>
        <div class="mb-3">

            <input id="pass" type="password" name="pass" placeholder="Password" class="form-control" required>
        </div>
        <div class="mb-3">

            <input id="cpass" type="password" name="cpass" placeholder="Confirm Password" class="form-control"
                required>
        </div>
        <div class="mb-3 text-center">
            <button type="submit" class="btn btn-primary">Register</button>
            <a href="login.html" class="btn btn-secondary">Login</a>
        </div>
    </form>
    <div id="form-errors" class="text-danger"></div>
</div>



<?php
include "footer.html";
?>