<!--================================ Script de rura spa de usuarios================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_multas.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-customselect.css" />
<!--=============================================================================================================== -->
<!--===============================================Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->
<body onload="nobackbutton();">
<div id="multas">
   <section class="content">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <span tooltip="Regresar">
            <a href="<?php echo base_url() ?>principal/configuracion" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
            </span>
            <p class="box-title">Administraci&oacute;n de Multas e Intereses</p>
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
   <a class='flotante'><span tooltip="Agregar Multa"><button type="submit" class="btn bg-olive btn-circle btn-lg"  onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
</div>


<div id="registrar_multa" style="display:none;" >
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
             <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <p class="box-title">Registrar Multas</p>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="formulario" method="POST" name="formulario" >
                     <?php
                        foreach($comunidades as $resultado)
                         {
                        ?>
                     <div class="form-group">
                        <div class="row">
                           <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                              <input type="hidden" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                           
                           <div class="form-group col-sm-12">
                              <label>Fecha de Vencimiento</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_vencimiento"  name="fecha_vencimiento" placeholder="FECHA VENCIMIENTO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-12">
                              <label>Proporcional a D&iacute;as..?</label> 
                              <select name="proporcional_a_dias" id="proporcional_a_dias"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-12">
                            <label>Porcentaje de Multa/Inter&eacute;s(%)</label> 
                             <select class="form-control redondeado 1-100" name="porcentaje" id="porcentaje"></select>
                            </div>
                            <div class="form-group col-sm-12">
                              <label>Descripci&oacute;n</label> 
                              <input type="text" name="descripcion" id="descripcion" class="form-control redondeado text-uppercase" placeholder="Descripci&oacute;n" onkeyup=""/>
                              </select>
                           </div>
                           <div class="form-group col-sm-12">
                        <label>Fondo</label> 
                        <select name="id_fondo" id="id_fondo" class="form-control redondeado custom-select" >
                        <option>Selecione...</option>
                        <?php
                           foreach ($fondos as $i => $fondo) {
                           echo '<option value="' . $fondo->id_fondo . '">' . $fondo->descripcion_fondo . $cargo->monto. '</option>';
                             }
                             ?>                     
                        </select>
                     </div>
                           <div class="form-group col-sm-12">
                              <label>Inter&eacute;s Simple..?</label> 
                              <select name="interes_simple" id="interes_simple"  class="form-control redondeado">
                                 <option value="1">SI</option>
                                 <option value="2">NO</option>
                              </select>
                           </div>
                          
                           <div class="col-sm-12">&nbsp;</div>
                          
                           <div class="col-sm-12">
                              <span tooltip="Guardar">
                              <button type="submit" class="btn bg-olive btn-circle" ><i class="fa fa-save"></i></button></span>
                              <span tooltip="Cancelar">
                              <button type="button"   class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                              </span>
                           </div>
                           <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-12">&nbsp;</div>
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
<div id="editar_multa" style="display:none;">
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
             <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <p class="box-title">Editar Multa</p>
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
                        <input type="hidden" name="id_comunidad_modal" id="id_comunidad_modal" value="<?php echo $resultado->id_comunidad?>">
                        <input type="hidden" name="comunidad" id="comunidad" class="form-control redondeado" value="<?php echo $resultado->nombre_comunidad?>" readonly>
                        <input type="hidden"  id="id" name="id" >
                     </div>
                     
                     <div class="col-sm-12">
                              <label>Fecha de Vencimiento</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_vencimiento2"  name="fecha_vencimiento2" placeholder="FECHA VENCIMIENTO" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-12">
                              <label>Proporcional a D&iacute;as..?</label> 
                              <select name="proporcional_a_dias" id="proporcional_a_dias"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                     
                     
                 
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="col-sm-12">
                            <label>Porcentaje de Multa/Inter&eacute;s(%)</label> 
                             <select class="form-control redondeado 1-100" name="porcentaje" id="porcentaje"></select>
                            </div>
                            <div class="col-sm-12">&nbsp;</div>
                            <div class="col-sm-12">
                              <label>Descripci&oacute;n</label> 
                              <input type="text" name="descripcion" id="descripcion" class="form-control redondeado text-uppercase" placeholder="Descripci&oacute;n" onkeyup=""/>
                              </select>
                           </div>
                           <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-12">
                        <label>Fondo</label> 
                        <select name="id_fondo" id="id_fondo" class="form-control redondeado custom-select" >
                        <option>Selecione...</option>
                        <?php
                           foreach ($fondos as $i => $fondo) {
                           echo '<option value="' . $fondo->id_fondo . '">' . $fondo->descripcion_fondo . $cargo->monto. '</option>';
                             }
                             ?>                     
                        </select>
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-12">
                              <label>Inter&eacute;s Simple..?</label> 
                              <select name="interes_simple" id="interes_simple"  class="form-control redondeado">
                                 <option value="1">SI</option>
                                 <option value="2">NO</option>
                              </select>
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
</body>
<script>
   $(function(){
    var $select = $(".1-100");
    for (i=0;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
   });
</script>

<script>
   $(function () {
       $.datepicker.setDefaults($.datepicker.regional["es"]);
       $("#fecha_vencimiento2").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: 'yy-mm-dd',
           firstDay: 1
       }).datepicker("setDate", new Date());
    })
   
   
   
   $(function () {
       $.datepicker.setDefaults($.datepicker.regional["es"]);
       $("#fecha_vencimiento").datepicker({
           changeMonth: true,
           changeYear: true,
           dateFormat: 'yy-mm-dd',
           firstDay: 1
       }).datepicker("setDate", new Date());
    })
     
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
  $(document).ready(function() {
    $('#formulario').formValidation({
        fields: {
            fecha_vencimiento: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
         
            proporcional_a_dias: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            porcentaje: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            descripcion: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            
                interes_simple: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
             id_fondo: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            }

            }
//==============  registro de Usuario ======================================================          
}).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "registrar_multa",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {

        alertify.log("Datos Registrados...!!"); 

        $('#formulario').formValidation('resetForm');
        $('#formulario')[0].reset();
        myFunction(1)
        reload_table();
        //location.reload();
    });
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
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>