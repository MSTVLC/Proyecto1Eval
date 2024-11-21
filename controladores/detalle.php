<?php
session_start();
include "../vistas/header.html";
include "../modelo/config/autocarga.php";

$base = new Base();

if (!isset($_GET['idProducto'])) {
    die("Product ID not specified.");
}

$idProducto = $_GET['idProducto'];

// Fetch product details
$productQuery = $base->link->prepare("SELECT * FROM productos WHERE idProducto = ?");
$productQuery->execute([$idProducto]);
$product = $productQuery->fetch(PDO::FETCH_ASSOC);

if (!$product) {
    die("Product not found.");
}
?>

<div class="container my-5">
    <h1 class="text-center mb-4">Detalle del Producto</h1>
    <?php if (isset($_SESSION['nombre'])): ?>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</p>
    <?php endif; ?>
    <div class="row justify-content-center">
        <div class="col-md-4">
            <img id="img_detalle" src="../vistas/img/<?php echo htmlspecialchars($product['foto']); ?>" alt="<?php echo htmlspecialchars($product['nombre']); ?>">
        </div>
        <div class="col-md-8">
            <h2><?php echo htmlspecialchars($product['nombre']); ?></h2>
            <p><?php echo htmlspecialchars($product['detalle']); ?></p>
            <ul class="list-group list-group-flush">
                <li class="list-group"><strong>Marca:</strong> <?php echo htmlspecialchars($product['marca']); ?></li>
                <li class="list-group"><strong>Categoría:</strong> <?php echo htmlspecialchars($product['categoria']); ?></li>
                <li class="list-group"><strong>Peso:</strong> <?php echo htmlspecialchars($product['peso']); ?> g</li>
                <li class="list-group"><strong>Unidades:</strong> <?php echo htmlspecialchars($product['unidades']); ?></li>
                <li class="list-group"><strong>Volumen:</strong> <?php echo htmlspecialchars($product['volumen']); ?> cm³</li>
                <li class="list-group"><strong>Precio:</strong> <?php echo htmlspecialchars($product['precio']); ?>€</li>
            </ul>
            <form action="vercarrito.php" method="post" class="mt-3 text-center">
                <input type="hidden" name="idProducto" value="<?php echo htmlspecialchars($product['idProducto']); ?>">
                <input type="hidden" name="nombre" value="<?php echo htmlspecialchars($product['nombre']); ?>">
                <input type="hidden" name="precio" value="<?php echo htmlspecialchars($product['precio']); ?>">
                <div class="form-group">
                    <label for="cantidad" class="d-block">Cantidad:</label>
                    <div class="d-flex justify-content-center">
                        <div class="col-2">
                            <input type="number" class="form-control" id="cantidad" name="cantidad" value="1" min="1" required>
                        </div>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-3">Comprar</button>
            </form>
        </div>
    </div>
</div>

<?php
include "../vistas/footer.html";
?>