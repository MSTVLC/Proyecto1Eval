<?php
session_start();

include "../modelo/config/autocarga.php";

$base = new Base();

$productsQuery = $base->link->prepare("SELECT * FROM productos");
$productsQuery->execute();
$products = $productsQuery->fetchAll(PDO::FETCH_ASSOC);

// Count the number of items in the cart
$cartCountQuery = $base->link->prepare("SELECT COUNT(*) as total FROM carrito");
$cartCountQuery->execute();
$cartCount = $cartCountQuery->fetch(PDO::FETCH_ASSOC)['total'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../vistas/estilos/style.css">

    <title>Productos</title>
</head>

<body>
    <div class="container-fluid">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-primary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">
                    <img src="../vistas/img/mobile_resized.png" alt="">MZ
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="input-group rounded bg-primary">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-primary border-0" id="search-addon">
                                <i class="fas fa-search text-black"></i>
                                <input type="search" class="form-control rounded border-0 bg-primary text-black"
                                    placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                            </span>
                        </div>
                    </div>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link" href="../index.php">
                                <img src="../vistas/img/home(1).svg" alt="Inicio">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.html">
                                <img src="../vistas/img/login_7856156(1).png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="vercarrito.php">
                                <img src="../vistas/img/carrito.png" alt="">
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <img src="../vistas/img/user.png" alt="">
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <div class="container my-5">
            <h2 class="text-center mb-4">Últimas unidades de Apple a la venta con Rebajas</h2>
            <?php if (isset($_SESSION['nombre'])): ?>
                <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['nombre']); ?>!</p>
            <?php endif; ?>

            <div class="row mt-4">
                <?php foreach ($products as $product): ?>
                    <div class="col-md-2">
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

        <!-- Footer -->
        <footer class="footer py-3 bg-primary">
            <div class="container d-flex justify-content-between">
                <span>
                    <strong>Location</strong>: Calle Cervantes 10, Valencia
                </span>
                <span>
                    <strong>Contact Us</strong>: Email mz@gmail.com | Tlf: 96009677
                </span>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>