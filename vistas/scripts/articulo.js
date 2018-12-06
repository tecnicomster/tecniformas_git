var tabla;

//funcion que se ejecuta al inicio
function init(){
  mostrarform(false);
  listar();
  $("#formulario").on("submit",function(e)
  {
    guardaryeditar(e);
  })

  $.post("../ajax/articulo.php?op=selectLineas", function(r){
              $("#lineas").html(r);
              $('#lineas').selectpicker('refresh');
});


}

//funcion limpiar
function limpiar(){

  $("#idarticulo").val("");
  $("#codigo").val("");
  $("#nombre").val("");
  $("#descripcion").val("");
  $("#lineas").val("");
  

  
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
          url: '../ajax/articulo.php?op=listar',
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
    url: "../ajax/articulo.php?op=guardaryeditar",
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

function mostrar(idarticulo)
{
  $.post("../ajax/articulo.php?op=mostrar",{idarticulo:idarticulo}, function(data, status){
    data = JSON.parse(data);
    mostrarform(true);

    $("#idarticulo").val(data.idarticulo);
    $("#codigo").val(data.codigo);
    $("#nombre").val(data.nombre);
    $("#descripcion").val(data.descripcion);
    $("#lineas").val(data.lineas);
    $("#lineas").selectpicker('refresh');


})
}

//funcion para desactivar la personas

function desactivar(idarticulo)
{
  bootbox.confirm("¿Esta seguro que desea desactivar esta articulo?",function(result){
    if (result)
    {
      $.post("../ajax/articulo.php?op=desactivar",{idarticulo:idarticulo},function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
        

      }
    })
  }

  function activar(idarticulo)
{
  bootbox.confirm("¿Esta seguro que desea activar esta articulo?",function(result){
    if (result)
    {
      $.post("../ajax/articulo.php?op=activar",{idarticulo:idarticulo},function(e){
        bootbox.alert(e);
        tabla.ajax.reload();
      });
        

      }
    })
  }

  init();