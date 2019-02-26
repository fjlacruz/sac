<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Copropietarios extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Copropietarios_model');
    }

    public function index() {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        if ($rol == 1) {
        $datos_cop = $this->Copropietarios_model->copropietariosT();
        $datos_torres['torres'] = $this->Copropietarios_model->torresT();
        $vars['resultados'] = $datos_cop;
        }else{
        $datos_cop = $this->Copropietarios_model->copropietarios($id_comunidad); 
        $datos_torres['torres'] = $this->Copropietarios_model->torres($id_comunidad);
        $vars['resultados'] = $datos_cop;
        }
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/copropietarios_view',$vars+$datos_torres);
        //$this->load->view('plantillas/footer');
    }
    

     //====== FUNCION PARA REGISTRAR NUEVAS COMUNIDADES =================
     public function registrar_copropietarios(){
 
        extract($_POST);
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_usuario = ($variablesSesion['id_usuario']);
        $id_comunidad = ($variablesSesion['id_comunidad']);
        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        
         $arrayData = array(
              'rut'=>$rut,
              'nombres'=>$nombres,
              'apellidos'=>$apellidos,
              'nro_dpto'=>$nro_dpto, 
              'alicuota_dpto'=>$alicuota_dpto,
              'alicuota_maletero'=>$alicuota_maletero,
              'alicuota_estacionamiento'=>$alicuota_estacionamiento,
              'alicuota_total'=>$alicuota_total,
              'telefono'=>$telefono,
              'email'=>$email,
              'fecha_registro'=>$fecha_registro,
              'id_usuario'=>$id_usuario,
              'id_comunidad'=>$id_comunidad,
              'id_torre'=>$id_torre
        );
       $this->Copropietarios_model->registar_copropietarios($arrayData);
        
     }
     
     
     public function consultar_existe_rut() {

        $rut = $_POST['rut'];
        if ($rut == "") {
            exit();
        }
        $consultar_rut = $this->Copropietarios_model->existe_rut($rut);
        if ($consultar_rut[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
     
     
     public function consultar_existe_apartamento() {

        $nro_dpto = $_POST['nro_dpto'];
        if ($nro_dpto == "") {
            exit();
        }
        $consultar_nro_dpto = $this->Copropietarios_model->existe_dpto($nro_dpto);
        if ($consultar_nro_dpto[0]!= 0) {
            echo 1;
        } else {
            echo 0;
        }
    }
     
     
     public function consultarCopropietariosId($id) {
        $datos = $this->Copropietarios_model->get_idCop($id);

        echo json_encode($datos);
    }
    
    public function actualizar_copropietarios() {

        extract($_POST);
        $alicuota_dpto = $this->input->post('alicuota_dpto2');
        $alicuota_estacionamiento = $this->input->post('alicuota_estacionamiento2');
        $alicuota_maletero = $this->input->post('alicuota_maletero2');
        $alicuota_total=$alicuota_dpto+$alicuota_estacionamiento+$alicuota_maletero;

        $this->Copropietarios_model->modificar_copropietarios($id,$rut,$nombres,$apellidos,
        $alicuota_dpto,$alicuota_estacionamiento,$alicuota_maletero,
        $alicuota_total,$estatus,$telefono,$email, $nro_dpto);
    }  
     public function eliminar_copropietario($id_copropietario)
	{
		$this->Copropietarios_model->delete_copropietario($id_copropietario);
		echo json_encode(array("status" => TRUE));
	}
    

}
