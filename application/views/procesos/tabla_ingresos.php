<!--================================ Script de rura spa de usuarios================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_ingresos.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-customselect.css" />
<!--=============================================================================================================== -->
<!--===============================================Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->
<body onload="nobackbutton();">
<div id="ingresos">
   <section class="content" >
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
            <p class="box-title">Administraci&oacute;n de Ingresos</p>
            <a href="<?php echo base_url() ?>Ingresos_extraordinarios/ingresos_extraordinarios">
                                <span tooltip="Ingresos Extraordinarios">
                                <button  type="button" class="btn bg-olive btn-circle" onclick="guardar2()"><i class="fa fa-plus"></i></button>
                                </span></a>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <div class="modal fade" id="myModal" >
                     <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                           <div class="modal-header  bg-olive">
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                              <h4>Registrar Usuario </h4>
                           </div>
                        </div>
                     </div>
                  </div>
                  
                  <div id="tabla">
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
   <a class='flotante'><span tooltip="Agregar Ingreso"><button type="submit" class="btn bg-olive btn-circle btn-lg"  onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
</div>
<!--=============================================================================================================== -->
<!--========================================= Fin Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<!--========================================= Registro de  Ingresos================================================ -->
<!--=============================================================================================================== -->
<div id="registrar_ingreso" style="display:none;" >
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
             <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <p class="box-title">Registrar Ingreso</p>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="formulario" method="POST" name="formulario" enctype="multipart/form-data" action="registrar_ingreso">
                     <?php
                        foreach($comunidades as $resultado)
                         {
                        ?>
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12"  id='resultado'></div>
                           <div class="form-group col-sm-6">
                              <label>Comunidad</label>
                              <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                              <input type="text" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                           </div>
                           <div class="form-group col-sm-6">
                              <label>Nro Departamento</label> &nbsp;
                              <select name="nro_dpto" id="nro_dpto" readonly class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                                 <?php
                                    foreach ($departamentos as $i => $dpto) {
                                    echo '<option value="' . $dpto->nro_dpto . '">' . $dpto->nro_dpto . '</option>';
                                      }
                                      ?>                     
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label>Nombres y Apellidos</label> 
                              <select name="id_copropietario" id="id_copropietario" readonly class="form-control redondeado" >
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label>Monto</label> 
                              <input type="text"  class="form-control redondeado" id="monto" onkeypress="return filterFloat(event,this);" name="monto" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Per&iacute;odo</label> 
                              <select name="periodo" id="periodo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3">3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                 <option value="6">6</option>
                                 <option value="7">7</option>
                                 <option value="8">8</option>
                                 <option value="9">9</option>
                                 <option value="10">10</option>
                                 <option value="11">11</option>
                                 <option value="12">12</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>&nbsp;</label> 
                              <select name="anio" id="anio"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <?php
                                    for ($anio = (date("Y")); 2017 <= $anio; $anio--) {
                                        echo "<option value='$anio'>" . $anio . "</option>";
                                    }
                                    ?>
                              </select>
                           </div>
                           <div class="form-group col-sm-6">
                              <label>Forma de Pago</label> 
                              <select name="id_forma_pago" id="id_forma_pago"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="1">EFECTIVO</option>
                                 <option value="2">DEPOSITO</option>
                                 <option value="3">CHEQUE</option>
                                 <option value="4">TRANSFERENCIA</option>
                              </select>
                           </div>
                           <div class="col-sm-12"></div>
                           <div class="form-group col-sm-6">
                              <label>Nro de Documento</label> 
                              <input type="text"  class="form-control redondeado" id="nro_documento" name="nro_documento" placeholder="NRO DE DOCUMENTO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-6">
                              <label>Fecha Ingreso</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_ingreso"  name="fecha_ingreso" placeholder="FECHA INGRESO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-12">&nbsp;</div>
                           <!--  <div class="form-group col-sm-6">-->
                           <!--    <span class="fa fa-folder-open"></span>-->
                           <!--    <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>-->
                           <!--    <input type='file' name='boton-file2' id="boton-file2" class="form-control redondeado" onchange="leerArchivo(); return fileValidation()">-->
                           <!--    <input type="hidden"  class="codigo" id="adjunto" name="adjunto"></textarea>-->
                           <!--</div>-->
                           <div class="form-group col-sm-6">
                              <span class="fa fa-folder-open"></span>
                              <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>
                              <input type='file' name='adjunto' id="adjunto" class="form-control redondeado" onchange="return fileValidation()">
                           </div>
                           <div class="col-sm-6" id='formato_incorrecto'>&nbsp;</div>
                           <div class="col-xs-12">
                              <span tooltip="Guardar">
                              <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
                             
                           </div>
                        </div>
                     </div>
                     <?php
                        }
                        ?>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!--=============================================================================================================== -->
