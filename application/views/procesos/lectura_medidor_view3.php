<?php 
   setlocale(LC_ALL, 'es_VE.UTF-8');
   date_default_timezone_set('America/Caracas');
   $hoy            = date("Y-m-d");
   $fecha_registro = substr($hoy, 0, 10);
   
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   $id_comunidad = ($variablesSesion['id_comunidad']);
   ?>

<script>
   function myFunction(idButton) {
      var registrar_lectura = document.getElementById('registrar_lectura');
      var actualizar_lectura = document.getElementById('actualizar_lectura');
   
      switch(idButton) {
       case 1:
       actualizar_lectura.style.display = 'block';
       registrar_lectura.style.display = 'none';
       break;
   
       case 2:
       actualizar_lectura.style.display = 'none';
       registrar_lectura.style.display = 'block';
       break;
       case 3:
       actualizar_lectura.style.display = 'none';
       registrar_lectura.style.display = 'none';
       break;
   
       default:
       alert("hay un problema: No existe la Ruta.")
   }
   
   }
   
</script>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<html>
   <body onload="nobackbutton();">
      <section class="content"   style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
      <div class="box-header with-border">
          <span tooltip="Regresar">
            <a href="<?php echo base_url() ?>Medidores/lectura_medidores2" class="btn bg-orange btn-circle" type="button">
            <span class='glyphicon glyphicon-arrow-left'></a>
            </span>
         <h3 class="box-title">Medidores</h3>
         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
         </div>
      </div>
      <div >
          <div class="col-sm-12">&nbsp;</div>
          <div class="col-sm-12">
      <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
          
             <table>
               <tr>
                  <td><a href="#" class="btn btn-success" disabled="disabled" type="button"><strong>Consultar Lecturas</strong></a></td>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/registrar_lectura'; ?>" class="btn btn-default" type="button"><strong>Registrar Lecturas</strong></a></td>
                  <td><a href="<?php echo base_url() . 'index.php/Medidores/plantilla'; ?>" class="btn btn-default" type="button"><strong>Descargar Plantilla(Carga Masiva)</strong></a></td>
               </tr>
            </table>
          
          <?php } ?> 
       </div>   
