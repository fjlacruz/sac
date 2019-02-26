

<!--================================ Script de rura spa de usuarios================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_usuarios.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />






  

<!--=============================================================================================================== -->
<!--===============================================Tabla de Usuarios================================================ -->
<!--=============================================================================================================== -->
<div id="usuarios">
    <section class="content" id="section">
        <div class="box box-success">
            <div class="box-header with-border">
                <p class="box-title">Administraci&oacute;n de Usuarios</p>
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
    <a class='flotante'><span tooltip="Agregar Usuario"><button type="submit" class="btn bg-olive btn-circle btn-lg" data-target='#myModal1' data-toggle='modal' onclick="myFunction(2)"><i class="glyphicon glyphicon-plus"></i></span></button></a>
</div>

<!--=============================================================================================================== -->
<!--========================================= Fin Tabla de Usuarios================================================ -->
<!--=============================================================================================================== -->




<!--=============================================================================================================== -->
<!--========================================= Registro de  Usuarios================================================ -->
<!--=============================================================================================================== -->
<div id="registrar_usuario" style="display:none;" >
    <section class="content" id="section" style="width: 95%; align-content: center">
        <div class="box box-success">
            <div class="box-header with-border">
                <p class="box-title">Registrar Usuario</p>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                  <form id="formulario" method="POST" name="formulario" >
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-12"  id='resultado'></div>
                            <div class="form-group col-sm-6">
                                <label>Rut</label>
                                <input type="text" v-model="cedula" autocomplete="off" class="form-control text-uppercase redondeado" id="cedula" maxlength="8" onKeyPress="return soloNumeros(event)" name="cedula" placeholder="C&eacute;dula">
                            </div>
                            <div class="form-group col-sm-6">
                               <label>Nombres</label> 
                               <input type="text"  v-model="nombres"  class="form-control text-uppercase redondeado" id="nombres" onKeyPress="return soloLetras(event)" name="nombres" placeholder="Nombres" maxlength="20">
                           </div>

                           <div class="form-group col-sm-6">
                            <label>Apellidos</label> 
                            <input type="text" class="form-control text-uppercase redondeado" id="apellidos" onKeyPress="return soloLetras(event)" name="apellidos" placeholder="Apellidos" maxlength="20">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Correo</label> 
                            <input type="text" class="form-control text-uppercase redondeado" id="correo" name="correo"  placeholder="Correo El&eacute;ctronico" maxlength="50">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Usuario</label> 
                            <input type="text"  class="form-control text-uppercase redondeado" id="usuario" onKeyPress="return soloLetras(event)" name="usuario" placeholder="Nombre de Usuario" maxlength="10">
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Comunidad</label> 
                            <select name="id_comunidad" id="id_comunidad"  class="form-control redondeado" ><option value="">Selecione...</option>
                           <?php
                         foreach ($comunidades as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        <div class="form-group col-sm-3">
                            <label>Rol</label> 
                             <select name="rol" id="rol"  class="form-control redondeado" ><option value="">Selecione...</option>
                           <?php
                         foreach ($roles as $i => $rol) {
                         echo '<option value="' . $rol->id_rol . '">' . $rol->descripcion_rol . '</option>';
                           }
                           ?>                     
                      </select>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Clave</label>
                            <input type="password" name="confirmar_clave" id="confirmar_clave" class="form-control text-uppercase redondeado" placeholder="Clave de Acceso" maxlength="20">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirmar Clave</label> 
                            <input type="password" name="clave" id="clave" class="form-control text-uppercase redondeado" placeholder="Confirme su Clave de Acceso" maxlength="20">
                        </div>
                        <div class="col-sm-12">&nbsp;</div>

                        <div class="col-xs-12">
                            <span tooltip="Guardar">
                                <button type="submit" class="btn bg-olive btn-circle" v-show="cedula" v-show="nombres" ><i class="fa fa-save"></i></button></span>
                                <span tooltip="Cancelar">
                                    <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                                </span>
                            </div>
                        </div>   
                    </div> 
                </form>
            </div>
        </div>
    </div>
</div>
</section>
</div>
<!--=============================================================================================================== -->
<!--========================================= Fin de Registro Usuarios============================================= -->
<!--=============================================================================================================== -->



<!--=============================================================================================================== -->
<!--===================================================Editar Usuarios============================================= -->
<!--=============================================================================================================== -->
<div id="editar_usuarios" style="display:none;">
    <section class="content" id="section" style="width: 95%; align-content: center">
        <div class="box box-success">
            <div class="box-header with-border">
                <p class="box-title">Editar Usuario</p>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div>
            </div>
            <div class="box-body">
              <div class="row">
                <div class="col-md-12">
                    <form id="userForm" method="post" class="form-horizontal">
                        <div class="col-sm-12"></div>
                        <input type="hidden"  id="id" name="id" >
                        <div class="col-sm-12"  id='resultado_modal'></div>

                        <div class="form-group col-sm-12">
                            <label >Rut</label> 
                            <input type="text"  class="form-control text-uppercase redondeado" id="cedula_modal" name="cedula_modal" readonly>
                        </div>

                        <div class="form-group col-sm-12">
                            <label >Nombre</label> 
                            <input type="text"  class="form-control text-uppercase redondeado" id="nombres_modal" name="nombres_modal" readonly>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Apellido</label>
                            <input type="text"  class="form-control text-uppercase redondeado" id="apellidos_modal" name="apellidos_modal" readonly>
                        </div>

                        <div class="form-group col-sm-12">
                            <label >Usuario</label> 
                            <input type="text"  class="form-control text-uppercase redondeado" id="usuario_modal" name="usuario_modal" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Correo</label>
                            <input type="text"  class="form-control text-uppercase redondeado" id="correo_modal" name="correo_modal" >
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Comunidad</label>

                            <select name="id_comunidad_modal" id="id_comunidad_modal"  class="form-control redondeado" ><option value="">Selecione...</option>
                             <?php
                         foreach ($comunidades as $i => $comunidad) {
                         echo '<option value="' . $comunidad->id_comunidad . '">' . $comunidad->nombre_comunidad . '</option>';
                           }
                           ?>                      
                         </select>
                     </div>
                     <div class="form-group col-sm-12">
                            <label>Rol</label>

                            <select name="rol_modal" id="rol_modal"  class="form-control redondeado" ><option value="">Selecione...</option>
                             <?php
                             foreach ($roles as $i => $rol) {
                                 echo '<option value="' . $rol->id_rol . '">' . $rol->descripcion_rol . '</option>';
                             }
                             ?>                     
                         </select>
                     </div>

                     <div class="form-group col-sm-12">
                        <label>Estatus del Usuario</label>
                        <select name="estatus_modal" id="estatus_modal"  class="form-control redondeado">
                            <option value="1">HABILITAR</option>
                            <option value="0">DESHABILITAR</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                         <span tooltip="Guardar">
                            <button type="submit" class="btn bg-olive btn-circle" onclick="myFunction(3)"><i class="fa fa-save"></i></button>
                        </span>
                        <span tooltip="Cancelar">
                            <button type="button" class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                        </span>
                    </div>
                </div>
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script>
    var registrar_usuario = new Vue({
        el:'#registrar_usuario',
        data:{  

            cedula:'',
            nombres:''

        }
    })

</script>






<script>
    // Validar si existe cedula, correo y usuario
    $(document).on("blur", '#cedula', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consultas/existe_cedula'; ?>",
            data: {cedula: $('#cedula').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {
                if (respuesta == 1)
                {
                    $('#formulario').formValidation('resetForm');
                    $('#cedula').val('');
                    $("#nombres").val('');
                    $("#apellidos").val('');
                    alertify.error("Cedula Ya Registrada...!!"); 
                    return false;
                }
            }
        });
    });

    $(document).on("blur", '#correo', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consultas/existe_correo'; ?>",
            data: {correo: $('#correo').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {
                if (respuesta == 1)
                {
                    $('#correo').val('');
                    $('#formulario').formValidation('resetForm');
                    alertify.error("Correo ya Registrado...!!"); 
                    return false;
                }
            }
        });
    });

    $(document).on("blur", '#usuario', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/consultas/existe_usuario'; ?>",
            data: {usuario: $('#usuario').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#formulario').formValidation('resetForm');
                    $('#usuario').val('');
                    alertify.error("usuario ya Registrado...!!"); 
                    return false;
                }
            }
        });
    });

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
//====================== Validacion del formulario de registro de usuarios ============================
$(document).ready(function() {
    $('#formulario').formValidation({
        fields: {
            cedula: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            correo: {
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
            usuario: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            rol: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            id_comunidad: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            confirmar_clave: {
                row: '.col-sm-6',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    },
                        /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial
                        regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&.-_#,/]).{8,12}$',
                            message: 'La contrase&ntilde;a debe contener m&iacute;nimo 8 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula del alfabeto , 1 min&uacute;sculas del alfabeto , 1 N&uacute;mero y el car&aacute;cter especial'
                        }

                    }
                },
                clave: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        identical: {
                            field: 'confirmar_clave',
                            message: 'Las contrase&ntilde;a deben ser iguales'
                        }
                    }
                }

            }
