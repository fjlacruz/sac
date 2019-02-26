<?php
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   
?>
<style>

    .modal-header{
        background-color:#942349 !important;
    }
    .modal-title{
        color:#ffffff;
    }
    #mdialTamanio{
        width: 90% !important;
    }
</style>

<style>
.sinbordefondo {
  background-color: #000;
  border: 0;
}
</style>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />





<body onload="nobackbutton();">
<div id="registrar_copropietario" style="display:none;">
<section class="content"   style="width: 95%; align-content: center">
   <div class="box box-success" id="section">
          <div class="box-header with-border">
              <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <h3 class="box-title">Registar Copropietarios</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
          <div class="box-body">
              <div class="row">
                   <form id="formulario" action="" method="POST" name="formulario">
                  <div class="col-md-12">
                          <div class="col-sm-12"  id='resultado'></div>
                          <div class="col-sm-12"  id='resultado2'></div>
                          <div class="form-group col-sm-4">
                              <label>Rut</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="rut"  name="rut" placeholder="Rut" >
                          </div>
                          
                           <div class="form-group col-sm-4">
                              <label>Nombres</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="nombres"  name="nombres" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          
                          <div class="form-group col-sm-4">
                              <label>Apellidos</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="apellidos"  name="apellidos" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          
                           
                          <div class="form-group col-sm-4">
                              <label>Nro Apartamento</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="nro_dpto"  name="nro_dpto" placeholder="Nro Apartamento" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                         <div class="form-group col-sm-4">
                              <label>Email</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="email"  name="email" placeholder="Email" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Telefono</label> &nbsp;
                          <input type="text" class="form-control redondeado" onkeyup="javascript:this.value = this.value.toUpperCase()" onkeyup="javascript:this.value = this.value.toUpperCase()" onkeypress="return soloNumeros(event)" id="telefono"  name="telefono" placeholder="telefono" >
                          </div>
                          
                          
                          
                           <div class="form-group col-sm-4">
                              <label>Al&iacute;cuota Departamento</label> &nbsp;
                          <input type="text" onkeyup="suma();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto" id="alicuota_dpto"  name="alicuota_dpto" placeholder="0.00" >
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Al&iacute;cuota Estacionamiento</label> &nbsp;
                          <input type="text" onkeyup="suma();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto" id="alicuota_estacionamiento" name="alicuota_estacionamiento" placeholder="0.00" >
                          </div>
                          <div class="form-group col-sm-4">
                              <label>Al&iacute;cuota Bodega/Maletero</label> &nbsp;
                          <input type="text" onkeyup="suma();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto"  id="alicuota_maletero"  name="alicuota_maletero" placeholder="0.00" >
                          </div>
                         <div class="form-group col-sm-4">
                              <label>Al&iacute;cuota Total</label> &nbsp;
                         <input type="text" id="alicuota_total" name="alicuota_total" onkeypress="return filterFloat(event,this);" class="form-control redondeado sinbordefondo " readonly placeholder="0.00">
                          </div>
                          
                          <div class="form-group col-sm-4">
                        <label>Torre/Edificio</label> &nbsp;
            
                        <select name="id_torre" id="id_torre"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($torres as $i => $torre) {
                              //echo '<option value="' . $torre->id_torre . '">' . $torre->id_torre . '</option>';
                              echo '<option value="' . $torre->nombre_torre . '">' . $torre->nombre_torre . '</option>';
                                }
                                ?>
                             
                        </select>
                     </div>
                          
                          <div class="col-sm-12" id='formato_incorrecto'>&nbsp;</div>
                          <div class="form-group col-sm-6">
                              <span tooltip="Guardar">
                                <button type="submit" class="btn bg-olive btn-circle" onclick="borrar()"><i class="fa fa-save"></i></button></span>
                                 <span tooltip="Cancelar">
                            <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                              
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
</section>
</div>





