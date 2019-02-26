<meta name="theme-color" content="#F0DB4F">
  <meta name="MobileOptimized" content="width">
  <meta name="HandheldFriendly" content="true">
  <meta name="apple-mobile-web-app-capable" content="yes">
  <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
  <link rel="shortcut icon" type="image/png" href="./img/ProgramadorFitness.png">
  <link rel="apple-touch-icon" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes/ProgramadorFitness.png">
  <link rel="apple-touch-startup-image" href="https://sac-jlacruz.c9users.io/application/recursos/imagenes//ProgramadorFitness.png">
  <link rel="manifest" href="https://sac-jlacruz.c9users.io/manifest.json">

<html>
    <body onload="nobackbutton();">
        

<!--=========== Formulario para registrar nuevos usuarios del sistema =============-->
<?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
<section class="content">
    <div class="box box-default collapsed-box">
        <div class="box-header with-border">
            <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
<!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
        </div>
        <div class="box-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formulario" action="" method="POST" name="formulario" >
                    
                        <div class="col-xs-12"  id='resultado'></div>
                        <div class="col-xs-12"  id='resultado2'></div>
                      
                        <div class="form-group col-sm-6">
                            <label>Identificaci&oacute;n</label> 
                            <input type="text" autocomplete="off" class="form-control" id="cedula" maxlength="8" onKeyPress="return soloNumeros(event)" name="cedula" placeholder="Identificaci&oacute;n">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Nombres</label> 
                            <input type="text"  class="form-control" id="nombres" onKeyPress="return soloLetras(event)" name="nombres" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Apellidos</label> 
                            <input type="text" class="form-control" id="apellidos" onKeyPress="return soloLetras(event)" name="apellidos" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                        </div>

                        <div class="form-group col-sm-6">
                            <label>Correo</label> 
                            <input type="text" class="form-control" id="correo" name="correo" onkeyup="javascript:this.value = this.value.toUpperCase()" placeholder="Correo El&eacute;ctronico">
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Usuario</label> 
                            <input type="text"  class="form-control" id="usuario" onkeyup="javascript:this.value = this.value.toUpperCase()" onKeyPress="return soloLetras(event)" name="usuario" placeholder="Nombre de Usuario">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Rol</label> 
                            <select name="rol" id="rol"  class="form-control">
                                <option value="">Selecione...</option>
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">ANALISTA</option>       
                            </select>
                        </div>
                        <div class="col-sm-12"></div>
                        <div class="form-group col-sm-6">
                            <label>Clave</label>
                            <input type="password" name="confirmar_clave"  id="confirmar_clave" class="form-control" placeholder="Clave de Acceso">
                        </div>
                        <div class="form-group col-sm-6">
                            <label>Confirmar Clave</label> 
                            <input type="password" name="clave" id="clave" class="form-control" placeholder="Confirme su Clave de Acceso">
                        </div>
                        <div class="col-sm-12">&nbsp;</div>

                        <div class="form-group col-sm-6">
                            <button  type="" class="btn btn-sample" id="guardar">
                                <span class='glyphicon glyphicon-saved'>&nbsp;Guardar</span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php } ?>
<!--============================= Ventana modal para editar los registros =====================================-->
<form id="userForm" method="post" class="form-horizontal" style="display: none;">
                        <div class="col-sm-12"></div>
                       
                        <input type="hidden"  id="id" name="id" >
                        <div class="form-group col-sm-12">
                            <label >Nombre</label> 
                            <input type="text"  class="form-control " id="nombres" name="nombres" readonly>
                        </div>
                        <div class="form-group col-sm-4"></div>

                        <div class="form-group col-sm-12">
                            <label>Apellido</label>
                            <input type="text"  class="form-control " id="apellidos" name="apellidos" readonly>

                        </div>

                        <div class="form-group col-sm-12">
                            <label>Rol</label>
                            <select name="rol" id="rol"  class="form-control " required >
                                <option value="1">ADMINISTRADOR</option>
                                <option value="2">ANALISTA</option>
                            </select>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Estatus del Usuario</label>

                            <select name="estatus" id="estatus"  class="form-control " required >
                                <option value="1">HABILITAR</option>
                                <option value="0">DESHABILITAR</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <div class="col-xs-12">
                                <button type="submit" class="btn btn-sample"> <span class='fa fa-pencil'>&nbsp;Modificar</span></button>
                            </div>
                        </div>
                    </form>

<!--============ En este div se muestran los datos de la tabla ====================-->
<div class="contenido_tabla" id="contenido_tabla"></div>
</body>
</html>
 
<script>
    function nobackbutton(){
	
   window.location.hash="no-back-button";
	
   window.location.hash="Again-No-back-button" //chrome
	
   window.onhashchange=function(){window.location.hash="no-back-button";}
	
}
</script>


