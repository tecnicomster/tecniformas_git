<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Empresa
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$tipo_documento,$num_documento,$regimen,$iva,$direccion,$telefono,$email)
	{
		$sql="INSERT INTO empresa (nombre,tipo_documento,num_documento,regimen,iva,direccion,telefono,email)
		VALUES ('$nombre','$tipo_documento','$num_documento','$regimen','$iva','$direccion','$telefono','$email')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idempresa,$nombre,$tipo_documento,$num_documento,$regimen,$iva,$direccion,$telefono,$email)
	{
		$sql="UPDATE empresa SET nombre='$nombre',tipo_documento='$tipo_documento',num_documento='$num_documento',regimen='$regimen',iva='$iva',telefono='$telefono',direccion='$direccion',email='$email' WHERE idempresa='$idempresa'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para eliminar categorías
	public function eliminar($idempresa)
	{
		$sql="DELETE FROM empresa WHERE idempresa='$idempresa'";
		return ejecutarConsulta($sql);
	}
	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM empresa";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idempresa)
	{
		$sql="SELECT * FROM empresa WHERE idempresa='$idempresa'";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>