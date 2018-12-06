<?php 
require_once "../modelos/Sucursal.php";

$sucursal=new Sucursal();

$idsucursal=isset($_POST["idsucursal"])? limpiarCadena($_POST["idsucursal"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$contacto=isset($_POST["contacto"])? limpiarCadena($_POST["contacto"]):"";
$correo=isset($_POST["correo"])? limpiarCadena($_POST["correo"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$idciudad=isset($_POST["idciudad"])? limpiarCadena($_POST["idciudad"]):"";
$idlocalidad=isset($_POST["idlocalidad"])? limpiarCadena($_POST["idlocalidad"]):"";
$barrio=isset($_POST["barrio"])? limpiarCadena($_POST["barrio"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idsucursal)){
			$rspta=$sucursal->insertar($idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Sucursal registrada" : "Sucursal no se pudo registrar";
		}
		else {
			$rspta=$sucursal->editar($idsucursal,$idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Sucursal actualizada" : "Sucursal no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$sucursal->desactivar($idsucursal);
 		echo $rspta ? "Sucursal Desactivada" : "Sucursal no se puede desactivar";
	break;

	case 'principal':
		$rspta=$sucursal->principal($idsucursal,$idcliente);
 		echo $rspta ? "Sucursal principal marcada" : "Sucursal no se puede marcar";
	break;

	case 'activar':
		$rspta=$sucursal->activar($idsucursal);
 		echo $rspta ? "Sucursal activada" : "Sucursal no se puede activar";
	break;

	case 'mostrar':
		$rspta=$sucursal->mostrar($idsucursal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$sucursal->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->cliente,
 				"2"=>$reg->nombre,
 				"3"=>$reg->contacto,
 				"4"=>$reg->correo,
 				"5"=>$reg->telefono,
 				"6"=>$reg->direccion,
 				"7"=>$reg->ciudad,
 				"8"=>$reg->localidad,
 				"9"=>$reg->barrio,
 				"10"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
 				'<span class="label bg-red">Desactivado</span>',
 				"11"=>($reg->facturacion)?'<button class="btn btn-warning"><i class="fa fa-check"></i></button>':'<button class="btn btn-success" onclick="principal('.$reg->idsucursal.','.$reg->idcliente.')"><i class="fa fa-plus"></i></button>',
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

	case "selectLocalidad":
		require_once "../modelos/Localidad.php";
		$localidad = new Localidad();

		$rspta = $localidad->select();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idlocalidad . '>' . $reg->nombre . '</option>';
				}
	break;

	case "selectCliente":
		require_once "../modelos/Clientes.php";
		$clientes = new Clientes();

		$rspta = $clientes->selectCliente();

		while ($reg = $rspta->fetch_object())
				{
					echo '<option value=' . $reg->idcliente . '>' . $reg->razon_social . '</option>';
				}
	break;
}
?>