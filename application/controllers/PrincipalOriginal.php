<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Principal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('email');
        $this->load->model('Pgsql');
        $this->load->library('Configemail');
    }

    public function index() {

        redirect('principal/inicio', 'refresh');
    }

    function inicio() {
        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');
    }

    function login() {

        $this->load->view('plantillas/login/header');
        $this->load->view('login');
        $this->load->view('plantillas/footer');

        if (isset($_POST['usuario'])) {

//Recogemos las variables 'usuario' y 'contrasena'
            $usuario = $this->input->post('usuario');
            $clave = md5($this->input->post('clave'));


            $arrayValidar = array();
            $arrayValidar[] = $usuario;
            $arrayValidar[] = $clave;

// cargamos el modelo para verificar el usuario/contrase帽a
// si el usuario y contrase帽a son correctos
            $consultarUsuario = $this->Pgsql->SELECTPLSQL('usuarios', $arrayValidar);

            if ($consultarUsuario[0][0] != "") {

//Creamos las variables de Sesi贸n
                $datasession = array(
                    'cedula' => $consultarUsuario[0][0],
                    'nombres' => $consultarUsuario[0][1],
                    'apellidos' => $consultarUsuario[0][2],
                    'rol' => $consultarUsuario[0][3],
                    'id_usuario' => $consultarUsuario[0][4],
                   
                );

                $this->session->set_userdata('usuario', $datasession);
                $variablesSesion = $this->session->userdata('usuario');

                redirect('principal/bienvenida', 'refresh');
            } else {
// si el usuario y contrase帽a son incorrectos
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
    function session() {

        $this->session->set_flashdata('info', '<div class="alert alert-info alert-dismissable fade in" style="display:block" >
                                           <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                         <i class="icon fa fa-info"></i> <strong>Informacion! </strong>Sesion Cerrada por Inactividad....!!!</div>');
        redirect('principal/inicio', 'refresh');
    }

    // PAGINA CUANDO INICIAMOS SESION
    function bienvenida() {
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('bienvenida');
        $this->load->view('plantillas/footer');
    }

// Funci贸n logout. Elimina las variables de sesi贸n y redirige al controlador principal

    function logout() {

        $this->session->sess_destroy();
// redirigimos al controlador principal
        redirect('principal/login', 'refresh');
    }

    ///CLAVES DE USUARIO recibe el tama駉 de la clave
    function generarClaveAleatoria($tamanio) {
        $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charsLength = strlen($chars);
        $randomString = '';
        for ($i = 0; $i < $tamanio; $i++) {
            $randomString .= $chars[rand(0, $charsLength - 1)];
        }
        return $randomString;
    }

    // CONSULTAMOS SI EXISTE EL CORREO 
    function consultar_correo() {
        extract($_POST);

        $arrayData = array();
        $arrayData[] = $correo;

        $consultaUsuario = $this->Pgsql->SELECTPLSQL('existe_correo', $arrayData);

        if ($consultaUsuario[0][0] != '0') {
            echo 1;
        } else {
            echo 2;
        }
    }

    // ENVIAMOS LA CONTRASE袮 ALEATORIA, AL CORREO REGISTRADO
    function recuperarClave() {
        extract($_POST);

        $claveNueva = $this->generarClaveAleatoria(8);
        $arrayNuevaClave = array();
        $arrayNuevaClave[] = $correo;
        $arrayNuevaClave[] = md5($claveNueva);


        $this->Pgsql->SELECTPLSQL('actualizar_contrasenia', $arrayNuevaClave);

        $msje = "Reciba un cordial saludo sr(a)  ud, a solicitado sus datos de acceso al sistema. 
    A continuaci髇 los <b>datos de ingreso</b>: <br>

    Contrase馻: <b>" . $claveNueva . "</b>";

        $configuracionSrvCorreo = $this->configemail->ConfigSrvEmail();
        $this->email->initialize($configuracionSrvCorreo);
        $this->email->from('cesppa@cesppa.gob.ve');
        $this->email->to($correo);
        $this->email->subject('Recuperaci贸n de Contrase帽a');
        $this->email->message($msje);
        $this->email->message($msje);
        $this->email->send();
    }

}
