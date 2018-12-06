<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Ciudad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre)
	{
		$sql="INSERT INTO ciudad (nombre,estado)
		VALUES ('$nombre','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idciudad,$nombre)
	{
		$sql="UPDATE ciudad SET nombre='$nombre' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idciudad)
	{
		$sql="UPDATE ciudad SET estado='0' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idciudad)
	{
		$sql="UPDATE ciudad SET estado='1' WHERE idciudad='$idciudad'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idciudad)
	{
		$sql="SELECT * FROM ciudad WHERE idciudad='$idciudad'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM ciudad";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM ciudad where estado=1";
		return ejecutarConsulta($sql);		
	}
}

?>