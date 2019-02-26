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
        width: 80% !important;
    }
</style>
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />





<body onload="nobackbutton();">
<div id="registrar_comunidad" style="display:none;">
<section class="content"  style="width: 95%; align-content: center">
    <div class="box box-success" id="section">
        <div class="box-header with-border">
            <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <h3 class="box-title">Registrar Informaci&oacute;n</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <?php
            foreach($comunidades as $resultado)
            {
            ?>
                    <form id="formulario" action="" method="POST" name="formulario" >
                        <div class="col-sm-12">
                              <label>Informaci&oacute;n</label> 
                              <textarea class="form-control redondeado" rows="4" id="informacion"  name="informacion" placeholder="Informaci&oacute;n"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>
                          </div>
                         <div class="col-md-12">&nbsp;</div>
                          <?php if ($variablesSesion['rol'] == 3) { ?>
                         <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                          <div class="col-sm-7">
                              <label>Comunidad</label>
                            <input type="text" class="form-control redondeado" readonly name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->nombre_comunidad?>">
                          </div>
                          <?php } ?>
                           <?php if ($variablesSesion['rol'] == 2) { ?>
                         <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                          <div class="col-sm-7">
                              <label>Comunidad</label>
                            <input type="text" class="form-control redondeado" readonly name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->nombre_comunidad?>">
                          </div>
                          <?php } ?>
                           <?php if ($variablesSesion['rol'] == 1) { ?>
                         
                          <div class="col-sm-7">
                              <label>Comunidad</label>
                            <select name="id_comunidad" id="id_comunidad"  class="form-control redondeado" ><option value="">Selecione...</option>
                           <?php
                         foreach ($com as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                     
                      </select>
                          </div>
                          <?php } ?>
                          <div class="form-group col-sm-2">
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
                                  for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                                      echo "<option value='$anio'>" . $anio . "</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                          <div class="col-sm-12"></div>
                            <span tooltip="Guardar">
                                <button type="" id="guardar" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                            <span tooltip="Cancelar">
                            <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                        </div>
                        <div class="col-sm-12">&nbsp;</div>
                        <div class="col-sm-12">&nbsp;</div>
                    </form>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
    </div>
</section>
</div>


<div id="comunidades">
<section class="content"  style="width: 95%; align-content: center">
    <div class="box box-success" id="section">
        <div class="box-header with-border">

               <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
            <h3 class="box-title"> M&oacute;dulo de Informaci&oacute;n</h3>
            
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
                                    <th>Informaci&oacute;n</th>
                                    <th>Comunidad</th>
                                    <th>Per&iacute;odo</th>
                                    <th>Año</th>
                                    <th onkeypress="return soloNumeros(event)">Fecha</th>
                                    <th onkeypress="return soloLetras(event)">Editar</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados != "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      

                              <td style='display:none'>" . "$resultado->id_info" . "</td>
                               <td align='justify'WIDTH='48%'>" .  "$resultado->informacion" . "</td>
                               <td align='center'WIDTH='12%'>" .  "$resultado->nombre_comunidad" . "</td>
                               <td align='center'WIDTH='10%'>" .  "$resultado->periodo" . "</td>
                               <td align='center'WIDTH='10%'>" .  "$resultado->anio" . "</td>
                               <td align='center' WIDTH='10%'>" .  "$resultado->fecha_registro" . "</td>
                               <td align='center' WIDTH='10%'><button type='button' title='Editar Comunidad' data-id='$resultado->id_info' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                               
                             
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
                                    <th>Informaci&oacute;n</th>
                                  
                                    <th>Per&iacute;odo</th>
                                    <th>Año</th>
                                    <th onkeypress="return soloNumeros(event)">Fecha</th>
                                    <th onkeypress="return soloLetras(event)">Editar</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados != "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      

                              <td style='display:none'>" . "$resultado->id_info" . "</td>
                               <td align='justify'WIDTH='48%'>" .  "$resultado->informacion" . "</td>
                               
                               <td align='center'WIDTH='10%'>" .  "$resultado->periodo" . "</td>
                               <td align='center'WIDTH='10%'>" .  "$resultado->anio" . "</td>
                               <td align='center' WIDTH='10%'>" .  "$resultado->fecha_registro" . "</td>
                               <td align='center' WIDTH='10%'><button type='button' title='Editar Comunidad' data-id='$resultado->id_info' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                               
                             
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
                                    <th>Informaci&oacute;n</th>
                                   
                                    <th>Per&iacute;odo</th>
                                    <th>Año</th>
                                    <th onkeypress="return soloNumeros(event)">Fecha</th>
                                   
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados != "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      

                              <td style='display:none'>" . "$resultado->id_info" . "</td>
                               <td align='justify'WIDTH='48%'>" .  "$resultado->informacion" . "</td>
                             
                               <td align='center'WIDTH='10%'>" .  "$resultado->periodo" . "</td>
                               <td align='center'WIDTH='10%'>" .  "$resultado->anio" . "</td>
                               <td align='center' WIDTH='10%'>" .  "$resultado->fecha_registro" . "</td>
                              
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
                    
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"  id='resultado'></div>
                        <div class="col-sm-12"  id='resultado2'></div>
        
                        <div class="form-group col-sm-12">
                            <label>Informaci&oacute;n</label> 
                           
                            <textarea class="form-control redondeado" rows="5" id="informacion"  name="informacion" placeholder="Informaci&oacute;n"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>
                        </div>
                        
                          <input type="hidden" name="id_comunidad" id="id_comunidad" value="<?php echo $resultado->id_comunidad?>">
                         
                          <div class="form-group col-sm-12">
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
                          <div class="form-group col-sm-12">
                              <label>Año</label> 
                              <select name="anio" id="anio"  class="form-control redondeado">
                                  <option value="">Selecione...</option>
                                  <?php
                                  for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                                      echo "<option value='$anio'>" . $anio . "</option>";
                                  }
                                  ?>
                              </select>
                          </div>
                        
                        <div class="form-group col-sm-12">
                            <label>Fecha Registro</label> 
                            <input type="text" readonly="readonly" class="form-control redondeado" id="fecha_registro" onKeyPress="return soloLetras(event)" name="fecha_registro" placeholder="Motivo" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Estatus</label>
                            <select name="estatus" id="estatus"  class="form-control redondeado">
                                <option value="">Selecione...</option>
                                <option value="1">ACTIVO</option>
                                <option value="2">DESACTIVADO</option>
                            </select>
                        </div>

                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden"  class="form-control" id="id"  name="id" >
                        <div class="form-group">
                            <div class="col-sm-12">
                                
                                
                                <span tooltip="Guardar">
                                <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                  
                            </div>
                        </div>
                    </form>

             </section>
             <?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
              <a class='flotante'><span tooltip="Agregar Informacion"><button type="submit" class="btn bg-olive btn-circle btn-lg" onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
              <?php } ?>
