<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Lineas
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO lineas (nombre,descripcion,condicion) VALUES ('$nombre','$descripcion','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idlineas,$nombre,$descripcion)
	{
		$sql="UPDATE lineas SET nombre='$nombre',descripcion='$descripcion' WHERE idlineas='$idlineas'";

		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idlineas)
	{
		$sql="UPDATE lineas SET condicion=0 WHERE idlineas='$idlineas'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idlineas)
	{
		$sql="UPDATE lineas SET condicion=1 WHERE idlineas='$idlineas'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idlineas)
	{
		$sql="SELECT * FROM lineas WHERE idlineas='$idlineas'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT * FROM lineas";
		return ejecutarConsulta($sql); 
	}

	public function select()
	{
		$sql = "SELECT * FROM lineas WHERE idlineas='$idlineas'";
		return ejecutarConsulta($sql); 
	}
	
}

?>