//==============  registro de Usuario ======================================================          
}).on('success.form.fv', function(e) {
    e.preventDefault();
    var $form = $(e.target);
    $.ajax({
        url: "registrar_usuario",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {

         Push.create("Notificacion Push",{
            body: "Este es el cuerpo de la notificacion",
            icon: "<?php echo base_url(); ?>application/recursos/imagenes/icon_64.png",
            //timeout: 12000,
            requireInteraction: true,// para dejar la notificacion fija hasta que el usuario la cierre manualmente
            onClick: function () {
                window.location="https://nickersoft.github.io/push.js/";
                this.close();
            }
        });
        alertify.log("Se ha Registrado un usuario...!!"); 

        $('#formulario').formValidation('resetForm');
        $('#formulario')[0].reset();
        myFunction(1)
        reload_table();
    });
});
});


//============= Consulat de datos por cedula en api de servicios (json)==========================
$(document).ready(function() {
    $("#cedula").keyup(function() {
        if ($("#cedula").val() != '' && $("#cedula").val().length > 6) {
            var cedula = document.getElementById("cedula").value;
            $.ajax({
                type: "GET",
                url: "http://192.168.10.219/api-services/index.php/personas/cedula/" + cedula,
                dataType: "json",
                success: function(data) {
                    if (data == 404) {
                        $("#nombres").val('');
                        $("#apellidos").val('');
                        $('#nombres').removeAttr("readonly");
                        $('#apellidos').removeAttr("readonly");
                    } else {
                        var obj = eval("(" + JSON.stringify(data) + ")");
                        $('#nombres').attr("readonly", true);
                        $('#apellidos').attr("readonly", true);
                        $("#nombres").val(obj.response.nombres);
                        if (obj.response.segundo_apellido == null) {
                            $("#apellidos").val(obj.response.primer_apellido);
                        } else {
                            $("#apellidos").val((obj.response.primer_apellido) + ' ' + (obj.response.segundo_apellido));
                        }

                    }
                }
            });
        }
    });
});

