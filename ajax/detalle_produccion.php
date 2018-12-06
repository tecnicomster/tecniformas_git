

<?php 
if (strlen(session_id()) < 1) 
  session_start();


require_once "../modelos/Detalle_produccion.php";

$produccion=new Detalle_produccion();

$planta=$_SESSION["idusuario"];
$iddetalle=isset($_POST["iddetalle"])?limpiarCadena($_POST["iddetalle"]):"";
$idorden=isset($_POST["idorden"])?limpiarCadena($_POST["idorden"]):"";

switch ($_GET["op"]){

	case 'listar':
		$rspta=$produccion->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

 				"0"=>'OP-'.$reg->idorden,
 				"1"=>$reg->cliente,
 				"2"=>$reg->nombre,
 				"3"=>$reg->peso,
 				"4"=>$reg->color,
 				"5"=>$reg->cantidad,
 			    "6"=>$reg->nombre1,
 				"7"=>$reg->observacion,
 				"8"=>$reg->lineas,
 				"9"=>$reg->estadop,
 				"10"=>($reg->estado>1)? '<button class="btn btn-warning" onclick="mostrar('.$reg->iddetalle.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->iddetalle.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->iddetalle.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->iddetalle.')"><i class="fa fa-check"></i></button>'

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'fabricacion':
		$rspta=$produccion->fabricacion($planta);
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(

 				"0"=>'OP-'.$reg->idorden,
 				"1"=>$reg->nombre1,
 				"2"=>$reg->nombre,
 				"3"=>$reg->lineas,
 				"4"=>$reg->peso,
 				"5"=>$reg->color,
 			    "6"=>$reg->cantidad,
 				"7"=>$reg->fecha_entrega,
 				"8"=>$reg->estadop,
 				"9"=>($reg->estado==2||$reg->estado==7)?'<button class="btn btn-success" onclick="iniciar('.$reg->iddetalle.')"><i class="fa fa-power-off" ></i></button>':'<button class="btn btn-primary" onclick="final('.$reg->iddetalle.')"><i class="fa fa-flag-checkered"></i></button>',
 				"10"=>($reg->estado==3)?'<button class="btn btn-primary" onclick="almacen('.$reg->iddetalle.')"><i class="fa fa-cubes"></i></button>'.' <button class="btn btn-danger" onclick="pausa('.$reg->iddetalle.')"><i class="fa fa-clock-o"></i></button>':'',
 				"11"=>($reg->estado==5)?'<button class="btn btn-primary" onclick="entrega('.$reg->iddetalle.')"><i class="fa fa-truck"></i></button>':''

 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'mostrar':
	$rspta= $produccion-> mostrar($iddetalle);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'desactivar':
	$rspta= $produccion-> desactivar($iddetalle);
	//codificar el resultado utilizando json
	echo $rspta ? "Orden desactivada" : "Orden no se puede desactivar";
	break;

	case 'activar':
	$rspta= $produccion-> activar($iddetalle);
	//codificar el resultado utilizando json
	echo $rspta ? "Orden activada" : "Orden no se puede activar";
	break;

	case 'iniciar':
		$rspta=$produccion->iniciar ($iddetalle);
 		//echo $rspta ? "Orden iniciada" : "Orden no se puede iniciar";
	break;

	case 'final':
		$rspta=$produccion->finalizar ($iddetalle);
 		//echo $rspta ? "Orden finalizada" : "Orden no se puede finalizar";
	break;

	case 'almacen':
		$rspta=$produccion->almacen ($iddetalle);
 		//echo $rspta ? "Orden almacenada" : "Orden no se puede almacenar";
	break;

	case 'pausa':
		$rspta=$produccion->pausa ($iddetalle);
 		//echo $rspta ? "Orden pausada" : "Orden no se puede pausar";
	break;

	case 'entrega':
		$rspta=$produccion->entrega ($iddetalle);
 		//echo $rspta ? "Orden entregada" : "Orden no se puede entregar";
	break;

	case 'selectEstado':
		require_once "../modelos/Estados.php";

		$estados=new Estados();
		$rspta = $estados->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idestado . '>' . $reg->nombre . '</option>';
				}

	break;
}

?>