<?php 
if (strlen(session_id()) < 1) 
  session_start();

require_once "../modelos/Pedido.php";

$pedido=new Pedido();
$idorden=isset($_POST["idorden"])?limpiarCadena($_POST["idorden"]):"";
$cliente=isset($_POST["cliente"])?limpiarCadena($_POST["cliente"]):"";
$fecha_entrega=isset($_POST["fecha_entrega"])?limpiarCadena($_POST["fecha_entrega"]):"";
$fecha=isset($_POST["fecha"])?limpiarCadena($_POST["fecha"]):"";
$prioridad=isset($_POST["prioridad"])?limpiarCadena($_POST["prioridad"]):"";
$encargado=$_SESSION['idusuario'];
$entrega=isset($_POST["entrega"])?limpiarCadena($_POST["entrega"]):"";

switch ($_GET["op"]){
	
	case 'guardaryeditar':
		$rspta= $pedido->editar($idorden,$cliente,$fecha,$fecha_entrega,$prioridad,$encargado,$entrega);
		echo $rspta ? "actualizado": "No se pudo actualizar";	
	break;

	case 'mostrar':
	$rspta= $pedido-> mostrar($idorden);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'editar':
	$rspta= $pedido-> mostrar($idorden);
	//codificar el resultado utilizando json
	echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$pedido->listar();
 		//Vamos a declarar un array
 		$data= Array();

 		while ($reg=$rspta -> fetch_object()){
 			
 			$data[]=array(
 				
 				"0"=>$reg->idorden,
 				"1"=>$reg->razonsocial,
 				"2"=>$reg->fecha,
 				"3"=>$reg->fecha_entrega,
 				"4"=>$reg->estado,
 				"5"=>$reg->total,
 				"6"=>$reg->factura,
 				"7"=>$reg->cotizacion,
 				"8"=>$reg->prioridad,
 				"9"=>$reg->entrega,
 				"10"=>($reg->estadon!=='4')?'<button class="btn btn-warning" onclick="mostrar('.$reg->idorden.')"><i class="fa fa-eye"></i></button>'.'<button class="btn btn-primary" onclick="editar('.$reg->idorden.')"><i class="fa fa-pencil"></i></button>':'<button class="btn btn-warning" onclick="mostrar('.$reg->idorden.')"><i class="fa fa-eye"></i></button>'
 				);
 		}
 		$results = array(
 			"sEcho"=>1, //Información para el datatables
 			"iTotalRecords"=>count($data), //enviamos el total registros al datatable
 			"iTotalDisplayRecords"=>count($data), //enviamos el total registros a visualizar
 			"aaData"=>$data);
 		echo json_encode($results);

	break;

	case 'listarDetalle':
		//Recibimos el idingreso
		$id=$_GET['id'];

		$rspta = $pedido->listarDetalle($id);
		$total=0;
		echo '<thead style="background-color:#A9D0F5">
                                    <th># Orden</th>
                                    <th>Articulo</th>
                                    <th>Peso</th>
                                    <th>Color</th>
                                    <th>Cantidad</th>
                                    <th>Observaciones</th>
                                </thead>';

		while ($reg = $rspta->fetch_object())
				{
					echo '<tr class="filas">

			        <td>'.$reg->idorden.'</td>
			        <td>'.$reg->nombre.'</td>
			        <td>'.$reg->peso.'</td>
			        <td>'.$reg->color.'</td>
			        <td>'.$reg->cantidad.'</td>
			        <td>'.$reg->observacion.'</td>
			        </tr>';
				
				}
		echo '<tfoot>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th>
                                    <th></th> 
                                </tfoot>';
	break;


	

	
}
?>