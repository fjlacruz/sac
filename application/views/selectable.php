   
<link rel="stylesheet" href="<?php echo base_url(); ?>application/recursos/fullcalendar/fullcalendar.min.css " />
<link rel="stylesheet" media="print" href="<?php echo base_url(); ?>application/recursos/fullcalendar/fullcalendar.print.min.css" />
<script src="<?php echo base_url(); ?>application/recursos/fullcalendar/lib/moment.min.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/fullcalendar/locale/es.js"></script>

<script>
    $(document).ready(function() {
        $.post('<?php echo base_url(); ?>index.php/Events/getEventos',
                function(data) {
                    //alert(data);

                    $('#calendar').fullCalendar({
                        header: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'month,basicWeek,basicDay',
                            lang: 'es'
                        },
                        defaultDate: new Date(),
                        navLinks: true,
                        editable: true,
                        eventLimit: true,
                        editable: true,
                                events: $.parseJSON(data),
                        eventDrop: function(event, delta, revertFunc) {
                            var id = event.id;
                            var fi = event.start.format();
                            var ff = event.end.format();

                            if (!confirm("Esta seguro??")) {
                                revertFunc();
                            } else {
                                $.post("<?php echo base_url(); ?>index.php/events/updEvento",
                                        {
                                            id: id,
                                            fecini: fi,
                                            fecfin: ff
                                        },
                                function(data) {
                                    if (data == 1) {
                                        alert('Se actualizo correctamente');
                                    } else {
                                        alert('ERROR.');
                                    }
                                });
                            }
                        },
                        eventResize: function(event, delta, revertFunc) {
                            var id = event.id;
                            var fi = event.start.format();
                            var ff = event.end.format();

                            if (!confirm("Esta seguro de cambiar la fecha?")) {
                                revertFunc();
                            } else {
                                $.post("<?php echo base_url(); ?>index.php/events/updEvento",
                                        {
                                            id: id,
                                            fecini: fi,
                                            fecfin: ff
                                        },
                                function(data) {
                                    if (data == 1) {
                                        alert('Se cambio correctamente');
                                    } else {
                                        alert('ERROR.');
                                    }
                                });
                            }
                        },
                        eventClick: function(event, jsEvent, view) {

                            //alert(event.porcentaje);

                            $('#mhdnIdEvento').val(event.id);
                            $('#mtitulo').html(event.title);
                            $('#txtBandaRP').val(event.title);
                            $('#txtUrl').val(event.url);
                            $('#modalEvento').modal();
                            $('#porcentaje').val(event.porcentaje);

                            $('#observacion').val(event.observacion);

                            if (event.porcentaje != "") {
                                var x = 1;
                                var porcentaje = event.porcentaje;
                                $("#barraporcentaje").load("<?php echo base_url() . 'index.php/events/consultar?porcentaje='; ?>" + porcentaje);


                            }

                            document.cookie = 'variable=' + x;



                            if (event.url) {
                                window.open(event.url);
                                return false;
                            }

                        }

                        //   eventRender: function(event, element) {
                        //       var el = element.html();
                        //       element.html("<div style='width:90%;float:left;'>" + el + "</div><div style='color:red;text-align:right;' class='closeE'>x</div>");

                        //      element.find('.closeE').click(function(){
                        //      	if (!confirm("Esta seguro de eliminar el evento?")) {
                        // 	return false;
                        // }else{
                        // 	var id = event.id;
                        // 	$.post("<?php echo base_url(); ?>index.php/Events/deleteEvento",
                        // 	{
                        // 		id:id
                        // 	},
                        // 	function(data){
                        // 		//alert(data);
                        // 		if (data == 1) {
                        // 			$('#calendar').fullCalendar('removeEvents' , event.id);
                        // 			alert('La infromacion sera eliminada definitivamente');
                        // 		}else{
                        // 			alert('ERROR.');
                        // 		}
                        // 	});			        	
                        //       }
                        //      });
                        //   }

                    });
                });
    });

</script>


<style>

    #calendar {
        max-width: 800px;
        margin: 0 auto;
    }

</style>
<style>
    .example-modal .modal {
        position: relative;
        top: auto;
        bottom: auto;
        right: auto;
        left: auto;
        display: block;
        z-index: 1;
    }

    .example-modal .modal {
        background: transparent !important;
    }
</style>



<?php
$x = $_COOKIE["variable"];
?>
<div class="col-sm-9"></div>
<div><button type="submit" class="btn btn-primary" data-target='#login' data-toggle='modal'  data-trigger='hover'  data-placement='top'>Nueva Actividad</button></div>

</br> 

<div id='calendar'></div>

