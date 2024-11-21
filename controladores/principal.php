<?php
session_start();
include "../modelo/config/autocarga.php";
include "../vistas/header.html";
/* include "../vistas/principal_productos.php"; */


$base = new Base();

$productsQuery = $base->link->prepare("SELECT * FROM productos");
$productsQuery->execute();
$products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

// Count the number of items in the cart
$cartCountQuery = $base->link->prepare("SELECT COUNT(*) as total FROM carrito");
$cartCountQuery->execute();
$cartCount = $cartCountQuery->fetch(PDO::FETCH_ASSOC)['total'];

?>
<div class="container my-5">
    <h1 class="text-center mb-4">Bienvenido a MZ</h1>
    <h2 class="text-center mb-4">Últimas unidades a la venta con Rebajas</h2>
    <a href="productos.php">Ver todos los productos</a>

    <?php if (isset($_SESSION['nombre'])): ?>
        <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</p>
    <?php endif; ?>

    <div class="row mt-4">
        <?php foreach ($products as $product): ?>
            <div class="col-md-3">
                <div class="card mb-2">
                    <img src="../vistas/img/<?php echo htmlspecialchars($product['foto']); ?>" class="card-img-top"
                        alt="<?php echo htmlspecialchars($product['nombre']); ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['nombre']); ?></h5>
                        <p class="card-text">Precio: <?php echo htmlspecialchars($product['precio']); ?>€</p>
                        <a href="detalle.php?idProducto=<?php echo htmlspecialchars($product['idProducto']); ?>"
                            class="btn btn-primary">Ver Detalle</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<?php
include "../vistas/footer.html";
?>