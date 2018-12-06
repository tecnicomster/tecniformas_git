
<?php 
if (strlen(session_id()) < 1) 
  session_start();
require_once "../modelos/Orden.php";

$orden = new Orden();
error_reporting(E_ALL);


$iddetalle=isset($_POST["iddetalle"])?limpiarCadena($_POST["iddetalle"]):"";
$idnombre=isset($_POST["idnombre"])?limpiarCadena($_POST["idnombre"]):"";
$cliente=isset($_POST["cliente"])?limpiarCadena($_POST["cliente"]):"";
$fecha=isset($_POST["fecha"])?limpiarCadena($_POST["fecha"]):"";
$fecha_entrega=isset($_POST["fecha_entrega"])?limpiarCadena($_POST["fecha_entrega"]):"";
$peso=isset($_POST["peso"])?limpiarCadena($_POST["peso"]):"";
$color1=isset($_POST["color1"])?limpiarCadena($_POST["color1"]):"";
$cantidad=isset($_POST["cantidad"])?limpiarCadena($_POST["cantidad"]):"";
$valor=isset($_POST["valor"])?limpiarCadena($_POST["valor"]):"";
$prioridad=isset($_POST["prioridad"])?limpiarCadena($_POST["prioridad"]):"";
$observacion=isset($_POST["observacion"])?limpiarCadena($_POST["observacion"]):"";
$grupo=isset($_POST["grupo"])?limpiarCadena($_POST["grupo"]):"";
$encargado=isset($_POST["encargado"])?limpiarCadena($_POST["encargado"]):"";
$entrega=isset($_POST["entrega"])?limpiarCadena($_POST["entrega"]):"";
$usuario=$_SESSION['idusuario'];


switch ($_GET["op"]){
	case 'guardaryeditar':
	if(empty($iddetalle)){
		$rspta= $orden->insertar($idnombre,$cliente,$fecha_entrega,$peso,$color1,$cantidad,$valor,$prioridad,$observacion,$usuario,$encargado,$entrega);
		echo $rspta ? "Registrada": "No se pudo registrar";
	}
	else {
		$rspta= $articulo->editar($idorden,$cliente,$fecha_entrega,$prioridad,$encargado,$entrega);
		echo $rspta ? "actualizado": "No se pudo actualizar";	
	}

	break;

	case 'adpedido':
		$rspta=$orden ->insertarPedido($cliente,$usuario);
 		echo $rspta ? "Registrado" : "No se pudo registrar el pedido";
	break;

	case 'borrarTodo':
		$rspta=$orden ->borrarTodo($cliente,$usuario);
 		echo $rspta ? "Orden borrada" : "No se pudo borrar la Orden";
	break;

	case 'borrar':
	$rspta= $orden -> borrar($iddetalle);
	echo $rspta ? "Eliminado": "No puede ser eliminado";
	break;

	case 'activar':
	$rspta= $articulo -> activar($idarticulo);
	echo $rspta ? "Activado": "No puede ser Activado";
	break;

	case 'mostrar':
	$rspta= $articulo-> mostrar($idarticulo);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	
	case 'listar':
		$cliente=$_REQUEST["cliente"];
		$rspta=$orden->listar($cliente,$usuario);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array( 				
 				
 				"0"=>$reg->nombre,
 				"1"=>$reg->peso,
 				"2"=>$reg->color1,
 				"3"=>$reg->cantidad,
 				"4"=>$reg->valor,
 				"5"=>$reg->observacion,
 				"6"=>$reg->encargado,
 				"7"=>'<button class="btn btn-danger" onclick="borrar('.$reg->iddetalle.')"><i class="fa fa-close"></i></button>'		
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
	
	case "selectEncargado":
		require_once "../modelos/Usuario.php";
		$usuario = new Usuario();

		$rspta = $usuario->selectPlanta();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idusuario . '>' . $reg->nombre .'</option>';
				}
	break;

	case "selectPrioridad":
		
		
		$rspta = $orden->selectPrioridad();
		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idprioridad . '>' . $reg->nombre1 .'</option>';
				}
	break;

	case "selectSucursal":
		require_once "../modelos/Sucursal.php";
		$sucursal = new Sucursal();

		$rspta = $sucursal->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idsucursal . '>' . $reg->razon_social .' - '. $reg->sede .'</option>';
				}
	break;

	case "selectArticulo":
		require_once "../modelos/Articulo.php";
		$articulo = new Articulo();

		$rspta = $articulo->selectArticulo();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idarticulo . '>' . $reg->nombre .'</option>';
				}
	break;

}
 ?>