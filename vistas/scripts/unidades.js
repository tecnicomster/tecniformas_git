var tabla;

//funcion que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$("#formulario").on("submit",function(e)
	{
		guardaryeditar(e);
	});

}

//funcion limpiar
function limpiar(){

	$("#idunidad").val("");
	$("#nombre").val("");
	
}

//funcion mostrar formulario
function mostrarform(flag)
{
	limpiar();
	if (flag)
	{
		$("#listadoregistros").hide();
		$("#formularioregistros").show();
		$("#btnguardar").prop("disabled", false);
	}	
	else
	{
		$("#listadoregistros").show();
		$("#formularioregistros").hide();
	}
}

//funcion cancelar form
function cancelarform()
{
	limpiar();
	mostrarform(false);
}

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
					url: '../ajax/unidades.php?op=listar',
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

//funcion para guardar y editar

function guardaryeditar(e)
{
	e.preventDefault(); //No se activará la acción predeterminada del evento
	$("#btnGuardar").prop("disabled",false);
	var formData = new FormData($("#formulario")[0]);

	$.ajax({
		url: "../ajax/unidades.php?op=guardaryeditar",
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

function mostrar(idunidad)
{
	$.post("../ajax/unidades.php?op=mostrar",{idunidad:idunidad}, function(data, status){
		data = JSON.parse(data);
		mostrarform(true);

		$("#idunidad").val(data.idunidad);
		$("#nombre").val(data.nombre);
		

})
}

//funcion para desactivar la categoria

function desactivar(idunidad)
{
	bootbox.confirm("¿Esta seguro que desea desactivar la unidad?",function(result){
		if (result)
		{
			$.post("../ajax/unidades.php?op=desactivar",{idunidad:idunidad},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}

	function activar(idunidad)
{
	bootbox.confirm("¿Esta seguro que desea activar la unidad?",function(result){
		if (result)
		{
			$.post("../ajax/unidades.php?op=activar",{idunidad:idunidad},function(e){
				bootbox.alert(e);
				tabla.ajax.reload();
			});
		}
		})
	}
	


init();