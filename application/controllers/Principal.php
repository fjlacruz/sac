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
        $this->load->model('Consultas_usuarios_model');
        $this->load->library('Configemail');
        $this->load->library('user_agent');
    }
    
    public function index()
    {
        
        redirect('principal/inicio', 'refresh');
    }
    
    function inicio()
    {
        
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
            
            $usuario = $this->input->post('usuario');
            $clave   = md5($this->input->post('clave'));   
            
            $arrayValidar   = array();
            $arrayValidar[] = $usuario;
            $arrayValidar[] = $clave;
            
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
                    'id_usuario' => $consultarUsuario[0]->id_usuario
                );
                
                $this->session->set_userdata('usuario', $datasession);
                $variablesSesion = $this->session->userdata('usuario');
                
                redirect('Bodega/inicio', 'refresh');
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
    


    // Función logout. Elimina las variables de sesión y redirige al controlador principal
    
    function logout()
    {
        
        $this->session->sess_destroy();
        // redirigimos al controlador principal
        redirect('principal/login', 'refresh');
    }
       
}