<!--========================================= Fin de Registro Ingreso============================================= -->
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<!--===================================================Editar Ingreso============================================= -->
<!--=============================================================================================================== -->
<div id="editar_ingreso" style="display:none;">
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <p class="box-title">Editar Ingreso</p>
            <div class="col-sm-12">
               <!--<input type="text" name="nombres_modal" id='nombres_modal' style="border: 0; text-align:right;"/>-->
               <!--<input type="text" name="apellidos_modal" id='apellidos_modal' style="border: 0;"/>-->
               <!--<input type="text" name="nro_dpto_modal" id='nro_dpto_modal' style="border: 0;"/>-->
            </div>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="userForm" method="post" class="form-horizontal">
                     <?php
                        foreach($comunidades as $resultado)
                             {
                           ?>
                     <div class="col-sm-12" align="center">
                        <input type="hidden"  id="id" name="id" >
                      
                        
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-6">
                        <label>Comunidad</label>
                        <input type="hidden" name="id_comunidad_modal" id="id_comunidad_modal" value="<?php echo $resultado->id_comunidad?>">
                        <input type="text" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                     </div>
                     <div class="col-sm-6">
                        <label>Nro Departamento</label> &nbsp;
                       <select name="id_copropietario_modal" id="id_copropietario_modal" readonly class="form-control redondeado custom-select" >
                                 <option value="">Selecione...</option>
                                 <?php
                                    foreach ($departamentos as $i => $dpto) {
                                    echo '<option value="' . $dpto->id_copropietario . '">' . $dpto->nro_dpto . '  '. $dpto->nombres .  '  '. $dpto->apellidos .'</option>';
                                      }
                                      ?>                     
                              </select>
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     
                     
                     <div class="col-sm-6">
                        <label>Monto</label> 
                        <input type="text"  class="form-control redondeado" id="monto_modal" onkeypress="return filterFloat(event,this);" name="monto_modal" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                    
                     <div class="col-sm-3">
                        <label>Per&iacute;odo</label> 
                        <select name="periodo_modal" id="periodo_modal"  class="form-control redondeado">
                           <option value="">Selecione...</option>
                           <option value="1">1</option>
                           <option value="2">2</option>
                           <option value="3">3</option>
                           <option value="4">4</option>
                           <option value="5">5</option>
                           <option value="6">6</option>
                           <option value="7">7</option>
                           <option value="8">8</option>
                           <option value="9">9</option>
                           <option value="10">10</option>
                           <option value="11">11</option>
                           <option value="12">12</option>
                        </select>
                     </div>
                     <div class="col-sm-3">
                        <label>&nbsp;</label> 
                        <select name="anio_modal" id="anio_modal"  class="form-control redondeado">
                           <option value="">Selecione...</option>
                           <?php
                              for ($anio = (date("Y")); 2017 <= $anio; $anio--) {
                                  echo "<option value='$anio'>" . $anio . "</option>";
                              }
                              ?>
                        </select>
                     </div>
                      <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-6">
                        <label>Forma de Pago</label> 
                        <select name="id_forma_pago_modal" id="id_forma_pago_modal"  class="form-control redondeado">
                           <option value="">Selecione...</option>
                           <option value="1">EFECTIVO</option>
                           <option value="2">DEPOSITO</option>
                           <option value="3">CHEQUE</option>
                           <option value="4">TRANSFERENCIA</option>
                        </select>
                     </div>
                    
                     <div class="col-sm-6">
                        <label>Nro de Documento</label> 
                        <input type="text"  class="form-control redondeado" id="nro_documento_modal" name="nro_documento_modal" placeholder="NRO DE DOCUMENTO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                      <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-6">
                        <label>Fecha Ingreso</label> 
                        <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_ingreso_modal"  name="fecha_ingreso_modal" placeholder="FECHA INGRESO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     
                     
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="col-xs-12">
                        <span tooltip="Guardar">
                        <button type="submit" class="btn bg-olive btn-circle" onclick="myFunction(3)"><i class="fa fa-save"></i></button>
                        </span>
                        <span tooltip="Cancelar">
                        <button type="button" class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                        </span>
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-12">&nbsp;</div>
                     <?php
                        }
                        ?>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<!--=============================================================================================================== -->
