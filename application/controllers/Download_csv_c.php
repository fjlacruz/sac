<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_csv_c extends CI_Controller {
    
  public function __construct(){
    parent::__construct();

    $this->load->helper(array('form','download'));
    $this->load->library('form_validation');
    $this->load->model('download_csv_m','modelo');
  }
  public function index($submit=false){

    // seteamos las variables principales
    $datos['sSubTitulo'] = 'Generar archivo CSV';
    $datos['sTitulo']    = 'mi titulo';
    $datos['submit']     = $submit;
    
    $datos['arrTablas'] = $this->modelo->get_tablas();

    // si ya esta cargado, lo enviamos
    if ($submit){
        $datos['id_tabla'] = $this->input->post('selTablas');
    }

    // cargamos  la interfaz
    $this->load->view('download_csv_v', $datos);
  }
  
  public function validar_form(){
    
      // armamos un array con las reglas de validacion
        $arrValidaciones = array(
            array(
                'field'   => 'selTablas',
                'label'   => 'Tabla',
                'rules'   => 'required'
            )
        );

        // establecemos las reglas de validacion
        $this->form_validation->set_rules($arrValidaciones);

        // indicamos que los errores se les aplique la clase .. (CSS)
        $this->form_validation
        ->set_error_delimiters('<span style="color:red;"> * ','</span>');

        // iniciamos las validaciones - solo si no se va a eliminar
        if ($this->form_validation->run() == FALSE){
            $this->index(true);
            
        }else{
            $sTabla         = $this->input->post('selTablas');
            $nombre_archivo = $sTabla.'_'.date('d-m-Y').'.csv';  
            $sCSV           = $this->modelo->get_datos_tabla($sTabla);
                       
            // Vamos a mostrar un CSV
            header('Content-type: application/csv');
            header('Content-Disposition: attachment; filename="'.$nombre_archivo.'"');
            
            // en este caso es necesario imprimir aqui mismo en el controlador
            echo $sCSV;
        }
  }

}
?>