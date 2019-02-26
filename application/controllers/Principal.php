<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal extends CI_Controller
{
    
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Egresos_model');
        $this->load->model('Ingresos_model');
        $this->load->model('Ingresos_extarordinarios_model');
        $this->load->model('Copropietarios_model');
        $this->load->model('Medidores_model');
        $this->load->library('Configemail');
        $this->load->library('user_agent');
    }
    
    public function index()
    {
        
        redirect('principal/inicio', 'refresh');
    }
    
    function inicio()
    {
        
        // echo $this->agent->platform();
        // echo '/';
        // echo $this->agent->version();
        // echo '/';
        // echo $this->agent->is_mobile();
        // echo '/';
        // echo $this->agent->browser();
        
        $this->agent->robot();
        $this->agent->platform();
        $this->agent->browser();
        $this->agent->version();
        if ($this->agent->is_mobile()) {
        }
        $this->agent->is_robot();
        $this->agent->is_browser();
        
        
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');
    }
    
    function login()
    {
        
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');
        
        if (isset($_POST['usuario'])) {
            
            //Recogemos las variables 'usuario' y 'contrasena'
            $usuario = $this->input->post('usuario');
            $clave   = md5($this->input->post('clave'));
            
            
            $arrayValidar   = array();
            $arrayValidar[] = $usuario;
            $arrayValidar[] = $clave;
            
            // cargamos el modelo para verificar el usuario/contraseña
            // si el usuario y contraseña son correctos
            //$consultarUsuario = $this->Pgsql->SELECTPLSQL('usuarios', $arrayValidar);
            $consultarUsuario = $this->Consultas_usuarios_model->consultar_usuario($usuario, $clave);
            
            if ($consultarUsuario == "") {
                $consultarUsuario[0] = "";
            }
            
            if (isset($consultarUsuario[0])) {
                
                //Creamos las variables de Sesión
                $datasession = array(
                    'cedula' => $consultarUsuario[0]->cedula,
                    'nombres' => $consultarUsuario[0]->nombres,
                    'apellidos' => $consultarUsuario[0]->apellidos,
                    'rol' => $consultarUsuario[0]->rol,
                    'id_usuario' => $consultarUsuario[0]->id_usuario,
                    'id_comunidad' => $consultarUsuario[0]->id_comunidad
                );
                
                $this->session->set_userdata('usuario', $datasession);
                $variablesSesion = $this->session->userdata('usuario');
                
                redirect('principal/bienvenida', 'refresh');
            } else {
                // si el usuario y contraseña son incorrectos
                $this->session->set_flashdata('danger', '<div class="alert alert-danger alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-ban"></i> <strong>Alerta! </strong>Clave Incorrecta....!!!</div>');
                redirect('principal/inicio', 'refresh');
            }
        } else {
            // SI NO EXISTE LA VARIABLE SESION REFRESCAMO EL INICIO
            redirect('principal/inicio', 'refresh');
        }
    }
    
    // MENSAJE QUE APARECE CUANDO SE CIERRA EL SISTEMA POR INACTIVIDAD
    function session()
    {
        
        $this->session->set_flashdata('info', '<div class="alert alert-info alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-info"></i> <strong>Informacion! </strong>Sesion Cerrada por Inactividad....!!!</div>');
        redirect('principal/inicio', 'refresh');
    }
    
    // PAGINA CUANDO INICIAMOS SESION
    function bienvenida2()
    {
        
        $data_comunidades['comunidades'] = $this->Egresos_model->get_comunidades();
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('bienvenida2', $data_comunidades);
        $this->load->view('plantillas/footer');
    }
    
    
    // PAGINA CUANDO INICIAMOS SESION
    //==========================================================================================//
    //====================================== Pantalla Principal ================================//
    //==========================================================================================//
    
    function bienvenida()
    {
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        if (($rol == 2) || ($rol == 3) || ($rol == 4)) {
            $suma_ingresos['suma']                  = $this->Ingresos_model->get_suma_ingresos_comunidad($id_comunidad);
            $suma_egreso['sumaE']                   = $this->Egresos_model->get_suma_egresos_comunidad($id_comunidad);
            $suma_ingresosEX['sumaExt']             = $this->Ingresos_extarordinarios_model->get_suma_ingresos_comunidadE($id_comunidad);
            $total_copropietarios['copropietarios'] = $this->Copropietarios_model->cantidad_copropietarios($id_comunidad);
            $total_comunidades['comunidades']       = $this->Egresos_model->cantidad_comunidades($id_comunidad);
            $total_proveedores['proveedores']       = $this->Egresos_model->cantidad_proveedores($id_comunidad);
            $total_items['items']                   = $this->Egresos_model->cantidad_items($id_comunidad);
            $total_cheques['cheques']               = $this->Egresos_model->cantidad_cheques($id_comunidad);
            $total_medidores['medidores']           = $this->Medidores_model->cantidad_medidores($id_comunidad);
        }
        
        else {
            $suma_ingresos['suma']                  = $this->Ingresos_model->get_suma_ingresos_comunidad_total();
            $suma_egreso['sumaE']                   = $this->Egresos_model->get_suma_egresos_comunidad_total();
            $suma_ingresosEX['sumaExt']             = $this->Ingresos_extarordinarios_model->get_suma_ingresos_comunidad_totalE();
            $total_copropietarios['copropietarios'] = $this->Copropietarios_model->cantidad_copropietariosT();
            $total_comunidades['comunidades']       = $this->Egresos_model->cantidad_comunidadesT();
            $total_proveedores['proveedores']       = $this->Egresos_model->cantidad_proveedoresT();
            $total_items['items']                   = $this->Egresos_model->cantidad_itemsT();
            $total_cheques['cheques']               = $this->Egresos_model->cantidad_chequesT();
            $total_medidores['medidores']           = $this->Medidores_model->cantidad_medidoresT();
            
            
        }
            $this->load->view('plantillas/administracion/header');
            $this->load->view('plantillas/menu');
            $this->load->view('dashboard',$total_medidores+ $suma_ingresos + $suma_egreso + $suma_ingresosEX + $total_copropietarios + $total_comunidades + $total_proveedores + $total_items + $total_cheques);
            $this->load->view('plantillas/footer');
        
    }
    
    function configuracion()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        if (($rol == 2) || ($rol == 3) || ($rol == 4)) {
            $total_medidores['medidores'] = $this->Medidores_model->cantidad_medidores($id_comunidad);
        }
        else {
            $total_medidores['medidores']  = $this->Medidores_model->cantidad_medidoresT();
        }
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('dashboard_configuracion',$total_medidores);
        $this->load->view('plantillas/footer');
    }
    

    // Función logout. Elimina las variables de sesión y redirige al controlador principal
    
    function logout()
    {
        
        $this->session->sess_destroy();
        // redirigimos al controlador principal
        redirect('principal/login', 'refresh');
    }
    
    ///CLAVES DE USUARIO recibe el tama�o de la clave
    function generarClaveAleatoria($tamanio)
    {
        $chars        = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength  = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $tamanio; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }
    
    // CONSULTAMOS SI EXISTE EL CORREO 
    function consultar_correo()
    {
        extract($_POST);
        
        $consultarUsuario = $this->Consultas_usuarios_model->existe_correo($correo);
        
        if ($consultarUsuario[0] != '0') {
            echo 1;
        } else {
            echo 2;
        }
    }
    
    // ENVIAMOS LA CONTRASE�A ALEATORIA, AL CORREO REGISTRADO
    function recuperarClave()
    {
        extract($_POST);
        
        $claveNueva = $this->generarClaveAleatoria(8);
        print_r($claveNueva);
        $correo = $this->input->post('correo');
        $clave  = md5($claveNueva);
        
        $this->Consultas_usuarios_model->actualizar_contrasenia($correo, $clave);
        
        $msje = "Reciba un cordial saludo sr(a)  ud, a solicitado sus datos de acceso al sistema. 
    A continuaci�n los <b>datos de ingreso</b>: <br>

    Contrase�a: <b>" . $claveNueva . "</b>";
        
        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('idsistemas15@gmail.com');
        $this->email->to($correo);
        $this->email->subject('Recuperación de Contraseña');
        $this->email->message($msje);
        $this->email->message($msje);
        $this->email->send();
    }

    //================== FUNCION QUE CONSULTA TODOS LOS EGRESOS DE UNA COMUNIDAD Y LOS MUESTRA EN LA TABLA =============
    public function consultar_egresos_comunidad()
    {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData = array();

        if ($rol == 1) {
        $data_comunidades['comunidades']     = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $datos_egreso                        = $this->Egresos_model->egresos_todos_comunidadT();
        $estatus_egreso['estatus']           = $this->Egresos_model->estatus_egreso_comunidadT();
        $data_proveedores['proveedores']     = $this->Egresos_model->get_proveedoresT2();
        $nom_comunidad['nombre_comunidad']   = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $data_item['items']                  = $this->Egresos_model->get_item();
        $data_item_descripcion['desc_items'] = $this->Egresos_model->get_descripcion_item_id();
        $datos_cheque['cheques']             = $this->Egresos_model->get_chequesT();
        $datos_cheque2['cheques2']           = $this->Egresos_model->get_cheques2T();
        $suma_egreso['suma']                 = $this->Egresos_model->get_suma_egresos_comunidadT();
        $medio_pago['medioPago']             = $this->Egresos_model->get_medio_pago();
        $forma_pago['formaPago']             = $this->Egresos_model->get_forma_pago();
        $data_dpto['departamentos']          = $this->Ingresos_model->get_departamentosT();
        $data_medidores['medidores']         = $this->Medidores_model->get_medidoresT();
        $data_torre['torres']                = $this->Ingresos_model->get_torresT();
        $vars['resultados']                  = $datos_egreso;
        
            
        }else{
        $data_comunidades['comunidades']     = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $datos_egreso                        = $this->Egresos_model->egresos_todos_comunidad($id_comunidad);
        
        $estatus_egreso['estatus']           = $this->Egresos_model->estatus_egreso_comunidad($id_comunidad);
        $data_proveedores['proveedores']     = $this->Egresos_model->get_proveedores2($id_comunidad);
        $nom_comunidad['nombre_comunidad']   = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $data_item['items']                  = $this->Egresos_model->get_item();
        $data_item_descripcion['desc_items'] = $this->Egresos_model->get_descripcion_item_id();
        $datos_cheque['cheques']             = $this->Egresos_model->get_cheques($id_comunidad);
        $datos_cheque2['cheques2']           = $this->Egresos_model->get_cheques2($id_comunidad);
        $suma_egreso['suma']                 = $this->Egresos_model->get_suma_egresos_comunidad($id_comunidad);
        $medio_pago['medioPago']             = $this->Egresos_model->get_medio_pago();
        $forma_pago['formaPago']             = $this->Egresos_model->get_forma_pago();
        $data_dpto['departamentos']          = $this->Ingresos_model->get_departamentos($id_comunidad);
        $data_medidores['medidores']         = $this->Medidores_model->get_medidores($id_comunidad);
        $data_torre['torres']                = $this->Ingresos_model->get_torres($id_comunidad);
        $vars['resultados']                  = $datos_egreso;
     
        }

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/egresos_comunidad_view', $vars +$data_torre+$data_medidores+ $data_dpto+$forma_pago+ $data_proveedores + $datos_cheque + $data_item + $datos_cheque2 + $data_item_descripcion + $suma_egreso + $estatus_egreso + $nom_comunidad + $data_comunidades+$medio_pago);
        $this->load->view('plantillas/footer');
  
    }
    
    public function consultar_egresos_comunidad2($id_comunidad)
    {
        
        extract($_POST);

        $variablesSesion        = $this->session->userdata('usuario');
        $rol                    = ($variablesSesion['rol']);
        $arrayData              = $id_comunidad;
        $id_comunidad           = $this->input->post('id_comunidad');
        $comunidad['comunidad'] = $id_comunidad;
        
        
        
        if ($rol == 1) {
            
            $datos_egreso = $this->Egresos_model->egresos_todos_comunidad($id_comunidad);
            
            $estatus_egreso['estatus'] = $this->Egresos_model->estatus_egreso_comunidad($id_comunidad);
            
            $data_proveedores['proveedores']   = $this->Egresos_model->get_proveedores();
            $nom_comunidad['nombre_comunidad'] = $this->Egresos_model->nombre_comunidad($id_comunidad);
            //print_r($nom_comunidad); exit;
            
            $data_item['items']                  = $this->Egresos_model->get_item();
            $data_item_descripcion['desc_items'] = $this->Egresos_model->get_descripcion_item_id();
            $datos_cheque['cheques']             = $this->Egresos_model->get_cheques();
            $datos_cheque2['cheques2']           = $this->Egresos_model->get_cheques2();
            $suma_egreso['suma']                 = $this->Egresos_model->get_suma_egresos_comunidad($id_comunidad);
            $vars['resultados']                  = $datos_egreso;
            //print_r($suma_egreso);
            
            $this->load->view('plantillas/administracion/header');
            $this->load->view('plantillas/menu');
            $this->load->view('procesos/egresos_comunidad_view', $vars + $data_proveedores + $datos_cheque + $data_item + $datos_cheque2 + $data_item_descripcion + $suma_egreso + $estatus_egreso + $nom_comunidad + $comunidad);
            $this->load->view('plantillas/footer');
            
        } else {
            
            $datos_egreso                        = $this->Egresos_model->egresos_todos();
            $estatus_egreso['estatus']           = $this->Egresos_model->estatus_egreso();
            //print_r($estatus_egreso);
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
            $this->load->view('procesos/egresos_view', $vars + $data_proveedores + $datos_cheque + $data_item + $datos_cheque2 + $data_item_descripcion + $suma_egreso + $data_comunidades + $estatus_egreso + $comunidad);
            $this->load->view('plantillas/footer');
        }
    }
    

}