<div class="modal fade" id="modalEvento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="mtitulo"></h4>
            </div>
            <div class="modal-body">
                <form  action="">
                    <input type="hidden" id="mhdnIdEvento">
                    <?php
                    if ($x == 0) {

                        echo"
                                    <div class='row' >
                                        <div class='col-md-10'>
                                            <label class='col-xs-2 control-label'>Observaciones</label> 
                                            <textarea  row='5' class='form-control' id='observacion' name='observacion' onKeyup='this.value = this.value.toUpperCase();' placeholder='Observacion' ></textarea>
                                        </div>

                                        <br><br><br><br><br><br>


                                        <div class='col-md-10'>
                                            <label class='col-xs-2 control-label'>Porcentaje </label> 
                                            <input type='text' class='form-control' id='porcentaje' maxlength='3' onKeyPress='return soloNumeros(event)' name='porcentaje' placeholder='Porcentaje'>
                                        </div>
                                     </div>
 

                                        ";
                    } else {
                        echo"

                                <div class='row' >
                                    <div class='col-md-10'>
                                        <label class='col-xs-2 control-label'>Observaciones</label> 
                                        <textarea row='5' class='form-control' id='observacion'  name='observacion' onKeyup='this.value = this.value.toUpperCase();' placeholder='Observacion'></textarea>
                                    </div>

                        <br><br><br><br><br><br>

                                <div class='col-md-10'>
                                    <label class='col-xs-2 control-label'>Porcentaje </label> 
                                    <input type='text' class='form-control' id='porcentaje'  maxlength='3' onKeyPress='return soloNumeros(event)' name='porcentaje' placeholder='Porcentaje'>
                                </div>
                        <br><br><br><br>    <br><br>
                                     
                                    <div id='barraporcentaje'></div>
                                </div>";
                    }
                    ?>

                    <br><br>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" id="btnCerrarModal" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-danger" id="btnUpdEvento">Guardar</button>
                    </div>
                </form> 
            </div> 
        </div> 
    </div>
</div>

<!-- Modal Cierre -->
<div class="modal fade" id="login">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-red">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="formulario" action="../Events/save" method="post">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-3">
                                <label>Nombre de la Actividad</label> 
                                <input type="text" class="form-control" name="actividad[]" id="actividad" onKeyup="this.value = this.value.toUpperCase();" placeholder="Nombre de la Actividad" />
                            </div>
                            <div class="col-sm-2">
                                <label>Responsable</label> 

                                <select name="responsable[]" id="responsable" class="form-control text-center">
                                    <option value="0">SELECCIONE</option>

                                    <?php
                                    foreach ($coordinador as $i => $responsable) {
                                        echo '<option value = "' . $responsable[0] . '">' . $responsable[1] . " " . $responsable[2] . '</option>';
                                    }
                                    ?> 
                                </select>
                            </div>
                            <div class="col-sm-2 dateContainer">
                                <label>Fecha de Inicio</label> 
                                <div class="input-group input-append date" id="dueDatePicker">
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" class="form-control" name="inicio[]" placeholder="Inicio" autocomplete="off"  readonly="true" />
                                </div>
                            </div>
                            <div class="col-sm-3 dateContainer2">
                                <label>Fecha de Culminacion</label> 
                                <div class="input-group input-append date" id="dueDatePicker2">
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type='text' name='fin[]' autocomplete="off" class="form-control" readonly="true" placeholder="Culminacion">
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <label>Agregar</label> 
                                <button type="button" class="btn btn-primary addButton"  data-toggle='popover' data-trigger='hover' data-placement='top'>+</button>
                            </div>
                        </div>
                    </div>


                    <!--=============================== Fila que se Clona =========================== -->
                    <div class="form-group hide" id="bookTemplate">
                        <div class="row">
                            <div class="col-sm-3">
                                <input type="text" class="form-control" name="actividad[]" id="actividad" onKeyup="this.value = this.value.toUpperCase();"  placeholder="Nombre de la Actividad" />
                            </div>
                            <div class="col-sm-2">
                                <select name="responsable[]" id="responsable" class="form-control text-center">
                                    <option value="">SELECCIONE</option>
                                    <?php
                                    foreach ($coordinador as $i => $responsable) {
                                        echo '<option value = "' . $responsable[0] . '">' . $responsable[1] . " " . $responsable[2] . '</option>';
                                    }
                                    ?> 
                                </select>
                            </div>

                            <div class="col-sm-2 dateContainer">
                                <div class="input-group input-append date" >
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type="text" autocomplete="off" class="form-control" readonly="true" name="inicio[]" placeholder="Inicio" />
                                </div>
                            </div>

                            <div class="col-sm-3 dateContainer2">
                                <div class="input-group input-append date" >
                                    <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                                    <input type='text' name='fin[]' autocomplete="off" class="form-control" readonly="true" placeholder="Culminacion" >
                                </div> 
                            </div>
                            <div class="col-sm-1">
                                <button type="button" class="btn btn-danger removeButton" data-content='Eliminar' data-toggle='popover' data-trigger='hover' data-placement='top'>-</button>
                            </div>
                        </div> 
                    </div> 
                    </br></br>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="submit"  class="btn btn-danger">Guardar</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

