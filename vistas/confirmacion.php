<!-- ?php
    require('path/to/fpdf.php');

    class PDF extends FPDF
    {
    function Header()
    {
    // Set up a header if needed
    }

    function Footer()
    {
    // Set up a footer if needed
    }

    function Content()
    {
    // Add content to the PDF
    $this->SetFont('Arial', 'B', 14);
    $this->Cell(0, 10, utf8_decode('¡Todo ha salido correcto!'), 0, 1, 'C');

    $this->SetFont('Arial', '', 12);
    $this->MultiCell(0, 10, utf8_decode('Gracias por realizar el pago. Hemos recibido tu transferencia.'), 0, 'C');
    }
    }

    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->Content();
    $pdf->Output('D', 'confirmation.pdf'); // 'D' means force download
    ?>
    -->




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../vistas/estilos/style.css">

    <title>Confirmacion Pago</title>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../vistas/img/mobile_resized.png" alt="">MZ
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
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
    <div class="d-flex justify-content-center align-items-center vh-100">
        <div class="alert alert-success text-center" role="alert">
            <h4 class="alert-heading">¡Todo ha salido correcto!</h4>
            <p>Gracias por realizar el pago. Hemos recibido tu transferencia.</p>
        </div>
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