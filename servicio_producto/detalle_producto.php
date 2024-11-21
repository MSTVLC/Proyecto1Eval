 <?php
include "../vistas/header.html";

?>

 <h1>Productos</h1>
 <div id="product-list" class="container-fluid no-border my-4">
     <div class="row" id="products-row"></div>
 </div>
 <div id="product-details" class="product-details"></div>


 <script>
document.addEventListener("DOMContentLoaded", function() {
    fetch("http://localhost/Proyecto1Eval/servicio_producto/productos_api.php")
        .then((response) => response.json())
        .then((data) => {
            const productsRow = document.getElementById("products-row");
            data.forEach((product) => {
                const productDiv = document.createElement("div");
                productDiv.className = "col-6 col-md-4 col-lg-2 mb-4";
                productDiv.innerHTML = `
          <div class="card">
            <img src="../vistas/img/${product.foto}" class="card-img-top" alt="${product.nombre}">
            <div class="card-body">
              <h5 class="card-title">${product.nombre}</h5>
              <p class="card-text">${product.precio}€</p>
              <button onclick="showProduct(${product.idProducto})" class="btn btn-primary">Ver Detalles</button>
            </div>
          </div>`;
                productsRow.appendChild(productDiv);
            });
        });
});

function showProduct(id) {
    window.location.href = `mas_detalle_producto.php?idProducto=${id}`;
}
 </script>


 <?php
include "../vistas/footer.html";

?>