<script>

    function soloNumeros(e)
    {
        var key = window.Event ? e.which : e.keyCode
        return ((key >= 48 && key <= 57) || (key == 8))
    }
    $(document).ready(function() {

        $('#formulario2').formValidation({
            framework: 'bootstrap',
            icon: {
                //valid: 'glyphicon glyphicon-ok',
                //invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                observacion: {
                    row: '.col-md-10',
                    validators: {
                        notEmpty: {
                            message: 'Campo requerido'
                        }
                    }
                },
                porcentaje: {
                    row: '.col-md-10',
                    validators: {
                        notEmpty: {
                            message: 'Campo requerido'
                        }
                    }
                }
            }
        })
    });
    $(document).ready(function() {

        $('#dueDatePicker').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '-10d',
            endDate: '+10d'
        }).on('changeDate', function(evt) {
            // Revalidate the date field
            $('#formulario').formValidation('revalidateField', $('#dueDatePicker').find('[name="inicio[]"]'));
        });
        $('#dueDatePicker2').datepicker({
            format: 'yyyy-mm-dd',
            autoclose: true,
            startDate: '-10d',
            endDate: '+1y'

        }).on('changeDate', function(evt) {
            // Revalidate the date field
            $('#formulario').formValidation('revalidateField', $('#dueDatePicker2').find('[name="fin[]"]'));
        });
        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                'actividad[]': {
                    // The task is placed inside a .col-xs-6 element
                    row: '.col-sm-3',
                    validators: {
                        notEmpty: {
                            message: 'Indique la Actividad'
                        }
                    }
                },
                'responsable[]': {
                    // The task is placed inside a .col-xs-6 element
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'Indique el Responsable'
                        }
                    }
                },
                'inicio[]': {
                    // The due date is placed inside a .col-xs-4 element
                    row: '.col-sm-2',
                    validators: {
                        notEmpty: {
                            message: 'Indique la Fecha'
                        }
                    }
                },
                'fin[]': {
                    // The due date is placed inside a .col-xs-4 element
                    row: '.col-sm-3',
                    validators: {
                        notEmpty: {
                            message: 'Indique la Fecha'
                        }
                    }
                }
            }
        }).on('added.field.fv', function(e, data) {
            if (data.field === 'inicio[]') {
                // The new due date field is just added
                // Create a new date picker
                data.element
                        .parent()
                        .datepicker({
                            format: 'yyyy-mm-dd',
                            autoclose: true,
                            startDate: '-10d',
                            endDate: '+10d'

                        })
                        .on('changeDate', function(evt) {
                            // Revalidate the date field
                            $('#formulario').formValidation('revalidateField', data.element);
                        });
            }
            if (data.field === 'fin[]') {
                // The new due date field is just added
                // Create a new date picker
                data.element
                        .parent()
                        .datepicker({
                            format: 'yyyy-mm-dd',
                            autoclose: true,
                            startDate: '-10d',
                            endDate: '+1y'

                        })
                        .on('changeDate', function(evt) {
                            // Revalidate the date field
                            $('#formulario').formValidation('revalidateField', data.element);
                        });
            }
        }).on('click', '.addButton', function() {
            var $template = $('#bookTemplate'),
                    $clone = $template
                    .clone()
                    .removeClass('hide')
                    .removeAttr('id')
                    .insertBefore($template);
            // Add new fields
            // Note that we DO NOT need to pass the set of validators
            // because the new field has the same name with the original one
            // which its validators are already set
            $('#formulario')
                    .formValidation('addField', $clone.find('[name="actividad[]"]'))
                    .formValidation('addField', $clone.find('[name="responsable[]"]'))
                    .formValidation('addField', $clone.find('[name="inicio[]"]'))
                    .formValidation('addField', $clone.find('[name="fin[]"]'));
        })

                // Remove button click handler
                .on('click', '.removeButton', function() {
                    var $row = $(this).closest('.form-group');
                    // Remove fields
                    $('#formulario')
                            .formValidation('removeField', $row.find('[name="actividad[]"]'))
                            .formValidation('removeField', $row.find('[name="responsable[]"]'))
                            .formValidation('removeField', $row.find('[name="inicio[]"]'))
                            .formValidation('removeField', $row.find('[name="fin[]"]'));
                    // Remove element containing the fields
                    $row.remove();
                });
    });
</script>
<script type="text/javascript">
    $('#btnUpdEvento').click(function() {
        var porcentaje = $('#porcentaje').val();
        var observacion = $('#observacion').val();
        var ide = $('#mhdnIdEvento').val();

        $.post("<?php echo base_url(); ?>index.php/Events/updEvento2",
                {
                    observacion: observacion,
                    porcentaje: porcentaje,
                    id: ide
              
                },
        function(data) {
            if (data == 1) {
                $('#btnCerrarModal').click();
                location.reload();
            }
            
        }) 
      
    })
</script>
