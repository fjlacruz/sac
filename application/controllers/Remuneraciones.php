<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Remuneraciones extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        
        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Ingresos_model');
        $this->load->model('Egresos_model');
        $this->load->model('Remuneraciones_model');
        $this->load->library('parser');
    }
    
    //====== TABLA DE INGRESOS QUE SE MONTA SOBRE LA VISTA DE LA FUNCION INGRESOS ====================       
    public function tabla()
    {
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData = array();
        
        if ($rol == 1) {
            $vars['resultados'] = $this->Remuneraciones_model->trabajadoresT();
            
            
        } else {
            
            $vars['resultados'] = $this->Remuneraciones_model->trabajadores($id_comunidad);
        }
        $this->load->view('procesos/tabla_trab', $vars);
    }
    //=========================== FUNCION PARA LA VISTA DE INGRESOS =================================================       
    public function trabajadores()
    {
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $rol             = ($variablesSesion['rol']);
        
        $arrayData = array();
        
        if ($rol == 1) {
            $data_cargos['cargos'] = $this->Remuneraciones_model->get_cargos();
        } else {
            $data_cargos['cargos'] = $this->Remuneraciones_model->get_cargos();
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_trabajadores', $data_cargos);
        $this->load->view('plantillas/footer');
    }
    
    
    //============== FUNCION QUE INSERTA LOS DATOS DEL TRABAJADOR EN LA BASE DE DATOS ===============        
    public function registrar_trabajador()
    {
        
        extract($_POST);
        
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad    = ($variablesSesion['id_comunidad']);
        $id_usuario      = ($variablesSesion['id_usuario']);
        
        $arrayData = array(
            'rut' => $rut,
            'nombres_trabajador' => $nombres_trabajador,
            'apellidos_trabajador' => $apellidos_trabajador,
            'direccion' => $direccion,
            'id_comunidad' => $id_comunidad,
            'telf_local' => $telf_local,
            'telf_celular' => $telf_celular,
            'email' => $email,
            'sexo' => $sexo,
            'nacionalidad' => $nacionalidad,
            'id_cargo' => $id_cargo,
            'fecha_contrato' => $fecha_contrato,
            'tipo_contrato' => $tipo_contrato,
            'tipo_sueldo' => $tipo_sueldo,
            'tipo_trabajador' => $tipo_trabajador,
            'jubilado' => $jubilado,
            'paga_afp' => $paga_afp,
            'horas_semanales' => $horas_semanales,
            'regimen_provisional' => $regimen_provisional,
            'afp' => $afp,
            'caja_ex_regimen' => $caja_ex_regimen,
            'prevencion_salud' => $prevencion_salud,
            'cargas_normales' => $cargas_normales,
            'cargas_maternales' => $cargas_maternales,
            'cargas_invalidez' => $cargas_invalidez,
            'tramo_sueldo' => $tramo_sueldo,
            'sueldo_base' => $sueldo_base,
            'movilizacion' => $movilizacion,
            'colacion' => $colacion,
            'bono_mensual' => $bono_mensual,
            'bono_proporcional_dias' => $bono_proporcional_dias,
            'bono_afecta_remuneraciones' => $bono_afecta_remuneraciones,
            'id_usuario' => $id_usuario
        );
        $this->Remuneraciones_model->registrar_trabajador($arrayData);
        
    }
    
    public function consultar_trabajdor()
    {
        
        $rut = $_POST['rut'];
        if ($rut == "") {
            exit();
        }
        
        $consultar_rut = $this->Remuneraciones_model->existe_rut($rut);
        if ($consultar_rut[0] != 0) {
            echo 1;
        } else {
            echo 0;
        }
    }

    public function consultar_trabajador_id($id)
    {
        $data = $this->Remuneraciones_model->get_id($id);
        
        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }
    
    
    
    
    
    
    
    
   
    
    
    //=========================== FUNCION PARA ACTUALIZAR UN INGRESO =================================================       
    public function actualizar_ingreso()
    {
        
        $param['id']               = $this->input->post('id');
        $param['id_comunidad']     = strtoupper($this->input->post('id_comunidad_modal'));
        $param['id_copropietario'] = strtoupper($this->input->post('id_copropietario_modal'));
        $param['monto']            = $this->input->post('monto_modal');
        $param['periodo']          = strtoupper($this->input->post('periodo_modal'));
        $param['anio']             = strtoupper($this->input->post('anio_modal'));
        $param['id_forma_pago']    = $this->input->post('id_forma_pago_modal');
        $param['nro_documento']    = $this->input->post('nro_documento_modal');
        $param['fecha_ingreso']    = $this->input->post('fecha_ingreso_modal');
        
        $datos = $this->Ingresos_model->modificar_ingreso($param);
        echo json_encode($datos);
        
    }
    
    
    public function verAdjunto($id_ingreso) // se coloca el id para la configuracion de la ruta/////////
    {
        
        extract($_GET);
        
        $adjunto              = $this->Ingresos_model->getAdjunto($id_ingreso);
        //print_r($adjunto);
        $adjuntoId['id_egre'] = $this->Ingresos_model->getAdjuntoId($id_ingreso);
        //print_r($adjuntoId);
        //exit;
        file_put_contents('adjuntos.pdf', $adjunto);
        
        file_put_contents('adjuntos.pdf', $adjunto);
        //echo '<img width="500" height="500" src="data:image/pdf;base64,' .$adjunto. '"/>';
        $datos['datos'] = '<img width="500" height="500" src="data:image/jpg;base64,' . $adjunto . '"/>';
        
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/adjunto_ingreso_view', $datos + $adjuntoId);
        
    }
    
    //====== FUNCION PARA REGISTRAR EGRESOS =================
    public function actualizar_adjunto()
    {
        
        extract($_POST);
        extract($_FILES);
        
        $dataAdjunto = file_get_contents($_FILES['adjunto']['tmp_name']);
        $adjunto     = base64_encode($dataAdjunto);
        
        $this->Ingresos_model->modificar_adjunto($id_ingreso, $adjunto);
        
        redirect('ingresos/ingresos', 'refresh');
        
    }
    public function eliminar_ingreso($id_ingresos)
    {
        $this->Ingresos_model->delete_ingreso($id_ingresos);
        echo json_encode(array(
            "status" => TRUE
        ));
    }
    
    
}