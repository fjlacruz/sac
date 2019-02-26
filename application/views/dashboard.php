<?php
   $variablesSesion = $this->session->userdata('usuario');
   //print_r($variablesSesion);
   
   $rol = ($variablesSesion['rol']);
   
   ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<html>
   <body onload="nobackbutton();">
      <?php if ($variablesSesion['rol'] == 1) { ?>
      <section class="content"  style="align-content: center">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Sistema de Administraci&oacute;n de Condominios 
                  <?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/logo_condominio.jpg">'; ?>
               </h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($suma as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Ingresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos/ingresos" class="small-box-footer">Ingresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaExt as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <h5>Total de Ingresos Extraordinarios</h5>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos_extraordinarios/ingresos_extraordinarios" class="small-box-footer">Ingresos Extraordinarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-red">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaE as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Egresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="small-box-footer">Egresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-blue">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($copropietarios as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Copropietarios</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-users"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Copropietarios/index" class="small-box-footer">Copropietarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-yellow">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($comunidades as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Comunidades</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-home"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosComunidad" class="small-box-footer">Comunidades <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-purple">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($proveedores as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Proveedores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor" class="small-box-footer">proveedores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-aqua">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($items as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Items</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosItem" class="small-box-footer">Items <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-maroon">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($cheques as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Cheques</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosCheque" class="small-box-footer">Cheques <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-orange">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Configuraci&oacute;n</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-gears"></i>
                        </div>
                        <a href="<?php echo base_url() ?>principal/configuracion" class="small-box-footer">Configuraci&oacute;n <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-primary">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Medidores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-dashboard"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Medidores/lectura_medidores2" class="small-box-footer">Medidores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
      <?php if ($variablesSesion['rol'] == 2) { ?>
      <section class="content"  style="align-content: center">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Sistema de Administraci&oacute;n de Condominios 
                  <?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/logo_condominio.jpg">'; ?>
               </h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  <div class="col-sm-12">&nbsp;</div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($suma as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Ingresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos/ingresos" class="small-box-footer">Ingresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaExt as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <h5>Total de Ingresos Extraordinarios</h5>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos_extraordinarios/ingresos_extraordinarios" class="small-box-footer">Ingresos Extraordinarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-red">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaE as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Egresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="small-box-footer">Egresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-blue">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($copropietarios as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Copropietarios</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-users"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Copropietarios/index" class="small-box-footer">Copropietarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-yellow">
                        <div class="inner">
                           <h4>
                              Torres/Edificios
                           </h4>
                           </br>
                           <p>Torres/Edificios</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-home"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosTorres" class="small-box-footer">Torres/Edificios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-purple">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($proveedores as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Proveedores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor" class="small-box-footer">proveedores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                 
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-maroon">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($cheques as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Cheques</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosCheque" class="small-box-footer">Cheques <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
               
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-orange">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Configuraci&oacute;n</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-gears"></i>
                        </div>
                        <a href="<?php echo base_url() ?>principal/configuracion" class="small-box-footer">Configuraci&oacute;n <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-primary">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Medidores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-dashboard"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Medidores/lectura_medidores2" class="small-box-footer">Medidores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-gray">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Remuneraciones</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-dashboard"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Remuneraciones/trabajadores" class="small-box-footer">Renuneraciones <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
      <?php if ($variablesSesion['rol'] == 3) { ?>
      <section class="content"  style="align-content: center">
         <div class="box box-success">
            <div class="box-header with-border">
               <h3 class="box-title">Sistema de Administraci&oacute;n de Condominios
                  <?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/logo_condominio.jpg">'; ?>
               </h3>
               <div class="box-tools pull-right">
                  <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
               </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
               <div class="row">
                  <div class="col-xs-12">&nbsp;</div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($suma as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Ingresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos/ingresos" class="small-box-footer">Ingresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaExt as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <h5>Total de Ingresos Extraordinarios</h5>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Ingresos_extraordinarios/ingresos_extraordinarios" class="small-box-footer">Ingresos Extraordinarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-red">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($sumaE as $fila)
                                 $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                                 {
                                 ?>
                              <?php echo '$' . $nombre_format_francais?>
                              <?php
                                 }
                                 ?>  
                           </h4>
                           </br>
                           <p>Total de Egresos</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-money"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="small-box-footer">Egresos <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-blue">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($copropietarios as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Copropietarios</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-users"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Copropietarios/index" class="small-box-footer">Copropietarios <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-purple">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($proveedores as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Proveedores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-shopping-cart"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor" class="small-box-footer">proveedores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  
                  <div class="col-xs-3">
                     <!-- small box -->
                     <div class="small-box bg-maroon">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($cheques as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Cheques</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosCheque" class="small-box-footer">Cheques <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-maroon">
                        <div class="inner">
                           <h4>
                              <?php
                                 foreach($medidores as $fila)
                                  {
                                  ?>
                              <?php echo $fila->cantidad ?>
                              <?php
                                 }
                                 ?>
                           </h4>
                           </br>
                           <p>Medidores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-dashboard"></i>
                        </div>
                        <a href="<?php echo base_url() ?>medidores/medidores" class="small-box-footer">Medidores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  <div class="col-sm-3">
                     <!-- small box -->
                     <div class="small-box bg-primary">
                        <div class="inner">
                           <h4>
                             &nbsp;
                           </h4>
                           </br>
                           <p>Lectura de Medidores</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-dashboard"></i>
                        </div>
                        <a href="<?php echo base_url() ?>Medidores/lectura_medidores2" class="small-box-footer">Medidores <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
                  
                  
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
   </body>
</html>