<!--========================================= Fin de Editar Usuarios============================================= -->
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<!--===================================================Editar Ingreso============================================= -->
<!--=============================================================================================================== -->
<div id="editar_adjunto" style="display:none;">
   <section class="content" id="section" style="width: 95%; align-content: center">
      <!-- SELECT2 EXAMPLE -->
      <div class="box box-success">
         <div class="box-header with-border">
            <h3 class="box-title">Documento Adjunto</h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
               <!--<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <!-- /.box-header -->
         <div class="box-body">
            <div class="row">
               <div class="col-md-3">&nbsp;</div>
               <div class="col-md-8">
                  <span tooltip="Regresar">
                  <a href="<?php echo base_url() ?>principal/bienvenida" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
                  </span>
                  <span tooltip="Actualizar">
                  <button type="button" class="btn bg-orange btn-circle" id="show"><span class='glyphicon glyphicon-refresh'></span></button>
                  </span>
               </div>
               <div class="col-md-1">&nbsp;</div>
               <div class="col-md-3">&nbsp;</div>
               <form id="formulario" action="<?php echo base_url() ?>index.php/egresos/actualizar_adjunto" method="POST" name="formulario" enctype="multipart/form-data">
                  <div class="col-md-8" id="element" style="display: none;">
                     <div id="close"><a href="#" id="hide"><font color="red">Cerrar</font></a></div>
                     <div class="form-group col-sm-8">
                        <span class="fa fa-folder-open"></span>
                        <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>
                        <input type='file' name='adjunto' id="adjunto" class="form-control" onchange="return fileValidation()">
                        <input type='hidden' name='id_egreso' id="id_egreso" class="form-control" value="<?php echo $id_egre?>">
                     </div>
                     <div class="col-md-3">&nbsp;</div>
                     <div class="col-md-5">
                        <span tooltip="Actualizar">
                        <button type="submit" class="btn bg-olive btn-circle"><span class='glyphicon glyphicon-pencil' onclick="mensaje();"></span></button>
                        </span>
                     </div>
                     <div class="col-md-1">&nbsp;</div>
                     <div class="col-md-12">&nbsp;</div>
                     <div class="col-sm-8" id='formato_incorrecto'>&nbsp;</div>
                  </div>
               </form>
               <div class="col-md-1">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-3">&nbsp;</div>
               <div class="col-md-8"><?php echo $datos?></div>
               <div class="col-md-1">&nbsp;</div>
               <!--<div class="col-md-12" align="center"><?php echo '<img width="10%" src="' . base_url() . 'application/recursos/imagenes/LogoCesppa.png">'; ?></div> -->
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
               <div class="col-md-12">&nbsp;</div>
            </div>
         </div>
      </div>
   </section>
</div>
</body>
<!--=============================================================================================================== -->
<!--========================================= Fin de Editar Usuarios============================================= -->
<!--=============================================================================================================== -->
<script>
   function leerArchivo(){
   	var inpute = document.getElementById("boton-file2");
   	if (inpute.files.length > 0){
   		var archivo = inpute.files[0];
   		var lector = new FileReader();
   		lector.addEventListener(
   			"load",
   			function(evento){
   				document.getElementById("adjunto").value = window.btoa(evento.target.result);
   			}, false
   		);
   		lector.readAsDataURL(archivo);
   	}
   }
    
    
</script>
<script>
   //=================== Script para mostrar municipios y parroquias ==================//
       $(document).on("change", '#nro_dpto', function ()
       {
           $("#id_copropietario").load("<?php echo base_url() . 'index.php/ingresos/obtener_copropietario?nro_dpto='; ?>" + $(this).val());
       });
       $(document).on("change", '#nro_dpto_modal', function ()
       {
           $("#id_copropietario_modal").load("<?php echo base_url() . 'index.php/ingresos/obtener_copropietario?nro_dpto='; ?>" + $(this).val());
       });
   
       
</script>
<script>
   $(function () {
       $.datepicker.setDefaults($.datepicker.regional["es"]);
       $("#fecha_ingreso_modal").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: 'yy-mm-dd',
           firstDay: 1
       }).datepicker("setDate", new Date());
    })
   
   
   
   $(function () {
       $.datepicker.setDefaults($.datepicker.regional["es"]);
       $("#fecha_ingreso").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: 'yy-mm-dd',
           firstDay: 1
       }).datepicker("setDate", new Date());
    })
     
</script>
<script>
   $(function() {
     $("#nro_dpto").customselect();
   });
</script>
<!--========== script para permitir solo numeros y dos decimales con punto ==========-->
<script type="text/javascript">
   function filterFloat(evt,input){
       // Backspace = 8, Enter = 13, ‘0′ = 48, ‘9′ = 57, ‘.’ = 46, ‘-’ = 43
       var key = window.Event ? evt.which : evt.keyCode;    
       var chark = String.fromCharCode(key);
       var tempValue = input.value+chark;
       if(key >= 48 && key <= 57){
           if(filter(tempValue)=== false){
               return false;
           }else{       
               return true;
           }
       }else{
             if(key == 8 || key == 13 || key == 0) {     
                 return true;              
             }else if(key == 46){
                   if(filter(tempValue)=== false){
                       return false;
                   }else{       
                       return true;
                   }
             }else{
                 return false;
             }
       }
   }
   function filter(__val__){
       var preg = /^([0-9]+\.?[0-9]{0,2})$/; //===== {0,2} Numero de decimales permitidos =====///
       if(preg.test(__val__) === true){
           return true;
       }else{
          return false;
       }
       
   }
   
