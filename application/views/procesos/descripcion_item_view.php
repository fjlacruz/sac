
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>


<section class="content">
    <div class="box box-danger">
        <div class="box-header with-border">
            <h3 class="box-title">Descripci&oacute;n  Items</h3>

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
                                <button class='btn btn-danger btn-xs btn-filter' title='Realizar Consultas Cruzadas' ><span class='fa fa-filter'></span>Filtrar</button>
                            </div>
                        </div>

                        <table id="nueva" class="display " cellspacing="0" width="100%" >
                            <thead>
                                <tr class="filters">
                                    <th onkeypress="return soloNumeros(event)" style='display:none'>Nro </th>   
                                    <th onkeypress="return soloLetras(event)">Descripci&oacute;n Item</th>
                                    <th onkeypress="return soloNumeros(event)">Fecha Registro</th>
                                    <th onkeypress="return soloLetras(event)">Estatus</th>
                                    <th onkeypress="return soloLetras(event)">Editar</th>
                                </tr>
                            </thead>
                             <?php
                            
                            if ($resultados[0] != "") {
                            $contenido = "";
                            foreach ($resultados as $resultado) {

                            $contenido.="<tr>      

                              <td style='display:none'>" . "$resultado->id_descripcion_item" . "</td>
                               <td align='center'>" .  "$resultado->descripcion_item" . "</td>
                               <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                               <td align='center'>" .  "$resultado->estatus" . "</td>
                               <td align='center'><button type='button' title='Editar' data-id='$resultado->id_descripcion_item' class='btn btn-primary btn-xs editButton'><span class='fa fa-edit'></span></button>
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
                    <button  onclick="history.back()" type="button" class="btn btn-warning">Atras</button>
                    </div>
                    
                    <form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"  id='resultado'></div>
                        <div class="col-sm-12"  id='resultado2'></div>
        
                        <div class="form-group col-sm-12">
                            <label>Descripci&oacute;n Item</label> 
                            <input type="text"  class="form-control" id="descripcion_item" onKeyPress="return soloLetras(event)" name="descripcion_item" placeholder="Item" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-12">
                            <label>Fecha Registro</label> 
                            <input type="text" readonly="readonly" class="form-control" id="fecha_registro" onKeyPress="return soloLetras(event)" name="fecha_registro" placeholder="Motivo" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Estatus</label>
                            <select name="estatus" id="estatus"  class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">ACTIVO</option>
                                <option value="2">DESACTIVADO</option>
                            </select>
                        </div>

                        <div class="col-sm-12">&nbsp;</div>
                        <input type="hidden"  class="form-control" id="id"  name="id" >
                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-success" onclick="testHoldon('sk-circle');" class="ajax">Modificar</button>
                            </div>
                        </div>
                    </form>
                    
                    

<script type="text/javascript">

    $(document).ready(function () {
        $('#userForm')
                .formValidation({
                    framework: 'bootstrap',
                    fields: {
                        descripcion_item: {
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
                        url: "<?php echo base_url() . 'index.php/egresos/actualizar_descripcion_item'; ?>",
                        method: 'POST',
                        data: $form.serialize()
                    }).success(function (response) {

                        $form.parents('.bootbox').modal('hide');
                        $.confirm({
                            title: 'Suceso...!!',
                            content: 'Registro Actualizado',
                            type: 'grey',
                            typeAnimated: true,
                            buttons: {
                                tryAgain: {
                                    text: 'Cerrar',
                                    btnClass: 'btn-green',
                                    action: function () {
                                        location.reload();
                                    }
                                }
                            }
                        });

                    });
                });
        $('.editButton').on('click', function () {
            // Get the record's ID via attribute
            var id = $(this).attr('data-id');
            $.ajax({
                url: "<?php echo base_url() . 'index.php/egresos/consultarDesItemId/'; ?>" + id,
                method: 'GET'

            }).success(function (data) {
                // Populate the form fields with the data returned from server

                var obj = JSON.parse(data);
                $('#userForm')
                        .find('[name="id"]').val(obj.id_descripcion_item).end()
                        .find('[name="descripcion_item"]').val(obj.descripcion_item).end()
                        .find('[name="fecha_registro"]').val(obj.fecha_registro).end()
                        .find('[name="estatus"]').val(obj.estatus).end();
                // Show the dialog
                bootbox
                        .dialog({
                            title: 'Editar Descripcion Item',
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
                    $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Este Item Ya se Encuentra Registrado......!!!</div>");
              
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
                        $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                        //Redirijimos luego de enviar los datos 
                        setInterval(function() {
                            location.reload();
                        }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                    }
                });
            }
        });
    });
</script>