</div>
<div class="col-sm-12">&nbsp;</div>
      <form id="formulario" name="formulario" action="<?php echo base_url() . 'index.php/Medidores/lectura_medidores_comunidad'; ?>" method="POST">
            <table border="0" align="center"  width="60%">
                <tr>
                    <td>
                         <label>Medidor</label> 
                          <select name="id_medidor" id="id_medidor"  class="form-control redondeado custom-select" >
                           <option value="">Selecione...</option>
                            <?php
                             foreach ($medidores as $i => $medidor) {
                            echo '<option value="' . $medidor->nombre_medidor . '">' . $medidor->nombre_medidor . '</option>';
                            }
                             ?>                     
                          </select>
                    </td>
                    <td>
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
                    </td>
                    <td>
                        <label>&nbsp;</label> 
                        <select name="anio" id="anio"  class="form-control redondeado">
                           <option value="">Selecione...</option>
                           <?php
                              for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                                  echo "<option value='$anio'>" . $anio . "</option>";
                              }
                              ?>
                        </select>
                    </td>
                    <td>
                        </br>
                        <span tooltip="Consultar">
                         <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-search"></i></button>
                        </span>
                    </td>
                </tr>
            </table>
      <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $id_comunidad ?>"/>
      </form>
      
      <div class="box-body">
      <div class="row">
      <div class="col-md-12">
      <div id="actualizar_lectura" style="display:none;">
         <div class="col-sm-4">
            <span class="badge badge-success">
               <strong>
                  <h5>Editar lectura</h5>
               </strong>
            </span>
         </div>
         <div class="col-sm-12">&nbsp;</div>
         <form id="userForm1" method="post" class="form-horizontal">
            <div class="col-sm-2">
               <label>N° Departamento</label> 
               <input type="text" readonly  class="form-control redondeado" id="nro_dpto_edit" onKeyPress="return soloLetras(event)" name="nro_dpto_edit" placeholder="Item">
            </div>
            <div class="col-sm-2">
               <label>Lectura Anterior</label> 
               <input type="text" class="form-control redondeado" id="lectura_anterior_edit" onkeypress="return filterFloat(event,this);" name="lectura_anterior_edit" placeholder="Lectura Anterior" onkeyup="javascript:this.value = this.value.toUpperCase()">
            </div>
            <div class="col-sm-2">
               <label>Lectura Actual</label> 
               <input type="text"  class="form-control redondeado" id="lectura_actual_edit" onkeypress="return filterFloat(event,this);"  name="lectura_actual_edit" placeholder="Lectura Actual" onkeyup="javascript:this.value = this.value.toUpperCase()">
            </div>
            <div class="col-sm-2">
               <label>Per&iacute;odo</label> 
               <select name="periodo_edit" id="periodo_edit"  class="form-control redondeado">
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
            <div class="col-sm-2">
               <label>&nbsp;</label> 
               <select name="anio_edit" id="anio_edit"  class="form-control redondeado">
                  <option value="">Selecione...</option>
                  <?php
                     for ($anio = (date("Y")); 2017 <= $anio; $anio--) {
                         echo "<option value='$anio'>" . $anio . "</option>";
                     }
                     ?>
               </select>
            </div>
            <input type="hidden"  class="form-control redondeado" id="estatus"  name="estatus" >
            <div class="col-sm-12">&nbsp;</div>
            <input type="hidden"  class="form-control" id="id"  name="id" >
            <input type="hidden"  class="form-control" id="id_medidor_edit"  name="id_medidor_edit" >
            <input type="hidden"  class="form-control" id="fecha_registro_edit"  name="fecha_registro_edit" value="<?php echo $fecha_registro?>">
            <div class="form-group">
               <div class="col-xs-12">
                  <span tooltip="Guardar">
                  <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                  <span tooltip="Cancelar">
                  <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(3)"><i class="fa fa-close"></i></button>
                  </span>
               </div>
            </div>
         </form>
      </div>
      <div id="registrar_lectura" style="display:none;">
         <div class="col-sm-4">
            <span class="badge badge-success">
               <strong>
                  <h5>Registar lectura</h5>
               </strong>
            </span>
         </div>
         <div class="col-sm-12">&nbsp;</div>
         <form id="userForm2" method="post" class="form-horizontal">
            <div class="col-sm-2">
               <label>Medidor</label> 
               <select name="id_medidor" id="id_medidor" readonly class="form-control redondeado custom-select" >
                  <option value="">Selecione...</option>
                  <?php
                     foreach ($medidores as $i => $medidor) {
                     echo '<option value="' . $medidor->id_medidor . '">' . $medidor->nombre_medidor . '</option>';
                       }
                       ?>                     
               </select>
            </div>
            <div class="col-sm-2">
               <label>N° Departamento</label> 
               <select name="nro_dpto" id="nro_dpto" readonly class="form-control redondeado custom-select" >
                  <option value="">Selecione...</option>
                  <?php
                     foreach ($departamentos as $i => $dpto) {
                     echo '<option value="' . $dpto->nro_dpto . '">' . $dpto->nro_dpto . '</option>';
                       }
                       ?>                     
               </select>
            </div>
            <div class="col-sm-2">
               <label>Lectura Anterior</label> 
               <input type="text" class="form-control redondeado" id="lectura_anterior" onkeypress="return filterFloat(event,this);" name="lectura_anterior" placeholder="Lectura Anterior" onkeyup="javascript:this.value = this.value.toUpperCase()">
            </div>
            <div class="col-sm-2">
               <label>Lectura Actual</label> 
               <input type="text"  class="form-control redondeado" id="lectura_actual" onkeypress="return filterFloat(event,this);"  name="lectura_actual" placeholder="Lectura Actual" onkeyup="javascript:this.value = this.value.toUpperCase()">
            </div>
            <div class="col-sm-2">
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
            <div class="col-sm-2">
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
            <input type="hidden"  class="form-control redondeado" id="estatus"  name="estatus" >
            <div class="col-sm-12">&nbsp;</div>
            <input type="hidden"  class="form-control" id="fecha_registro"  name="fecha_registro" value="<?php echo $fecha_registro?>">
            <div class="form-group">
               <div class="col-xs-12">
                  <span tooltip="Guardar">
                  <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                  <span tooltip="Cancelar">
                  <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(3)"><i class="fa fa-close"></i></button>
                  </span>
               </div>
            </div>
         </form>
      </div>
      <div id="lectura_medidor">
         <div class='filterable'>
            <div class='panel-heading'>
               <div class='pull-right'>
                  <span tooltip="Filtrar">
                  <button class='btn bg-olive btn-xs btn-filter btn-circle'><span class='fa fa-filter'></span></button>
                  </span>
               </div>
            </div>
            
            
            
            <?php if ($variablesSesion['rol'] == 1) { ?>
            <table id="nueva" class="display " cellspacing="0" width="100%" >
               <thead>
                  <tr class="filters">
                     <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                     <th onkeypress="return soloLetras(event)">Comunidad</th>
                     <th onkeypress="return soloLetras(event)">Torre</th>
                     <th onkeypress="return soloLetras(event)">N° Departamento</th>
                     <th onkeypress="return soloLetras(event)">Medidor</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Anterior</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Actual</th>
                     <th onkeypress="return soloNumeros(event)">Consumo</th>
                     <th onkeypress="return soloNumeros(event)">Monto a Pagar</th>
                     <th onkeypress="return soloNumeros(event)">Per&iacute;odo</th>
                     <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                     <th onkeypress="return soloLetras(event)">Editar</th>
                  </tr>
               </thead>
               <?php
                  $contenido = "";
                  foreach ($lectura as $resultado) {
                   $nombre_format_francais = number_format($resultado->pago, 2, ',', '. ');
                  $contenido.="<tr>      
                  
                     <td style='display:none'>" . "$resultado->id_lectura" . "</td>
                     <td align='center'>" . "$resultado->id_comunidad" . "</td>
                     <td align='center'>" . "$resultado->id_torre" . "</td>
                     <td align='center'>" . "$resultado->nro_dpto" . "</td>
                     <td align='center'>" . "$resultado->id_medidor" . "</td>
                     <td align='center'>" .  "$resultado->lectura_anterior" . "</td>
                     <td align='center'>" .  "$resultado->lectura_actual" . "</td>
                      <td align='center'>" .  "$resultado->consumo" . "</td>
                      <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                     <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                     <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                     
                     <td align='center'>

                     
                     <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_lectura' class='btn bg-olive btn-circle editButton1' onclick='myFunction(1)'>
            <span class='fa  fa-edit'></span>
            </button></span>
            <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_lectura' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
             </button></span>
                   </td> 
                    </tr>";
                     }
                  
                     ?>
               <tbody>                  
                  <?php
                     echo $contenido;
                     ?>
               </tbody>
            </table>
            

            <?php } ?>
            
            <?php if ($variablesSesion['rol'] == 2) { ?>
            <table id="nueva" class="display " cellspacing="0" width="100%" >
               <thead>
                  <tr class="filters">
                     <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                     <th onkeypress="return soloLetras(event)">N° Departamento</th>
                     <th onkeypress="return soloLetras(event)">Torre</th>
                     <th onkeypress="return soloLetras(event)">Medidor</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Anterior</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Actual</th>
                     <th onkeypress="return soloNumeros(event)">Consumo</th>
                     <th onkeypress="return soloNumeros(event)">Monto a Pagar</th>
                     <th onkeypress="return soloNumeros(event)">Per&iacute;odo</th>
                     <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                     <th onkeypress="return soloLetras(event)">Editar</th>
                  </tr>
               </thead>
               <?php
                  $contenido = "";
                  foreach ($lectura as $resultado) {
                  $nombre_format_francais = number_format($resultado->pago, 2, ',', '. ');
                  $contenido.="<tr>      
                  
                     <td style='display:none'>" . "$resultado->id_lectura" . "</td>
                     <td align='center'>" . "$resultado->nro_dpto" . "</td>
                     <td align='center'>" . "$resultado->id_torre" . "</td>
                     <td align='center'>" . "$resultado->id_medidor" . "</td>
                     <td align='center'>" .  "$resultado->lectura_anterior" . "</td>
                     <td align='center'>" .  "$resultado->lectura_actual" . "</td>
                     <td align='center'>" .  "$resultado->consumo" . "</td>
                     <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                     <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                     <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                     
                     <td align='center'>
                     
                      <span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_lectura' class='btn bg-olive btn-circle editButton1' onclick='myFunction(1)'>
            <span class='fa  fa-edit'></span>
            </button></span>
            <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_lectura' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
             </button></span>
                     
                   </td> 
                    </tr>";
                     }
                  
                     ?>
               <tbody>                  
                  <?php
                     echo $contenido;
                     ?>
               </tbody>
            </table>
      
            <?php } ?>
            <?php if ($variablesSesion['rol'] == 3) { ?>
            <table id="nueva" class="display " cellspacing="0" width="100%" >
               <thead>
                  <tr class="filters">
                     <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>
                     <th onkeypress="return soloLetras(event)">Torre</th>
                     <th onkeypress="return soloLetras(event)">N° Departamento</th>
                     <th onkeypress="return soloLetras(event)">Medidor</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Anterior</th>
                     <th onkeypress="return soloNumeros(event)">Lectura Actual</th>
                     <th onkeypress="return soloNumeros(event)">Consumo</th>
                     <th onkeypress="return soloNumeros(event)">Monto a Pagar</th>
                     <th onkeypress="return soloNumeros(event)">Per&iacute;odo</th>
                     <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                  </tr>
               </thead>
               <?php
                  $contenido = "";
                  foreach ($lectura as $resultado) {
                   $nombre_format_francais = number_format($resultado->pago, 2, ',', '. ');
                  $contenido.="<tr>      
                  
                    <td style='display:none'>" . "$resultado->id_lectura" . "</td>
                     <td align='center'>" . "$resultado->nro_dpto" . "</td>
                     <td align='center'>" . "$resultado->id_torre" . "</td>
                     <td align='center'>" . "$resultado->id_medidor" . "</td>
                     <td align='center'>" .  "$resultado->lectura_anterior" . "</td>
                     <td align='center'>" .  "$resultado->lectura_actual" . "</td>
                     <td align='center'>" .  "$resultado->consumo" . "</td>
                     <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                     <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                     <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                     <td align='center'>
                   </td> 
                    </tr>";
                     }
                  
                     ?>
               <tbody>                  
                  <?php
                     echo $contenido;
                     ?>
               </tbody>
            </table>
            <?php } ?>
            
        
            
         </div>
         <div class="col-sm-12">&nbsp;</div><div class="col-sm-12">&nbsp;</div>
         <button type="button" class="btn bg-olive">Total Consumo del Medidor: <span class="badge">
  
         
                  <?php
                  foreach($consumo as $resultado)
                  {
                  ?>
               <?php echo $resultado->consumo?>
               
               <?php
                  }
                  ?>
  
   </span></button>
   
   <button type="button" class="btn bg-olive">Monto de la factura(s): <span class="badge">
  
         
                  <?php
                  foreach($montos as $monto)
                   $nombre_format_francais = number_format($monto->monto, 2, ',', '. ');
                  {
                  ?>
               <?php echo '$'.$nombre_format_francais?>
               
               <?php
                  }
                  ?>
  
   </span></button>
   
   <button type="button" class="btn bg-olive">Monto de la factura(s) Seg&uacute;n porcentaje aplicable: <span class="badge">
  
         
                  <?php
                  foreach($montos_porcenteje as $porcentaje)
                   $nombre_format_francais = number_format($porcentaje->porcentaje, 2, ',', '. ');
                  {
                  ?>
               <?php echo '$'.$nombre_format_francais?>
               
               <?php
                  }
                  ?>
  
   </span></button>
   
   
   <button type="button" class="btn bg-olive">M3: <span class="badge">
  
         
                  <?php
                  foreach($m3 as $result)
                  $nombre_format_francais = number_format($result->m3, 2, ',', '. ');
                  {
                  ?>
               <?php echo $nombre_format_francais?>
               
               <?php
                  }
                  ?>
              
   </span></button>
    <div class="col-sm-12">&nbsp;</div>
     <div class="col-sm-12">&nbsp;</div>
      <div class="col-sm-12">&nbsp;</div>
      </div>
      <input type="hidden" id="redireccion" value="<?php echo base_url() ?>medidores/lectura_medidores"> 
   </body>
