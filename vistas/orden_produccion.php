<?php
//Activamos el almacenamiento en el buffer
ob_start();
session_start();


if (!isset($_SESSION["nombre"]))
{
  header("Location: login.html");
}
else
{
require 'header.php';

if ($_SESSION['produccion']==1)
{
  $usu= $_SESSION['idusuario']
?>
<!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">        
        <!-- Main content -->
        <section class="content">
            <div class="row">
               <div class="col-md-12">
                  <div class="box">
                    <div class="box-header with-border">
                          <h1 class="box-title">Orden de produccion </h1>
                          <div class="box-tools pull-right">

                        </div>
                      </div>
                    
                    <!-- /.box-header -->
                    <div class="panel-body" id="formularioregistros">
                      <form name="formulario" id="formulario" method="POST">
                        <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-12">
                        <label>Cliente - Sede:</label>
                        <select id="cliente" name="cliente" class="form-control selectpicker" data-live-search="true" required></select>
                        <input type="hidden" class="form-control" name="iddetalle" id="iddetalle">
                        <input type="hidden" class="form-control" name="usuario" id="usuario" value="<?php echo $usu;?>"> 
                          </div>
                        <div class="form-group col-log-2 col-md-3 col-sm-6 col-xs-6">
                          <label>Prioridad:</label>
                          <select id="prioridad" name="prioridad" class="form-control selectpicker" data-live-search="true" required></select>
                          </div>
                        <div class="form-group col-log-2 col-md-3 col-sm-6 col-xs-6">
                          <label>Encargado:</label>
                          <select id="encargado" name="encargado" class="form-control selectpicker" data-live-search="true" required></select>
                          </div> 
                        <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <label>Fecha entrega:</label>
                        <input type="date" class="form-control" name="fecha_entrega" id="fecha_entrega" required="">
                        </div>
                         <div class="form-group col-lg-2 col-md-3 col-sm-6 col-xs-6">
                        <label>Entrega:</label>
                         <select id="entrega" name="entrega" class="form-control selectpicker" data-live-search="true" required>
                           <option value="Recoge">Se recoge</option>
                           <option value="Envie">Se envia</option>
                         </select>
                        </div>
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <legend>Articulos de la orden</legend> 
                        </div>
                        <div class="form-group col-lg-4 col-md-4 col-sm-6 col-xs-12">
                        <label>Articulo</label>
                        <select id="idnombre" name="idnombre" class="form-control selectpicker" data-live-search="true" required=""></select>
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Peso:</label>
                        <input type="number" class="form-control" name="peso" id="peso" required="">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Color:</label>
                        <input type="text" class="form-control" name="color1" id="color1" required="">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Cantidad:</label>
                        <input type="number" class="form-control" name="cantidad" id="cantidad" required="">
                        </div>
                        <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label>Valor:</label>
                        <input type="number" class="form-control" name="valor" id="valor" required="">
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-6">
                        <label>Observaciones:</label>
                        <input type="text" class="form-control" name="observacion" id="observacion">
                        </div>

                          <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-6">
                            <br>
                            <button class="btn btn-primary" type="submit" id="btnGuardar"><i class="fa fa-save"></i> Guardar</button>
                          </div>

                    <!-- centro -->
                    <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed dt-responsive table-hover">
                          <thead>
                            <th>Articulo</th>
                            <th>peso</th>
                            <th>color</th>
                            <th>cantidad</th>
                            <th>valor</th>
                            <th>observacion</th>
                            <th>Encargado</th>
                            <th>Opciones</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Articulo</th>
                            <th>peso</th>
                            <th>color</th>
                            <th>cantidad</th>
                            <th>valor</th>
                            <th>observacion</th>
                            <th>Encargado</th>
                            <th>Opciones</th>
                          </tfoot>
                        </table>
                    </div>
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12" id="botones"><button class="btn btn-primary" id="confirmar" onclick="adpedido()"><i class="fa fa-plus-circle"></i> Confirmar Pedido</button> <button class="btn btn-danger" onclick="borrarTodo()" type="button"><i class="fa fa-arrow-circle-left"></i> Borrar</button>
                            </div>
                        </form>
                    </div>
                    <!--Fin centro -->
                  </div><!-- /.box -->
              </div><!-- /.col -->
          </div><!-- /.row -->
      </section><!-- /.content -->
    </div><!-- /.content-wrapper -->
  <!--Fin-Contenido-->
<?php
}
else
{
  require 'noacceso.php';
}

require 'footer.php';
?>
<script type="text/javascript" src="scripts/orden_produccion.js"></script>
<?php 
}
ob_end_flush();
?>


