<?php 
require_once "../modelos/Empresa.php";

$empresa=new Empresa();

$idempresa=isset($_POST["idempresa"])? limpiarCadena($_POST["idempresa"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$tipo_documento=isset($_POST["tipo_documento"])? limpiarCadena($_POST["tipo_documento"]):"";
$num_documento=isset($_POST["num_documento"])? limpiarCadena($_POST["num_documento"]):"";
$regimen=isset($_POST["regimen"])? limpiarCadena($_POST["regimen"]):"";
$iva=isset($_POST["iva"])? limpiarCadena($_POST["iva"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idempresa)){
			$rspta=$empresa->insertar($nombre,$tipo_documento,$num_documento,$regimen,$iva,$direccion,$telefono,$email);
			echo $rspta ? "Empresa registrada" : "Empresa no se pudo registrar";
		}
		else {
			$rspta=$empresa->editar($idempresa,$nombre,$tipo_documento,$num_documento,$regimen,$iva,$direccion,$telefono,$email);
			echo $rspta ? "Empresa actualizada" : "Empresa no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$empresa->eliminar($idempresa);
 		echo $rspta ? "Empresa eliminada" : "Empresa no se puede eliminar";
	break;

	case 'mostrar':
		$rspta=$empresa->mostrar($idempresa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$empresa->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>'<button class="btn btn-warning" onclick="mostrar('.$reg->idempresa.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="eliminar('.$reg->idempresa.')"><i class="fa fa-trash"></i></button>',
 				"1"=>$reg->nombre,
 				"2"=>$reg->tipo_documento,
 				"3"=>$reg->num_documento,
 				"4"=>$reg->regimen,
 				"5"=>$reg->iva,
 				"6"=>$reg->direccion,
 				"7"=>$reg->telefono,
 				"8"=>$reg->email
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