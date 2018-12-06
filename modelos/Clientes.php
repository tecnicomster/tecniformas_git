<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Clientes
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($razon_social,$identificacion,$tipo,$uso,$mercado,$obs,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio)
	{
		$sql="INSERT INTO cliente (razon_social,identificacion,tipo,uso, mercado,obs,estado,empresa)
		VALUES ('$razon_social','$identificacion','$tipo','$uso','$mercado','$obs','1','1')";
				
		$idclientenew=ejecutarConsulta_retornarID($sql);

		$sql_detalle = "INSERT INTO sucursal(idcliente, nombre, contacto, correo, telefono, direccion, idciudad, idlocalidad, barrio, estado,facturacion) VALUES ('$idclientenew','$nombre','$contacto','$correo','$telefono','$direccion','$idciudad','$idlocalidad','$barrio','1','1')";
			return ejecutarConsulta($sql_detalle);
			
	}

	//Implementamos un método para editar registros
	public function editar($idcliente,$idsucursal,$razon_social,$identificacion,$tipo,$uso,$mercado,$obs,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio)
	{
		$sql="UPDATE cliente SET razon_social='$razon_social', identificacion='$identificacion',tipo='$tipo',uso='$uso',mercado='$mercado',obs='$obs' WHERE idcliente='$idcliente'";

		ejecutarConsulta($sql);
		
		$sql1="UPDATE sucursal SET nombre='$nombre',contacto='$contacto',correo='$correo',telefono='$telefono',direccion='$direccion',idciudad='$idciudad',idlocalidad='$idlocalidad',barrio WHERE idsucursal='$idsucursal'";
		
		return ejecutarConsulta($sql1);
		
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idcliente)
	{
		$sql="UPDATE cliente SET estado='0' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idcliente)
	{
		$sql="UPDATE cliente SET estado='1' WHERE idcliente='$idcliente'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idsucursal)
	{
		$sql="SELECT c.idcliente,c.razon_social,c.identificacion,s.idsucursal,s.nombre,s.contacto,s.correo,s.telefono,s.direccion,s.idciudad,d.nombre as ciudad,s.idlocalidad,l.nombre as localidad,s.barrio,c.tipo,c.uso,c.mercado,c.obs,c.estado FROM cliente c INNER JOIN sucursal s ON c.idcliente=s.idcliente LEFT JOIN ciudad d ON s.idciudad=d.idciudad LEFT JOIN localidad l ON s.idlocalidad=l.idlocalidad WHERE s.idsucursal='$idsucursal'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT c.idcliente,c.razon_social,c.identificacion,s.idsucursal,s.nombre as sede,s.contacto,s.correo,s.telefono,s.direccion,s.idciudad,d.nombre as ciudad,s.idlocalidad,l.nombre as localidad,s.barrio,c.tipo,c.uso,c.mercado,c.obs,c.estado FROM cliente c INNER JOIN sucursal s ON c.idcliente=s.idcliente LEFT JOIN ciudad d ON s.idciudad=d.idciudad LEFT JOIN localidad l ON s.idlocalidad=l.idlocalidad";
		return ejecutarConsulta($sql);	
	}
	//Implementar un método para listar los registros y mostrar en el select
	public function selectCliente()
	{
		$sql="SELECT * FROM cliente c inner JOIN sucursal s on s.idcliente=c.idcliente where c.estado=1";
		return ejecutarConsulta($sql);		
	}
		
}

?>