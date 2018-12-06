<?php 
require_once "../modelos/Ciudad.php";

$ciudad=new Ciudad();

$idciudad=isset($_POST["idciudad"])? limpiarCadena($_POST["idciudad"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idciudad)){
			$rspta=$ciudad->insertar($nombre);
			echo $rspta ? "Ciudad registrada" : "Ciudad no se pudo registrar";
		}
		else {
			$rspta=$ciudad->editar($idciudad,$nombre);
			echo $rspta ? "Ciudad actualizada" : "Ciudad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$ciudad->desactivar($idciudad);
 		echo $rspta ? "Ciudad Desactivada" : "Ciudad no se puede desactivar";
	break;

	case 'activar':
		$rspta=$ciudad->activar($idciudad);
 		echo $rspta ? "Ciudad activada" : "Ciudad no se puede activar";
	break;

	case 'mostrar':
		$rspta=$ciudad->mostrar($idciudad);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$ciudad->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idciudad.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idciudad.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idciudad.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idciudad.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;
}
?>