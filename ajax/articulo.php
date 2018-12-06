
<?php 
require_once "../modelos/Articulo.php";

$articulo = new Articulo();
error_reporting(E_ALL);


$idarticulo=isset($_POST["idarticulo"])?limpiarCadena($_POST["idarticulo"]):"";
$codigo=isset($_POST["codigo"])?limpiarCadena($_POST["codigo"]):"";
$nombre=isset($_POST["nombre"])?limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";
$lineas=isset($_POST["lineas"])?limpiarCadena($_POST["lineas"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
	if(empty($idarticulo)){
		$rspta= $articulo->insertar($codigo,$nombre,$descripcion,$lineas);
		echo $rspta ? "Registrada": "No se pudo registrar";
	}
	else {
		$rspta= $articulo->editar($idarticulo,$codigo,$nombre,$descripcion,$lineas);
		echo $rspta ? "actualizado": "No se pudo actualizar";	
	}

	break;

	case 'desactivar':
	$rspta= $articulo -> desactivar($idarticulo);
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
	$rspta=$articulo ->listar();
	//vamos a declarar un array
	$data = array();

	while ($reg=$rspta -> fetch_object()){
		$data[]=array(
			"0"=>($reg->condicion)? '<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-danger" onclick="desactivar('.$reg->idarticulo.')"><i class="fa fa-close"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idarticulo.')"><i class="fa fa-pencil"></i></button>'.
				' <button class="btn btn-primary" onclick="activar('.$reg->idarticulo.')"><i class="fa fa-check"></i></button>',
			"1"=> $reg->codigo,
			"2"=> $reg->nombre,
			"3"=> $reg->descripcion,
			"4"=> $reg->lineas,
		    "5"=> ($reg->condicion)?'<span class="label bg-green">Activo</span>':'<span class="label bg-red">Desactivo</span>'
		);
	}
	$results = array(
		"sEcho"=>1, //informacion para el datatables
		"iTotalRecords"=>count($data), //enviamos el tota registros al datatable
		"iTotalDisplayRecords"=>count($data),//enviamos el total de registros a visualizar
		"aaData"=>$data);
		echo json_encode($results);

	break;

	case "selectLineas":
		
		$rspta = $articulo->selectLineas();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idlineas . '>' . $reg->nombre .'</option>';
				}
	break;
}
 ?>