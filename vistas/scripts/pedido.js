var tabla;

//funcion que se ejecuta al inicio
function init(){
  mostrarform(false);
  listar();
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

//funcion mostrar formulario
function mostrarform(flag)
{
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

function guardaryeditar(e)
{
  e.preventDefault(); //No se activará la acción predeterminada del evento
  $("#btnGuardar").prop("disabled",true);
  var formData = new FormData($("#formulario")[0]);

  $.ajax({
    url: "../ajax/pedido.php?op=guardaryeditar",
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

//funcion limpiar
function limpiar(){
	$("#idorden").val("");
    $("#cliente").val("");
    $("#fecha").val("");
    $("#fecha_entrega").val("");
    $("#idprioridad").val("");
    $("#total").val("");
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
          url: '../ajax/pedido.php?op=listar',
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

function mostrar(idorden)
{
  $.post("../ajax/pedido.php?op=mostrar",{idorden:idorden}, function(data, status){
    data = JSON.parse(data);
    mostrarform(true);

    $("#idorden").val(data.idorden);
    $("#cliente").val(data.razonsocial);
    $("#fecha").val(data.fecha);
    $("#fecha_entrega").val(data.fecha_entrega);
    $("#idprioridad").val(data.prioridad);
    $("#total").val(data.total);
    $("#guardar").hide();
});
$.post("../ajax/pedido.php?op=listarDetalle&id="+idorden,function(r){
	        $("#detalles").html(r);
	});	
}

function editar(idorden)
{
  $.post("../ajax/pedido.php?op=editar",{idorden:idorden}, function(data, status){
    data = JSON.parse(data);
    mostrarform(true);

    $("#idorden").val(data.idorden);
    $("#cliente").val(data.razonsocial);
    $("#cliente").selectpicker('refresh');
    $("#fecha").val(data.fecha);
    $("#fecha_entrega").val(data.fecha_entrega);
    $("#idprioridad").val(data.prioridad);
    $("#idprioridad").selectpicker('refresh');
    $("#entrega").val(data.entrega);
    $("#entrega").selectpicker('refresh');
    $("#total").val(data.total);
    $("#guardar").show();
    $("#detalles").hide();

   
});

}

  init();