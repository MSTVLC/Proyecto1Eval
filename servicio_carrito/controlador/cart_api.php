<?php
session_start();
include "../config/autocarga.php";

$base = new Base();

// Function to generate a unique ID if not set
function generateUniqueID()
{
    return bin2hex(random_bytes(16));
}

// Ensure user is logged in
if (!isset($_SESSION['dniCliente'])) {
    echo json_encode(["status" => "error", "message" => "User not logged in"]);
    exit();
}

$dniCliente = $_SESSION['dniCliente'];

// Ensure idUnico exists in the session
if (!isset($_SESSION['idUnico'])) {
    $_SESSION['idUnico'] = generateUniqueID();
}
$idUnico = $_SESSION['idUnico'];

// Add product to cart
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $idProducto = $_POST['idProducto'];
    $cantidad = $_POST['cantidad'] ?? 1;

    // Check if the product is already in the cart
    $checkQuery = $base->link->prepare("SELECT * FROM carrito WHERE idProducto = ? AND idUnico = ?");
    $checkQuery->execute([$idProducto, $idUnico]);
    $existingItem = $checkQuery->fetch(PDO::FETCH_ASSOC);

    if ($existingItem) {
        // Update the quantity of the existing item
        $newQuantity = $existingItem['cantidad'] + $cantidad;
        $updateQuery = $base->link->prepare("UPDATE carrito SET cantidad = ? WHERE idCarrito = ?");
        $updateQuery->execute([$newQuantity, $existingItem['idCarrito']]);
        echo json_encode(["status" => "success", "message" => "Cantidad del producto actualizada"]);
    } else {
        // Add the product as a new entry
        $insertQuery = $base->link->prepare("INSERT INTO carrito (idUnico, dniCliente, idProducto, cantidad) VALUES (?, ?, ?, ?)");
        $insertQuery->execute([$idUnico, $dniCliente, $idProducto, $cantidad]);
        echo json_encode(["status" => "success", "message" => "Producto añadido al carrito"]);
    }
    exit();
}

// Fetch cart items
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['idProducto'])) {
        // Fetch specific cart item based on product ID
        $idProducto = $_GET['idProducto'];
        $consulta = $base->link->prepare("SELECT * FROM carrito WHERE idProducto = ? AND idUnico = ?");
        $consulta->execute([$idProducto, $idUnico]);
        echo json_encode($consulta->fetchAll(PDO::FETCH_ASSOC));
    } else {
        // Fetch all cart items
        $consulta = $base->link->prepare("SELECT c.idCarrito, p.idProducto, p.nombre, p.precio, c.cantidad, p.foto 
                                           FROM carrito c 
                                           JOIN productos p ON c.idProducto = p.idProducto 
                                           WHERE c.idUnico = ?");
        $consulta->execute([$idUnico]);
        echo json_encode($consulta->fetchAll(PDO::FETCH_ASSOC));
    }
    exit();
}

// Update cart item quantity
if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    parse_str(file_get_contents("php://input"), $_PUT);
    $idCarrito = $_PUT['idCarrito'];
    $cantidad = $_PUT['cantidad'];
    $consulta = $base->link->prepare("UPDATE carrito SET cantidad = ? WHERE idCarrito = ?");
    $consulta->execute([$cantidad, $idCarrito]);
    echo json_encode(["status" => "success", "message" => "Cantidad actualizada"]);
    exit();
}

// Remove cart items
if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['idCarrito'])) {
        // Remove specific cart item
        $idCarrito = $_GET['idCarrito'];
        $consulta = $base->link->prepare("DELETE FROM carrito WHERE idCarrito = ?");
        $consulta->execute([$idCarrito]);
        echo json_encode(["status" => "success", "message" => "Producto eliminado del carrito"]);
    } else {
        // Empty the cart
        $consulta = $base->link->prepare("DELETE FROM carrito WHERE idUnico = ?");
        $consulta->execute([$idUnico]);
        echo json_encode(["status" => "success", "message" => "Carrito vaciado"]);
    }
    exit();
}
