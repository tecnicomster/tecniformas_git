
<?php 
require_once "../modelos/Lineas.php";

$lineas = new Lineas();
error_reporting(E_ALL);

$idlineas=isset($_POST["idlineas"])?limpiarCadena($_POST["idlineas"]):"";
$nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	if(empty($idlineas)){
		$rspta= $lineas->insertar($nombre,$descripcion);
		echo $rspta ? "Registrada": "No se pudo registrar";
	}
	else {
		$rspta= $lineas->editar($idlineas,$nombre,$descripcion);
		echo $rspta ? "Actualizada": "No se pudo actualizar";
	}
	break;

	case 'desactivar':
	$rspta= $lineas -> desactivar($idlineas);
	echo $rspta ? "Desactivada": "No puede se desactivar";
	break;

	case 'activar':
	$rspta= $lineas-> activar($idlineas);
	echo $rspta ? "Activada": "No se puede activar";
	break;

	case 'mostrar':
	$rspta= $lineas-> mostrar($idlineas);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'listar':
	$rspta =$lineas ->listar();
	//vamos a declarar un array
	$data = array();

	while ($reg=$rspta -> fetch_object()){
		$data[]=array(
			"0"=>($reg->condicion)? '<button class="btn btn-warning" onclick="mostrar('.$reg->idlineas.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idlineas.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idlineas.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idlineas.')"><i class="fa fa-check"></i></button>',
			"1"=> $reg->nombre,
			"2"=> $reg->descripcion,
			"3"=> ($reg->condicion)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Desactivo</span>'
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