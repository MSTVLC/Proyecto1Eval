<?php
session_start();
include "../vistas/header.html";
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Resumen de Compras</h1>
    <?php if (isset($_SESSION['nombre'])): ?>
        <?php echo htmlspecialchars($_SESSION['nombre']); ?>
    <?php endif; ?>
</div>




<?php

include "../modelo/config/autocarga.php";

$base = new Base();

if (!isset($_SESSION['dniCliente'])) {
    header("Location: login.html");
    exit();
}

$idUnico = isset($_SESSION['idUnico']) ? $_SESSION['idUnico'] : '';

if ($idUnico) {
    // Collect cart data
    $cartItemsQuery = $base->link->prepare("SELECT * FROM carrito WHERE idUnico = ?");
    $cartItemsQuery->execute([$idUnico]);
    $cartItems = $cartItemsQuery->fetchAll(PDO::FETCH_ASSOC);

    if (empty($cartItems)) {
        exit();
    }

    // Create new order
    $dniCliente = $_SESSION['dniCliente'];
    $fecha = date('Y-m-d');
    $direccion = $_SESSION['direccion'] ?? '';  // Assuming this is set somewhere during the user's session

    $maxIdQuery = $base->link->prepare("SELECT MAX(idPedido) as maxId FROM pedidos");
    $maxIdQuery->execute();
    $maxId = $maxIdQuery->fetch(PDO::FETCH_ASSOC)['maxId'];
    $newIdPedido = $maxId + 1;

    $insertPedidoQuery = $base->link->prepare("INSERT INTO pedidos (idPedido, fecha, dniCliente, dirEntrega) VALUES (?, ?, ?, ?)");
    $insertPedidoQuery->execute([$newIdPedido, $fecha, $dniCliente, $direccion]);

    // Insert order lines
    foreach ($cartItems as $index => $item) {
        $nlinea = $index + 1;
        $insertLineQuery = $base->link->prepare("INSERT INTO lineaspedidos (idPedido, nlinea, idProducto, cantidad) VALUES (?, ?, ?, ?)");
        $insertLineQuery->execute([$newIdPedido, $nlinea, $item['idProducto'], $item['cantidad']]);
    }

    // Clear cart
    $clearCartQuery = $base->link->prepare("DELETE FROM carrito WHERE idUnico = ?");
    $clearCartQuery->execute([$idUnico]);

    // Create order summary

    $orderSummary = "<div class='container d-flex align-items-center justify-content-center min-vh-70'>";

    $orderSummary .= "<div class='row justify-content-center' style='width: 70%;'>";
    $orderSummary .= "<div class='card w-100'>";
    $orderSummary .= "<div class='card-header text-center bg-primary text-white'><h1>Pedido confirmado</h1></div>";
    $orderSummary .= "<div class='card-body' style='max-height: 70vh; overflow-y: auto;'>";
    $orderSummary .= "<p class='text-center'>Gracias por tu compra. Aquí están los detalles de tu pedido:</p>";
    $orderSummary .= "<ul class='list-group'>";
    $total = 0;
    foreach ($cartItems as $item) {
        $subtotal = $item['cantidad'] * $item['precio'];
        $total += $subtotal;
        $orderSummary .= "<li class='list-group-item'>" . htmlspecialchars($item['nombre']) . " - " . $item['cantidad'] . " x " . $item['precio'] . "€ = " . $subtotal . "€</li>";
    }
    $orderSummary .= "</ul>";
    $orderSummary .= "<p class='mt-3 text-center'><strong>Total: " . $total . "€</strong></p>";
    $orderSummary .= "<p class='text-center'>Por favor, <a href='../vistas/pago.php'>rellenar el formulario para realizar la transferencia</a></p>";

    $orderSummary .= "</div>";
    $orderSummary .= "</div>";
    $orderSummary .= "</div>";
    $orderSummary .= "</div>";
    $orderSummary .= "</div>";

    // Clear sessions
    session_unset();
    session_destroy();

    // Display order summary



    echo $orderSummary;

    include "../vistas/footer.html";

    exit();
}
?>