<?php 
require_once "../modelos/Clientes.php";

$clientes=new Clientes();
$idsucursal=isset($_POST["idsucursal"])? limpiarCadena($_POST["idsucursal"]):"";
$idcliente=isset($_POST["idcliente"])? limpiarCadena($_POST["idcliente"]):"";
$razon_social=isset($_POST["razon_social"])? limpiarCadena($_POST["razon_social"]):"";
$identificacion=isset($_POST["identificacion"])? limpiarCadena($_POST["identificacion"]):"";
$tipo=isset($_POST["tipo"])? limpiarCadena($_POST["tipo"]):"";
$uso=isset($_POST["uso"])? limpiarCadena($_POST["uso"]):"";
$mercado=isset($_POST["mercado"])? limpiarCadena($_POST["mercado"]):"";
$obs=isset($_POST["obs"])? limpiarCadena($_POST["obs"]):"";
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
		if (empty($idcliente)){
			$rspta=$clientes->insertar($razon_social,$identificacion,$tipo,$uso,$mercado,$obs,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Cliente registrado" : "Cliente no se pudo registrar";
		}
		else {
			$rspta=$clientes->editar($idcliente,$idsucursal,$razon_social,$identificacion,$tipo,$uso,$mercado,$obs,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Cliente actualizado" : "Cliente no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$clientes->desactivar($idcliente);
 		echo $rspta ? "Cliente Desactivado" : "Cliente no se puede desactivar";
	break;

	case 'activar':
		$rspta=$clientes->activar($idcliente);
 		echo $rspta ? "Cliente activado" : "Cliente no se puede activar";
	break;

	case 'mostrar':
		$rspta=$clientes->mostrar($idsucursal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$clientes->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta->fetch_object()){
 			$data[]=array(
 				"0"=>($reg->estado)?'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-danger" onclick="desactivar('.$reg->idsucursal.')"><i class="fa fa-close"></i></button>':
 					'<button class="btn btn-warning" onclick="mostrar('.$reg->idsucursal.')"><i class="fa fa-pencil"></i></button>'.
 					' <button class="btn btn-primary" onclick="activar('.$reg->idsucursal.')"><i class="fa fa-check"></i></button>',
 				"1"=>$reg->razon_social,
 				"2"=>$reg->identificacion,
 				"3"=>$reg->sede,
 				"4"=>$reg->contacto,
 				"5"=>$reg->correo,
 				"6"=>$reg->telefono,
 				"7"=>$reg->direccion,
 				"8"=>$reg->ciudad,
 				"9"=>$reg->localidad,
 				"10"=>$reg->barrio,
 				"11"=>$reg->tipo,
 				"12"=>$reg->uso,
 				"13"=>$reg->mercado,
 				"14"=>$reg->obs,
 				"15"=>($reg->estado)?'<span class="label bg-green">Activado</span>':
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


	
//control del modal

	case 'nuevaSede':
	$idcliente=$_POST['idcliente1'];
	$nombre=$_POST['nombre'];
	$correo=$_POST['correo'];
	$telefono=$_POST['telefono'];
	$direccion=$_POST['direccion'];
	$idciudad=$_POST['idciudad'];
	$idlocalidad=$_POST['idlocalidad'];
	$barrio=$_POST['barrio'];

		$rspta=$clientes->nuevaSede($idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);

		echo $rspta ? "Sucursal registrada" : "Sucursal no se pudo registrar";

		echo json_encode($rspta);
	break;

	case 'guardaryeditarSuc':
		if (empty($idsucursal)){
			$rspta=$sucursal->insertarSuc($idcliente,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Sucursal registrada" : "Sucursal no se pudo registrar";
		}
		else {
			$rspta=$sucursal->editarSuc($idsucursal,$$idcliente1,$nombre,$contacto,$correo,$telefono,$direccion,$idciudad,$idlocalidad,$barrio);
			echo $rspta ? "Sucursal actualizada" : "Sucursal no se pudo actualizar";
		}
	break;

	case 'mostrarSuc':
		$rspta=$sucursal->mostrar($idsucursal);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;


//fin del modal

	
}
?>