<?php 

//incluimos inicialmente la conexion a la base de datos 
require "../config/conexion.php";

class Orden
{
	//implementamos nuestro constructor
	public function __construct()
	{

	}

	//implementamos un metodo para insertar registros 

	public function insertar($idnombre,$cliente,$fecha_entrega,$peso,$color1,$cantidad,$valor,$prioridad,$observacion,$usuario,$encargado,$entrega)
	{
		$sql="INSERT INTO detalle_p(idnombre,cliente,fecha,fecha_entrega,peso,color1,cantidad,valor,prioridad,observacion,grupo,encargado,entrega) VALUES ('$idnombre','$cliente',curdate(),'$fecha_entrega','$peso','$color1','$cantidad','$valor','$prioridad','$observacion',concat('$cliente','$usuario'),'$encargado','$entrega')";
		return ejecutarConsulta($sql);
	}

	//funcion para editar el encabezado de la orden de produccion
	public function editar ($idorden,$cliente,$fecha_entrega,$prioridad,$encargado,$entrega)
	{
			$sql="UPDATE orden_produccion SET cliente='$cliente',fecha_entrega='$fecha_entrega',prioridad='$prioridad',encargado='$encargado',entrega='$entrega' WHERE idorden ='$idorden'";
			return ejecutarConsulta($sql);

	}

	public function insertarPedido($cliente,$usuario)
	{
		$sql="INSERT INTO orden_produccion(cliente,fecha,fecha_entrega,estado,total,factura,cotizacion,prioridad,encargado,entrega)SELECT cliente,fecha,fecha_entrega,2,sum(valor),0,0,prioridad,encargado,entrega FROM detalle_p where grupo=concat('$cliente','$usuario')";
		 $idorden=ejecutarConsulta_retornarID($sql);

		 $sql1="INSERT INTO detalle_produccion( idorden,idnombre,peso,color,cantidad,idprioridad,observacion,estado) select '$idorden',idnombre,peso,color1,cantidad,prioridad,observacion,'2' from detalle_p where grupo=concat('$cliente','$usuario')";

		 ejecutarConsulta($sql1);

		 $sql2="DELETE FROM detalle_p where grupo=concat('$cliente','$usuario')" ;

		 return ejecutarConsulta($sql2);

	}

	//implementar un metodo para eliminar registros
	public function borrar($iddetalle)
	{
		$sql = "DELETE FROM detalle_p WHERE iddetalle='$iddetalle' ";
			return ejecutarConsulta($sql);

	}

	//implementar un metodo para borrar todo
	public function borrarTodo($cliente,$usuario)
	{
		$sql = "DELETE FROM detalle_p WHERE grupo=concat('$cliente','$usuario')";
			return ejecutarConsulta($sql);

	}

	//implementar un metodo para listar los registros

	public function listar($cliente,$usuario)
	{
		$sql = "SELECT d.iddetalle,a.nombre,d.cliente,d.peso,d.color1,d.cantidad,d.valor,d.observacion,u.nombre as encargado FROM detalle_p d INNER JOIN articulo a on d.idnombre=a.idarticulo INNER JOIN usuario u on u.idusuario=d.encargado WHERE d.grupo=concat('$cliente','$usuario')";

		return ejecutarConsulta($sql); 
	}
	public function selectArticulo()
	{
		$sql="SELECT a.idarticulo,a.nombre FROM articulo a";
		return ejecutarConsulta($sql);		
	}

	public function selectPrioridad()
	{
		$sql = "SELECT * FROM prioridad ORDER BY idprioridad DESC";
		return ejecutarConsulta($sql); 
	}
}

 ?>