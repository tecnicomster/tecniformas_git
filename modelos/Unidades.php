<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Unidades
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO unidades (nombre,condicion) VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idunidad,$nombre)
	{
		$sql="UPDATE unidades SET nombre='$nombre' WHERE idunidad='$idunidad'";

		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idunidad)
	{
		$sql="UPDATE unidades SET condicion='0' WHERE idunidad='$idunidad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idunidad)
	{
		$sql="UPDATE unidades SET condicion='1' WHERE idunidad='$idunidad'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idunidad)
	{
		$sql="SELECT * FROM unidades WHERE idunidad='$idunidad'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM unidades";
		return ejecutarConsulta($sql); 
	}

	public function select()
	{
		$sql = "SELECT * FROM unidades WHERE idunidad='$idunidad'";
		return ejecutarConsulta($sql); 
	}
	
}

?>