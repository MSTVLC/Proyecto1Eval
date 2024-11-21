<?php
include "header.html";

?>

<body>
    <div class="container my-5">
        <h1 class="text-center mb-4">Carrito de Compras</h1>
        <div id="cart-items" class="row"></div>
        <div id="cart-total" class="text-right mt-3"></div>
        <div class="text-right mt-3">
            <a href="../servicio_producto/detalle_producto.php">
                <button class="btn btn-danger">Seguir Comprando</button></a>
            <button class="btn btn-danger" onclick="emptyCart()">
                Vaciar Carrito
            </button>
            <button class="btn btn-primary" onclick="checkout()">Pagar</button>
            <!--  <button class="btn btn-primary mt-2" onclick="updateCart()">Actualizar</button> -->
        </div>
    </div>

    <script>
    document.addEventListener("DOMContentLoaded", function() {
        fetchCart();
    });

    function fetchCart() {
        fetch("http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php")
            .then((response) => response.json())
            .then((data) => {
                const cartItems = document.getElementById("cart-items");
                cartItems.innerHTML = "";

                let totalCost = 0;

                if (data.length === 0) {
                    cartItems.innerHTML = "<p>El carrito está vacío.</p>";
                    return;
                }

                data.forEach((item) => {
                    const itemDiv = document.createElement("div");
                    itemDiv.className = "col-12 mb-3";
                    itemDiv.innerHTML = `
                <div class="card">
                  <div class="card-body d-flex align-items-center">
                    <img src="img/${item.foto}" class="img-thumbnail mr-3" style="width: 100px;" alt="${item.nombre}">
                    <div class="flex-grow-1">
                      <h5 class="card-title">${item.nombre}</h5>
                      <p class="card-text">Precio: ${item.precio}€</p>
                      <div class="d-flex align-items-center">
                        <button class="btn btn-outline-secondary" onclick="changeQuantity(${item.idCarrito}, -1)">-</button>
                        <input type="number" value="${item.cantidad}" min="1" class="form-control mx-2" style="width: 60px;" data-id="${item.idCarrito}" onchange="updateQuantity(${item.idCarrito}, this.value)">
                        <button class="btn btn-outline-secondary" onclick="changeQuantity(${item.idCarrito}, 1)">+</button>
                      </div>
                      <button class="btn btn-danger mt-2" onclick="removeFromCart(${item.idCarrito})">Eliminar</button>
                      
                    </div>
                  </div>
                </div>`;
                    cartItems.appendChild(itemDiv);
                    totalCost += item.precio * item.cantidad;
                });

                document.getElementById(
                    "cart-total"
                ).innerHTML = `<h4>Total: ${totalCost}€</h4>`;
            });
    }

    function changeQuantity(idCarrito, change) {
        const input = document.querySelector(`input[data-id='${idCarrito}']`);
        let newQuantity = parseInt(input.value) + change;
        if (newQuantity < 1) newQuantity = 1;
        input.value = newQuantity;
        updateQuantity(idCarrito, newQuantity);
    }

    function updateQuantity(idCarrito, cantidad) {
        if (cantidad < 1) return;

        fetch("http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php", {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify({
                    idCarrito: idCarrito,
                    cantidad: cantidad
                }),
            })
            .then((response) => response.json())
            .then(() => {
                fetchCart();
            });
    }

    function removeFromCart(idCarrito) {
        fetch(
                `http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php?idCarrito=${idCarrito}`, {
                    method: "DELETE",
                }
            )
            .then((response) => response.json())
            .then(() => {
                fetchCart();
            });
    }

    function emptyCart() {
        fetch(
                "http://localhost/Proyecto1Eval/servicio_carrito/controlador/cart_api.php?action=empty", {
                    method: "DELETE",
                }
            )
            .then((response) => response.json())
            .then(() => {
                fetchCart();
            });
    }

    function checkout() {
        window.location.href = "../controladores/confirmar.php";

    }


    /*   function updateCart(productId) {
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
                                  window.location.href = `carrito.php`;
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
                  } 
              })
              .catch((error) => {
                  console.error("Error fetching cart items:", error);
                  alert("Error al obtener los productos del carrito");
              });
      } */
    </script>

    <!-- <a href="../controladores/vercarrito.php" class="btn btn-primary">Actualizar</a> -->



    <?php
include "footer.html";
?>