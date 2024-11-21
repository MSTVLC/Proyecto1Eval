<?php



class Carrito
{

	private $nombre;
	private $idProducto;
	private $idUnico;
	private $unidades;
	private $precio;
	private $total;

	static function getAll($link)
	{
		try {
			$consulta = "SELECT * FROM carrito";
			$result = $link->prepare($consulta);
			$result->execute();
			return $result;
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}
	function __construct($nombre, $idProducto, $idUnico, $unidades, $precio, $total)
	{

		$this->nombre = $nombre;
		$this->idProducto = $idProducto;
		$this->idUnico = $idUnico;
		$this->unidades = $unidades;
		$this->precio = $precio;
		$this->total = $total;
	}
	function buscar($link)
	{
		try {
			$consulta = "SELECT * FROM carrito where idProducto='$this->idProducto'";
			$result = $link->prepare($consulta);
			$result->execute();
			return $result->fetch(PDO::FETCH_ASSOC);
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}
	function validar($link)
	{
		try {
			$cli = $this->buscar($link);
			if (password_verify($this->pwd, $cli['pwd']))
				return $cli;
			else return false;
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}
	function insertar($link)
	{
		try {
			$consulta = "INSERT INTO carrito VALUES (:nombre,:idProducto,:idUnico,:unidades,:precio,:total)";
			$result = $link->prepare($consulta);

			$result->bindParam(':nombre', $nombre);
			$result->bindParam(':idProducto', $idProducto);
			$result->bindParam(':idUnico', $idUnico);
			$result->bindParam(':unidades', $unidades);
			$result->bindParam(':precio', $precio);
			$result->bindParam(':total', $total);

			$nombre = $this->nombre;
			$idProducto = $this->idProducto;
			$idUnico = $this->idUnico;
			$unidades = $this->unidades;
			$precio = $this->precio;
			$total = $this->totale;
			//	$pwd=password_hash($this->pwd, PASSWORD_DEFAULT);
			$result->execute();
			return $result;
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}


	//crear funcion para obtener y asignar idUnico, si esta asignado por parte de cliene obtener desde alli



	//revisar funcion modificar
	function modificar($link)
	{
		try {
			$consulta = "UPDATE carrito SET nombre='$this->nombre',  unidades='$this->unidades', precio='$this->precio', total='$this->total', WHERE idProducto='$this->idProducto'dniCliente='$this->dniCliente'";
			$result = $link->prepare($consulta);
			return $result->execute();
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}
	function borrar($link)
	{
		try {
			$consulta = "DELETE FROM carrito where idProducto='$this->idProducto'";
			$result = $link->prepare($consulta);
			return $result->execute();
		} catch (PDOException $e) {
			$dato = "¡Error!: " . $e->getMessage() . "<br/>";
			require "../vistas/mensaje.php";
			die();
		}
	}
	function __get($var)
	{
		return $this->$var;
	}
}
