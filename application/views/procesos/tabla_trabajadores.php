<!--================================ Script de rura spa de usuarios================================================ -->
<script src="<?php echo base_url(); ?>application/scripts/ruta_ingresos.js"></script>
<script src="<?php echo base_url(); ?>application/recursos/js/jquery-customselect.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/jquery-customselect.css" />

<style type="text/css">
    input[type="text"]
{
    border: 0;
    border-bottom: 1px solid red;
    outline: 0;
}
</style>
<!--=============================================================================================================== -->
<!--===============================================Tabla de Ingresos================================================ -->
<!--=============================================================================================================== -->

<body onload="nobackbutton();">
<div id="ingresos">
   <section class="content">
      <div class="box box-success" id="section" >
         <div class="box-header with-border">
            <a href="<?php echo base_url() ?>principal/bienvenida">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
            <p class="box-title">Administraci&oacute;n de Trabajadores</p>
            
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
<!--========================================= Fin Tabla de Trabajadores =========================================== -->
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<!--========================================= Registro de Trabajadores ============================================ -->
<!--=============================================================================================================== -->
<div id="registrar_ingreso" style="display:none;" >
   <section class="content" style="width: 95%; align-content: center">
      <div class="box box-success" id="section" >
         <div class="box-header with-border">
             <a href="<?php echo base_url() ?>Remuneraciones/trabajadores">
                                <span tooltip="Regresar">
                                <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
                                </span></a>
            <p class="box-title">Registrar Trabajador</p>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="formulario" method="POST" name="formulario" action="">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12"  id='resultado'></div>
                           <div class="form-group col-sm-3">
                              <label>Rut</label> 
                              <input type="text"  class="form-control redondeado" id="rut" name="rut" placeholder="Rut" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Nombres</label> 
                              <input type="text"  class="form-control redondeado" id="nombres_trabajador"  name="nombres_trabajador" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Apellidos</label> 
                              <input type="text"  class="form-control redondeado" id="apellidos_trabajador" name="apellidos_trabajador" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Direccion</label> 
                              <input type="text"  class="form-control redondeado" id="direccion"  name="direccion" placeholder="Direccion" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           
                           
                           <div class="form-group col-sm-3">
                              <label>Telefono local</label> 
                              <input type="text"  class="form-control redondeado" id="telf_local"  name="telf_local" placeholder="Telefono local" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Telefono celular</label> 
                              <input type="text"  class="form-control redondeado" id="telf_celular" name="telf_celular" placeholder="Telefono celular" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Email</label> 
                              <input type="text"  class="form-control redondeado" id="email"  name="email" placeholder="Email" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Sexo</label> 
                              <select name="sexo" id="sexo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="M">M</option>
                                 <option value="F">F</option>
                              </select>
                           </div>
                           
                           <div class="form-group col-sm-3">
                              <label>Nacionalidad</label> 
                               <select name="nacionalidad" id="nacionalidad"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="CHILENA">CHILENA</option>
                                 <option value="EXTRANJERO">EXTRANJERO</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Cargo</label> 
                              <select name="id_cargo" id="id_cargo"  class="form-control redondeado" >
                                 <option value="">Selecione...</option>
                                 <?php
                                    foreach ($cargos as $i => $cargo) {
                                    echo '<option value="' . $cargo->id_cargo . '">' . $cargo->descripcion_cargo .'</option>';
                                      }
                                      ?>                     
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Fecha Contrato</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_contrato"  name="fecha_contrato" readonly>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Tipo Contrato</label> 
                              <select name="tipo_contrato" id="tipo_contrato"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="FIJO">FIJO</option>
                                 <option value="INDEFINIDO">INDEFINIDO</option>
                              </select>
                           </div>
                           
                           <div class="form-group col-sm-3">
                              <label>Tipo Sueldo</label> 
                              <select name="tipo_sueldo" id="tipo_sueldo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="MENSUAL">MENSUAL</option>
                                 <option value="DIARIO">DIARIO</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Horas Semanales</label> 
                              <select name="horas_semanales" id="horas_semanales"  class="form-control redondeado 1-100"></select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Tipo Trabajador</label> 
                              <select name="tipo_trabajador" id="tipo_trabajador"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="ACTIVO">ACTIVO</option>
                                 <option value="PENSIONADO(COTIZA)">PENSIONADO(COTIZA)</option>
                                 <option value="PENSIONADO(NO COTIZA)">PENSIONADO(NO COTIZA)</option>
                                 <option value="MUEJER ACTIVA ENTRE 60-65 AÑOS">MUEJER ACTIVA ENTRE 60-65 AÑOS</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Jubilado</label> 
                              <select name="jubilado" id="jubilado"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>

                           <div class="form-group col-sm-3">
                              <label>Paga AFP?</label> 
                              <select name="paga_afp" id="paga_afp"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Regimen Previsional</label> 
                              <select name="regimen_provisional"  id="regimen_provisional" class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="1">AFP</option>
                                 <option value="2">ISP</option>
                              </select>
                           </div>
                           
                           <div id="div_1" class="form-group col-sm-3 contenido">
                              <label>AFP</label> 
                              <select name="afp" id="afp"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="seleccion1">seleccion1</option>
                                 <option value="seleccion2">seleccion12</option>
                              </select>
                           </div>
                           <div id="div_2" class="form-group col-sm-3 contenido">
                              <label>Caja ex regimen</label> 
                              <select name="caja_ex_regimen" id="caja_ex_regimen"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="caja1">caja1</option>
                                 <option value="caja2">caja2</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Prevencion de Salud</label> 
                              <select name="prevencion_salud" id="prevencion_salud"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="a">a</option>
                                 <option value="b">b</option>
                              </select>
                           </div>
                           
                           <div class="form-group col-sm-3">
                              <label>Cargas Mormales</label> 
                              <select name="cargas_normales" id="cargas_normales"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Cargas Maternales</label> 
                              <select name="cargas_maternales" id="cargas_maternales"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Cargas Invalidez</label> 
                              <select name="cargas_invalidez" id="cargas_invalidez"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Tramo Sueldo</label> 
                              <select name="tramo_sueldo" id="tramo_sueldo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="A">A</option>
                                 <option value="B">B</option>
                                 <option value="C">C</option>
                              </select>
                           </div>

                           <div class="form-group col-sm-3">
                              <label>Sueldo Base</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="sueldo_base"  name="sueldo_base" placeholder="Sueldo Base" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Movilizacion</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="movilizacion"  name="movilizacion" placeholder="Movilizacion" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Colocacion</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="colacion"  name="colacion" placeholder="Colocacion" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Bono Mensual</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="bono_mensual"  name="bono_mensual" placeholder="Bono Mensual" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Bono proporcional a Dias</label> 
                              <select name="bono_proporcional_dias" id="bono_proporcional_dias"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           <div class="form-group col-sm-3">
                              <label>Bono afecta total de Remuneraciones</label> 
                              <select name="bono_afecta_remuneraciones" id="bono_afecta_remuneraciones"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           
                           <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-2">
                           <label>&nbsp;</label>
                           <span tooltip="Guardar">
                              <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
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
<!--========================================= Fin de Registro Trabajadores ======================================== -->
<!--=============================================================================================================== -->
<!--=============================================================================================================== -->
<!--===================================================Editar Trabajador ========================================== -->
<!--=============================================================================================================== -->
<div id="editar_ingreso" style="display:none;">
   <section class="content" id="section" style="width: 95%; align-content: center">
      <div class="box box-success">
         <div class="box-header with-border">
            <p class="box-title">Editar TRabajador</p>
            <div class="col-sm-12">
               <!--<input type="text" name="nombres_modal" id='nombres_modal' style="border: 0; text-align:right;"/>-->
               <!--<input type="text" name="apellidos_modal" id='apellidos_modal' style="border: 0;"/>-->
               <!--<input type="text" name="nro_dpto_modal" id='nro_dpto_modal' style="border: 0;"/>
               <input type="hidden"  id="id" name="id" >-->
            </div>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="userForm" method="post" class="form-horizontal">
                    <input type="hidden"  id="id" name="id">
                    <div>
                        <div class="row">
                           <div class="col-sm-12"  id='resultado'></div>
                           <div class="col-sm-3">
                              <label>Rut</label> 
                              <input type="text"  class="form-control redondeado" id="rut" name="rut" placeholder="Rut" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class=" col-sm-3">
                              <label>Nombres</label> 
                              <input type="text"  class="form-control redondeado" id="nombres_trabajador"  name="nombres_trabajador" placeholder="Nombres" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-3">
                              <label>Apellidos</label> 
                              <input type="text"  class="form-control redondeado" id="apellidos_trabajador" name="apellidos_trabajador" placeholder="Apellidos" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-3">
                              <label>Direccion</label> 
                              <input type="text"  class="form-control redondeado" id="direccion"  name="direccion" placeholder="Direccion" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           
                           
                           <div class="col-sm-3">
                              <label>Telefono local</label> 
                              <input type="text"  class="form-control redondeado" id="telf_local"  name="telf_local" placeholder="Telefono local" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-3">
                              <label>Telefono celular</label> 
                              <input type="text"  class="form-control redondeado" id="telf_celular" name="telf_celular" placeholder="Telefono celular" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-3">
                              <label>Email</label> 
                              <input type="text"  class="form-control redondeado" id="email"  name="email" placeholder="Email" onkeyup="javascript:this.value = this.value.toUpperCase()">
                           </div>
                           <div class="col-sm-3">
                              <label>Sexo</label> 
                              <select name="sexo" id="sexo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="M">M</option>
                                 <option value="F">F</option>
                              </select>
                           </div>
                           
                           <div class="col-sm-3">
                              <label>Nacionalidad</label> 
                               <select name="nacionalidad" id="nacionalidad"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="CHILENA">CHILENA</option>
                                 <option value="EXTRANJERO">EXTRANJERO</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Cargo</label> 
                              <select name="id_cargo" id="id_cargo"  class="form-control redondeado" >
                                 <option value="">Selecione...</option>
                                 <?php
                                    foreach ($cargos as $i => $cargo) {
                                    echo '<option value="' . $cargo->id_cargo . '">' . $cargo->descripcion_cargo .'</option>';
                                      }
                                      ?>                     
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Fecha Contrato</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="fecha_contrato"  name="fecha_contrato" readonly>
                           </div>
                           <div class="col-sm-3">
                              <label>Tipo Contrato</label> 
                              <select name="tipo_contrato" id="tipo_contrato"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="FIJO">FIJO</option>
                                 <option value="INDEFINIDO">INDEFINIDO</option>
                              </select>
                           </div>
                           
                           <div class="col-sm-3">
                              <label>Tipo Sueldo</label> 
                              <select name="tipo_sueldo" id="tipo_sueldo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="MENSUAL">MENSUAL</option>
                                 <option value="DIARIO">DIARIO</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Horas Semanales</label> 
                              <select name="horas_semanales" id="horas_semanales"  class="form-control redondeado 1-100"></select>
                           </div>
                           <div class="col-sm-3">
                              <label>Tipo Trabajador</label> 
                              <select name="tipo_trabajador" id="tipo_trabajador"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="ACTIVO">ACTIVO</option>
                                 <option value="PENSIONADO(COTIZA)">PENSIONADO(COTIZA)</option>
                                 <option value="PENSIONADO(NO COTIZA)">PENSIONADO(NO COTIZA)</option>
                                 <option value="MUEJER ACTIVA ENTRE 60-65 AÑOS">MUEJER ACTIVA ENTRE 60-65 AÑOS</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Jubilado</label> 
                              <select name="jubilado" id="jubilado"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>

                           <div class="col-sm-3">
                              <label>Paga AFP?</label> 
                              <select name="paga_afp" id="paga_afp"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Regimen Previsional</label> 
                              <select name="regimen_provisional"  id="regimen_provisional" class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="1">AFP</option>
                                 <option value="2">ISP</option>
                              </select>
                           </div>
                           
                           <div id="div_1" class="col-sm-3 contenido">
                              <label>AFP</label> 
                              <select name="afp" id="afp"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="seleccion1">seleccion1</option>
                                 <option value="seleccion2">seleccion12</option>
                              </select>
                           </div>
                           <div id="div_2" class="col-sm-3 contenido">
                              <label>Caja ex regimen</label> 
                              <select name="caja_ex_regimen" id="caja_ex_regimen"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="caja1">caja1</option>
                                 <option value="caja2">caja2</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Prevencion de Salud</label> 
                              <select name="prevencion_salud" id="prevencion_salud"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="a">a</option>
                                 <option value="b">b</option>
                              </select>
                           </div>
                           
                           <div class="col-sm-3">
                              <label>Cargas Mormales</label> 
                              <select name="cargas_normales" id="cargas_normales"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="col-sm-3">
                              <label>Cargas Maternales</label> 
                              <select name="cargas_maternales" id="cargas_maternales"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="col-sm-3">
                              <label>Cargas Invalidez</label> 
                              <select name="cargas_invalidez" id="cargas_invalidez"  class="form-control redondeado 1-10"></select>
                           </div>
                           <div class="col-sm-3">
                              <label>Tramo Sueldo</label> 
                              <select name="tramo_sueldo" id="tramo_sueldo"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="A">A</option>
                                 <option value="B">B</option>
                                 <option value="C">C</option>
                              </select>
                           </div>

                           <div class="col-sm-3">
                              <label>Sueldo Base</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="sueldo_base"  name="sueldo_base" placeholder="Sueldo Base" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="col-sm-3">
                              <label>Movilizacion</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="movilizacion"  name="movilizacion" placeholder="Movilizacion" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="col-sm-3">
                              <label>Colocacion</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="colacion"  name="colacion" placeholder="Colocacion" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="col-sm-3">
                              <label>Bono Mensual</label> 
                              <input type="text" autocomplete="off"  class="form-control redondeado"  id="bono_mensual"  name="bono_mensual" placeholder="Bono Mensual" onkeypress="return filterFloat(event,this);">
                           </div>
                           <div class="col-sm-3">
                              <label>Bono proporcional a Dias</label> 
                              <select name="bono_proporcional_dias" id="bono_proporcional_dias"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           <div class="col-sm-3">
                              <label>Bono afecta total de Remuneraciones</label> 
                              <select name="bono_afecta_remuneraciones" id="bono_afecta_remuneraciones"  class="form-control redondeado">
                                 <option value="">Selecione...</option>
                                 <option value="SI">SI</option>
                                 <option value="NO">NO</option>
                              </select>
                           </div>
                           
                           <div class="col-sm-12">&nbsp;</div>
                           <div class="col-sm-2">
                           <label>&nbsp;</label>
                           <span tooltip="Guardar">
                              <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje();"><i class="fa fa-save"></i></button></span>
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
</body>
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
               <form id="formulario2" action="<?php echo base_url() ?>index.php/egresos/actualizar_adjunto" method="POST" name="formulario" enctype="multipart/form-data">
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
<!--=============================================================================================================== -->
<!--========================================= Fin de Editar Usuarios============================================= -->
<!--=============================================================================================================== -->








