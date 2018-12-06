var tabla;

//Función que se ejecuta al inicio
function init(){
	limpiarTodo();
	listar();

	$("#cliente").prop("disabled",false);
	

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	
		$.post("../ajax/orden.php?op=selectSucursal", function(r){
	            $("#cliente").html(r);
	            $('#cliente').selectpicker('refresh');
		})
		$.post("../ajax/orden.php?op=selectArticulo", function(r){
	            $("#idnombre").html(r);
	            $('#idnombre').selectpicker('refresh');
	    })
	    $.post("../ajax/orden.php?op=selectPrioridad", function(r){
	            $("#prioridad").html(r);
	            $('#prioridad').selectpicker('refresh');

		})
	    $.post("../ajax/orden.php?op=selectEncargado", function(r){
	            $("#encargado").html(r);
	            $('#encargado').selectpicker('refresh');

	});
}


//Función limpiar
function limpiar()
{
	
	$("#idnombre").val("");
	$("#peso").val("");
	$("#color1").val("");
	$("#cantidad").val("");
 	$("#valor").val("");
 	$("#observacion").val("");

}

//Función limpiar
function limpiarTodo()
{
	$("#iddetalle").val("");
	$("#idnombre").val("");
	$("#idnombre").selectpicker('refresh');
	$("#cliente").val("");
	$("#cliente").selectpicker('refresh');
	$("#fecha").val("");
	$("#fecha_entrega").val("");
	$("#peso").val("");
	$("#color1").val("");
	$("#cantidad").val("");
 	$("#valor").val("");
	$("#prioridad").val("");
	$("#prioridad").selectpicker('refresh');
 	$("#observacion").val("");
 	$("#grupo").val("");
 	$("#encargado").val("");
	$("#encargado").selectpicker('refresh');

}


//Función Listar
function listar()
{
	var cliente = $("#cliente").val();
	var usuario = $("#usuario").val();
	
	tabla=$('#tbllistado').dataTable(
	{
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	   buttons: [		          
		            
		        ],
		"ajax":
				{
					url: '../ajax/orden.php?op=listar',
					data:{cliente: cliente,usuario: usuario},
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 0, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	//$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/orden.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	         //$("#idsucursal").prop("disabled",true);
	        listar();

	    }

	});
	limpiar();
}

//Función para generar el pedido
function adpedido($cliente,$usuario)
{
	var usuario = $("#usuario").val();
	var cliente = $("#cliente").val();
	
	bootbox.confirm("¿Confirma agregar el pedido?", function(result){
		if(result)
        {
        	$.post("../ajax/orden.php?op=adpedido", {cliente : cliente,usuario : usuario}, function(e){
        	bootbox.alert(e);

        		console.log(cliente+usuario);
	            tabla.ajax.reload();
        	});
        $.post("../ajax/orden.php?op=borrarTodo", {cliente : cliente,usuario : usuario});
        limpiarTodo();
    	}
        })
	
		
}

function mostrar(iddetalle)
{
	$.post("../ajax/orden.php?op=mostrar",{iddetalle : iddetalle}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

		
		$("#iddetalle").val(data.iddetalle);
		$("#cliente").val(data.cliente);
		$("#cliente").selectpicker('refresh');
		$("#entrega").val(data.entrega);
		$("#entrega").selectpicker('refresh');
		$("#idnombre").val(data.idnombre);
		$("#idnombre").selectpicker('refresh');
		$("#fecha_entrega").val(data.fecha_entrega);
		$("#peso").val(data.peso);
		$("#color1").val(data.color1);
 		$("#cantidad").val(data.cantidad);
 		$("#valor").val(data.valor);
 		$("#observacion").val(data.observacion);
 		$("#encargado").val(data.encargado);
		$("#encargado").selectpicker('refresh');
		$("#prioridad").val(data.prioridad);
		$("#prioridad").selectpicker('refresh');

 	})
}

function borrar(iddetalle)
{
	
        	$.post("../ajax/orden.php?op=borrar", {iddetalle : iddetalle}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
	            mostrarTotal();
        	});	
}
	
//Función para borrar todos los registros

function borrarTodo($cliente,$usuario)
{
	var usuario = $("#usuario").val();
	var cliente = $("#cliente").val();
	
	bootbox.confirm("¿Confirma borrar completamente el pedido?", function(result){
		if(result)
        {
	
        	$.post("../ajax/orden.php?op=borrarTodo", {cliente : cliente,usuario : usuario}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
	limpiarTodo()
}

	
init();