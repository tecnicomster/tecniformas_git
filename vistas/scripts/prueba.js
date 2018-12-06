var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(true);
	listar()

	$("#idsucursal").prop("disabled",false);
	

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	
		$.post("../ajax/orden_produccion.php?op=selectSucursal", function(r){
	            $("#idsucursal").html(r);
	            $('#idsucursal').selectpicker('refresh');

	})
		$.post("../ajax/orden_produccion.php?op=selectArticulo", function(r){
	            $("#idnombre").html(r);
	            $('#idnombre').selectpicker('refresh');

	})
		
}

$(document).ready(function(){
        $("#idsucursal").change(function () {

          //funcion para limpiar un tercer select
          //$('#cbx_localidad').find('option').remove().end().append('<option value="whatever"></option>').val('whatever');
          
          $("#idsucursal option:selected").each(function () {
            idsucursal = $(this).val();
            $.post("../ajax/orden_produccion.php?op=listarProductos", { idsucursal: idsucursal }, function(r){
               $("#idsaldo").html(r);
	            $('#idsaldo').selectpicker('refresh');
            });            
          });
        })
      });


//Función limpiar
function limpiar()
{
	$("#iddetalle").val("");
	$("#idnombre").val("");
	$("#peso").val("");
	$("#color1").val("");
	$("#cantidad").val("");
 	$("#valor").val("");
 	$("#observaciones").val("");


}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").show();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#botones").show();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#botones").show();
	}
}

//Función cancelarform
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

//Función Listar
function listar()

{  

	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//activamos el procesamiento del datatables
		"aServerSide": true, //paginacion y filtrado realizado por el servidor
		dom: 'Bfrtip',//Definimos los elementos del control de tabla
		buttons: ['copyHtml5',
				'excelHtml5',
				'csvHtml5',
				'pdf'],
		"ajax":
				{
					url: '../ajax/orden_produccion.php?op=listar',
					type: "get",
					dataType: "json",
					error: function(e){
						console.log(e.responseText);
					}
				},
				"bDestrot":true,
				"iDisplayLength":5,//paginacion
				"order":[[0,"desc"]]//ordenar los datos
	}).DataTable();
}

//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/orden_produccion.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	         
	          //$("#idsucursal").prop("disabled",true);
	          listar();
	          sumar();
	    }

	});
	limpiar();
}

//funcion para sumar totales
function sumar()
{
	var total = $('#tbllistado').DataTable();
  	total.column( 8 ).data().sum();
			console.log(total[8]);
			$("#total").html(total);
}



//Función para generar el pedido
function adpedido(idsucursal,usuario)
{
	var idsucursal = $("#idsucursal").val();
	var usuario = $("#usuario").val();
	
	bootbox.confirm("¿Confirma agregar el pedido?", function(result){
		if(result)
        {
        	$.post("../ajax/orden_produccion.php?op=adpedido", {idsucursal : idsucursal,usuario : usuario}, function(e){
        		bootbox.alert(e);
        		console.log(idsucursal+usuario);
	            tabla.ajax.reload();
        	});	
        }
	})
}

function mostrar(idnuevo)
{
	$.post("../ajax/orden_produccion.php?op=mostrar",{idnuevo : idnuevo}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

		
		$("#iddetalle").val(data.iddetalle);
		$("#idsucursal").val(data.idsucursal);
		$("#idsucursal").selectpicker('refresh');
		$("#idnombre").val(data.idnombre);
		$("#idnombre").selectpicker('refresh');
		$("#peso").val(data.peso);
		$("#color1").val(data.color1);
 		$("#cantidad").val(data.cantidad);
 		$("#valor").val(data.valor);
 		$("#observacion").val(data.observacion);
 		
 	})
}

function mostrarTotal(idsucursal,usuario)
{
	var idsucursal = $("#idsucursal").val();
	var usuario = $("#usuario").val();
	$.post("../ajax/orden_produccion.php?op=mostrarTotal",{idsucursal : idsucursal,usuario : usuario}, function(data, status)
	{
		data = JSON.parse(data);		
		for (var i = 0; i < json.length; i++) { console.log(i, json.charAt(i), json.charCodeAt(i)); }		
 		$("#total").val(data.total);
 		$("#iva").val(data.viva);
 		
 	})
}

//Función para borrar registros
function borrar(idnuevo)
{
	
        	$.post("../ajax/orden_produccion.php?op=borrar", {idnuevo : idnuevo}, function(e){
        		//bootbox.alert(e);
	            tabla.ajax.reload();
	            mostrarTotal();
        	});	
}
	
//Función para borrar registros
function borrarTodo(idsucursal,usuario)
{
	var idsucursal = $("#idsucursal").val();
	var usuario = $("#usuario").val();
	bootbox.confirm("¿Confirma borrar completamente el pedido?", function(result){
		if(result)
        {
	
        	$.post("../ajax/orden_produccion.php?op=borrarTodo", {idsucursal : idsucursal,usuario : usuario}, function(e){
        		//bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}
	
init();