<div id="copropietarios">
<section class="content"  style="width: 95%; align-content: center">
    <div class="box box-success" id="section">
        <div class="box-header with-border">
            <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
            <h3 class="box-title">Administraci&oacute;n de Copropietarios</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
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
                                    <th>Comunidad</th>
                                    <th>Torre</th>
                                    <th>Rut</th>
                                    <th onkeypress="return soloLetras(event)">Nombres</th>
                                    <th>Nro Dpto</th>
                                    <th>Al. Dpto</th>
                                    <th>Al. Estacionamiento</th>
                                    <th>Al. Maletero/Bodega</th>
                                    <th>Al. Total</th>
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados!= "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      
                               <td style='display:none'>" . "$resultado->id_copropietario" . "</td>
                               <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                               <td align='center'>" .  "$resultado->nombre_torre" . "</td>
                               <td align='center'>" .  "$resultado->rut" . "</td>
                               <td align='center'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
                               <td align='center'>" .  "$resultado->nro_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_estacionamiento" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_maletero" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_total" . "</td>
                          
                               <td align='center'>
                               <button type='button' title='Editar Copropietarios' data-id='$resultado->id_copropietario' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                                <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_copropietario' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
                               
                             
                             </td> 
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
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
                                    <th>Torre</th>
                                    <th>Rut</th>
                                    <th onkeypress="return soloLetras(event)">Nombres</th>
                                    <th>Nro Dpto</th>
                                    <th>Al. Dpto</th>
                                    <th>Al. Estacionamiento</th>
                                    <th>Al. Maletero/Bodega</th>
                                    <th>Al. Total</th>
                                   
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados!= "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      
                               <td style='display:none'>" . "$resultado->id_copropietario" . "</td>
                               <td align='center'>" .  "$resultado->nombre_torre" . "</td>
                               <td align='center'>" .  "$resultado->rut" . "</td>
                               <td align='center'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
                               <td align='center'>" .  "$resultado->nro_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_estacionamiento" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_maletero" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_total" . "</td>
                              
                               <td align='center'>
                               <button type='button' title='Editar Copropietarios' data-id='$resultado->id_copropietario' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                               <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_copropietario' class='btn bg-olive btn-circle deleteButton'>
             <span class='fa  fa-close'></span>
                               
                             
                             </td> 
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
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
                                    <th>Torre</th>
                                    <th>Rut</th>
                                    <th onkeypress="return soloLetras(event)">Nombres</th>
                                    <th>Nro Dpto</th>
                                    <th>Al. Dpto</th>
                                    <th>Al. Estacionamiento</th>
                                    <th>Al. Maletero/Bodega</th>
                                    <th>Al. Total</th>
                                    
                                    <th>Acciones</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados!= "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      
                               <td style='display:none'>" . "$resultado->id_copropietario" . "</td>
                               <td align='center'>" .  "$resultado->nombre_torre" . "</td>
                               <td align='center'>" .  "$resultado->rut" . "</td>
                               <td align='center'>" .  "$resultado->nombres" . " "  . "$resultado->apellidos" . "</td>
                               <td align='center'>" .  "$resultado->nro_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_dpto" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_estacionamiento" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_maletero" . "</td>
                               <td align='center'>" .  "$resultado->alicuota_total" . "</td>
                           
                               <td align='center' WIDTH='8%'><button type='button' title='Editar Copropietarios' data-id='$resultado->id_copropietario' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                               
                             
                             </td> 
                              </tr>";
                               }
                         } else {
                              $contenido = '
    
                                     </div>
                                           <div class="alert alert-danger">
                                           <strong>No se Encontraron datos para esta busquedad!</strong>
                                           <a class="alert-link" href="#">Volver a consultar.</a>

                                    </div>';
                                  }
                               ?>
                            <tbody>                  
                         <?php
                                 echo $contenido;
                                 ?>
                            </tbody>
                           
                        </table>
                        <?php } ?>
                        
                        <div class="col-sm-12">&nbsp;</div>
         
                    </div>
                    <div class="container">
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                      <div class=" col-sm-4">
                              <label>Rut</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="rut"  name="rut" placeholder="Rut" >
                          </div>
                          
                           <div class="col-sm-4">
                              <label>Nombres</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="nombres"  name="nombres" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          
                          <div class="col-sm-4">
                              <label>Apellidos</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="apellidos"  name="apellidos" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          <div class="col-sm-12">&nbsp;</div>
                           
                          <div class="col-sm-4">
                              <label>Nro Apartamento</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="nro_dpto"  name="nro_dpto" placeholder="Nro Apartamento" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          
                          <div class="col-sm-4">
                              <label>Al. Departamento</label> &nbsp;
                          <input type="text" onkeyup="suma2();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto" id="alicuota_dpto2"  name="alicuota_dpto2" placeholder="0.00" >
                          </div>
                          <div class="col-sm-4">
                              <label>Al. Estacionamiento</label> &nbsp;
                          <input type="text" onkeyup="suma2();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto" id="alicuota_estacionamiento2" name="alicuota_estacionamiento2" placeholder="0.00" >
                          </div>
                           <div class="col-sm-12">&nbsp;</div>
                          
                          
                           <div class="col-sm-4">
                              <label>Al. Bodega/Maletero</label> &nbsp;
                          <input type="text" onkeyup="suma2();" onkeypress="return filterFloat(event,this);" class="form-control redondeado monto"  id="alicuota_maletero2"  name="alicuota_maletero2" placeholder="0.00" >
                          </div>
                          
                          
                          <div class="col-sm-4">
                              <label>Email</label> &nbsp;
                          <input type="text" class="form-control redondeado" id="email"  name="email" placeholder="Email" onkeyup="javascript:this.value = this.value.toUpperCase()">
                          </div>
                          <div class="col-sm-4">
                              <label>Telefono</label> &nbsp;
                          <input type="text" class="form-control redondeado" onkeyup="javascript:this.value = this.value.toUpperCase()" onkeyup="javascript:this.value = this.value.toUpperCase()" id="telefono"  name="telefono" placeholder="telefono" >
                          </div>


                            <input type="hidden" name="estatus" id="estatus"  value="1">
                     

                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden"  class="form-control" id="id"  name="id" >
                        <div class="form-group">
                            <div class="col-sm-12">
                                
                                
                                <span tooltip="Guardar">
                                <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                  
                            </div>
                        </div>
                    </form>
                 </div>
             </section>
              <a class='flotante'><span tooltip="Agregar Copropietarios"><button type="submit" class="btn bg-olive btn-circle btn-lg" onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