//===== Validacion de campos del formulario de edicion de usuario  ======================
$(document).ready(function() {
    $('#userForm').formValidation({
        fields: {
            correo_modal: {
                row: '.col-sm-12',
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
            usuario_modal: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            rol_modal: {
                row: '.col-sm-12',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            estatus_modal: {
                row: '.col-sm-12',
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
            url: "<?php echo base_url() . 'index.php/administracion/actualizar_usuario'; ?>",
            method: 'POST',
            data: $form.serialize()
        }).success(function(response) {
            $('#resultado_msj').html('<div class="loading"><img src="<?php echo base_url(); ?>application/recursos/imagenes/ajax-loader.gif" alt="loading" /><br/>Un momento, por favor...</div>');
            $('#userForm').formValidation('resetForm');
            $('#userForm')[0].reset();
                myFunction(1)// ==== funcion de enruutamiento
                reload_table();
            });
    });
});
// ================== Consulat del id del usuario para montar el resultado en la dista de editar usuario ======================    
$('.editButton').on('click', function() {
    var id = $(this).attr('data-id');
    $.ajax({
        url: "<?php echo base_url() . 'index.php/consultas/consultar_usuario_id/'; ?>" + id,
        method: 'GET'

    }).success(function(data) {
        $('#userForm').formValidation('resetForm');
        $('#userForm')[0].reset();

        var obj = JSON.parse(data);
        $('#userForm')
        .find('[name="id"]').val(obj.id_usuario).end()
        .find('[name="cedula_modal"]').val(obj.cedula).end()
        .find('[name="nombres_modal"]').val(obj.nombres).end()
        .find('[name="apellidos_modal"]').val(obj.apellidos).end()
        .find('[name="usuario_modal"]').val(obj.usuario).end()
        .find('[name="correo_modal"]').val(obj.correo).end()
        .find('[name="rol_modal"]').val(obj.rol).end()
        .find('[name="estatus"]').val(obj.estatus).end();


    });
});
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

