
<?php 
require_once "../modelos/Unidades.php";

$unidades = new Unidades();
error_reporting(E_ALL);

$idunidad=isset($_POST["idunidad"])?limpiarCadena($_POST["idunidad"]):"";
$nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
	if(empty($idunidad)){
		$rspta= $unidades->insertar($nombre);
		echo $rspta ? "Registrada": "No se pudo registrar";
	}
	else {
		$rspta= $unidades->editar($idunidad,$nombre);
		echo $rspta ? "Actualizada": "No se pudo actualizar";
	}
	break;

	case 'desactivar':
	$rspta= $unidades -> desactivar($idunidad);
	echo $rspta ? "Desactivada": "No puede se desactivar";
	break;

	case 'activar':
	$rspta= $unidades-> activar($idunidad);
	echo $rspta ? "Activada": "No se puede activar";
	break;

	case 'mostrar':
	$rspta= $unidades-> mostrar($idunidad);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta =$unidades ->listar();
	//vamos a declarar un array
	$data = array();

	while ($reg=$rspta -> fetch_object()){
		$data[]=array(
			"0"=>($reg->condicion)? '<button class="btn btn-warning" onclick="mostrar('.$reg->idunidad.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idunidad.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idunidad.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idunidad.')"><i class="fa fa-check"></i></button>',
			"1"=> $reg->nombre,
			"2"=> ($reg->condicion)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Desactivo</span>'
		);
	}
	$results = array(
		"sEcho"=>1, //informacion para el datatables
		"iTotalRecords"=>count($data), //enviamos el tota registros al datatable
		"iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
		"aaData"=>$data);
		echo json_encode($results);
break;

}

 ?>