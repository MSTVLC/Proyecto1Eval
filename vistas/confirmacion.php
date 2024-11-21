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


<?php
        include "header.html";
     ?>


<div class="d-flex justify-content-center align-items-center vh-100">
    <div class="alert alert-success text-center" role="alert">
        <h4 class="alert-heading">¡Todo ha salido correcto!</h4>
        <p>Gracias por realizar el pago. Hemos recibido tu transferencia.</p>
    </div>
</div>


<?php
        include "header.html";
     ?>