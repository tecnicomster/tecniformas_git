<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Localidad
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre, $idciudad)
	{
		$sql="INSERT INTO localidad (nombre,idciudad,estado)
		VALUES ('$nombre','$idciudad','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idlocalidad,$nombre, $idciudad)
	{
		$sql="UPDATE localidad SET nombre='$nombre',idciudad='$idciudad' WHERE idlocalidad='$idlocalidad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idlocalidad)
	{
		$sql="UPDATE localidad SET estado='0' WHERE idlocalidad='$idlocalidad'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idlocalidad)
	{
		$sql="UPDATE localidad SET estado='1' WHERE idlocalidad='$idlocalidad'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idlocalidad)
	{
		$sql="SELECT * FROM localidad WHERE idlocalidad='$idlocalidad'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT l.idlocalidad, l.nombre, l.idciudad, c.nombre as ciudad, l.estado FROM localidad l INNER JOIN ciudad c ON l.idciudad=c.idciudad ";
		return ejecutarConsulta($sql);	
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT * FROM localidad where estado=1";
		return ejecutarConsulta($sql);		
	}
}

?>