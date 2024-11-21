<?php

include "config/autocarga.php";

$base = new Base();

header("Content-Type: application/json; charset=UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  if (isset($_POST['login'])) {
    // Login request
    $email = $_POST['email'];
    $pwd = $_POST['pass'];

    try {
      $consulta = $base->link->prepare("SELECT * FROM clientes WHERE email = ?");
      $consulta->execute([$email]);
      $cliente = $consulta->fetch(PDO::FETCH_ASSOC);



      if ($cliente && password_verify($pwd, $cliente['pwd'])) {
        echo json_encode(["status" => "success", "message" => "Login successful", "debug" => $debugInfo]);
      } else {
        header("HTTP/1.1 401 Unauthorized");
        echo json_encode(["status" => "error", "message" => "Invalid email or password.", "debug" => $debugInfo]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      header("HTTP/1.1 500 Internal Server Error");
      echo json_encode(["status" => "error", "message" => "An error occurred.", "debug" => ["exception" => $e->getMessage()]]);
    }
    exit();
  } elseif (isset($_POST['register'])) {
    // Registration request
    $dniCliente = $_POST['dni'];
    $nombre = $_POST['nom'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $pwd = $_POST['pass'];


    try {
      $cliente = new Cliente($dniCliente, $nombre, $direccion, $email, $pwd);
      $result = $cliente->insertar($base->link);

      if ($result) {
        echo json_encode(["status" => "success"]);
      } else {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(["status" => "error", "message" => "Error al registrar el cliente."]);
      }
    } catch (Exception $e) {
      error_log($e->getMessage());
      header("HTTP/1.1 500 Internal Server Error");
      echo json_encode(["status" => "error", "message" => "An error occurred during registration."]);
    }
    exit();
  }
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  try {
    if (isset($_GET['dniCliente'])) {
      // Mostrar un Cliente
      $cli = new Cliente($_GET['dniCliente']);
      $dato = $cli->buscar($base->link);
      echo json_encode($dato);
    } else {
      // Mostrar lista de clientes
      $dato = Cliente::getAll($base->link);
      $dato->setFetchMode(PDO::FETCH_ASSOC);
      echo json_encode($dato->fetchAll());
    }
  } catch (Exception $e) {
    error_log($e->getMessage());
    header("HTTP/1.1 500 Internal Server Error");
    echo json_encode(["status" => "error", "message" => "An error occurred while fetching data."]);
  }
  exit();
}
