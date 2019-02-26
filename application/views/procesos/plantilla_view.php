<?php
 $variablesSesion = $this->session->userdata('usuario');
 $rol = ($variablesSesion['rol']);
?>

<!--================================ Script de rutas ============================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_medidores.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-customselect.css" />
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<script>
   $(function() {
     $("#nro_dpto").customselect();
   });
</script>
<!--=============================================================================================================== -->
<!--===============================================Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->
<body onload="nobackbutton();">
<div>
   <section class="content" style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)) { ?>
            <a href="<?php echo base_url() ?>Medidores/lectura_medidores2">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
             <?php } ?>
             
             
             <?php if ($variablesSesion['rol'] == 3) { ?>
            <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
             <?php } ?>
             
            <p class="box-title">Generar Plantilla para Carga Masiva</p>

            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
            
         </div>
         <div class="col-sm-12">
          <div class="col-sm-12">&nbsp;</div>
            <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
            
            <table>
               <tr>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/registrar_lectura'; ?>" class="btn btn-default"  type="button"><strong>Registrar Lecturas</strong></a></td>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/lectura_medidores2'; ?>" class="btn btn-default" type="button"><strong>Consultar Lecturas</strong></a></td>
      
                  <td><a href="#" class="btn btn-success" disabled="disabled" type="button"><strong>Descargar Plantilla(Carga Masiva)</strong></a></td>
               </tr>
            </table>
            </div>
            
            </br></br>
            
            
            <?php } ?>   
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="modal fade" id="myModal" >
                     <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                           <div class="modal-header  bg-olive">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div id="asignar_medidor">
                     <div class="col-sm-4">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <form id="formulario" name="formulario" method='POST' action='exel'>
                        <div class="col-sm-6">
                           <label >Nombre del Medidor</label>
                           <select name="medidor" id="medidor"  class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                                 
                                  <?php
                        foreach ($medidores as $i => $medidor) {
                            echo '<option value="' . $medidor->nombre_medidor . '">' . $medidor->nombre_medidor . '</option>';
                        }
                        ?>                      
                              </select>
                        </div>
                        
                         <div class="col-sm-2">
                           <label>Torre</label>
                           <select name="torre" id="torre"  class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                               
                                  <?php
                        foreach ($torres as $i => $torre) {
                            echo '<option value="' . $torre->nombre_torre . '">' . $torre->nombre_torre . '</option>';
                        }
                        ?>                      
                              </select>
                        </div>
                       
             
                         <select name="torres" id="torres" readonly class="form-control redondeado" style="visibility:hidden"></select>
              
                        
                       
                        <div class="col-sm-2">
                           <label>&nbsp;</label>
                           <span tooltip="Generar Plantilla">
                              <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
                       
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden" id="F" value="<?php echo base_url() ?>Medidores/medidores">
                     </form>
                  </div>
               </div>
            </div>
         </div>
         
      </div>
   </section>
</div>
</body>


<script type="text/javascript">
   $(document).ready(function () {
       $('#formulario')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       medidor: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                           torre: {
                           row: '.col-sm-2',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                       anio: {
                           row: '.col-sm-2',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          }
                   }
               })
               
       
   });
   
</script>


<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>