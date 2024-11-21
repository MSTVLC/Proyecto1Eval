<!DOCTYPE html>
<html lang="es">

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

    <title>Formulario Pago</title>
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
            <h2 class="text-center mb-4">Formulario de Cobro por Transferencia</h2>
            <form action="confirmacion.php" method="post">
                <div class="mb-3">
                    <label for="nombre" class="form-label">Nombre Completo</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="cuenta" class="form-label">Número de Cuenta</label>
                    <input type="text" class="form-control" id="cuenta" name="cuenta" required>
                </div>
                <div class="mb-3">
                    <label for="monto" class="form-label">Importe a Pagar</label>
                    <input type="number" class="form-control" id="monto" name="monto" step="0.01" required>
                </div>
                <div class="mb-3">
                    <label for="concepto" class="form-label">Concepto de la Transferencia</label>
                    <input type="text" class="form-control" id="concepto" name="concepto" required>
                </div>
                <button type="submit" class="btn btn-primary">Realizar Pago</button>
            </form>
        </div>

        <!-- Footer -->
        <footer class="footer  py-3  bg-primary ">
            <div class="container d-flex justify-content-between">
                <span>

                    <strong>Location</strong>: Calle Cervantes 10, Valencia

                </span>
                <span>

                    <strong>Contact Us</strong>: Email mz@gmail.com | Tlf: 96009677
                </span>
            </div>
        </footer>

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>

</html>