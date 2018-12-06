<?php 

//incluimos inicialmente la conexion a la base de datos 
require "../config/conexion.php";

class Articulo
{
	//implementamos nuestro constructor
	public function __construct()
	{

	}

	//implementamos un metodo para insertar registros 

	public function insertar ($codigo,$nombre,$descripcion,$lineas)
	{
			$sql="INSERT INTO articulo ( codigo,nombre,descripcion,lineas,condicion) VALUES ('$codigo','$nombre','$descripcion','$lineas','1')";
			return ejecutarConsulta($sql);

	}

		public function editar ($idarticulo,$codigo,$nombre,$descripcion,$lineas)
	{
			$sql="UPDATE articulo SET codigo='$codigo',nombre='$nombre',descripcion='$descripcion',lineas='$lineas' WHERE idarticulo ='$idarticulo'";
			return ejecutarConsulta($sql);

	}

	//implementar un metodo para editar registros

	

	//implementar un metodo para desactivar registros
public function desactivar($idarticulo)
	{
		$sql = "UPDATE articulo SET condicion=0 WHERE idarticulo='$idarticulo'";
			return ejecutarConsulta($sql);

	}

	public function activar($idarticulo)
	{
		$sql = "UPDATE articulo SET condicion=1 WHERE idarticulo='$idarticulo'";
			return ejecutarConsulta($sql);

	}
	

	public function mostrar($idarticulo)
	{
		$sql = "SELECT * FROM articulo WHERE idarticulo='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql); 
	}

	//implementar un metodo para listar los registros

	public function listar()
	{
		$sql = "SELECT a.idarticulo,a.codigo,a.nombre,a.descripcion,l.nombre as lineas,a.condicion FROM articulo a INNER JOIN lineas l on l.idlineas=a.lineas";
		return ejecutarConsulta($sql); 
	}
	public function selectArticulo()
	{
		$sql="SELECT a.idarticulo,a.nombre FROM articulo a";
		return ejecutarConsulta($sql);		
	}

	public function selectLineas()
	{
		$sql="SELECT l.idlineas,l.nombre FROM lineas l";
		return ejecutarConsulta($sql);		
	}
}

 ?>