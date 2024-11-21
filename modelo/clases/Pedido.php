<?php
	class Pedido 
	{
		private $idPedido;
		private $fecha;	
		private $dniCliente;
		
		
		public function __construct($idPedido, $fecha, $dniCliente){
			$this->idPedido = $idPedido;
			$this->fecha = date('Y-m-d', strtotime($fecha));
			$this->dniCliente = $dniCliente;
			
		}
		public function guardar(){
			$_SESSION['idPedido']=$this->idPedido;
			$_SESSION['fecha']=$this->fecha;
			$_SESSION['dniCliente']=$this->dniCliente;
			
		}
		
		public function __set($propiedad, $var){
			if(property_exists(__CLASS__, $propiedad)){
				$this->$propiedad = $var;
			}
		}
		public function __get($propiedad){
			if(property_exists(__CLASS__, $propiedad)){
				return $this->$propiedad;
			}
		}
		function Existe($link){
			try{
				$consulta = $link->prepare("SELECT * FROM pedidos where idPedido='$this->idPedido'");
				$consulta->execute();
				return $consulta->fetch(PDO::FETCH_ASSOC);
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				require "vistas/mensaje.php";
				die();
			}
		}
		function Insertar($link){
			try{
				$consulta = $link->prepare("INSERT into pedidos (idPedido, fecha, dniCliente) values ('$this->idPedido','$this->fecha','$this->dniCliente')");
				$consulta->execute();
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				require "vistas/mensaje.php";
				die();
			}
		}
	}