</div>

</body>
<script>
   function myFunction(idButton) {
      var copropietarios = document.getElementById('copropietarios');
      var registrar_copropietario = document.getElementById('registrar_copropietario');
      

      switch(idButton) {
       case 1:
       copropietarios.style.display = 'block';
       registrar_copropietario.style.display = 'none';
      
       break;

       case 2:
       copropietarios.style.display = 'none';
       registrar_copropietario.style.display = 'block';
       
       break;

       default:
       alert("hay un problema: No existe el producto.")
   }

}
</script>



<script>

    function suma() {
        var alicuota_dpto = document.formulario.alicuota_dpto.value;
        var alicuota_estacionamiento = document.formulario.alicuota_estacionamiento.value;
        var alicuota_maletero = document.formulario.alicuota_maletero.value;

        try {
            //Calculamos el n�mero escrito:
            alicuota_dpto = (isNaN(parseFloat(alicuota_dpto))) ? 0 : parseFloat(alicuota_dpto);
            alicuota_estacionamiento = (isNaN(parseFloat(alicuota_estacionamiento))) ? 0 : parseFloat(alicuota_estacionamiento);
            alicuota_maletero = (isNaN(parseFloat(alicuota_maletero))) ? 0 : parseFloat(alicuota_maletero);
          
            document.formulario.alicuota_total.value = alicuota_dpto + alicuota_estacionamiento + alicuota_maletero;
            
        }
        //Si se produce un error no hacemos nada
        catch (e) {
        }
    }
</script>

<script>

    function suma2() {
      
        var alicuota_dpto2 = document.userForm.alicuota_dpto2.value;
        var alicuota_estacionamiento2 = document.userForm.alicuota_estacionamiento2.value;
        var alicuota_maletero2 = document.userForm.alicuota_maletero2.value;
        
        try {
            
            alicuota_dpto2 = (isNaN(parseFloat(alicuota_dpto2))) ? 0 : parseFloat(alicuota_dpto2);
            alicuota_estacionamiento2 = (isNaN(parseFloat(alicuota_estacionamiento2))) ? 0 : parseFloat(alicuota_estacionamiento2);
            alicuota_maletero2 = (isNaN(parseFloat(alicuota_maletero2))) ? 0 : parseFloat(alicuota_maletero2);

            document.userForm.alicuota_total2.value = alicuota_dpto2 + alicuota_estacionamiento2 + alicuota_maletero2;
        }
        catch (e) {
        }
    }
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




