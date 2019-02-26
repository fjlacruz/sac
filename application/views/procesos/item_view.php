<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<style>

    .modal-header{
        background-color:#3d9970 !important;
    }
    .modal-title{
        color:#ffffff;
    }
    #mdialTamanio{
        width: 60% !important;
    }
</style>
<html>
    <body onload="nobackbutton();">
<section class="content"  id="section" style="width: 95%; align-content: center">
    <div class="box box-success collapsed-box">
        <div class="box-header with-border">
            <span tooltip="Regresar">
                <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="btn bg-orange btn-circle" type="button">
                    <span class='glyphicon glyphicon-arrow-left'></a>
            <h3 class="box-title">Registrar Nuevo Item</h3>
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formulario" action="" method="POST" name="formulario" >

                        <div class="form-group col-sm-12">
                            <label>Item</label> 
                            <input type="text"  class="form-control redondeado" id="item"  name="item" placeholder="Indique el Nombre del Item" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        <div class="col-sm-12">&nbsp;</div>

                        <div class="form-group col-sm-6">
                             <span tooltip="Regresar">
                <a href="<?php echo base_url() ?>principal/bienvenida" class="btn bg-orange btn-circle" type="button"><span class='glyphicon glyphicon-arrow-left'></a>
              </span>
                            <span tooltip="Guardar">
                <button type="" id="guardar" class="btn bg-olive btn-circle"><span class='glyphicon glyphicon-pencil'></span></button>
              </span>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content"  id="section" style="width: 95%; align-content: center">
    <div class="box box-success">
        <div class="box-header with-border">
            <h3 class="box-title">Administraci&oacute;n de Items</h3>

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

                        <table id="nueva" class="display " cellspacing="0" width="100%" >
                            <thead>
                                <tr class="filters">
                                    <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>   
                                    <th onkeypress="return soloLetras(event)">Item</th>
                                    <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                                   
                                    <th onkeypress="return soloLetras(event)">Editar</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados[0] != "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      

                              <td style='display:none'>" . "$resultado->id_item" . "</td>
                               <td align='center'>" .  "$resultado->item" . "</td>
                               <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                               
                               <td align='center'>
                               <button type='button' title='Editar Comunidad' data-id='$resultado->id_item' class='btn bg-olive btn-circle editButton'><span class='fa fa-edit'></span></button>
                               <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_item' class='btn bg-olive btn-circle deleteButton'>
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
                        <div class="col-sm-12">&nbsp;</div>
                   <span tooltip="Regresar">
                <a href="<?php echo base_url() ?>Principal/consultar_egresos_comunidad" class="btn bg-orange btn-circle" type="button">
                    <span class='glyphicon glyphicon-arrow-left'></a>
              </span>
                    </div>
                    
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"  id='resultado'></div>
                        <div class="col-sm-12"  id='resultado2'></div>
        
                        <div class="form-group col-sm-12">
                            <label>Item</label> 
                            <input type="text"  class="form-control redondeado" id="item" onKeyPress="return soloLetras(event)" name="item" placeholder="Item" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-12">
                            <label>Fecha Registro</label> 
                            <input type="text" readonly="readonly" class="form-control redondeado" id="fecha_registro" onKeyPress="return soloLetras(event)" name="fecha_registro" placeholder="Motivo" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        
                <input type="hidden"  class="form-control redondeado" id="estatus"  name="estatus" >
                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden"  class="form-control" id="id"  name="id" >
                        <div class="form-group">
                            <div class="col-xs-12">
                                <span tooltip="Guardar">
                                <button type="submit" class="btn bg-olive btn-circle"><i class="fa fa-save"></i></button></span>
                            </div>
                        </div>
                    </form>

<input type="hidden" id="F" value="<?php echo base_url() ?>egresos/buscarDatosItem">

 </body>
</html> 




<script type="text/javascript">

    $(document).ready(function () {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        item: {
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
                        url: "<?php echo base_url() . 'index.php/egresos/actualizar_item'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function (response) {

                        alertify.log("Datos Actualizados...!!!"); 
                    setInterval(function() {
                            location.reload();
                        }, 3000);

                        $form.parents('.bootbox').modal('hide');

                    });
                });
        $('.editButton').on('click', function () {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/egresos/consultarItemId/'; ?>" + id,
                method: 'GET'

            }).success(function (data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_item).end()
                        .find('[name="item"]').val(obj.item).end()
                        .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                        .find('[name="estatus"]').val(obj.estatus).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar Item',
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
            retrieve: true
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
                proveedor: {
                    row: '.col-sm-12',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                item: {
                    row: '.col-sm-12',
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
    $(document).on("keyup", '#item', function ()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/egresos/consultar_existe_item'; ?>",
            data: {item: $('#item').val()},
            dataType: 'html',
            type: 'post',
            success: function (respuesta) {

                if (respuesta == 1)
                {
                    $('#item').val('');
                    alertify.error("Este Item Ya Existe...!!!");
              
                }
            }
        });
    });
</script>


<script>
    $(document).ready(function() {
        $("#guardar").click(function() {
            var dataEgreso = {
                "item": $("#item").val()             
            };

            //validamos que no quede ningun campo vacio
            if (dataEgreso.item === '') {

                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                $.ajax({
                    url: "<?php echo base_url() . 'index.php/Egresos/registrar_Item'; ?>",
                    type: "POST",
                    data: dataEgreso,
                    beforeSend: function() {
                        $("#resultado").show();
                        $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    //Despues de enviar los datos limpiamos los campos del formulario
                    success: function(respuesta) {
                        // Enviamos un mensaje de exito al insertar los datos
                        $("#item").val(''),
                        alertify.log("Datos Registrados...!!!");
                        //Redirijimos luego de enviar los datos 
                        setInterval(function() {
                            //location.reload();
                            window.location.href = $("#F").val();
                        }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                    }
                });
            }
        });
    });
</script>

<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Egresos/eliminar_item/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Comunidad Eliminada...!!!"); 
            $('#formulario')[0].reset();
               //myFunction(1)
               location.reload();
               
           });
       });
   });
</script>


<script>
    function nobackbutton(){
	
   window.location.hash="no-back-button";
	
   window.location.hash="Again-No-back-button" //chrome
	
   window.onhashchange=function(){window.location.hash="no-back-button";}
	
}
</script>