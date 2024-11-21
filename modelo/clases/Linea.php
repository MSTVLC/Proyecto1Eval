<?php
class Linea 
	{
		private $idPedido;
		private $nlinea;	
		private $idProducto;
		private $cantidad;
		
		public function __construct($idPedido, $nlinea, $idProducto,$cantidad){
			$this->idPedido = $idPedido;
			$this->nlinea = $nlinea;
			$this->idProducto = $idProducto;
			$this->cantidad = $cantidad;
			
		}
		public function guardar(){
			$indice=$_SESSION['linea'];
			$_SESSION['nlinea'][$indice]=$this->nlinea;
			$_SESSION['idProducto'][$indice]=$this->idProducto;
			$_SESSION['cantidad'][$indice]=$this->cantidad;
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
		static function getall($link){
			try{
				$consulta = $link->prepare("SELECT * FROM lineaspedidos");
				$consulta->execute();
				return $consulta;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				require "vistas/mensaje.php";
				die();
			}
		}
		static function InsertarTodas($link){
			try{
				$consulta = $link->prepare("INSERT into lineaspedidos (idPedido, nlinea, idProducto, cantidad) values (:idPedido,:nlinea,:idProducto, :cantidad)");
				$consulta->bindParam(':idPedido',$idPedido);
				$consulta->bindParam(':nlinea',$nlinea);
				$consulta->bindParam(':idProducto',$idProducto);
				$consulta->bindParam(':cantidad',$cantidad);
				$string="<table><tr><td>Pedido</td><td>Nlinea</td><td>producto</td><td>cantidad</td></tr>";
				foreach ($_SESSION['idProducto'] as $indice => $value) {
					$idPedido=$_SESSION['idPedido'];
					$nlinea=$_SESSION['nlinea'][$indice];
					$idProducto=$_SESSION['idProducto'][$indice];
					$cantidad=$_SESSION['cantidad'][$indice];
					$consulta->execute();
					$string.="<tr><td>$idPedido</td><td> $nlinea </td><td>$idProducto</td><td> $cantidad </td></tr>";	
				}
				$string.="</table>";
				session_destroy();
				return $string;
			}
			catch(PDOException $e){
				$dato= "¡Error!: " . $e->getMessage() . "<br/>";
				require "vistas/mensaje.php";
				die();
			}
		}

	}
