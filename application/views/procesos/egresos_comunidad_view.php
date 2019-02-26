<?php
   $variablesSesion = $this->session->userdata('usuario');
   $rol = ($variablesSesion['rol']);
   $hoy = date("d-m-Y");
   $mes = date("m");
   $anio=date("Y");
   
   ?>
<style>
   .modal-header{
   background-color:#942349 !important;
   }
   .modal-title{
   color:#ffffff;
   }
   #mdialTamanio{
   width: 60% !important;
   }
   .bg-primary {
  background-color: #fff;
}
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>application/recursos/css/estilosUI.css" />
<script type="text/javascript">
   function add(){
   var text = document.getElementById("text");
   var id_cheque = document.getElementById("id_cheque");
   
   var opt = document.createElement("option");
   
   opt.appendChild(document.createTextNode(text.value));
   opt.setAttribute("value", text.value);
   
   id_cheque.appendChild(opt);
   }
   
   function see(){
   alert(document.getElementById("id_cheque").value);
   }
</script>
<body onload="nobackbutton();">
<div id="registrar_egreso" style="display:none;">
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <h3 class="box-title">Registrar Egreso&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <?php
                  foreach($nombre_comunidad as $resultado)
                  {
                  ?>
               Comunidad:<?php echo $resultado->nombre_comunidad?>
               <?php
                  }
                  ?>
            </h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="formulario" action="<?php echo base_url() ?>egresos/registrar_egreso" method="POST" name="formulario" enctype="multipart/form-data">
                     <div class="col-sm-12"  id='resultado'></div>
                     <div class="col-sm-12"  id='resultado2'></div>
                     <input type="hidden" class="form-control" value="<?php echo $resultado->id_comunidad?>"  name="id_comunidad" >
                     <div class="form-group col-sm-6">
                        <label>Proveedor</label> &nbsp;
                        <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor">
                        <span tooltip="Administrar Proveedor">
                        <button  type="button" class="btn bg-olive btn-circle-xs" onclick="guardar2()"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <select name="id_proveedor" id="id_proveedor"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($proveedores as $i => $proveedor) {
                              echo '<option value="' . $proveedor->id_proveedor . '">' . $proveedor->proveedor . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-3">
                        <label>Monto</label> 
                        <a href="#" title="Ayuda!" data-toggle="popover" data-placement="top" data-content="Para registrar las cantidades utilice solo punto(.) para indicar las cifras decimales Ej: 123456.89">
                        <i class="fa fa-info-circle"></i>
                        </a>
                        <input type="text"  class="form-control redondeado" id="monto" onkeypress="return filterFloat(event,this);" name="monto" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="form-group col-sm-3">
                        <label>N° de Cuotas</label> 
                        <select class="form-control redondeado 1-100" name="nro_cuotas" id="nro_cuotas"  class="form-control redondeado"></select>
                     </div>
                     <div class="col-sm-12"></div>
                     <!--<div class="form-group col-sm-6">-->
                     <!--   <label>Motivo</label> -->
                     <!--   <textarea class="form-control redondeado" rows="2" id="motivo"  name="motivo" placeholder="Motivo"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>-->
                     <!--</div>-->
                     <div class="form-group col-sm-6">
                        <label>Medio de Pago</label> 
                        <select name="medio_pago" id="medio_pago" class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($medioPago as $i => $fila) {
                              echo '<option value="' . $fila->id_forma_pago . '">' . $fila->descripcion . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-3">
                        <label>N° Cheque/Documento</label>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosCheque">
                        <span tooltip="Administrar Cheques">
                        <button  type="button" onclick="guardar2()" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <select name="id_cheque" id="id_cheque"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($cheques as $i => $cheque) {
                              echo '<option value="' . $cheque->nro_cheque . '">' . $cheque->nro_cheque . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="col-sm-3">
                        <label>Agregar Documento de Pago</label>
                        <a href="#">
                        <span tooltip="Agregar N° de Pago a la Lista">
                        <button  type="button" onclick="add();" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <input type="text" id="text" class="form-control redondeado">
                     </div>
                     <div class="col-sm-12"></div>
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
                     <div class="form-group col-sm-4">
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
                     <div class="form-group col-sm-6">
                        <label>Item</label> 
                        <a href="<?php echo base_url() ?>egresos/buscarDatosItem">
                        <span tooltip="Administrar Items">
                        <button  type="button" onclick="guardar2()" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <select name="id_item" id="id_item"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($items as $i => $item) {
                              echo '<option value="' . $item->id_item . '">' . $item->item . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Descripcion Item</label> 
                        <textarea class="form-control redondeado" rows="1" id="descripcion_item"  name="descripcion_item" placeholder="Descripcion Item"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea> 
                     </div>
                     <div class="form-group col-sm-6">
                        <span class="fa fa-folder-open"></span>
                        <label>Adjuntar Archivo (Seleccione un archivo jpg,jpeg,png,gif)</label>
                        <input type='file' name='adjunto' id="adjunto" class="form-control redondeado" onchange="return fileValidation()">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <label>Forma de Cobro</label> 
                        <select  name="id_pago" id="id_pago" onChange="pagoOnChange(this)" class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($formaPago as $i => $fila) {
                              echo '<option value="' . $fila->id_pago . '">' . $fila->forma_pago . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div id="con_cobro_individual" style="display:none;">
                        <div class="form-group col-sm-3">
                        <label>Torre</label> 
                        <select name="id_torre" id="id_torre"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($torres as $i => $fila) {
                              echo '<option value="' . $fila->id_torre . '">' . $fila->nombre_torre .'</option>';
                                }
                                ?>                     
                        </select>
                        </div>
                        <div class="form-group col-sm-3">
                        <label>N° Departamento</label> 
                        <select name="nro_dpto" id="nro_dpto" readonly class="form-control redondeado" >
                             </select>
                        </div>
                     </div>
                     <div class="form-group col-sm-6" id="sin_cobro_individual" style="display:none;">
                     </div>
                     
                     
                     <div class="form-group col-sm-6">
                         
                        <select name="id_medidor" id="id_medidor" readonly class="form-control redondeado" style="display:none;" ></select>
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     
         
                  
                     <div class="col-sm-12" id='formato_incorrecto'>&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <span tooltip="Guardar...">
                        <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje(); borrar()"><i class="fa fa-save"></i></button></span>
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
<div id="egresos">
   <section class="content"  style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <a href="<?php echo base_url() ?>principal/bienvenida">
            <span tooltip="Regresar">
            <button  type="button" class="btn bg-orange btn-circle" onclick="guardar2()"><i class="glyphicon glyphicon-arrow-left"></i></button>
            </span></a>
            <h3 class="box-title">Administraci&oacute;n de Egresos</h3>
            <span tooltip="Consulta de Gastos Comunes">
            <a href="<?php echo base_url().'egresos/egresos_por_periodo/'.$resultado->id_comunidad?>">
            <button type="button"  class="btn bg-orange btn-circle" ><i class="fa fa-tag"></i></button>
            </a></span>
            <span tooltip="Agregar Informacion">
            <a href="<?php echo base_url().'informacion/index/'.$resultado->id_comunidad?>">
            <button type="button"  class="btn bg-orange btn-circle" ><i class="fa fa-comments-o"></i></button>
            </a></span>
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
                        <thead align='center'>
                           <tr class="filters">
                              <th class="text-center"  style='display:none'>Id</th>
                              <th class="text-center">Comunidad</th>
                              <th class="text-center">Proveedor</th>
                              <th class="text-center">Item</th>
                              <th class="text-center">Monto</th>
                              <th class="text-center">Cuotas</th>
                              <th class="text-center">Per&iacute;odo</th>
                              <th class="text-center">Fecha Registro</th>
                              <th class="text-center">Estatus</th>
                              <th class="text-center" WIDTH="150">Acciones</th>
                           </tr>
                        </thead>
                        <?php
                           if ($resultados != "") {
                           $contenido = "";
                           foreach ($resultados as $resultado) {
                            $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                            $contenido.="<tr> 
                              <td align='center' style='display:none'>" . "$resultado->id_egreso" . "</td>
                              <td align='center'>" .  "$resultado->nombre_comunidad" . "</td>
                              <td align='center'>" .  "$resultado->proveedor" . "</td>
                              <td align='center'>" .  "$resultado->item" . "</td>
                              <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                              <td align='center'>" .  "$resultado->nro_cuotas_pagadas".  "/". "$resultado->nro_cuotas" . "</td>
                              <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                              <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                              <td align='center'>" .  "$resultado->estatus" . "</td>
                              <td align='center'><span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_egreso' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
                     <span class='fa  fa-pencil-square-o'></span>
                             <a href='" . base_url() . "Egresos/imprimirPDF?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                             <button type='button' class='btn bg-olive btn-circle' title='Descargar Egreso'><span class='glyphicon glyphicon-print'></span></button>
                              <a href='" . base_url() . "Egresos/verAdjunto/" . "$resultado->id_egreso" . "'>
                             <button type='button' class='btn bg-olive btn-circle' title='Ver Adjunto'><span class='glyphicon glyphicon-search'></span></button>
                              <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_egreso' class='btn bg-olive btn-circle deleteButton'>
                           <span class='fa  fa-close'></span>
                           </button></span>
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
                  </div>
               </div>
               </tbody>
               </table>
               <button type="button" class="btn bg-olive">Total General de Egresos <span class="badge"><?php
                  foreach($suma as $fila)
                   $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
                  {
                  ?>
               <?php echo '$' . $nombre_format_francais?>
               <?php
                  }
                  ?></span></button>
               <?php } ?>
               <?php if ($variablesSesion['rol'] == 2) { ?>
               <table id="nueva" class="display " cellspacing="0" width="100%" >
                  <thead align='center'>
                     <tr class="filters">
                        <th class="text-center"  style='display:none'>Id</th>
                        <th class="text-center">Proveedor</th>
                        <th class="text-center">Item</th>
                        <th class="text-center">Monto</th>
                        <th class="text-center">Cuotas</th>
                        <th class="text-center">Per&iacute;odo</th>
                        <th class="text-center">Fecha Registro</th>
                        <th class="text-center">Estatus</th>
                        <th class="text-center" WIDTH="150">Acciones</th>
                     </tr>
                  </thead>
                  <?php
                     if ($resultados != "") {
                     $contenido = "";
                     foreach ($resultados as $resultado) {
                      $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                      $contenido.="<tr> 
                        <td align='center' style='display:none'>" . "$resultado->id_egreso" . "</td>
                        <td align='center'>" .  "$resultado->proveedor" . "</td>
                        <td align='center'>" .  "$resultado->item" . "</td>
                        <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                        <td align='center'>" .  "$resultado->nro_cuotas_pagadas".  "/". "$resultado->nro_cuotas" . "</td>
                        <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                        <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                        <td align='center'>" .  "$resultado->estatus" . "</td>
                             
                        <td align='center'><span tooltip='Editar' flow='left'><button type='button' data-id='$resultado->id_egreso' class='btn bg-olive btn-circle editButton' onclick='myFunction(3)'>
                     <span class='fa  fa-pencil-square-o'></span>
                       <a href='" . base_url() . "Egresos/imprimirPDF?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                       <button type='button' class='btn bg-olive btn-circle' title='Descargar Egreso'><span class='glyphicon glyphicon-print'></span></button>
                        <a href='" . base_url() . "Egresos/verAdjunto/" . "$resultado->id_egreso" . "'>
                       <button type='button' class='btn bg-olive btn-circle' title='Ver Adjunto'><span class='glyphicon glyphicon-search'></span></button></a>
                        <span tooltip='Eliminar' flow='left'><button type='button' data-id='$resultado->id_egreso' class='btn bg-olive btn-circle deleteButton'>
                     <span class='fa  fa-close'></span>
                     </button></span>
                       
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
            </div>
         </div>
         </tbody>
         </table>
         <button type="button" class="btn bg-olive">Total General de Egresos <span class="badge"><?php
            foreach($suma as $fila)
             $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
            {
            ?>
         <?php echo '$' . $nombre_format_francais?>
         <?php
            }
            ?></span></button>
         <?php } ?>
         <?php if ($variablesSesion['rol'] == 3) { ?>
         <table id="nueva" class="display " cellspacing="0" width="100%" >
            <thead align='center'>
               <tr class="filters">
                  <th class="text-center"  style='display:none'>Id</th>
                  <th class="text-center">Proveedor</th>
                  <th class="text-center">Item</th>
                  <th class="text-center">Monto</th>
                  <th class="text-center">Cuotas</th>
                  <th class="text-center">Per&iacute;odo</th>
                  <th class="text-center">Fecha Registro</th>
                  <th class="text-center">Estatus</th>
                  <th class="text-center" WIDTH="150">Acciones</th>
               </tr>
            </thead>
            <?php
               if ($resultados != "") {
               $contenido = "";
               foreach ($resultados as $resultado) {
                $nombre_format_francais = number_format($resultado->monto, 2, ',', '. ');
                $contenido.="<tr> 
                  <td align='center' style='display:none'>" . "$resultado->id_egreso" . "</td>
                  <td align='center'>" .  "$resultado->proveedor" . "</td>
                  <td align='center'>" .  "$resultado->item" . "</td>
                  <td align='center'>". "$" .  "$nombre_format_francais" . "</td>
                  <td align='center'>" .  "$resultado->nro_cuotas_pagadas".  "/". "$resultado->nro_cuotas" . "</td>
                  <td align='center'>" .  "$resultado->periodo".  "-". "$resultado->anio" . "</td>
                  <td align='center'>" .  "$resultado->fecha_registro" . "</td>
                  <td align='center'>" .  "$resultado->estatus" . "</td>
                  <td align='center'>
                 <a href='" . base_url() . "Egresos/imprimirPDF?id_egreso=" . "&id_egreso=" . "$resultado->id_egreso" . "'>
                 <button type='button' class='btn bg-olive btn-circle' title='Descargar Egreso'><span class='glyphicon glyphicon-print'></span></button>
                  <a href='" . base_url() . "Egresos/verAdjunto/" . "$resultado->id_egreso" . "'>
                 <button type='button' class='btn bg-olive btn-circle' title='Ver Adjunto'><span class='glyphicon glyphicon-search'></span></button>
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
      </div>
</div>
</tbody>
</table>
<button type="button" class="btn bg-olive">Total General de Egresos <span class="badge"><?php
   foreach($suma as $fila)
    $nombre_format_francais = number_format($fila->monto, 2, ',', '. ');
   {
   ?>
<?php echo '$' . $nombre_format_francais?>
<?php
   }
   ?></span></button>
<?php } ?>
<div class="col-sm-12">&nbsp;</div>
</div>

</section>


<?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
<a class='flotante'><span tooltip="Agregar Egreso">
   <button type="submit" class="btn bg-olive btn-circle btn-lg" onclick="myFunction(2)">
      <i class="glyphicon glyphicon-plus"></i></span>
   </button>
</a>
<?php } ?>
</div>


<?php if (($variablesSesion['rol'] == 1) || ($variablesSesion['rol'] == 2)){ ?>
<div id="editar_egreso" style="display:none;">
   <section class="content"   style="width: 95%; align-content: center">
      <div class="box box-success" id="section">
         <div class="box-header with-border">
            <span tooltip="Regresar">
                              <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="glyphicon glyphicon-arrow-left"></i></button>
                              </span>
            <h3 class="box-title">Editar Egreso &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
               <?php
                  foreach($nombre_comunidad as $resultado)
                  {
                  ?>
               Comunidad:<?php echo $resultado->nombre_comunidad?>
               <?php
                  }
                  ?>
            </h3>
            <div class="box-tools pull-right">
               <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i></button>
               <!--                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>-->
            </div>
         </div>
         <div class="box-body">
            <div class="row">
               <div class="col-md-12">
                  <form id="userForm" action="<?php echo base_url() ?>egresos/registrar_egreso" method="POST" name="formulario" enctype="multipart/form-data">
                     <div class="col-sm-12"  id='resultado'></div>
                     <div class="col-sm-12"  id='resultado2'></div>
                     <input type="hidden" class="form-control redondeado" value="" name="nro_documento" id="nro_documento" readonly>
                     <input type="hidden" class="form-control redondeado" value="" name="motivo" id="motivo" readonly>
                     <input type="hidden" class="form-control" value="<?php echo $resultado->id_comunidad?>"  name="id_comunidad" >
                     <input type="hidden" class="form-control"  name="id" id="id">
                     <div class="form-group col-sm-6">
                        <label>Proveedor</label> &nbsp;
                        <a href="<?php echo base_url() ?>egresos/buscarDatosProveedor">
                        <span tooltip="Administrar Proveedor">
                        <button  type="button" class="btn bg-olive btn-circle-xs" onclick="guardar2()"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <select name="id_proveedor_modal" id="id_proveedor_modal"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($proveedores as $i => $proveedor) {
                              echo '<option value="' . $proveedor->id_proveedor . '">' . $proveedor->proveedor . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-3">
                        <label>Monto</label> 
                        <a href="#" title="Ayuda!" data-toggle="popover" data-placement="top" data-content="Para registrar las cantidades utilice solo punto(.) para indicar las cifras decimales Ej: 123456.89">
                        <i class="fa fa-info-circle"></i>
                        </a>
                        <input type="text" class="form-control redondeado" id="monto_modal" onkeypress="return filterFloat(event,this);" name="monto_modal" placeholder="Monto" onkeyup="javascript:this.value = this.value.toUpperCase()">
                     </div>
                     <div class="form-group col-sm-3">
                        <label>N° de Cuotas</label> 
                        <select class="form-control redondeado 1-100" name="nro_cuotas_modal" id="nro_cuotas_modal"  class="form-control redondeado"></select>
                     </div>
                     <div class="col-sm-12"></div>
                     <!--<div class="form-group col-sm-6">-->
                     <!--   <label>Motivo</label> -->
                     <!--   <textarea class="form-control redondeado" rows="2" id="motivo"  name="motivo" placeholder="Motivo"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea>-->
                     <!--</div>-->
                     <div class="form-group col-sm-6">
                        <label>Medio de Pago</label> 
                        <select name="medio_pago_modal" id="medio_pago_modal" class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($medioPago as $i => $fila) {
                              echo '<option value="' . $fila->id_forma_pago . '">' . $fila->descripcion . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-3">
                        <label>N° Cheque/Documento</label>
                        <a href="<?php echo base_url() ?>egresos/buscarDatosCheque">
                        <span tooltip="Administrar Cheques">
                        <button  type="button" onclick="guardar2()" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <select name="id_cheque_modal" id="id_cheque_modal"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($cheques as $i => $cheque) {
                              echo '<option value="' . $cheque->nro_cheque . '">' . $cheque->nro_cheque . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="col-sm-3">
                        <label>Agregar Documento de Pago</label>
                        <a href="#">
                        <span tooltip="Agregar N° de Pago a la Lista">
                        <button  type="button" onclick="add();" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>
                        </span></a>
                        <input type="text" id="text" class="form-control redondeado">
                     </div>
                     <div class="col-sm-12"></div>
                     <div class="form-group col-sm-3">
                        <label>Per&iacute;odo</label> 
                        <select name="periodo_modal" id="periodo_modal"  class="form-control redondeado">
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
                        <select name="anio_modal" id="anio_modal"  class="form-control redondeado">
                           <option value="">Selecione...</option>
                           <?php
                              for ($anio = (date("Y")); 2016 <= $anio; $anio--) {
                                  echo "<option value='$anio'>" . $anio . "</option>";
                              }
                              ?>
                        </select>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Item</label> 
                        <!--<a href="<?php echo base_url() ?>egresos/buscarDatosItem">-->
                        <!--<span tooltip="Administrar Items">-->
                        <!--<button  type="button" onclick="guardar2()" class="btn bg-olive btn-circle-xs"><i class="fa fa-plus"></i></button>-->
                        <!--</span></a>-->
                        <select name="id_item_modal" id="id_item_modal"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($items as $i => $item) {
                              echo '<option value="' . $item->id_item . '">' . $item->item . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Descripcion Item</label> 
                        <textarea class="form-control redondeado" rows="1" id="descripcion_item_modal"  name="descripcion_item_modal" placeholder="Descripcion Item"  onkeyup="javascript:this.value = this.value.toUpperCase()"></textarea> 
                     </div>
                     <div class="form-group col-sm-6">
                        <label>Forma de Cobro</label> 
                        <select  name="id_pago_modal" id="id_pago_modal" onChange="pagoOnChange(this)" class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($formaPago as $i => $fila) {
                              echo '<option value="' . $fila->id_pago . '">' . $fila->forma_pago . '</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-6" id="con_cobro_individual" style="display:none;">
                        <label>N° Departamento</label> 
                        <select name="id_copropietario_modal" id="id_copropietario_modal"  class="form-control redondeado" >
                           <option value="">Selecione...</option>
                           <?php
                              foreach ($departamentos as $i => $fila) {
                              echo '<option value="' . $fila->id_copropietario . '">' . $fila->nro_dpto .' '. $fila->nombres.' '. $fila->apellidos .'</option>';
                                }
                                ?>                     
                        </select>
                     </div>
                     <div class="form-group col-sm-6" id="sin_cobro_individual" style="display:none;">
                     </div>
                     <div class="col-sm-12">&nbsp;</div>
                     <div class="form-group col-sm-6">
                        <span tooltip="Guardar...">
                        <button type="submit" class="btn bg-olive btn-circle" onclick="mensaje(); borrar()"><i class="fa fa-save"></i></button></span>
                        <span tooltip="Cancelar">
                        <button type="button"  class="btn bg-orange btn-circle" onclick="myFunction(1)"><i class="fa fa-close"></i></button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
   <?php } ?>
   
</div>

</body>


<script>

       $(document).on("change", '#id_proveedor', function ()
       {
           $("#id_medidor").load("<?php echo base_url() . 'index.php/egresos/obtener_medidor?id_proveedor='; ?>" + $(this).val());
       });
   
       
</script>



<script>
   //=================== Script para mostrar municipios y parroquias ==================//
       $(document).on("change", '#id_torre', function ()
       {
           $("#nro_dpto").load("<?php echo base_url() . 'index.php/medidores/obtener_dpto?id_torre='; ?>" + $(this).val());
           $("#torre").load("<?php echo base_url() . 'index.php/medidores/obtener_torre?id_torre='; ?>" + $(this).val());
       });

</script> 


<script>
   $(function(){
    var $select = $(".1-100");
    for (i=0;i<=100;i++){
        $select.append($('<option></option>').val(i).html(i))
    }
   });
</script>
<script type="text/javascript">
   function pagoOnChange(sel) {
       if (sel.value == "3") {
           $("#con_cobro_individual").show();
           $("#sin_cobro_individual").hide();
   
       } else {
   
           $("#sin_cobro_individual").show();
           $("#con_cobro_individual").hide();
   
       }
   }
</script>
<script type="text/javascript">
   $(document).ready(function() {
   $('.deleteButton').on('click', function() {
       var id = $(this).attr('data-id');
       $.ajax({
           url: "<?php echo base_url() . 'index.php/Egresos/eliminar_egreso/'; ?>" + id,
           method: 'POST'
   
       }).success(function(response) {
            alertify.log("Egreso Eliminado...!!!"); 
            $('#formulario')[0].reset();
               myFunction(1)
               location.reload();
               
           });
       });
   });
</script>
<script>
   function mensaje(){
   	 alertify.log("Egreso Registrado...!!"); 
   }
    
</script>
<script>
   function myFunction(idButton) {
      var egresos = document.getElementById('egresos');
      var registrar_egreso = document.getElementById('registrar_egreso');
      var editar_egreso = document.getElementById('editar_egreso');
   
      switch(idButton) {
       case 1:
       egresos.style.display = 'block';
       registrar_egreso.style.display = 'none';
       editar_egreso.style.display = 'none';
       break;
   
       case 2:
       egresos.style.display = 'none';
       registrar_egreso.style.display = 'block';
       editar_egreso.style.display = 'none';
       break;
       
       case 3:
       egresos.style.display = 'none';
       registrar_egreso.style.display = 'none';
       editar_egreso.style.display = 'block';
       break;
   
       default:
       alert("hay un problema: No existe la ruta")
   }
   
   }
</script>
<script>
   function fileValidation(){
       var fileInput = document.getElementById('adjunto');
       var filePath = fileInput.value;
       var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
       if(!allowedExtensions.exec(filePath)){
           
           $("#formato_incorrecto").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Formato de Imagen Incorrecto (Seleccione un archivo jpg,jpeg,png,gif)....xxx!!!.</div>");
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
   function guardar2(){
       var nro_documento = document.getElementById('nro_documento').value;
       var id_proveedor = document.getElementById('id_proveedor').value;
       var monto = document.getElementById('monto').value;
       var motivo = document.getElementById('motivo').value;
       var id_cheque = document.getElementById('id_cheque').value;
       var medio_pago = document.getElementById('medio_pago').value;
       var periodo = document.getElementById('periodo').value;
       var anio = document.getElementById('anio').value;
        
       localStorage.setItem('nro_documento',nro_documento);
       localStorage.setItem('id_proveedor',id_proveedor);
       localStorage.setItem('monto',monto);
       localStorage.setItem('motivo',motivo);
       localStorage.setItem('id_cheque',id_cheque);
       localStorage.setItem('medio_pago',medio_pago);
       localStorage.setItem('periodo',periodo);
       localStorage.setItem('anio',anio);
   }
   
   $(document).ready( function() 
   {
     var nro_documento = localStorage.getItem('nro_documento');
     var id_proveedor = localStorage.getItem('id_proveedor');
     var monto = localStorage.getItem('monto');
     var motivo = localStorage.getItem('motivo');
     var id_cheque = localStorage.getItem('id_cheque');
     var medio_pago = localStorage.getItem('medio_pago');
     var periodo = localStorage.getItem('periodo');
     var anio = localStorage.getItem('anio');
     
     document.getElementById('nro_documento').value=nro_documento;
     document.getElementById('id_proveedor').value=id_proveedor;
     document.getElementById('monto').value=monto;
     document.getElementById('motivo').value=motivo;
     document.getElementById('id_cheque').value=id_cheque;
     document.getElementById('medio_pago').value=medio_pago;
     document.getElementById('periodo').value=periodo;
     document.getElementById('anio').value=anio;
   } );
   
   function borrar(){
   if (localStorage)  {
     localStorage.removeItem("nro_documento");
     localStorage.removeItem("id_proveedor");
     localStorage.removeItem("monto");
     localStorage.removeItem("motivo");
     localStorage.removeItem("id_cheque");
     localStorage.removeItem("medio_pago");
     localStorage.removeItem("periodo");
     localStorage.removeItem("anio");
     }
       
   }
</script>
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
     $("#hide").click(function(){
       $("#element").hide();
     });
     $("#show").click(function(){
       $("#element").show();
     });
   });
</script>
<script>
   function number_format(number, decimals, dec_point, thousands_sep) {
    var n = !isFinite(+number) ? 0 : +number, 
        prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
        sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
        dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
        s = '',
        toFixedFix = function (n, prec) {
            var k = Math.pow(10, prec);
            return '' + Math.round(n * k) / k;
        };
    // Fix for IE parseFloat(0.55).toFixed(0) = 0;
    s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
    if (s[0].length > 3) {
        s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
    }
    if ((s[1] || '').length < prec) {
        s[1] = s[1] || '';
        s[1] += new Array(prec - s[1].length + 1).join('0');
    }
    return s.join(dec);
   }
   
   //number_format(67000, 2, ',', '.');devuelve 67.000,00000
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#userForm')
               .formValidation({
                   framework: 'bootstrap',
                    excluded: ':disabled',
                   fields: {
                       id_proveedor_modal: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          
                       monto_modal: {
                           row: '.col-sm-3',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                           nro_cuotas_modal: {
                           row: '.col-sm-3',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          
                       id_cheque_modal: {
                           row: '.col-sm-3',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          medio_pago_modal: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          periodo_modal: {
                           row: '.col-sm-3',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          anio_modal: {
                           row: '.col-sm-3',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          id_item_modal: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          id_pago_modal: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                          descripcion_item_modal: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                       rol: {
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
                       url: "<?php echo base_url() . 'egresos/actualizar_egreso'; ?>",
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
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'egresos/consultarId/'; ?>" + id,
               method: 'GET'
   
           }).success(function (data) {
   
               var obj = JSON.parse(data);
               $('#userForm')
                       .find('[name="id"]').val(obj.id_egreso).end()
                       .find('[name="id_comunidad_modal"]').val(obj.id_comunidad).end()
                       
                       .find('[name="id_proveedor_modal"]').val(obj.id_proveedor).end()
                       .find('[name="proveedor_modal"]').val(obj.proveedor).end()
                       
                       .find('[name="monto_modal"]').val(obj.monto).end()
                       .find('[name="motivo_modal"]').val(obj.motivo).end()
                       .find('[name="id_cheque_modal"]').val(obj.id_cheque).end()
                       .find('[name="medio_pago_modal"]').val(obj.medio_pago).end()
                       .find('[name="forma_pago_modal"]').val(obj.forma_pago).end()
                       .find('[name="periodo_modal"]').val(obj.periodo).end()
                       .find('[name="anio_modal"]').val(obj.anio).end()
                       .find('[name="estatus_modal"]').val(obj.estatus1).end()
                       .find('[name="descripcion_item_modal"]').val(obj.descripcion_item).end()
                       .find('[name="item_modal"]').val(obj.item).end()
                       .find('[name="descripcion_modal"]').val(obj.descripcion).end()
                       .find('[name="nro_cuotas_modal"]').val(obj.nro_cuotas).end()
                       .find('[name="id_pago_modal"]').val(obj.id_pago).end()
                       .find('[name="id_item_modal"]').val(obj.id_item).end();
                
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
                   //.order( [[ 1, 'asc' ], [ 1, 'asc' ]] )
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
   $(document).ready(function () {
       $('#userForm2')
               .formValidation({
                   framework: 'bootstrap',
                    excluded: ':disabled',
                   fields: {
                       id_item2: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
   
                          id_descripcion_item2: {
                           row: '.col-sm-6',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
   
                       rol: {
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
                       url: "<?php echo base_url() . 'egresos/actualizar_egreso2'; ?>",
                       method: 'POST',
                       data: $form.serialize()
                   }).success(function (response) {
   
                       $form.parents('.bootbox').modal('hide');
                       $.confirm({
                           title: 'Suceso!',
                           content: 'Egreso Actualizado',
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
       $('.editButton2').on('click', function () {
           // Get the record's ID via attribute
           var id = $(this).attr('data-id');
           $.ajax({
               url: "<?php echo base_url() . 'egresos/consultarId2/'; ?>" + id,
               method: 'GET'
   
           }).success(function (data) {
               // Populate the form fields with the data returned from server
   
               var obj = JSON.parse(data);
               $('#userForm2')
                       .find('[name="id"]').val(obj.id_egreso).end()
                       .find('[name="id_item"]').val(obj.id_item).end()
                       .find('[name="item"]').val(obj.item).end()
                       .find('[name="id_descripcion_item"]').val(obj.id_descripcion_item).end()
                       .find('[name="descripcion_item"]').val(obj.descripcion_item).end();
               // Show the dialog
               bootbox
                       .dialog({
                           title: 'Informacion Actual del Item',
                           message: $('#userForm2'),
                           show: false // We will show it manually later
                       })
                       .on('shown.bs.modal', function () {
                           $('#userForm2')
                                   .show()                             // Show the login form
                                   .formValidation('resetForm2'); // Reset form
                       })
                       .on('hide.bs.modal', function (e) {
                           $('#userForm2').hide().appendTo('body');
                       })
                       .modal('show');
           });
       });
   });
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
<!--============= script para registar usuarios ============================================== -->
<script>
   $(document).ready(function () {
       $('#formulario').formValidation({
           framework: 'bootstrap',
           excluded: ':disabled',
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
                 nro_documento: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_proveedor: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               monto: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               nro_cuotas: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               
               motivo: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_cheque: {
                   row: '.col-sm-3',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_pago: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               medio_pago: {
                   row: '.col-sm-6',
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
                   row: '.col-sm-4',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               id_item: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
                 descripcion_item: {
                   row: '.col-sm-6',
                   validators: {
                       notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                       }
                   }
               },
               adjunto: {
                   row: '.col-sm-6',
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
               "id_comunidad": $("#id_comunidad").val(),
               "id_proveedor": $("#id_proveedor").val(),
               "monto": $("#monto").val(),
               "motivo": $("#motivo").val(),
               "id_cheque": $("#id_cheque").val(),
               "medio_pago": $("#medio_pago").val(),
               "periodo": $("#periodo").val(),
               "anio": $("#anio").val(),
               "id_item": $("#id_item").val(),
               "descripcion_item": $("#descripcion_item").val(),
               "adjunto": $("#adjunto").val(),
               "nro_documento": $("#nro_documento").val()
               
           };
   
           //validamos que no quede ningun campo vacio
           if (dataEgreso.id_comunidad === '' ||dataEgreso.id_proveedor === '' || dataEgreso.monto === '' || dataEgreso.motivo === '' || dataEgreso.nro_cheque === '' ||
               dataEgreso.medio_pago === '' || dataEgreso.periodo === '' || dataEgreso.anio === ''|| dataEgreso.id_item === ''|| dataEgreso.id_descripcion_item === ''
               || dataEgreso.adjunto === ''|| dataEgreso.nro_documento === '') {
   
               // mensaje en caso de que exista un campo vacio del formulario
               $("#resultado").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
               //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
           } else {
               $.ajax({
                   url: "<?php echo base_url() . 'Egresos/registrar_egreso'; ?>",
                   type: "POST",
                   data: dataEgreso,
                   beforeSend: function() {
                       $("#resultado").show();
                       $("#resultado").html('<div><?php echo '<img width="2%" src="' . base_url() . 'application/recursos/imagenes/ajax-loader_1.gif">'; ?></div>');
                   },
                   //Despues de enviar los datos limpiamos los campos del formulario
                   success: function(respuesta) {
                       // Enviamos un mensaje de exito al insertar los datos
                       $("#id_comunidad").val(''),
                       $("#id_proveedor").val(''),
                       $("#monto").val(''),
                       $("#motivo").val(''),
                       $("#id_cheque").val(''),
                       $("#medio_pago").val(''),
                       $("#periodo").val(''),
                       $("#anio").val(''),
                       $("#id_item").val(''),
                       $("#id_descripcion_item").val(''),
                       $("#adjunto").val(''),
                       $("#nro_documento").val(''),
                       $("#resultado").html("<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-check'></i> Suceso..!Los Datos Fueron registrados Exitosamente</div>");
                       //Redirijimos luego de enviar los datos 
                      setInterval(function() {
                         // location.reload();
                          window.location.href = $("#F").val();
                      }, 3000); //Lo temporizamos a 3 segundos para mostrar el mensaje al usuario
                   }
               });
           }
       });
   });
</script>
<script>
   $(document).ready(function(){
       $('[data-toggle="popover"]').popover();   
   });
</script>
<script>
   $(document).on("change", '#nro_documentos', function ()
   {
       $.ajax({
           url: "<?php echo base_url() . 'index.php/egresos/consultar_existe_documento'; ?>",
           data: {nro_documento: $('#nro_documento').val()},
           dataType: 'html',
           type: 'post',
           success: function (respuesta) {
   
               if (respuesta == 1)
               {
                    $("#nro_documento").val('');
                  alertify.error("El documento Ya Existe...!!!");
             
               }
           }
       });
   });
</script>
<script>
   //=================== Script para obtener descripcion del item ==================//
       $(document).on("change", '#id_item', function ()
       {
           $("#id_descripcion_item").load("<?php echo base_url() . 'Egresos/buscarDescripcion_Item?id_item='; ?>" + $(this).val());
       });
   
       
</script> 
<script>
   //=================== Script para obtener descripcion del item ==================//
       $(document).on("change", '#id_item2', function ()
       {
           $("#id_descripcion_item2").load("<?php echo base_url() . 'Egresos/buscarDescripcion_Item?id_item='; ?>" + $(this).val());
       });
   
       
</script> 
<script src="<?php echo base_url(); ?>application/recursos/js/bootbox.js"></script>
<script>
   $(document).on("click", '#buscar2', function (){
       var dataEgreso = {
               "id_comunidad": $("#id_comunidad").val(),
               "periodo": $("#periodo").val(),
               "anio": $("#anio").val()
           };
           
           if (dataEgreso.id_comunidad === '' || dataEgreso.periodo === '' || dataEgreso.anio === '') {
               // mensaje en caso de que exista un campo vacio del formulario
               $("#resultado3").html("<div class='alert alert-warning alert-dismissable'><button type='button' class='close' data-dismiss='alert'>&times;</button><i class='icon fa fa-warning'></i> Alerta...! Informacion Incompleta, debe llenar todos los campos....</div>");
               //En caso contrario que no hayan campos vacios enviamos los parametros por ajax
           }else{
       
        $.ajax({
           url: "<?php echo base_url() . 'index.php/egresos/detalles_egresos_por_periodo'; ?>",
           data: {id_comunidad: $('#id_comunidad').val(),periodo: $('#periodo').val(),anio: $('#anio').val()},
           dataType: 'html',
           type: 'post',
           success: function (salida) {
               //alert(salida); 
               //var datos = salida.split("~");
               //alert(datos[0]);
               $("#resultado3").html(salida);
               
           }
       });
     }
   });
   
</script>
<script type="text/javascript">
   $(document).ready(function () {
       $('#formulario')
               .formValidation({
                   framework: 'bootstrap',
                   fields: {
                       periodo: {
                           row: '.col-sm-2',
                           validators: {
                           notEmpty: {
                           message: 'CAMPO OBLIGATORIO'
                                 }
                              }
                          },
                           id_comunidad: {
                           row: '.col-sm-4',
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
               })
               
       
   });
   
</script>

<script>
   function nobackbutton(){
   window.location.hash=".";
   window.location.hash="." //chrome
   window.onhashchange=function(){window.location.hash="";}
   
   }
</script>