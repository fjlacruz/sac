<?php
   $variablesSesion = $this->session->userdata('usuario');
   
   $rol = ($variablesSesion['rol']);
   
   ?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<html>
   <body onload="nobackbutton();">
      <?php if ($variablesSesion['rol'] == 1) { ?>
      <section class="content"  style="align-content: center">
         <div class="box box-success" id="section">
            <div class="box-header with-border">
               <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
               <h3 class="box-title">Configuraciones 
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
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              Multas
                           </h4>
                           </br>
                           <p>Multas e Intereses(%)</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>MultasIntereses/multas" class="small-box-footer">Configuracion <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
      <?php if ($variablesSesion['rol'] == 2) { ?>
      <section class="content"  style="align-content: center">
         <div class="box box-success" id="section">
            <div class="box-header with-border">
               <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
               <h3 class="box-title">Configuraciones
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
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              &nbsp;
                           </h4>
                           </br>
                           <p>Multas e Intereses(%)</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>MultasIntereses/multas" class="small-box-footer">Multas e Intereses(%) <i class="fa fa-arrow-circle-right"></i></a>
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
               <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
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
                     <div class="small-box bg-olive">
                        <div class="inner">
                           <h4>
                              &nbsp;
                           </h4>
                           </br>
                           <p>Multas e Intereses(%)</p>
                        </div>
                        <div class="icon">
                           <i class="fa fa-tags"></i>
                        </div>
                        <a href="<?php echo base_url() ?>MultasIntereses/multas" class="small-box-footer">Multas e Intereses(%) <i class="fa fa-arrow-circle-right"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </section>
      <?php } ?>
     
   </body>
</html>


<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>