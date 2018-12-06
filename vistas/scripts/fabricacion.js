var tabla;

//Función que se ejecuta al inicio
function init(){
	mostrarform(false);
	listar();
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
		            //'copyHtml5',
		            //'excelHtml5',
		            //'csvHtml5',
		            //'pdf'
		        ],
		"ajax":
				{
					url: '../ajax/detalle_produccion.php?op=fabricacion',
					type : "get",
					dataType : "json",						
					error: function(e){
						console.log(e.responseText);	
					}
				},
		"bDestroy": true,
		"iDisplayLength": 5,//Paginación
	    "order": [[ 1, "desc" ]]//Ordenar (columna,orden)
	}).DataTable();
}

//funcion para iniciar

function iniciar(iddetalle)
{
	bootbox.confirm("¿Esta seguro que desea iniciar el proceso?",function(result){
		if (result)
		{
			$.post("../ajax/detalle_produccion.php?op=iniciar",{iddetalle:iddetalle},function(e){
				//bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}

//funcion para finalizar

function final(iddetalle)
{
	bootbox.confirm("¿Esta seguro que desea finalizar el proceso?",function(result){
		if (result)
		{
			$.post("../ajax/detalle_produccion.php?op=final",{iddetalle:iddetalle},function(e){
				//bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}


function almacen(iddetalle)
{
	bootbox.confirm("¿Esta seguro que desea almacenar el producto?",function(result){
		if (result)
		{
			$.post("../ajax/detalle_produccion.php?op=almacen",{iddetalle:iddetalle},function(e){
				//bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}


function pausa(iddetalle)
{
	bootbox.confirm("¿Esta seguro que desea pausar el proceso?",function(result){
		if (result)
		{
			$.post("../ajax/detalle_produccion.php?op=pausa",{iddetalle:iddetalle},function(e){
				//bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}


function entrega(iddetalle)
{
	bootbox.confirm("¿Esta seguro que desea entregar los productos?",function(result){
		if (result)
		{
			$.post("../ajax/detalle_produccion.php?op=entrega",{iddetalle:iddetalle},function(e){
				//bootbox.alert(e);
				tabla.ajax.reload();
			});
				

			}
		})
	}

init();