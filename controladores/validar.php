<?php
session_start();
include "../modelo/config/autocarga.php";

header('Content-Type: application/json');

$base = new Base();

try {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $email = $_POST['email'];
        $pwd = $_POST['pwd'];

        // Validate cliente credentials
        $query = $base->link->prepare("SELECT nombre, dniCliente, pwd FROM clientes WHERE email = ?");
        $query->execute([$email]);
        $cliente = $query->fetch(PDO::FETCH_ASSOC);

        if ($cliente && password_verify($pwd, $cliente['pwd'])) {
            $_SESSION['nombre'] = $cliente['nombre'];
            $_SESSION['dniCliente'] = $cliente['dniCliente'];

            // Check if `idUnico` exists in the session
            if (isset($_SESSION['idUnico'])) {
                $idUnico = $_SESSION['idUnico'];
                // Update carrito table with the cliente's dniCliente
                $updateQuery = $base->link->prepare("UPDATE carrito SET dniCliente = ? WHERE idUnico = ?");
                $updateQuery->execute([$cliente['dniCliente'], $idUnico]);
            }

            // Save session cart items to database
            if (isset($_SESSION['cartItems'])) {
                foreach ($_SESSION['cartItems'] as $item) {
                    $addQuery = $base->link->prepare("INSERT INTO carrito (idUnico, idProducto, nombre, precio, cantidad, dniCliente) VALUES (?, ?, ?, ?, ?, ?)");
                    $addQuery->execute([$idUnico, $item['idProducto'], $item['nombre'], $item['precio'], $item['cantidad'], $cliente['dniCliente']]);
                }
                unset($_SESSION['cartItems']); // Clear the session cart items
            }

            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Invalid email or password. Please try again."]);
        }
    }
} catch (Exception $e) {
    echo json_encode(["status" => "error", "message" => $e->getMessage()]);
}