<script language="javascript" type="text/javascript">
            $(document).ready(function(){
                $(".contenido").hide();
                $("#regimen_provisional").change(function(){
                $(".contenido").hide();
                    $("#div_" + $(this).val()).show();
                });
            });
        </script>


<script>
   $(function(){
    var $select = $(".1-100");
    for (i=0;i<=50;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
   });
    $(function(){
    var $select = $(".1-10");
    for (i=0;i<=10;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
   });
</script>

<script>
$(document).on("blur", '#rut', function() {
        $.ajax({
            url: "<?php echo base_url() . 'index.php/Remuneraciones/consultar_trabajdor'; ?>",
            data: {rut: $('#rut').val()},
            dataType: 'html',
            type: 'post',
            success: function(respuesta) {

                if (respuesta == 1)
                {
                    $('#formulario').formValidation('resetForm');
                    $('#rut').val('');
                    alertify.error("Rut ya Registrado...!!"); 
                    return false;
                }
            }
        });
    });
</script>

<script>
  $(document).ready(function() {
    $('#formulario').formValidation({
        fields: {
            rut: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            email: {
                row: '.col-sm-3',
                validators: {
                    
                    regexp: {
                        regexp: '^[^@\\s]+@([^@\\s]+\\.)+[^@\\s]+$',
                        message: 'Direcci&oacute;n de Correo Inv&aacute;lida'
                    }
                }
            },
            nombres_trabajador: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            apellidos_trabajador: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            sexo: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            nacionalidad: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            id_cargo: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            fecha_contrato: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            tipo_contrato: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            tipo_sueldo: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            horas_semanales: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            tipo_trabajador: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            jubilado: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            paga_afp: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            prevencion_salud: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            afp: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            caja_ex_regimen: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            	regimen_provisional: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            cargas_normales: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            cargas_maternales: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            cargas_invalidez: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            cargas_invalidez: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            tramo_sueldo: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            sueldo_base: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            movilizacion: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            
            colacion: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            bono_mensual: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            bono_proporcional_dias: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
                    }
                }
            },
            bono_afecta_remuneraciones: {
                row: '.col-sm-3',
                validators: {
                    notEmpty: {
                        message: 'CAMPO OBLIGATORIO'
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
        url: "registrar_trabajador",
        method: 'POST',
        data: $form.serialize()
    }).success(function(response) {

        alertify.log("Datos Registrados con Exsito...!!"); 

        $('#formulario').formValidation('resetForm');
        $('#formulario')[0].reset();
        myFunction(1)
        reload_table();
    });
});
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
       $("#fecha_contrato").datepicker({
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