<?php
session_start();

include "../modelo/config/autocarga.php";
include "../vistas/header.html";
$base = new Base();

function generateUniqueID()
{
    return bin2hex(random_bytes(16));
}

// Check if the request came from detalle.php
if (isset($_POST['idProducto'])) {
    $idProducto = $_POST['idProducto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];

    // Check if idUnico exists in the session
    if (!isset($_SESSION['idUnico'])) {
        $_SESSION['idUnico'] = generateUniqueID();
    }
    $idUnico = $_SESSION['idUnico'];
    $dniCliente = $_SESSION['dniCliente'] ?? '';

    // Store cart items in session if user is not logged in
    if (empty($dniCliente)) {
        $_SESSION['cartItems'][] = [
            'idProducto' => $idProducto,
            'nombre' => $nombre,
            'precio' => $precio,
            'cantidad' => $cantidad,
        ];
    } else {
        // Add the item to the database cart if user is logged in
        $addQuery = $base->link->prepare("INSERT INTO carrito (idUnico, idProducto, nombre, precio, cantidad, dniCliente) VALUES (?, ?, ?, ?, ?, ?)");
        $addQuery->execute([$idUnico, $idProducto, $nombre, $precio, $cantidad, $dniCliente]);
    }
}

// Handle updates to cart quantities
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $quantities = $_POST['cantidad'];
    foreach ($quantities as $idCarrito => $cantidad) {
        $updateQuery = $base->link->prepare("UPDATE carrito SET cantidad = ? WHERE idCarrito = ?");
        $updateQuery->execute([$cantidad, $idCarrito]);
    }
}

// Handle removal of items from the cart
if (isset($_GET['remove'])) {
    $idCarrito = $_GET['remove'];
    if (isset($_SESSION['dniCliente']) && isset($_SESSION['nombre'])) {
        $removeQuery = $base->link->prepare("DELETE FROM carrito WHERE idCarrito = ?");
        $removeQuery->execute([$idCarrito]);
    } else {
        // Remove from session cart
        unset($_SESSION['cartItems'][$idCarrito]);
    }
}

// Fetch the cart items from the database
$idUnico = $_SESSION['idUnico'] ?? null;
$cartItems = [];
if (isset($_SESSION['dniCliente']) && isset($_SESSION['nombre'])) {
    if ($idUnico) {
        $cartQuery = $base->link->prepare("SELECT * FROM carrito WHERE idUnico = ?");
        $cartQuery->execute([$idUnico]);
        $cartItems = $cartQuery->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    $cartItems = $_SESSION['cartItems'] ?? [];
}

$totalCost = 0;
foreach ($cartItems as $item) {
    $totalCost += $item['cantidad'] * $item['precio'];
}
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Carrito de Compras</h1>
    <?php if (isset($_SESSION['nombre'])): ?>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?></p>
    <?php endif; ?>
    <?php if (empty($cartItems)): ?>
        <p>El carrito está vacío.</p>
    <?php else: ?>
        <form method="post" action="vercarrito.php">
            <table class="table">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Precio</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                        <th>Acción</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($cartItems as $index => $item): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($item['nombre']); ?></td>
                            <td><?php echo htmlspecialchars($item['precio']); ?>€</td>
                            <td>
                                <div class="col-6">
                                    <input type="number" name="cantidad[<?php echo htmlspecialchars($item['idCarrito'] ?? $index); ?>]"
                                        value="<?php echo htmlspecialchars($item['cantidad']); ?>" min="1"
                                        class="form-control">
                                </div>
                            </td>
                            <td><?php echo htmlspecialchars($item['cantidad'] * $item['precio']); ?>€</td>
                            <td><a href="vercarrito.php?remove=<?php echo htmlspecialchars($item['idCarrito'] ?? $index); ?>"
                                    class="btn btn-danger">Eliminar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="text-right">
                <strong>Total: <?php echo htmlspecialchars($totalCost); ?>€</strong>
            </div>
            <div class="text-right">
                <button type="submit" name="update" class="btn btn-primary">Actualizar</button>
                <a href="principal.php" class="btn btn-secondary">Seguir Comprando</a>
                <?php if (!isset($_SESSION['dniCliente']) && !isset($_SESSION['nombre'])): ?>
                    <a href="../vistas/login.php" class="btn btn-success">Confirmar Pedido</a>
                <?php else: ?>
                    <a href="confirmar.php" class="btn btn-success">Confirmar Pedido</a>
                <?php endif; ?>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php
include "../vistas/footer.html";
?>