</script>
<script>
   $(document).ready(function () {
       $('#formulario').formValidation({
           framework: 'bootstrap',
           excluded: ':disabled',
           fields: {
              
             nro_dpto: {
             row: '.col-sm-6',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
         
         monto: {
             row: '.col-sm-6',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
         periodo: {
             row: '.col-sm-3',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
         anio: {
             row: '.col-sm-3',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
         fecha_ingreso: {
             row: '.col-sm-6',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
               id_forma_pago: {
             row: '.col-sm-6',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
               
               nro_documento: {
             row: '.col-sm-6',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
           },
               id_cheque: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               cuenta: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               periodo: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               anio: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_item: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                 descripcion_item: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               adjunto: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
           }
       });
   });
</script>
<script>
   //========== Validacion de tipo de campo solo letras o numeros =====================================
   function soloLetras(e) {
       key = e.keyCode || e.which;
       tecla = String.fromCharCode(key).toLowerCase();
       letras = " qwertyuiop\F1lkjhgfdsazxcvbnm";
       especiales = "8-37-39-46";
       tecla_especial = false
       for (var i in especiales) {
           if (key == especiales[i]) {
               tecla_especial = true;
               break;
           }
       }
   
       if (letras.indexOf(tecla) == -1 && !tecla_especial) {
           return false;
       }
   }
   
   function soloNumeros(e)
   {
       var key = window.Event ? e.which : e.keyCode
       return ((key >= 48 && key <= 57) || (key == 8));
   }
   
   
   //================= filtros de la tabla ===================================================//
   
   $('#nueva thead th').each(function() {
       var title = $(this).text();
       $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
   });
   
       // DataTable
       var table = $('#nueva').DataTable({
           "scrollY": "500px",
           "scrollCollapse": true,
           "paging": true,
           "order": [[ 0, 'desc' ], [ 2, 'desc' ]],
           retrieve: true
       });
       //Apply the search
       table.columns().every(function() {
           var that = this;
           $('input', this.header()).on('keyup change', function() {
               if (that.search() !== this.value) {
                   that.search(this.value).draw();
               }
           });
       });
   
       $(document).ready(function() {
           $('.filterable .btn-filter').click(function() {
               var $panel = $(this).parents('.filterable'),
               $filters = $panel.find('.filters input'),
               $tbody = $panel.find('.table tbody');
               if ($filters.prop('disabled') == true) {
                   $filters.prop('disabled', false);
                   $filters.first().focus();
               } else {
                   $filters.val('').prop('disabled', true);
                   $tbody.find('.no-result').remove();
                   $tbody.find('tr').show();
               }
           });
           $('.filterable .filters input').keyup(function(e) {
   
               var code = e.keyCode || e.which;
               if (code == '9')
                   return;
               var $input = $(this),
               inputContent = $input.val().toLowerCase(),
               $panel = $input.parents('.filterable'),
               column = $panel.find('.filters th').index($input.parents('th')),
               $table = $panel.find('.table'),
               $rows = $table.find('tbody tr');
               var $filteredRows = $rows.filter(function() {
                   var value = $(this).find('td').eq(column).text().toLowerCase();
                   return value.indexOf(inputContent) === -1;
               });
               $table.find('tbody .no-result').remove();
               $rows.show();
               $filteredRows.hide();
               if ($filteredRows.length === $rows.length) {
                   $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
               }
           });
       });
</script>
<script>
   function fileValidation(){
       var fileInput = document.getElementById('adjunto');
       var filePath = fileInput.value;
       var allowedExtensions = /(.jpg|.jpeg|.png|.gif|.gif)$/i;
       if(!allowedExtensions.exec(filePath)){
           
           alertify.error("Formato Incorrecto  (Seleccione un archivo jpg,jpeg,png,gif)...!!");
           fileInput.value = '';
           return false;
       }else{
           //Image preview
           if (fileInput.files && fileInput.files[0]) {
               var reader = new FileReader();
               reader.onload = function(e) {
                   document.getElementById('imagePreview').innerHTML = '<img width="100" height="100" src="'+e.target.result+'"/>';
               };
               reader.readAsDataURL(fileInput.files[0]);
           }
       }
   }
</script>
<script>
   function mensaje(){
   	 alertify.log("Ingreso Registrado...!!"); 
   }
    
</script>



<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>