</div>       

</body>

<script>
    function nobackbutton(){
   window.location.hash="/";
   window.location.hash="informacion" //chrome
   window.onhashchange=function(){window.location.hash="/";}
}
</script>


<script>
   function myFunction(idButton) {
      var comunidades = document.getElementById('comunidades');
      var registrar_comunidad = document.getElementById('registrar_comunidad');

      switch(idButton) {
       case 1:
       comunidades.style.display = 'block';
       registrar_comunidad.style.display = 'none';
       break;

       case 2:
       comunidades.style.display = 'none';
       registrar_comunidad.style.display = 'block';
       break;

       default:
       alert("hay un problema: No existe el producto.")
   }

}
</script>


<script type="text/javascript">

    $(document).ready(function () {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        informacion: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           id_comunidad: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           anio: {
                            row: '.col-sm-12',
                            validators: {
                            notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                                  }
                               }
                           },
                           informacion: {
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
                        url: "<?php echo base_url() . 'index.php/Informacion/actualizar_informacion'; ?>",
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
                url: "<?php echo base_url() . 'index.php/informacion/consultarInformacionId/'; ?>" + id,
                method: 'GET'

            }).success(function(data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_info).end()
                        .find('[name="informacion"]').val(obj.informacion).end()
                        .find('[name="id_comunidad"]').val(obj.id_comunidad).end()
                        .find('[name="periodo"]').val(obj.periodo).end()
                        .find('[name="anio"]').val(obj.anio).end()
                        .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                        .find('[name="estatus"]').val(obj.estatus).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar Comunidad',
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
    $(document).ready(function () {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                informacion: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                }
            },
            fields: {
                id_comunidad: {
                    row: '.col-sm-7',
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
                    row: '.col-sm-3',
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
    $(document).ready(function() {
        $("#guardar").click(function() {
            var dataEgreso = {
                "informacion": $("#informacion").val(),
                "id_comunidad": $("#id_comunidad").val(),
                "periodo": $("#periodo").val(),
                "anio": $("#anio").val()
                
            };

            //validamos que no quede ningun campo vacio
            if (dataEgreso.informacion === '') {

                alertify.error("Debe completar todos los campos...!!!"); 
            } else {
                $.ajax({
                    url: "<?php echo base_url() . 'index.php/Informacion/registrar_informacion'; ?>",
                    type: "POST",
                    data: dataEgreso,
                    beforeSend: function() {
                        $("#resultado").show();
                        $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    success: function(respuesta) {
                        $("#informacion").val(''),
                        alertify.log("Informaci&oacute;n Registrada con Exito...!!"); 
                        setInterval(function() {
                            location.reload();
                        }, 2000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                    }
                });
            }
        });
    });
</script>