<script type="text/javascript">

    $(document).ready(function () {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        rut: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                            nombres: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                            apellidos: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           
                           estatus: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           nro_dpto: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            alicuota: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            estacionamiento: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            bodega: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            }
                    }
                })
                .on('success.form.fv', function (e) {
                    // Save the form data via an Ajax request
                    e.preventDefault();
                    var $form = $(e.target),
                            id = $form.find('[name="id"]').val();
                    // The url and method might be different in your application

                    $.ajax({
                        url: "<?php echo base_url() . 'index.php/copropietarios/actualizar_copropietarios'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function (response) {
                    alertify.log("Datos Actualizados...!!!"); 
                    setInterval(function() {
                            location.reload();
                        }, 2000);

                        $form.parents('.bootbox').modal('hide');
                        

                    });
                });
        $('.editButton').on('click', function () {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/copropietarios/consultarCopropietariosId/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_copropietario).end()
                        .find('[name="rut"]').val(obj.rut).end()
                        .find('[name="nombres"]').val(obj.nombres).end()
                        .find('[name="apellidos"]').val(obj.apellidos).end()
                        .find('[name="nro_dpto"]').val(obj.nro_dpto).end()
                        .find('[name="alicuota_dpto2"]').val(obj.alicuota_dpto).end()
                        .find('[name="alicuota_estacionamiento2"]').val(obj.alicuota_estacionamiento).end()
                        .find('[name="alicuota_maletero2"]').val(obj.alicuota_maletero).end()
                        .find('[name="alicuota_total2"]').val(obj.alicuota_total).end()
                        .find('[name="email"]').val(obj.email).end()
                        .find('[name="telefono"]').val(obj.telefono).end()
                        .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                        .find('[name="estatus"]').val(obj.estatus).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar Copropietario',
                            message: $('#userForm'),
                            show: false // We will show it manually later
                        })
                        .on('shown.bs.modal', function () {
                            $('#userForm')
                                    .show()                             // Show the login form
                                    .formValidation('resetForm'); // Reset form
                        })
                        .on('hide.bs.modal', function (e) {
                            // Bootbox will remove the modal (including the body which contains the login form)
                            // after hiding the modal
                            // Therefor, we need to backup the form
                            $('#userForm').hide().appendTo('body');
                        })
                        .modal('show');
            });
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
            "paging": false,
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
    });</script>




<!--============= script para registar usuarios ============================================== -->
<script>
    $(document).ready(function() {
    $('#formulario').formValidation({
        fields: {
            rut: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            nombres: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            apellidos: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            nro_dpto: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            alicuota_dpto: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            id_torre: {
                row: '.col-sm-4',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
           
            emailss: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    },
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Direcci&oacute;n de Correo Inv&aacute;lida'
                    }
                }
            },

            }
//==============  registro de Usuario ======================================================          
}).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "registrar_copropietarios",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {
        alertify.log("Se ha Registrado un copropietario...!!"); 

        $('#formulario').formValidation('resetForm');
        $('#formulario')[0].reset();
        
         setInterval(function() {
                            location.reload();
                        }, 3000);
    });
});
});
</script>


<script>
   
      $(document).on("change", '#ruts', function ()
      {
          $.ajax({
              url: "<?php echo base_url() . 'index.php/Copropietarios/consultar_existe_rut'; ?>",
              data: {rut: $('#rut').val()},
              dataType: 'html',
              type: 'post',
              success: function (respuesta) {

                  if (respuesta == 1)
                  {
                     $('#formulario').formValidation('resetForm');
                    $('#rut').val('');
                     alertify.error("El rut Ya Existe...!!!");
                
                  }
              }
          });
      });
      
      
      $(document).on("change", '#nro_dpto', function ()
      {
          $.ajax({
              url: "<?php echo base_url() . 'index.php/Copropietarios/consultar_existe_apartamento'; ?>",
              data: {nro_dpto: $('#nro_dpto').val()},
              dataType: 'html',
              type: 'post',
              success: function (respuesta) {

                  if (respuesta == 1)
                  {
                    $('#formulario').formValidation('resetForm');
                    $('#nro_dpto').val('');
                     alertify.error("El Apartamento Ya Existe...!!!");
                     
                
                  }
              }
          });
      });
  </script>

<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Copropietarios/eliminar_copropietario/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Copropietario Eliminado...!!!"); 
            $('#formulario')[0].reset();
               myFunction(1)
               location.reload();
               
           });
       });
   });
</script>


<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>