<script>
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
    
     $(document).ready(function() {
        $('#formulario').formValidation({
            framework: 'bootstrap',
            fields: {
                cedula: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        },
                        stringLength: {
                            min: 6,
                            max: 8,
                            message: 'M&iacute;nimo 6 m&aacute;ximo 8 d&iacute;gitos'
                        }

                    }
                },
                nombres: {
                    row: '.col-sm-6',
                    validators: {
                        notEmpty: {
                            message: 'CAMPO OBLIGATORIO'
                        }
                    }
                },
                apellidos: {
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
                            message: 'La Direcci&oacute;n de Correo es Requerida'
                        },
                        regexp: {
                            regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                            message: ' '
                        },
                        emailAddress: {
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
                    row: '.col-sm-6',
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
                        stringLength: {
                            //min: 8,
                            //max: 20,
                            message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                        },
                        /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial
                        regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&*]).{8,12}$',
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
                        stringLength: {
                            //min: 8,
                            //max: 20,
                            message: 'La contrase&ntilde;a debe contener minimo 8 digitos'
                        },
                        /////PASSWORD = Mayuscula, Minuscula, numero, caracter especial ej: POab12@, AAbb01**
                        /////NO importa el orden de como se llenen la password puede ser al contrario ej:12@abPO

                        regexp: {
                            regexp: '^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[$@!%?&*]).{8,12}$',
                            message: 'La contrase&ntilde;a debe contener m&iacute;nimo 8 y m&aacute;ximo 12 caracteres, y por lo menos 1 may&uacute;scula del alfabeto , 1 min&uacute;sculas del alfabeto , 1 N&uacute;mero y el car&aacute;cter especial'
                        },
                        identical: {
                            field: 'confirmar_clave',
                            message: 'Las contrase&ntilde;a deben ser iguales'
                        }
                    }
                }

            }
        });
    });

    $(document).on("keyup", '#cedula', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario'; ?>",
            data: {cedula: $('#cedula').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#cedula').val('');
                    $("#nombres").val('');
                    $("#apellidos").val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-ban'></i> Alerta...!     Nro de Identificaci&oacute;n YA registrado</div>");
                }
            }
        });
    });
    $(document).on("keyup", '#usuario', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_usuario2'; ?>",
            data: {usuario: $('#usuario').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#usuario').val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban'></i> Alert!</h4> Nombre de Usuario No Disponible</div>");
                }
            }
        });
    });
    $(document).on("keyup", '#correo', function()
    {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/administracion/consultar_correo2'; ?>",
            data: {correo: $('#correo').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#correo').val('');
                    $("#resultado").html("<div class='alert alert-danger alert-dismissible'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button><h4><i class='icon fa fa-ban'></i> Alert!</h4>Este E-mail ya se encuentra registrado</div>");
                }
            }
        });
    });
 
    //======================= Funcion para registrar usuarios============= 
    window.onload = function () {
    Cargar();    
}
    $(document).ready(function() {
        $("#guardar").click(function() {//evento javascript onclick
            // Declaracion de variables

            var dataUser = {
                "cedula": $("#cedula").val(),
                "usuario": $("#usuario").val(),
                "clave": $("#clave").val(),
                "confirmar_clave": $("#confirmar_clave").val(),
                "nombres": $("#nombres").val(),
                "apellidos": $("#apellidos").val(),
                "correo": $("#correo").val(),
                "rol": $("#rol").val()
            };
            //validamos que no quede ningun campo vacio
            if (dataUser.cedula === '' || dataUser.usuario === '' || dataUser.clave === '' || dataUser.nombres === '' || dataUser.apellidos === '' || dataUser.correo === '' || dataUser.rol === '') {
                // mensaje en caso de que exista un campo vacio del formulario
                $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
                //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
            } else {
                var user = 1;
            }
            if (dataUser.clave !== dataUser.confirmar_clave) {
                $("#resultado2").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button>Las contrase&ntilde;a deben ser iguales</div>");
            } else {
                var cont = 1;
            }

            if (user === 1 && cont === 1) {
                $.ajax({
                    type: 'POST',
                    dataType: 'html',
                    data: dataUser,
                    url: "<?php echo base_url() . 'index.php/administracion/registrar_usuario'; ?>",
                    // mostramos un loader antes de enviar los datos
                    beforeSend: function() {
                        $("#resultado2").show();
                       // $("#resultado2").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                    },
                    //Despues de enviar los datos limpiamos los campos del formulario
                    success: function(respuesta) {

                        $("#cedula").val(''),
                        $("#usuario").val(''),
                        $("#clave").val(''),
                        $("#confirmar_clave").val(''),
                        $("#nombres").val(''),
                        $("#apellidos").val(''),
                        $("#correo").val(''),
                        $("#rol").val(''),
                        // Enviamos un mensaje de exito al insertar los datos
                        $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                        Cargar();
                    }
                });
                //Redirijimos luego de enviar los datos 
                 //setInterval(function() {
                  // location.reload();
               // }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
               
            }
        });
    });


function Cargar()
{
    $('#contenido_tabla').load('<?php echo BASE_URL() ?>index.php/Administracion/buscarDatos');    
}
setInterval('Cargar()',1000);// Actualiza la pagina cada 2 segundos
</script>











