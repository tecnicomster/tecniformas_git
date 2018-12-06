var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	//Cargamos los items al select ciudad
	$.post("../ajax/sucursal.php?op=selectCiudad", function(r){
	            $("#idciudad").html(r);
	            $('#idciudad').selectpicker('refresh');
	})
	//Cargamos los items al select localidad
	$.post("../ajax/sucursal.php?op=selectLocalidad", function(r){
	            $("#idlocalidad").html(r);
	            $('#idlocalidad').selectpicker('refresh');
	})
	//Cargamos los items al select cliente
	$.post("../ajax/sucursal.php?op=selectCliente", function(r){
	            $("#idcliente").html(r);
	            $('#idcliente').selectpicker('refresh');
	});
}

//Función limpiar
function limpiar()
{
	$("#idsucursal").val("");
	$("#idcliente").val("");
	$("#nombre").val("");
	$("#contacto").val("");
	$("#correo").val("");
	$("#telefono").val("");
	$("#direccion").val("");
	$("#idciudad").val("");
	$("#idlocalidad").val("");
	$("#barrio").val("");
}

//Función mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnGuardar").prop("disabled",false);
		$("#btnagregar").hide();
	}
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
		$("#btnagregar").show();
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
		"aProcessing": true,//Activamos el procesamiento del datatables
	    "aServerSide": true,//Paginación y filtrado realizados por el servidor
	    dom: 'Bfrtip',//Definimos los elementos del control de tabla
	    buttons: [		          
		            'copyHtml5',
		            'excelHtml5',
		            'csvHtml5',
		            'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/sucursal.php?op=listar',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 1, "asc" ]]//Ordenar (columna,orden)
	}).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/sucursal.php?op=guardaryeditar",
	    type: "POST",
	    data: formData,
	    contentType: false,
	    processData: false,

	    success: function(datos)
	    {                    
	          bootbox.alert(datos);	          
	          mostrarform(false);
	          tabla.ajax.reload();
	    }

	});
	limpiar();
}

function mostrar(idsucursal)
{
	$.post("../ajax/sucursal.php?op=mostrar",{idsucursal : idsucursal}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#idcliente").selectpicker('refresh');
		$("#nombre").val(data.nombre);
		$("#contacto").val(data.contacto);
		$("#correo").val(data.correo);
		$("#telefono").val(data.telefono);
		$("#direccion").val(data.direccion);
		$("#idciudad").selectpicker('refresh');
		$("#idlocalidad").selectpicker('refresh');
		$("#barrio").val(data.barrio);
 		$("#idsucursal").val(data.idsucursal);

 	})
}

//Función para desactivar registros
function desactivar(idsucursal)
{
	bootbox.confirm("¿Está Seguro de desactivar la Sede?", function(result){
		if(result)
        {
        	$.post("../ajax/sucursal.php?op=desactivar", {idsucursal : idsucursal}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para marcar sucursal principal
function principal(idsucursal,idcliente)
{
	bootbox.confirm("¿Está Seguro de marcar la Sede como principal?", function(result){
		if(result)
        {
        	$.post("../ajax/sucursal.php?op=principal", {idsucursal,idcliente : idsucursal,idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idsucursal)
{
	bootbox.confirm("¿Está Seguro de activar la Sede?", function(result){
		if(result)
        {
        	$.post("../ajax/sucursal.php?op=activar", {idsucursal : idsucursal}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();