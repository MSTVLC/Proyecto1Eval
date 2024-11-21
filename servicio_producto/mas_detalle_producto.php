<?php
include "../vistas/header.html";
?>
<div class="container my-5">

    <h1 class="text-center mb-4">Detalle del Producto</h1>
    <div id="product-details" class="row justify-content-center"></div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const urlParams = new URLSearchParams(window.location.search);
    const idProducto = urlParams.get("idProducto");
    if (idProducto) {
        fetch(
                `http://localhost/Proyecto1Eval/servicio_producto/productos_api.php?idProducto=${idProducto}`
            )
            .then((response) => response.json())
            .then((product) => {
                const productDetails = document.getElementById("product-details");
                productDetails.innerHTML = `
                <div class="col-md-4">
                  <img src="../vistas/img/${product.foto}" class="img-fluid" alt="${product.nombre}">
                </div>
                <div class="col-md-8">
                  <h2>${product.nombre}</h2>
                  <p>${product.detalle}</p>
                  <ul class="list-group list-group-flush">
                    <li class="list-group-item"><strong>Marca:</strong> ${product.marca}</li>
                    <li class="list-group-item"><strong>Categoría:</strong> ${product.categoria}</li>
                    <li class="list-group-item"><strong>Peso:</strong> ${product.peso} g</li>
                    <li class="list-group-item"><strong>Unidades:</strong> ${product.unidades}</li>
                    <li class="list-group-item"><strong>Volumen:</strong> ${product.volumen} cm³</li>
                    <li class="list-group-item"><strong>Precio:</strong> ${product.precio}€</li>
                  </ul>
                  <button class="btn btn-primary mt-3" onclick="addToCart(${product.idProducto})">Add to Cart</button>
                </div>`;
            });
    } else {
        document.getElementById("product-details").innerHTML =
            "<p>Producto no encontrado.</p>";
    }
});

function addToCart(productId) {
    fetch(
            `http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php?idProducto=${productId}`
        )
        .then((response) => {
            if (!response.ok) {
                throw new Error("Network response was not ok");
            }
            return response.json();
        })
        .then((cartItems) => {
            if (Array.isArray(cartItems) && cartItems.length > 0) {
                // Product is already in the cart, update the quantity
                const cartItem = cartItems[0];
                const newQuantity = parseInt(cartItem.cantidad) + 1;

                fetch("http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php", {
                        method: "PUT",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `idCarrito=${cartItem.idCarrito}&cantidad=${newQuantity}`,
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((response) => {
                        if (response.status === "success") {
                            window.location.href = `../vistas/carrito.php`;
                        } else {
                            throw new Error(response.message);
                        }
                    })
                    .catch((error) => {
                        console.error(
                            "Error updating product quantity in cart:",
                            error
                        );
                        alert(
                            "Error actualizando la cantidad del producto en el carrito"
                        );
                    });
            } else {
                // Product is not in the cart, add as a new entry
                fetch("http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded",
                        },
                        body: `idProducto=${productId}&cantidad=1`,
                    })
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error("Network response was not ok");
                        }
                        return response.json();
                    })
                    .then((response) => {
                        if (response.status === "success") {
                            window.location.href = `../vistas/carrito.php`;
                        } else {
                            throw new Error(response.message);
                        }
                    })
                    .catch((error) => {
                        console.error("Error adding product to cart:", error);
                        alert("Error añadiendo el producto al carrito");
                    });
            }
        })
        .catch((error) => {
            console.error("Error fetching cart items:", error);
            alert("Error al obtener los productos del carrito");
        });
}
</script>


<?php
include "../vistas/footer.html";
?>