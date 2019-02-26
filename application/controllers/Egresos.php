<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Egresos extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pgsql');
        $this->load->library('parser');
        $this->load->model('Events_model');
        $this->load->model('Egresos_model');
        $this->load->model('Informacion_model');
    }
    
    //================== FUNCION QUE CONSULTA TODOS LOS EGRESOS Y LOS MUESTRA EN LA TABLA =============
    public function buscarDatos()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $rol             = ($variablesSesion['rol']);
        
        if ($rol == 1) {
            
            $datos_egreso                        = $this->Egresos_model->egresos_todos();
            $estatus_egreso['estatus']           = $this->Egresos_model->estatus_egreso();
            //print_r($datos_egreso);
            $data_proveedores['proveedores']     = $this->Egresos_model->get_proveedores();
            $data_comunidades['comunidades']     = $this->Egresos_model->get_comunidades();
            $data_item['items']                  = $this->Egresos_model->get_item();
            $data_item_descripcion['desc_items'] = $this->Egresos_model->get_descripcion_item_id();
            $datos_cheque['cheques']             = $this->Egresos_model->get_cheques();
            $datos_cheque2['cheques2']           = $this->Egresos_model->get_cheques2();
            $suma_egreso['suma']                 = $this->Egresos_model->get_suma_egresos();
            $vars['resultados']                  = $datos_egreso;
            //print_r($suma_egreso);
            
            $this->load->view('plantillas/administracion/header');
            $this->load->view('plantillas/menu');
            $this->load->view('procesos/egresos_view', $vars + $data_proveedores + $datos_cheque + $data_item + $datos_cheque2 + $data_item_descripcion + $suma_egreso + $data_comunidades + $estatus_egreso);
            $this->load->view('plantillas/footer');
            
        } else {
            
            $datos_egreso                        = $this->Egresos_model->egresos_todos();
            $estatus_egreso['estatus']           = $this->Egresos_model->estatus_egreso();
            print_r($datos_egreso);
            $data_proveedores['proveedores']     = $this->Egresos_model->get_proveedores();
            $data_comunidades['comunidades']     = $this->Egresos_model->get_comunidades();
            $data_item['items']                  = $this->Egresos_model->get_item();
            $data_item_descripcion['desc_items'] = $this->Egresos_model->get_descripcion_item_id();
            $datos_cheque['cheques']             = $this->Egresos_model->get_cheques();
            $datos_cheque2['cheques2']           = $this->Egresos_model->get_cheques2();
            $suma_egreso['suma']                 = $this->Egresos_model->get_suma_egresos();
            $vars['resultados']                  = $datos_egreso;
            //print_r($suma_egreso);
            
            $this->load->view('plantillas/administracion/header');
            $this->load->view('plantillas/menu');
            $this->load->view('procesos/egresos_view', $vars + $data_proveedores + $datos_cheque + $data_item + $datos_cheque2 + $data_item_descripcion + $suma_egreso + $data_comunidades + $estatus_egreso);
            $this->load->view('plantillas/footer');
        }
    }
    
    //============== FUNCION QUE MUESTRA LOS DETALLES DEL EGRESO====================     
    public function verDetalle()
    {
        
        $id_egreso         = $this->input->get('id_egreso');
        $datos_egreso      = $this->Egresos_model->egresos_id($id_egreso);
        $vars['resultado'] = $datos_egreso;
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/destalles_egreso_view', $vars);
        $this->load->view('plantillas/footer');
    }
    //================== FUNCION QUE CONSULTA TODOS LOS ITEMS Y LOS MUESTRA EN LA TABLA =============
    public function MostrarDetallesEgreso()
    {
        $arrayData = array();
        extract($_GET);
        $arrayData                       = $id_egreso;
        $data_proveedores['proveedores'] = $this->Egresos_model->get_proveedores();
        $datos_cheque2['cheques2']       = $this->Egresos_model->get_cheques2();
        $data_item['items']              = $this->Egresos_model->get_item();
        $datos_egreso                    = $this->Egresos_model->egresos_detalles($id_egreso);
        $vars['resultado']               = $datos_egreso;
        //print_r($vars);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/egresosDetalle_view', $vars + $data_proveedores + $datos_cheque2 + $data_item);
        $this->load->view('plantillas/footer');
    }
    //====== FUNCION PARA REGISTRAR EGRESOS =================
    public function registrar_egreso()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario      = ($variablesSesion['id_usuario']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);
        
        $id_pago = $this->input->post('id_pago');
        if ($id_pago == 3) {
        
        $arrayData = array(
            'id_comunidad' => $id_comunidad,
            'id_proveedor' => $id_proveedor,
            'monto' => $monto,
            'nro_cuotas' => $nro_cuotas,
            'medio_pago' => $medio_pago,
            'id_cheque' => $id_cheque,
            'periodo' => $periodo,
            'anio' => $anio,
            'id_item' => $id_item,
            'descripcion_item' => $descripcion_item,
            'id_pago' => $id_pago,
            'nro_dpto' => $nro_dpto,
            'id_torre' => $id_torre,
            'fecha_registro' => $fecha_registro,
            'id_usuario' => $id_usuario,
            'adjunto' => $adjunto,
            'id_medidor' => $id_medidor
        );
        
        $this->Egresos_model->registar_Egreso($arrayData);
        $this->Egresos_model->actualizar_estatus_cheque($id_cheque);
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissable fade in">
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Suceso! </strong>Datos Registrados con Exito</div>');
        redirect('Principal/consultar_egresos_comunidad', 'refresh');
            
        }else{
          $arrayData = array(
            'id_comunidad' => $id_comunidad,
            'id_proveedor' => $id_proveedor,
            'monto' => $monto,
            'nro_cuotas' => $nro_cuotas,
            'medio_pago' => $medio_pago,
            'id_cheque' => $id_cheque,
            'periodo' => $periodo,
            'anio' => $anio,
            'id_item' => $id_item,
            'descripcion_item' => $descripcion_item,
            'id_pago' => $id_pago,
            //'nro_dpto' => $nro_dpto,
            'id_torre' => $id_torre,
            'fecha_registro' => $fecha_registro,
            'id_usuario' => $id_usuario,
            'adjunto' => $adjunto,
            'id_medidor' => $id_medidor
        ); 
        
         $this->Egresos_model->registar_Egreso2($arrayData);
        $this->Egresos_model->actualizar_estatus_cheque($id_cheque);
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissable fade in">
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Suceso! </strong>Datos Registrados con Exito</div>');
        redirect('Principal/consultar_egresos_comunidad', 'refresh');
        }

        
    }
    //====== FUNCION PARA CONSULTAR ID DE TABLA EGRESOS Y MOSTRAR EN LA VENTANA MODAL =================  
    public function consultarId($id)
    {
        $datos = $this->Egresos_model->get_id($id);
        echo json_encode($datos);
    }

    //=========================== FUNCION PARA ACTUALIZAR EGRESO =================================================       
    public function actualizar_egreso()
    {
        
        extract($_POST);
        $this->Egresos_model->modificar_egreso($id, $id_proveedor_modal, $monto_modal, $id_cheque_modal, $medio_pago_modal, $periodo_modal, $anio_modal, $id_item_modal, $descripcion_item_modal,$id_pago_modal);
    }
    
    
    //================== FUNCION QUE CONSULTA TODOS LOS PROVEEDORES Y LOS MUESTRA EN LA TABLA =============
    public function buscarDatosProveedor()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData                  = array();
        
        if ($rol == 1) {
        $data_proveedores           = $this->Egresos_model->proveedores_todosT();
        $consultar_max_id_proveedor = $this->Egresos_model->max_id_proveedorT();
        $vars['resultados']         = $data_proveedores;
        }else{
        $data_proveedores           = $this->Egresos_model->proveedores_todos($id_comunidad);
        $consultar_max_id_proveedor = $this->Egresos_model->max_id_proveedor($id_comunidad);
        $vars['resultados']         = $data_proveedores;    
        }
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/proveedor_view', $vars);
        $this->load->view('plantillas/footer');
    }
    
    //====== FUNCION PARA REGISTRAR NUEVOS PROVEEDORES =================
    public function registrar_proveedor()
    {
        
        extract($_POST);
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario      = ($variablesSesion['id_usuario']);
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy              = date("d-m-Y");
        $fecha_registro   = substr($hoy, 0, 10);
        $letra_codigo     = 'P-';
        $max_id_proveedor = $this->Egresos_model->max_id_proveedor($id_comunidad);
        $max              = $max_id_proveedor[0]->max_id_proveedor;
        
        $arrayData = array(
            'cod_proveedor' => $letra_codigo . ($max + 1),
            'proveedor'     => $proveedor,
            'fecha_registro'=> $fecha_registro,
            'usuario'       => $id_usuario,
            'id_comunidad'  => $id_comunidad,
            'rut_dni'       => $rut_dni
        );
        $this->Egresos_model->registar_Proveedor($arrayData);
        
    }
    //====== FUNCION PARA CONSULTAR ID DE TABLA PROVEEDORES Y MOSTRAR EN LA VENTANA MODAL =================  
    public function consultarProveedorId($id)
    {
        $datos = $this->Egresos_model->get_idP($id);
        echo json_encode($datos);
    }
    //=========================== FUNCION PARA ACTUALIZAR PROVEEDORES =================================================       
    public function actualizar_proveedor()
    {
        extract($_POST);
        $this->Egresos_model->modificar_proveedor($id, $proveedor, $estatus, $rut_dni);
    }
    
    //================== FUNCION QUE CONSULTA TODOS LAS COMUNIDADES Y LOS MUESTRA EN LA TABLA =============
    public function buscarDatosComunidad()
    {
        
        $arrayData                  = array();
        $data_comunidad             = $this->Egresos_model->comunidades_todas();
        $data_torres['torres']                = $this->Egresos_model->torres_todas();
        $consultar_max_id_comunidad = $this->Egresos_model->max_id_comunidad();
        $vars['resultados']         = $data_comunidad;
        //print_r($vars);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/comunidad_view', $vars + $data_torres);
        $this->load->view('plantillas/footer');
    }
    
    public function buscarDatosTorres()
    {
        
        $arrayData             = array();
        $data_torres['torres'] = $this->Egresos_model->torres_todas();

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/comunidad_torres_view',  $data_torres);
        $this->load->view('plantillas/footer');
    }
    
    //====== FUNCION PARA REGISTRAR NUEVAS COMUNIDADES =================
    public function registrar_comunidad()
    {
        
        extract($_POST);
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario      = ($variablesSesion['id_usuario']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);
        
        
        $arrayData = array(
            'nombre_comunidad' => $nombre_comunidad,
            'direccion' => $direccion,
            'rut' => $rut,
            'telefono' => $telefono,
            'fecha_registro' => $fecha_registro,
            'id_usuario' => $id_usuario
        );
        $this->Egresos_model->registar_Comunidad($arrayData);
        
    }
     //====== FUNCION PARA REGISTRAR NUEVAS COMUNIDADES =================
    public function registrar_torre()
    {
        
        extract($_POST);

        $arrayData = array(
            'nombre_torre' => $nombre_torre,
            'id'           => $id
        );
        $this->Egresos_model->registar_torre($arrayData);
        
    }
    //========== FUNCION QUE CONSULTA SI YA EXISTE UNA COMUNIDAD REGISTRADA ===============   
    public function consultar_existe_comunidad()
    {
        
        $nombre_comunidad = $_POST['nombre_comunidad'];
        if ($nombre_comunidad == "") {
            exit();
        }
        $consultar_comunidad = $this->Egresos_model->existe_comunidad($nombre_comunidad);
        if ($consultar_comunidad[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN RUT DE  UNA COMUNIDAD REGISTRADA ===============   
    public function consultar_existe_rut()
    {
        
        $rut = $_POST['rut'];
        if ($rut == "") {
            exit();
        }
        $consultar_rut = $this->Egresos_model->existe_rut($rut);
        if ($consultar_rut[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //====== FUNCION PARA CONSULTAR ID DE TABLA COMUNIDADES Y MOSTRAR EN LA VENTANA MODAL =================  
    public function consultarComunidadId($id)
    {
        $datos = $this->Egresos_model->get_idCom($id);
        
        echo json_encode($datos);
    }
     public function consultarTorreId($id)
    {
        $datos = $this->Egresos_model->get_idTorr($id);
        
        echo json_encode($datos);
    }
    //=========================== FUNCION PARA ACTUALIZAR PROVEEDORES =================================================       
    public function actualizar_comunidad()
    {
        
        extract($_POST);
        
        $this->Egresos_model->modificar_comunidad($id, $nombre_comunidad, $direccion, $estatus, $rut, $telefono);
    }
     public function actualizar_torre()
    {
        
        extract($_POST);
        //print_r($_POST); exit;
        
        $this->Egresos_model->modificar_torre($id, $nombre_torre);
        redirect('egresos/buscarDatosComunidad', 'refresh');
    }
    public function actualizar_torre2()
    {
        
        extract($_POST);
        //print_r($_POST); exit;
        
        $this->Egresos_model->modificar_torre($id, $nombre_torre);
        redirect('egresos/buscarDatosTorres', 'refresh');
    }
    //================== FUNCION QUE CONSULTA TODOS LOS CHEQUES Y LOS MUESTRA EN LA TABLA =============
    public function buscarDatosCheque()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        if ($rol == 1) {
        $arrayData          = array();
        $datos_cheque       = $this->Egresos_model->cheques_todosT();
        $vars['resultados'] = $datos_cheque;
        }else{
        $arrayData          = array();
        $datos_cheque       = $this->Egresos_model->cheques_todos($id_comunidad);
        $vars['resultados'] = $datos_cheque;   
        }
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/cheque_view', $vars);
        $this->load->view('plantillas/footer');
    }
    
    //====== FUNCION PARA REGISTRAR NUEVOS CHEQUES =================
    public function registrar_cheque()
    {
        
        extract($_POST);
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario      = ($variablesSesion['id_usuario']);
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);
        
        $arrayData = array(
            'nro_cheque' => $nro_cheque . $dos_digitos,
            'talonario' => $talonario,
            'cantidad' => $cantidad,
            'fecha_registro' => $fecha_registro,
            'usuario' => $id_usuario,
            'id_comunidad' => $id_comunidad
        );
        $this->Egresos_model->registar_Cheque($arrayData);
        
        for ($i = 0; $i <= $cantidad - 1; $i++) {
            
            if (($dos_digitos == '00') || ($dos_digitos == '01') || ($dos_digitos == '02') || ($dos_digitos == '03') || ($dos_digitos == '04') || ($dos_digitos == '05') || ($dos_digitos == '06') || ($dos_digitos == '07') || ($dos_digitos == '08')) {
                
                $dos_digitos = "0" . ($dos_digitos + 1);
                
            } else {
                
                $dos_digitos = $dos_digitos + 1;
                
            }
            $variablesSesion = $this->session->userdata('usuario');
            $id_usuario      = ($variablesSesion['id_usuario']);
            setlocale(LC_ALL, 'es_VE.UTF-8');
            date_default_timezone_set('America/Caracas');
            $hoy            = date("d-m-Y");
            $fecha_registro = substr($hoy, 0, 10);
            
            $arrayData = array(
                'nro_cheque' => $nro_cheque . $dos_digitos,
                'talonario' => $talonario,
                'cantidad' => $cantidad,
                'fecha_registro' => $fecha_registro,
                'usuario' => $id_usuario,
                'id_comunidad' => $id_comunidad
            );
            $this->Egresos_model->registar_Cheque($arrayData);
            
        }
    }
    //====== FUNCION PARA CONSULTAR ID DE TABLA CHEQUES Y MOSTRAR EN LA VENTANA MODAL =================  
    public function consultarChequeId($id)
    {
        $datos = $this->Egresos_model->get_idC($id);
        
        echo json_encode($datos);
    }
    //=========================== FUNCION PARA ACTUALIZAR CHEQUES =================================================       
    public function actualizar_cheque()
    {
        
        extract($_POST);
        
        $this->Egresos_model->modificar_cheque($id, $nro_cheque, $talonario, $estatus);
    }
    
    //================== FUNCION QUE CONSULTA TODOS LOS ITEM Y LOS MUESTRA EN LA TABLA =============
    public function buscarDatosItem()
    {
        
        $arrayData          = array();
        $data_item['items'] = $this->Egresos_model->get_item();
        $datos_item         = $this->Egresos_model->item_todos();
        
        $vars['resultados'] = $datos_item;
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/item_view', $vars + $data_item);
        $this->load->view('plantillas/footer');
    }
    
    
    //====== FUNCION PARA REGISTRAR NUEVOS ITEM =================
    public function registrar_Item()
    {
        
        extract($_POST);
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario      = ($variablesSesion['id_usuario']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy            = date("d-m-Y");
        $fecha_registro = substr($hoy, 0, 10);
        
        $arrayData = array(
            'item' => $item,
            'fecha_registro' => $fecha_registro,
            'usuario' => $id_usuario
        );
        $this->Egresos_model->registar_Item($arrayData);
        
    }
    //====== FUNCION PARA CONSULTAR ID DE TABLA ITEM Y MOSTRAR EN LA VENTANA MODAL =================  
    public function consultarItemId($id)
    {
        $datos = $this->Egresos_model->get_idI($id);
        
        echo json_encode($datos);
    }
    
    //=========================== FUNCION PARA ACTUALIZAR ITEMS =================================================       
    public function actualizar_item()
    {
        
        extract($_POST);
        
        $this->Egresos_model->modificar_item($id, $item, $estatus);
    }
    
    //================== FUNCION QUE CONSULTA TODOS LOS ITEMS Y LOS MUESTRA EN LA TABLA =============
    public function MostrarDescripcionItem()
    {
        $arrayData = array();
        extract($_GET);
        $arrayData = $id_item;
        
        $datos_item         = $this->Egresos_model->item_todos_id($id_item);
        $vars['resultados'] = $datos_item;
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/descripcion_item_view', $vars);
        $this->load->view('plantillas/footer');
    }
    
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN PROVEEDOR REGISTRADO ===============   
    public function consultar_existe_proveedor()
    {
        
        $proveedor = $_POST['proveedor'];
        if ($proveedor == "") {
            exit();
        }
        $consultar_proveedor = $this->Egresos_model->existe_proveedor($proveedor);
        if ($consultar_proveedor[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN DNI REGISTRADO ===============   
    public function consultar_existe_rut_dni()
    {
        
        $rut_dni = $_POST['rut_dni'];
        if ($rut_dni == "") {
            exit();
        }
        $consultar_rut_dni = $this->Egresos_model->existe_rut_dni($rut_dni);
        if ($consultar_rut_dni[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN CHEQUE REGISTRADO ===============   
    public function consultar_existe_cheque()
    {
        
        $nro_cheque = $_POST['nro_cheque'];
        if ($nro_cheque == "") {
            exit();
        }
        $consultar_chequer = $this->Egresos_model->existe_nro_cheque($nro_cheque);
        if ($consultar_chequer[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN NRO DE DOCUMENTO  REGISTRADO ===============   
    public function consultar_existe_documento()
    {
        
        $nro_documento = $_POST['nro_documento'];
        if ($nro_documento == "") {
            exit();
        }
        $consultar_doc = $this->Egresos_model->existe_nro_documento($nro_documento);
        if ($consultar_doc[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    
    //========== FUNCION QUE CONSULTA SI YA EXISTE UN ITEM REGISTRADO ===============   
    public function consultar_existe_item()
    {
        
        $item = $_POST['item'];
        if ($item == "") {
            exit();
        }
        $consultar_item = $this->Egresos_model->existe_item($item);
        if ($consultar_item[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
    
    //====================== FUNCION PARA GENERAR PDF ====================================  
    public function imprimirPDF()
    {
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        extract($_GET);
        
        $datos_egreso['resultado'] = $this->Egresos_model->egresos_id($id_egreso);
        
        $html  = $this->load->view('pdf/egresoPDF_view', $datos_egreso, true);
        //print_r($html); exit;
        $fecha = date('d-m-Y');
        
        //$pdf->SetHtmlHeader('<img width="100%" src="' . base_url() . 'application/recursos/imagenes/headerAuditoria.png">');
        $pdf->SetHtmlHeader('Fecha: ' . $fecha);
        //$pdf->SetHTMLFooter('<img width="80%" height="7%" align="center" src="' . base_url() . 'application/recursos/imagenes/cintillo_gobierno.jpg">');
        $pdf->SetHTMLFooter('Fecha: ' . $fecha);
        
        $pdfFilePath = "DatosDeEgreso.pdf";
        
        $pdf->AddPage('', '', '', '', '', 20, 20, 20, 35, 10, 10);
        $pdf->WriteHTML($html);
        
        $pdf->Output($pdfFilePath, "I");
    }
    
    //================== FUNCION QUE RENDERIZA A LA VISTA DE CONSULTA DE EGRESOS POR PERIODO =============
    public function egresos_por_periodo($id_comunidad)
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $data_comunidades['comunidades'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $data_com['com'] = $this->Egresos_model->get_comunidades();
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/egresos_periodo_view', $data_comunidades+$data_com);
        $this->load->view('plantillas/footer');
    }
    
    //================== FUNCION QUE CONSULTA TODOS LOS EGRESOS POR PERIODO =============  
    public function detalles_egresos_por_periodo()
    {
        
        $arrayData = array();
        extract($_POST);
        
        $id_comunidad     = $this->input->post('id_comunidad');
        $com['comunidad'] = $id_comunidad;
        $periodo          = $this->input->post('periodo');
        $per['periodo']   = $periodo;
        $anio             = $this->input->post('anio');
        $an['anio']       = $anio;
        
        $arrayData = $id_comunidad;
        $arrayData = $periodo;
        $arrayData = $anio;
        
        $datos_gastos_adm                                 = $this->Egresos_model->egresos_por_periodo_administracion($id_comunidad, $periodo, $anio);
        $administracion['gastos_admnistracion']           = $datos_gastos_adm;
        $suma_gastos_administracion['suma_adminstracion'] = $this->Egresos_model->get_suma_egresos_admin_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_man                          = $this->Egresos_model->egresos_por_period_mantencion($id_comunidad, $periodo, $anio);
        $mantencion['gastos_mantencion']           = $datos_gastos_man;
        $suma_gastos_mantencion['suma_mantencion'] = $this->Egresos_model->get_suma_egresos_man_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_comun              = $this->Egresos_model->egresos_por_period_comun($id_comunidad, $periodo, $anio);
        $comun['gastos_comun']           = $datos_gastos_comun;
        $suma_gastos_comun['suma_comun'] = $this->Egresos_model->get_suma_egresos_comun_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_varios     = $this->Egresos_model->egresos_por_period_varios($id_comunidad, $periodo, $anio);
        $varios['gastos_varios'] = $datos_gastos_varios;
        
        $suma_gastos_varios['suma_varios'] = $this->Egresos_model->get_suma_egresos_varios_periodo($id_comunidad, $periodo, $anio);
        
        $suma_egreso_periodo['suma_egreso_periodo'] = $this->Egresos_model->get_suma_egresos_total_periodo($id_comunidad, $periodo, $anio);
        
        
        $datos_serv_basicos                 = $this->Egresos_model->egresos_por_periodo_serv_bas($id_comunidad, $periodo, $anio);
        $serv_bas['gastos_serv_bas']        = $datos_serv_basicos;
        $suma_serv_bas['suma_serv_basicos'] = $this->Egresos_model->get_suma_egresos_ser_bas($id_comunidad, $periodo, $anio);
        
        $datos_gastos_gen                         = $this->Egresos_model->egresos_gastos_generales($id_comunidad, $periodo, $anio);
        $gastos_generales['gastos_gen']           = $datos_gastos_gen;
        $suma_gastos_generales['suma_gastos_gen'] = $this->Egresos_model->get_suma_gastos_generales($id_comunidad, $periodo, $anio);
        
        $datos_servicios_seguros                         = $this->Egresos_model->egresos_servicios_seguros($id_comunidad, $periodo, $anio);
        $gastos_servicios_seguros['servicios_seguros']   = $datos_servicios_seguros;
        $suma_servicios_seguros['sum_servicios_seguros'] = $this->Egresos_model->get_suma_servicios_seguros($id_comunidad, $periodo, $anio);
        
        $datos_otros_rubros                  = $this->Egresos_model->egresos_otros_rubros($id_comunidad, $periodo, $anio);
        $gastos_otros_rubros['otros_rubros'] = $datos_otros_rubros;
        $suma_otros_rubros['suma_rubros']    = $this->Egresos_model->get_suma_rubros($id_comunidad, $periodo, $anio);
        
        
        
        $this->load->view('procesos/egresos_administracion_view', $administracion + $suma_gastos_administracion + $mantencion + $suma_gastos_mantencion + $comun + $suma_gastos_comun + $varios + $suma_gastos_varios + $suma_egreso_periodo + $serv_bas + $suma_serv_bas + $gastos_generales + $suma_gastos_generales + $gastos_servicios_seguros + $suma_servicios_seguros + $gastos_otros_rubros + $suma_otros_rubros + $per + $an + $com);
        //$this->load->view('plantillas/footer');
    }
    
    
    //====================== FUNCION PARA GENERAR PDF ====================================  
    public function imprimirPDF_periodo()
    {
        $this->load->library('Pdf');
        $pdf = $this->pdf->load();
        extract($_POST);
        //print_r($_POST); exit;
        
        $id_comunidad     = $this->input->post('id_comunidad');
        $com['comunidad'] = $id_comunidad;
        $periodo          = $this->input->post('periodo');
        $per['periodo']   = $periodo;
        $anio             = $this->input->post('anio');
        $an['anio']       = $anio;
        
        $arrayData    = $id_comunidad;
        $arrayDataCom = $id_comunidad;
        $arrayData    = $periodo;
        $arrayData    = $anio;
        
        $datos_gastos_adm                                 = $this->Egresos_model->egresos_por_periodo_administracion($id_comunidad, $periodo, $anio);
        $administracion['gastos_admnistracion']           = $datos_gastos_adm;
        $suma_gastos_administracion['suma_adminstracion'] = $this->Egresos_model->get_suma_egresos_admin_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_man                          = $this->Egresos_model->egresos_por_period_mantencion($id_comunidad, $periodo, $anio);
        $mantencion['gastos_mantencion']           = $datos_gastos_man;
        $suma_gastos_mantencion['suma_mantencion'] = $this->Egresos_model->get_suma_egresos_man_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_comun              = $this->Egresos_model->egresos_por_period_comun($id_comunidad, $periodo, $anio);
        $comun['gastos_comun']           = $datos_gastos_comun;
        $suma_gastos_comun['suma_comun'] = $this->Egresos_model->get_suma_egresos_comun_periodo($id_comunidad, $periodo, $anio);
        
        $datos_gastos_varios     = $this->Egresos_model->egresos_por_period_varios($id_comunidad, $periodo, $anio);
        $varios['gastos_varios'] = $datos_gastos_varios;
        
        $suma_gastos_varios['suma_varios'] = $this->Egresos_model->get_suma_egresos_varios_periodo($id_comunidad, $periodo, $anio);
        
        $suma_egreso_periodo['suma_egreso_periodo'] = $this->Egresos_model->get_suma_egresos_total_periodo($id_comunidad, $periodo, $anio);
        
        $data_comunidad['comunidad2'] = $this->Egresos_model->get_comunidad($id_comunidad);
        //print_r($data_comunidad[0]->nombre_comunidad); exit;
        
        $datos_serv_basicos                 = $this->Egresos_model->egresos_por_periodo_serv_bas($id_comunidad, $periodo, $anio);
        $serv_bas['gastos_serv_bas']        = $datos_serv_basicos;
        $suma_serv_bas['suma_serv_basicos'] = $this->Egresos_model->get_suma_egresos_ser_bas($id_comunidad, $periodo, $anio);
        
        $datos_gastos_gen                         = $this->Egresos_model->egresos_gastos_generales($id_comunidad, $periodo, $anio);
        $gastos_generales['gastos_gen']           = $datos_gastos_gen;
        $suma_gastos_generales['suma_gastos_gen'] = $this->Egresos_model->get_suma_gastos_generales($id_comunidad, $periodo, $anio);
        
        
        $datos_servicios_seguros                         = $this->Egresos_model->egresos_servicios_seguros($id_comunidad, $periodo, $anio);
        $gastos_servicios_seguros['servicios_seguros']   = $datos_servicios_seguros;
        $suma_servicios_seguros['sum_servicios_seguros'] = $this->Egresos_model->get_suma_servicios_seguros($id_comunidad, $periodo, $anio);
        
        $datos_otros_rubros                  = $this->Egresos_model->egresos_otros_rubros($id_comunidad, $periodo, $anio);
        $gastos_otros_rubros['otros_rubros'] = $datos_otros_rubros;
        $suma_otros_rubros['suma_rubros']    = $this->Egresos_model->get_suma_rubros($id_comunidad, $periodo, $anio);
        
        $datos_informacion   = $this->Informacion_model->informacion_comunidad($id_comunidad, $periodo, $anio);
        $info['informacion'] = $datos_informacion;
        
        
        $html  = $this->load->view('pdf/egreso_detallePDF_view', $administracion + $suma_gastos_administracion + $mantencion + $suma_gastos_mantencion + $comun + $suma_gastos_comun + $varios + $suma_gastos_varios + $suma_egreso_periodo + $per + $an + $com + $serv_bas + $suma_serv_bas + $data_comunidad + $gastos_generales + $suma_gastos_generales + $gastos_servicios_seguros + $suma_servicios_seguros + $gastos_otros_rubros + $suma_otros_rubros + $info, true);
        $fecha = date('d-m-Y');
        
        //$pdf->SetHtmlHeader('<img width="100%" src="' . base_url() . 'application/recursos/imagenes/headerAuditoria.png">');
        $pdf->SetHtmlHeader('Fecha de Emisi&oacute;n: ' . $fecha);
        //$pdf->SetHTMLFooter('<img width="80%" height="7%" align="center" src="' . base_url() . 'application/recursos/imagenes/cintillo_gobierno.jpg">');
        //$pdf->SetHTMLFooter('Fecha: '.$fecha);
        
        $pdfFilePath = "DatosDeEgreso.pdf";
        
        $pdf->AddPage('', '', '', '', '', 20, 20, 20, 35, 10, 10);
        $pdf->WriteHTML($html);
        
        $pdf->Output($pdfFilePath, "I");
    }
    
    //====================== FUNCION PARA VER ADJUNTO ====================================  
    public function verAdjunto1()
    {
        //header('Content-Type: application/jpg'); 
        ///header('Content-type: pdf');
        
        extract($_GET);
        
        $adjunto              = $this->Egresos_model->getAdjunto($id_egreso);
        $adjuntoId['id_egre'] = $this->Egresos_model->getAdjuntoId($id_egreso);
        
        $datos['datos'] = '<img width="500" height="500" src="data:image/pdf;base64,' . $adjunto . '"/>';
        
        file_put_contents('adjuntos.jpg', $adjunto);
        file_put_contents('adjuntos.png', $adjunto);
        file_put_contents('adjuntos.pdf', $adjunto);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/adjunto_view', $datos + $adjuntoId);
    }
    
    //====================== FUNCION PARA VER ADJUNTO ====================================  
    public function verAdjunto($id_egreso) // se coloca el id para la configuracion de la ruta/////////
    {
        //header('Content-Type: application/jpg'); 
        //header('Content-type: pdf');
        // header('content-type: application/pdf');
        //header('Content-Transfer-Encoding: binary');
        
        extract($_GET);
        
        $adjunto              = $this->Egresos_model->getAdjunto($id_egreso);
        $adjuntoId['id_egre'] = $this->Egresos_model->getAdjuntoId($id_egreso);
        file_put_contents('adjuntos.pdf', $adjunto);
        //print_r($adjunto); print_r($adjuntoId);exit;
        
        //echo '<img width="500" height="500" src="data:image/pdf;base64,' .$adjunto. '"/>';
        
        $datos['datos'] = '<img width="500" height="500" src="data:image/jpg;base64,' . $adjunto . '"/>';
        //echo '<iframe  width="100%" height="100%" src="src="data:image/jpg;base64,' .$adjunto. '"></iframe>';
        
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/adjunto_view', $datos + $adjuntoId);
        //$this->load->view('plantillas/footer');
        
    }
    
    
    //====== FUNCION PARA REGISTRAR EGRESOS =================
    public function actualizar_adjunto()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);
        
        $this->Egresos_model->modificar_adjunto($id_egreso, $adjunto);
        
        $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissable fade in">
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                          <strong>Suceso! </strong>El archivo Adjunto fue modificado con Exito</div>');
        // redirect('Egresos/buscarDatos', 'refresh');
        
        redirect('Principal/consultar_egresos_comunidad', 'refresh');
        
    }
    
    
    //====================== FUNCION PARA OBTENER EL ID DEL EGRESO Y AUTOFRESCAR LA PAGIAN AL ACTUALIZAR ADJUNTO ====================================  
    public function idEgreso()
    {
        
        extract($_GET);
        $datos = $this->Egresos_model->getAdjuntoId2($id_egreso);
        echo json_encode($datos);
        
    }
    
    
    public function egresos_bitacora()
    {
        
        $datos_egreso       = $this->Egresos_model->egresos_todos_bitacora();
        $vars['resultados'] = $datos_egreso;
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/egresos_bitacora_view', $vars);
        $this->load->view('plantillas/footer');

    }
    
    public function prueba()
    {
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/prueba_view');
        $this->load->view('plantillas/footer');
    }
    
    
    public function index()
    {
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/egresos_view');
        $this->load->view('plantillas/footer');
    }
    
    //================== FUNCION QUE CONSULTA LOS DATOS DEL SAIME =============
    public function consultar()
    {
        $datos = $this->Events_model->get();
        
        //echo json_encode($datos);
        echo json_encode(array(
            'response' => $datos
        ));
    }
    
    
    
    public function actualizar()
    {
        
        print_r($_POST);
        $param['id']      = $this->input->post('id');
        $param['estatus'] = $this->input->post('estatus');
        $param['rol']     = $this->input->post('rol');
        
        $datos = $this->Events_model->upd($param);
        echo json_encode($datos);
    }
    
    
    //============== FUNCION QUE MUESTRA LOS DETALLES DE LA CONSULTA PARA EDITAR ====================     
    public function MostrarDetalles()
    {
        
        $arrayData = array();
        extract($_GET);
        $arrayData[] = $cedula;
        $arrayData2  = array();
        
        $data['buscar_usuario'] = $this->Pgsql->SELECTPLSQL('buscar_usuario', $arrayData);
        
        $data2['roles'] = $this->Pgsql->SELECTPLSQL('consultar_rol', $arrayData2);
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('administracion/editarEstatus', $data + $data2);
        $this->load->view('plantillas/footer');
    }
    
    //====== FUNCION PARA CONSULTAR Y MOSTRAR LOS DATOS CON JSON EN LA MISMA VISTA ======================================   
    public function consultarJson()
    {
        extract($_POST);
        $arrayData       = array();
        $arrayData[]     = $cedula;
        $arrayData[]     = 'V';
        $this->db_b      = $this->load->database('personas', true);
        $consultaPersona = $this->Pgsql->SELECTPLSQL('consultar_datos_persona', $arrayData);
        if ($consultaPersona[0][0] != '') {
            
            $data['nombres']   = $consultaPersona[0][1];
            $data['apellidos'] = $consultaPersona[0][2] . ' ' . $consultaPersona[0][3];
        } else {
            $data = 0;
        }
        echo json_encode($data);
    }

    public function eliminar_egreso($id_egreso)
	{
		$this->Egresos_model->delete_egresos($id_egreso);
		echo json_encode(array("status" => TRUE));
	}
	public function eliminar_torre($id_torre)
	{
		$this->Egresos_model->delete_torre($id_torre);
		echo json_encode(array("status" => TRUE));
	}
	 public function eliminar_comunidad($id_comunidad)
	{
		$this->Egresos_model->delete_comunidad($id_comunidad);
		echo json_encode(array("status" => TRUE));
	}
	
	 public function eliminar_item($id_item)
	{
		$this->Egresos_model->delete_item($id_item);
		echo json_encode(array("status" => TRUE));
	}
	public function eliminar_proveedor($id_proveedor)
	{
		$this->Egresos_model->delete_proveedor($id_proveedor);
		echo json_encode(array("status" => TRUE));
	}
	public function obtener_medidor() {
        extract($_GET);
        $datos_dpto = $this->Egresos_model->get_medidores($id_proveedor);
        $combo = "<select name='nombre_medidor' id='nombre_medidor' class='form-control'>";
        foreach ($datos_dpto as $dpto) {
            $combo .= "<option value='" . $dpto->nombre_medidor . "'>$dpto->nombre_medidor";
        }
        $combo .= "</select>";
        echo $combo;
    }
}