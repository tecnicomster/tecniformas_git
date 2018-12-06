var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
	$.post("../ajax/orden.php?op=selectArticulo", function(r){
	            $("#idnombre").html(r);
	            $('#idnombre').selectpicker('refresh');
	    })

	$.post("../ajax/detalle_produccion.php?op=selectEstado", function(r){
	            $("#estado").html(r);
	            $('#estado').selectpicker('refresh');
	    })
}

function limpiar()
{
		$("#iddetalle").val("");
		$("#peso").val("");
		$("#color").val("");
		$("#cantidad").val("");
		$("#idnombre").val("");
		$("#estado").val("");
 		$("#observacion").val("");
}
//Función mostrar formulario
function mostrarform(flag)
{

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
					url: '../ajax/detalle_produccion.php?op=listar',
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

function cancelarform()
{
	limpiar();
	mostrarform(false);
}

function mostrar(iddetalle)
{
	$.post("../ajax/detalle_produccion.php?op=mostrar",{iddetalle : iddetalle}, function(data, status)
	{
		data = JSON.parse(data);		
		mostrarform(true);

	
		$("#iddetalle").val(data.iddetalle);
		$("#peso").val(data.peso);
		$("#color").val(data.color);
		$("#cantidad").val(data.cantidad);
		$("#idnombre").val(data.idnombre);
		$("#idnombre").selectpicker('refresh');
		$("#estado").val(data.estado);
		$("#estado").selectpicker('refresh');
 		$("#observacion").val(data.observacion);
 		

 	})
}

//Función para desactivar registros
function desactivar(iddetalle)
{
	bootbox.confirm("¿Está Seguro de desactivar la orden?", function(result){
		if(result)
        {
        	$.post("../ajax/detalle_produccion.php?op=desactivar", {iddetalle : iddetalle}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}

//Función para activar registros
function activar(iddetalle)
{
	bootbox.confirm("¿Está Seguro de activar la orden?", function(result){
		if(result)
        {
        	$.post("../ajax/detalle_produccion.php?op=activar", {iddetalle : iddetalle}, function(e){
        		bootbox.alert(e);
	            tabla.ajax.reload();
        	});	
        }
	})
}


init();

