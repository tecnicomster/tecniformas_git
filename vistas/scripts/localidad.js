var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();

	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);	
	})
	//Cargamos los items al select categoria
	$.post("../ajax/localidad.php?op=selectCiudad", function(r){
	            $("#idciudad").html(r);
	            $('#idciudad').selectpicker('refresh');
	});
}

//Función limpiar
function limpiar()
{
	$("#idlocalidad").val("");
	$("#nombre").val("");
	$("#idciudad").val("");
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
					url: '../ajax/localidad.php?op=listar',
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
		url: "../ajax/localidad.php?op=guardaryeditar",
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

function mostrar(idlocalidad)
{
	$.post("../ajax/localidad.php?op=mostrar",{idlocalidad : idlocalidad}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

		$("#nombre").val(data.nombre);
		$("#idciudad").selectpicker('refresh');
 		$("#idlocalidad").val(data.idlocalidad);

 	})
}

//Función para desactivar registros
function desactivar(idlocalidad)
{
	bootbox.confirm("¿Está Seguro de desactivar la Localidad?", function(result){
		if(result)
        {
        	$.post("../ajax/localidad.php?op=desactivar", {idlocalidad : idlocalidad}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(idlocalidad)
{
	bootbox.confirm("¿Está Seguro de activar la Localidad?", function(result){
		if(result)
        {
        	$.post("../ajax/localidad.php?op=activar", {idlocalidad : idlocalidad}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();