<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Estados
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	public function select()
	{
		$sql = "SELECT * FROM estados WHERE condicion='1'";
		return ejecutarConsulta($sql); 
	}

	
	
}

?>