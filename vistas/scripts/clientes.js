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
	$.post("../ajax/clientes.php?op=selectCiudad", function(r){
	            $("#idciudad").html(r);
	            $('#idciudad').selectpicker('refresh');
	})
	
	//Cargamos los items al select localidad
	$.post("../ajax/clientes.php?op=selectLocalidad", function(r){
	            $("#idlocalidad").html(r);
	            $('#idlocalidad').selectpicker('refresh');
	})
	//Cargamos los items al select cliente
	$.post("../ajax/clientes.php?op=selectCliente", function(r){
	            $("#idcliente1").html(r);
	            $('#idcliente1').selectpicker('refresh');
	})
	
}

//Función limpiar
function limpiar()
{
	$("#idcliente").val("");
	$("#razon_social").val("");
	$("#identificacion").val("");
	$("#tipo").val("");
	$("#uso").val("");
	$("#mercado").val("");
	$("#obs").val("");
	$("#idcliente1").val("");
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
		$("#btnagregar").hide();
		$("#btnGuardar").prop("disabled",false);
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
					url: '../ajax/clientes.php?op=listar',
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
	$("#btnGuardar").prop("disabled",true);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/clientes.php?op=guardaryeditar",
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
	$.post("../ajax/clientes.php?op=mostrar",{idsucursal : idsucursal}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#razon_social").val(data.razon_social);
		$("#identificacion").val(data.identificacion);
 		$("#tipo").val(data.tipo);
 		$("#uso").val(data.uso);
 		$("#mercado").val(data.mercado);
 		$("#obs").val(data.obs);
 		$("#idcliente").val(data.idcliente);
	$("#idsucursal").val(data.idsucursal);
	$("#nombre").val(data.nombre);
 	$("#contacto").val(data.contacto);
 	$("#correo").val(data.correo);
 	$("#telefono").val(data.telefono);
 	$("#direccion").val(data.direccion);
 	$("#idciudad").val(data.idciudad);
 	$("#idlocalidad").val(data.idlocalidad);
 	$("#barrio").val(data.barrio);
 	$("#idciudad").selectpicker('refresh');
 	$("#idlocalidad").selectpicker('refresh');

 	})
}

//Función para desactivar registros
function desactivar(idcliente)
{
	bootbox.confirm("¿Está Seguro de desactivar el Cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/clientes.php?op=desactivar", {idcliente : idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idcliente)
{
	bootbox.confirm("¿Está Seguro de activar el Cliente?", function(result){
		if(result)
        {
        	$.post("../ajax/clientes.php?op=activar", {idcliente : idcliente}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Funciones para el modal de la sucursal
//Función para guardar o editar
$("#FormularioM").on('submit',function(e)
{
	e.preventDefault();
		idcliente=$("#idcliente1").val();
		nombre=$("#nombre").val();
 		contacto=$("#contacto").val();
 		correo=$("#correo").val();
 		telefono=$("#telefono").val();
 		direccion=$("#direccion").val();
 		idciudad=$("#idciudad").val();
 		idlocalidad=$("#idlocalidad").val();
 		barrio=$("#barrio").val();

    $.post("../ajax/clientes.php?op=nuevaSede",
        {"idcliente":idcliente,"nombre":nombre,"contacto":contacto,"correo":correo,"telefono":telefono,"direccion":direccion,"idciudad":idciudad,"idlocalidad":idlocalidad,"barrio":barrio}
        );
})

function guardaryeditarSuc(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardarM").prop("disabled",true);
	var formData = new FormData($("#formularioM")[0]);

	$.ajax({
		url: "../ajax/clientes.php?op=guardaryeditarSuc",
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

function mostrarSuc(idsucursal)
{
	$.post("../ajax/clientes.php?op=mostrarSuc",{idsucursal : idsucursal}, function(data, status)
	{
		data = JSON.parse(data);		
		//mostrarform(true);

		$("#idcliente1").selectpicker('refresh');
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
//Fin del modal

init();