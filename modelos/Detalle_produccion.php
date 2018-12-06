<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Detalle_produccion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql = "SELECT dp.iddetalle,dp.idorden,dp.idnombre,a.nombre,dp.peso,dp.color,dp.cantidad,p.nombre1,dp.observacion,dp.estado,e.nombre as estadop,(SELECT l.nombre FROM articulo a INNER JOIN lineas l on l.idlineas=a.lineas  where dp.idnombre=a.idarticulo) as lineas,(SELECT c.razon_social FROM sucursal s INNER JOIN cliente c ON c.idcliente=s.idcliente INNER JOIN orden_produccion o ON o.cliente=s.idsucursal WHERE o.idorden=dp.idorden) as cliente FROM detalle_produccion dp INNER JOIN articulo a on dp.idnombre=a.idarticulo INNER JOIN prioridad p on dp.idprioridad=p.idprioridad INNER JOIN  estados e on e.idestado=dp.estado ";
		return ejecutarConsulta($sql); 
	}

		public function mostrar($iddetalle)
	{
		$sql = "SELECT dp.iddetalle,dp.idnombre,a.nombre,dp.peso,dp.color,dp.cantidad,p.nombre1,dp.observacion,dp.estado,e.nombre as estadop  FROM detalle_produccion dp INNER JOIN articulo a on dp.idnombre=a.idarticulo INNER JOIN prioridad p on dp.idprioridad=p.idprioridad INNER JOIN  estados e on e.idestado=dp.estado where dp.iddetalle='$iddetalle' ";
		return ejecutarConsultaSimpleFila($sql);
	}
	
	//Implementar un método para listar los registros de fabricacion
	public function fabricacion($planta)
	{
		$sql = "SELECT dp.iddetalle,dp.idorden,a.nombre,dp.peso,dp.color,dp.cantidad,p.nombre1,dp.observacion,dp.estado,e.nombre as estadop,o.fecha_entrega,o.prioridad,(SELECT l.nombre FROM articulo a INNER JOIN lineas l on l.idlineas=a.lineas  where dp.idnombre=a.idarticulo)as lineas FROM detalle_produccion dp INNER JOIN articulo a on dp.idnombre=a.idarticulo INNER JOIN prioridad p on dp.idprioridad=p.idprioridad INNER JOIN  estados e on e.idestado=dp.estado INNER JOIN orden_produccion o ON o.idorden=dp.idorden WHERE o.encargado='$planta' AND e.ver_fabrica=1 and o.estado>1 ORDER BY o.prioridad ASC,dp.idorden ASC ";
		return ejecutarConsulta($sql); 
	}

	public function desactivar($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='1' WHERE iddetalle='$iddetalle'";
		return ejecutarConsulta($sql); 
	}

	public function activar($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='7' WHERE iddetalle='$iddetalle'";
		return ejecutarConsulta($sql); 
	}
	

	public function select()
	{
		$sql = "SELECT * FROM detalle_produccion";
		return ejecutarConsulta($sql); 
	}

	public function iniciar($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='3' WHERE iddetalle='$iddetalle'";
		ejecutarConsulta($sql);
		$sql1 = "UPDATE  orden_produccion SET estado='3' WHERE orden_produccion.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle')";
		return ejecutarConsulta($sql1); 
	}
	
	public function finalizar($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='4' WHERE iddetalle='$iddetalle'";
		ejecutarConsulta($sql);
		//actualiza el estado de la orden si todos los registros de detalle tienen el mismo estado
		$sql1 = "UPDATE  orden_produccion SET estado='4' WHERE orden_produccion.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle') and (SELECT COUNT(*) FROM (select DISTINCT d.estado FROM detalle_produccion d WHERE d.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle')) as detalle)='1'";
		return ejecutarConsulta($sql1); 
	}
	
	public function almacen($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='5' WHERE iddetalle='$iddetalle'";
		ejecutarConsulta($sql);
		//actualiza el estado de la orden si todos los registros de detalle tienen el mismo estado
		$sql1 = "UPDATE  orden_produccion SET estado='5' WHERE orden_produccion.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle') and (SELECT COUNT(*) FROM (select DISTINCT d.estado FROM detalle_produccion d WHERE d.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle')) as detalle)='1'";
		return ejecutarConsulta($sql1); 
	}
	public function entrega($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='6' WHERE iddetalle='$iddetalle'";
		ejecutarConsulta($sql);
		//actualiza el estado de la orden si todos los registros de detalle tienen el mismo estado
		$sql1 = "UPDATE  orden_produccion SET estado='6' WHERE orden_produccion.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle') and (SELECT COUNT(*) FROM (select DISTINCT d.estado FROM detalle_produccion d WHERE d.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle')) as detalle)='1'";
		return ejecutarConsulta($sql1); 
	}
	
	public function pausa($iddetalle)
	{
		$sql = "UPDATE detalle_produccion SET estado='7' WHERE iddetalle='$iddetalle'";
		ejecutarConsulta($sql);
		//actualiza el estado de la orden si todos los registros de detalle tienen el mismo estado
		$sql1 = "UPDATE  orden_produccion SET estado='7' WHERE orden_produccion.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle') and (SELECT COUNT(*) FROM (select DISTINCT d.estado FROM detalle_produccion d WHERE d.idorden=(SELECT d.idorden FROM  detalle_produccion d WHERE d.iddetalle='$iddetalle')) as detalle)='1'";
		return ejecutarConsulta($sql1); 
	}
	
	
}

?>