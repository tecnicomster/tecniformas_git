<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Sucursal
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio)
	{
		$sql="INSERT INTO sucursal(idcliente, nombre, contacto, correo, telefono, direccion, idciudad, idlocalidad, barrio, estado) VALUES ('$idcliente','$nombre','$contacto','$correo','$telefono','$direccion','$idciudad','$idlocalidad','$barrio','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idsucursal,$idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio)
	{
		$sql="UPDATE sucursal SET idcliente='$idcliente',nombre='$nombre',contacto='$contacto',correo='$correo',telefono='$telefono',direccion='$direccion',idciudad='$idciudad',idlocalidad='$idlocalidad',barrio WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para marcar direccion principal
	public function principal($idsucursal,$idcliente)
	{
		$sql="UPDATE sucursal SET facturacion='0' WHERE idcliente='$idcliente'";
		ejecutarConsulta($sql);
		$sql2="UPDATE sucursal SET facturacion='1' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql2);
	}


	//Implementamos un método para desactivar
	public function desactivar($idsucursal)
	{
		$sql="UPDATE sucursal SET estado='0' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar
	public function activar($idsucursal)
	{
		$sql="UPDATE sucursal SET estado='1' WHERE idsucursal='$idsucursal'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsucursal)
	{
		$sql="SELECT * FROM sucursal WHERE idsucursal='$idsucursal'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT s.idsucursal,s.idcliente,cl.razon_social as cliente,cl.identificacion,s.nombre,s.contacto,s.correo,s.telefono,s.direccion,s.idciudad,c.nombre as ciudad,s.idlocalidad,l.nombre as localidad,s.barrio,s.estado,s.facturacion FROM sucursal s INNER JOIN cliente cl ON s.idcliente=cl.idcliente INNER JOIN ciudad c ON s.idciudad=c.idciudad INNER JOIN localidad l ON s.idlocalidad=l.idlocalidad";
		return ejecutarConsulta($sql);		
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function select()
	{
		$sql="SELECT s.idsucursal,c.razon_social,s.nombre as sede FROM cliente c INNER JOIN sucursal s ON c.idcliente=s.idcliente where c.estado=1 ORDER BY c.razon_social";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros y mostrar sedes segun client
	public function selectSede($idcliente)
	{
		$sql="SELECT * FROM sucursal where estado=1 AND idcliente='$idcliente'";
		return ejecutarConsulta($sql);		
	}
}

?>