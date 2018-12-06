<?php 
require_once "../modelos/Localidad.php";

$localidad=new Localidad();

$idlocalidad=isset($_POST["idlocalidad"])? limpiarCadena($_POST["idlocalidad"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$idciudad=isset($_POST["idciudad"])? limpiarCadena($_POST["idciudad"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idlocalidad)){
			$rspta=$localidad->insertar($nombre,$idciudad);
			echo $rspta ? "Localidad registrada" : "Localidad no se pudo registrar";
		}
		else {
			$rspta=$localidad->editar($idlocalidad,$nombre,$idciudad);
			echo $rspta ? "Localidad actualizada" : "Localidad no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$localidad->desactivar($idlocalidad);
 		echo $rspta ? "Localidad Desactivada" : "Localidad no se puede desactivar";
	break;

	case 'activar':
		$rspta=$localidad->activar($idlocalidad);
 		echo $rspta ? "Localidad activada" : "Localidad no se puede activar";
	break;

	case 'mostrar':
		$rspta=$localidad->mostrar($idlocalidad);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$localidad->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idlocalidad.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idlocalidad.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idlocalidad.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idlocalidad.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->ciudad,
 				"3"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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

	case "selectCiudad":
		require_once "../modelos/Ciudad.php";
		$ciudad = new Ciudad();

		$rspta = $ciudad->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idciudad . '>' . $reg->nombre . '</option>';
				}
	break;
}
?>