</html>
<script type="text/javascript">
   $(document).ready(function() {
       $('#userForm1').formValidation({
           fields: {
               
               lectura_anterior_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               
                lectura_actual_edit: {
             row: '.col-sm-2',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
          anio_edit: {
             row: '.col-sm-2',
             validators: {
                 notEmpty: {
                     message: 'CAMPO OBLIGATORIO'
                 }
             }
         },
               periodo_edit: {
                   row: '.col-sm-2',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               }
           }
       }).on('success.form.fv', function(e) {
           e.preventDefault();
           var $form = $(e.target);
           $.ajax({
               url: "<?php echo base_url() . 'index.php/Medidores/actualizar_lectura'; ?>",
               method: 'POST',
               data: $form.serialize()
           }).success(function(response) {
   
            alertify.log("Lectura Registrada...!!!"); 
              
            $('#userForm1')[0].reset();
             myFunction(1)
             //reload_table();
             location.reload();
           });
       });
   });
   $('.editButton1').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/consultarLecturaId/'; ?>" + id,
           method: 'GET'
   
       }).success(function(data) {
   
            var obj1 = JSON.parse(data);//parceamos los datos
            var obj = eval("(" + JSON.stringify(obj1) + ")");// limpiamos el json
            
           $('#userForm')
           $('[name="id"]').val(obj.id_lectura);
           $('[name="id_medidor"]').val(obj.id_medidor);
           $('[name="nro_dpto_edit"]').val(obj.nro_dpto);
           $('[name="lectura_anterior_edit"]').val(obj.lectura_anterior);
           $('[name="lectura_actual_edit"]').val(obj.lectura_actual);
           $('[name="periodo_edit"]').val(obj.periodo);
           $('[name="anio_edit"]').val(obj.anio);
   
       });
   });
    $(document).ready(function () {
   
        $('#nueva thead th').each(function () {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control text-center"  placeholder="' + title + '" disabled  />');
        }
        );
        // DataTable
        var table = $('#nueva').DataTable({
            "scrollY": "500px",
            "scrollCollapse": true,
            "paging": true,
            "order": [[ 0, 'desc' ], [ 2, 'desc' ]],
            "retrieve": true
        });
        
        //Apply the search
        table.columns().every(function () {
            var that = this;
            $('input', this.header()).on('keyup change', function () {
                if (that.search() !== this.value) {
                    that
                            .search(this.value)
                            .draw();
                }
            });
        });
        
    });
   
    //------------------------------------------------- Solo Letra-------------------------------------------------//
   
    function soloLetras(e) {
        key = e.keyCode || e.which;
        tecla = String.fromCharCode(key).toLowerCase();
        letras = " qwertyuiop�lkjhgfdsazxcvbnm";
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
        return ((key >= 48 && key <= 57) || (key == 8))
    }
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
   
    $(document).ready(function () {
        $('.filterable .btn-filter').click(function () {
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
        $('.filterable .filters input').keyup(function (e) {
            /* Ignore tab key */
            var code = e.keyCode || e.which;
            if (code == '9')
                return;
            /* Useful DOM data and selectors */
            var $input = $(this),
                    inputContent = $input.val().toLowerCase(),
                    $panel = $input.parents('.filterable'),
                    column = $panel.find('.filters th').index($input.parents('th')),
                    $table = $panel.find('.table'),
                    $rows = $table.find('tbody tr');
            /* Dirtiest filter function ever ;) */
            var $filteredRows = $rows.filter(function () {
                var value = $(this).find('td').eq(column).text().toLowerCase();
                return value.indexOf(inputContent) === -1;
            });
            /* Clean previous no-result if exist */
            $table.find('tbody .no-result').remove();
            /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
            $rows.show();
            $filteredRows.hide();
            /* Prepend no-result row if all rows are filtered */
            if ($filteredRows.length === $rows.length) {
                $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="' + $table.find('.filters th').length + '">No se encontraron Registros con ese Parametro</td></tr>'));
            }
        });
    });
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Medidores/eliminar_lectura/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Lectura Eliminada...!!!"); 
            $('#userForm1')[0].reset();
               //myFunction(1)
               location.reload();
               
           });
       });
   });
</script>


<script>
  $(document).ready(function() {
    $('#userForm2').formValidation({
        fields: {

            lectura_anterior: {
                row: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            lectura_actual: {
                row: '.col-sm-2',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            periodo: {
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
       
}).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "actualizar_lectura_medidor",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Datos Registrados...!!"); 

        $('#userForm2').formValidation('resetForm');
        $('#userForm2')[0].reset();
        //myFunction(1)
        //location.reload();
        window.location.href = $("#redireccion").val();
    });
});
});

</script>


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
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>