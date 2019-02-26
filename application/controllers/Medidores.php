<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Medidores extends CI_Controller {

    function __construct() {
        parent::__construct();

        $this->load->model('Pgsql');
        $this->load->model('Consultas_usuarios_model');
        $this->load->model('Ingresos_model');
        $this->load->model('Medidores_model');
        $this->load->model('Egresos_model');
        $this->load->library('parser');
        $this->load->dbutil();
        $this->load->helper('mysql_to_excel_helper');
    }

    //====== TABLA DE INGRESOS QUE SE MONTA SOBRE LA VISTA DE LA FUNCION INGRESOS ====================       
    public function tabla() {
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();

        if ($rol == 1) {
            $vars['resultados'] = $this->Medidores_model->medidores_todosT();
            $estatus = $this->Medidores_model->verificar_estatusT();
        } else {
            $vars['resultados'] = $this->Medidores_model->medidores_todos($id_comunidad);
        }
        $this->load->view('procesos/tabla_med', $vars);
    }

    //=========================== FUNCION PARA LA VISTA DE INGRESOS =================================================       
    public function medidores() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();

        if ($rol == 1) {

            $data_comunidades['comunidades']  = $this->Egresos_model->nombre_comunidad($id_comunidad);
            $data_dpto['departamentos']       = $this->Ingresos_model->get_departamentosT();
            $data_proveedores['proveedores']  = $this->Egresos_model->get_proveedoresT();
            $data_torre['torres'] = $this->Ingresos_model->get_torresT();
        } else {

            $data_comunidades['comunidades']  = $this->Egresos_model->nombre_comunidad($id_comunidad);
            $data_dpto['departamentos']       = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_proveedores['proveedores']  = $this->Egresos_model->get_proveedores($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
           
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/tabla_medidores', $data_comunidades + $data_dpto+$data_proveedores+$data_torre);
        $this->load->view('plantillas/footer');
    }

    //============== FUNCION QUE INSERTA LOS DATOS DEL MEDIDOR EN LA BASE DE DATOS ===============        
    public function registrar_medidor() {

        extract($_POST);

        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);

        $arrayData = array(
            'id_comunidad' => $id_comunidad,
            'nombre_medidor' => $nombre_medidor,
            'vigente' => $vigente,
            'obligatorio' => $obligatorio,
            'fecha_registro' => $fecha_registro,
            'porcentaje' => $porcentaje,
            'id_proveedor' => $id_proveedor
        );
        $this->Medidores_model->registar_medidor($arrayData);
        redirect('medidores/medidores', 'refresh');
    }

    //============== FUNCION PARA CONSULTAR LOS DATOS DEL MEDIDOR =========================================== 
    public function consultar_medidores_id($id) {
        $data = $this->Medidores_model->get_id($id);

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }

    public function consultarLecturaId($id) {
        $data = $this->Medidores_model->get_idLectura($id);

        echo json_encode($data);
        // echo json_encode(array('data' => $data));
    }

    //=========================== FUNCION PARA ACTUALIZAR UN MEDIDOR =================================================       
    public function actualizar_medidor() {

        $param['id'] = $this->input->post('id');
        $param['id_comunidad'] = $this->input->post('id_comunidad_edit');
        $param['nombre_medidor'] = $this->input->post('nombre_medidor_edit');
        $param['vigente'] = $this->input->post('vigente_edit');
        $param['obligatorio'] = $this->input->post('obligatorio_edit');
        $param['porcentaje'] = $this->input->post('porcentaje_edit');
        $param['id_proveedor'] = $this->input->post('id_proveedor_edit');

        $datos = $this->Medidores_model->modificar_medidor($param);
        echo json_encode($datos);
    }

    public function eliminar_medidor($id_medidor) {
        $this->Medidores_model->delete_medidor($id_medidor);
        echo json_encode(array(
            "status" => TRUE
        ));
    }

//=================== funcion para generar la plantilla ====================================//
    public function registar_asignacion() {
        extract($_POST);

        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("Y-m-d");
        
        $periodo=date("m");
        $anio=date("Y");
        $fecha_registro = substr($hoy, 0, 10);

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);

        $todos = $this->input->post('nro_dpto');
        $medidor = $this->input->post('id');
        $id_torre = $this->input->post('id_torre');
        $torre = $this->input->post('torre');
        $comunidad = $this->input->post('comunidad');

        if ($todos == 't') {

            $this->Medidores_model->carga_masiva($id_comunidad,$id_torre);
        }else{
            $this->Medidores_model->carga_masiva2($id_comunidad,$id_torre,$todos);
        }

        $arrayData2 = array(
            'id' => $id,
            'nro_dpto' => $nro_dpto,
            'id_comunidad' => $id_comunidad,
            'torre' => $torre,
            'periodo' => $periodo,
            'anio' => $anio,
            'fecha_registro' => $fecha_registro
        );
        
        //$this->Medidores_model->registar_lectura($arrayData2);
        
        $this->Medidores_model->upd_medidor($comunidad,$torre, $medidor,$periodo,$anio);
        $this->Medidores_model->delete_medidort();
        $this->Medidores_model->delete_duplicados();
        
        redirect('medidores/plantilla', 'refresh');
    }
    
    public function generar_plantilla() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();

        if ($rol == 1) {

            
        } else {
            $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);
            $data_comunidad['comunidad'] = $this->Egresos_model->get_comunidad($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/generar_plantilla_view',$data_medidores+$data_comunidad+$data_torre);
        $this->load->view('plantillas/footer');
    }

    

    public function lectura_medidores() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();

        if ($rol == 1) {

            $data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidorT();
            //$data_dpto['departamentos']      = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidoresT();
        } else {
            $data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
            //$data_dpto['departamentos']      = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/lectura_medidor_view', $data_lectura_medidor + $data_torre + $data_medidores);
        $this->load->view('plantillas/footer');
    }

    public function lectura_medidores2() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();

        if ($rol == 1) {

            //$data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidorT();
            $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidoresT();
        } else {
            //$data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor($id_comunidad);
            $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);
            
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/lectura_medidor_view2', $data_dpto + $data_medidores);
        $this->load->view('plantillas/footer');
    }

    public function lectura_medidores_comunidad() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);
        $id_medidor = $this->input->post('id_medidor');
        
        $data_comunidad = $this->Egresos_model->get_comunidad($id_comunidad);
        $Id=$data_comunidad[0]->nombre_comunidad;
        $periodo = $this->input->post('periodo');
        $anio = $this->input->post('anio');
        
        extract($_POST);

        $arrayData = array();

        if ($rol == 1) {

            $data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor_comunidad2($id_medidor,$periodo,$anio);
            $data_consumo_medidor['consumo'] = $this->Medidores_model->consumo_medidorT($id_medidor,$periodo,$anio);
            $data_montos_factura['montos'] = $this->Medidores_model->get_monto_factura($id_comunidad, $id_medidor,$periodo,$anio);
            $data_montos_factura_porcentaje['montos_porcenteje'] = $this->Medidores_model->get_monto_factura_porcentajeT($id_medidor,$periodo,$anio);
            $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidoresT();
            $data_m3['m3'] = $this->Medidores_model->get_m3T($id_medidor,$periodo,$anio);
        } else {
            $data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor_comunidad($id_comunidad,$Id, $id_medidor,$periodo,$anio);
            $data_consumo_medidor['consumo'] = $this->Medidores_model->consumo_medidor($Id, $id_medidor,$periodo,$anio);
            $data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);
            $data_montos_factura['montos'] = $this->Medidores_model->get_monto_factura($id_comunidad, $id_medidor,$periodo,$anio);
            $data_montos_factura_porcentaje['montos_porcenteje'] = $this->Medidores_model->get_monto_factura_porcentaje($id_comunidad, $id_medidor,$periodo,$anio);
            $data_m3['m3'] = $this->Medidores_model->get_m3($Id,$id_comunidad, $id_medidor,$periodo,$anio);
           
        }
        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/lectura_medidor_view3', $data_montos_factura_porcentaje+$data_consumo_medidor+$data_lectura_medidor + $data_dpto + $data_medidores+$data_montos_factura+$data_m3);
        $this->load->view('plantillas/footer');
    }

    public function actualizar_lectura_medidor() {
        extract($_POST);

        setlocale(LC_ALL, 'es_VE.UTF-8');
        date_default_timezone_set('America/Caracas');
        $hoy = date("Y-m-d");
        $fecha_registro = substr($hoy, 0, 10);
        $periodo=date("m");
        $anio=date("Y");
        $variablesSesion = $this->session->userdata('usuario');
        $torre = $this->input->post('torre');
        //$id_comunidad = ($variablesSesion['id_comunidad']);


        $arrayData = array(
            'id_medidor' => $id_medidor,
            'id_torre' => $torre,
            'nro_dpto' => $nro_dpto,
            'periodo' => $periodo,
            'anio' => $anio,
            'lectura_anterior' => $lectura_anterior,
            'lectura_actual' => $lectura_actual,
            'id_comunidad' => $id_comunidad,
            'fecha_registro' => $fecha_registro
        );
        
        $verificacion=$this->Medidores_model->existe_lectura($id_comunidad,$torre,$periodo,$anio,$id_medidor,$nro_dpto);
        if($verificacion==0){
           $this->Medidores_model->registar_lectura($arrayData); 
        }else{
            exit;
        }

    }

    public function actualizar_lectura() {

        $param['id'] = $this->input->post('id');
        $param['lectura_anterior'] = $this->input->post('lectura_anterior_edit');
        $param['lectura_actual'] = $this->input->post('lectura_actual_edit');
        $param['periodo'] = $this->input->post('periodo_edit');
        $param['anio'] = $this->input->post('anio_edit');

        $datos = $this->Medidores_model->modificar_lectura($param);
        echo json_encode($datos);
    }

    public function eliminar_lectura($id_lectura) {
        $this->Medidores_model->delete_lectura($id_lectura);
        echo json_encode(array(
            "status" => TRUE
        ));
    }

    public function obtener_dpto() {
        extract($_GET);
        $datos_dpto = $this->Ingresos_model->get_departamentos_torres($id_torre);
        $combo = "<select name='nro_dpto' id='nro_dpto' class='form-control'>";
        foreach ($datos_dpto as $dpto) {
            $combo .= "<option value='" . $dpto->nro_dpto . "'>$dpto->nro_dpto";
            
        }
        $combo .= "</select>";
        echo $combo;
    }
    
    public function obtener_dpto2() {
        extract($_GET);
        $datos_dpto = $this->Ingresos_model->get_departamentos_torres($id_torre);
        $combo = "<select name='nro_dpto' id='nro_dpto' class='form-control'><option value='t'>Todos</option>";
        foreach ($datos_dpto as $dpto) {
            $combo .= "<option value='" . $dpto->nro_dpto . "'>$dpto->nro_dpto";
            
        }
        $combo .= "</select>";
        echo $combo;
    }
    
    
    public function obtener_torre() {
        extract($_GET);
        $datos_dpto = $this->Ingresos_model->get_departamentos_torres2($id_torre);
        $combo = "<select name='id_torre' id='id_torre' class='form-control'>";
        foreach ($datos_dpto as $dpto) {
            $combo .= "<option value='" . $dpto->nombre_torre . "'>$dpto->nombre_torre";
        }
        $combo .= "</select>";
        echo $combo;
    }
    
    
    public function registrar_lectura() {

        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $rol = ($variablesSesion['rol']);

        $arrayData = array();
        
        if ($rol == 1) {

            //$data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor_comunidad2($id_medidor);
            //print_r($data_lectura_medidor);
            //$data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_comunidad['comunidad'] = $this->Egresos_model->get_comunidad($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidoresT();
        } else {
            //$data_lectura_medidor['lectura'] = $this->Medidores_model->consulta_lectura_medidor_comunidad($id_comunidad, $id_medidor);
            //print_r($data_lectura_medidor);
            //$data_dpto['departamentos'] = $this->Ingresos_model->get_departamentos($id_comunidad);
            $data_comunidad['comunidad'] = $this->Egresos_model->get_comunidad($id_comunidad);
            $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
            $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);
        }

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
        $this->load->view('procesos/registrar_lectura_view',$data_comunidad+$data_medidores+$data_torre);
        $this->load->view('plantillas/footer');
    }
    
    
     public function createcsv(){
        // Los datos
        $data["contenido"]= $this->Medidores_model->csv();
        // Cargamos la vista preparada con los headers CSV
        $this->load->view('procesos/lectura_view', $data);
     }
	
	public function exel()
 {
     
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $data_comunidad = $this->Egresos_model->get_comunidad($id_comunidad);
        $comunidad=$data_comunidad[0]->nombre_comunidad;
        $periodo=date("m");
        $anio=date("Y");
        $torre = $this->input->post('torre');
        $medidor = $this->input->post('medidor');
        
        $this->load->model('Medidores_model');
        to_excel($this->Medidores_model->get($comunidad,$periodo,$anio,$torre,$medidor), "Lecturas");
 }
 
 
 //================= Funcion que realiza la subida del archivo csv a la tabla de lectura de medidores =====================//
     public function carga_masiva() {
        extract($_POST);
        $tipo = $_FILES['archivo']['type'];
        //print_r($tipo); exit;
        $tamanio = $_FILES['archivo']['size'];
        $archivotmp = $_FILES['archivo']['tmp_name'];
        
        if ($tipo == "application/vnd.ms-excel"){
        //cargamos el archivo
        $lineas = file($archivotmp);

        //inicializamos variable a 0, esto nos ayudará a indicarle que no lea la primera línea
        $i = 0;

        //Recorremos el bucle para leer línea por línea
        foreach ($lineas as $linea_num => $linea) {
            //abrimos bucle
            /* si es diferente a 0 significa que no se encuentra en la primera línea 
              (con los títulos de las columnas) y por lo tanto puede leerla */
            if ($i != 0) {
                //abrimos condición, solo entrará en la condición a partir de la segunda pasada del bucle.
                /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irá 
                  leyendo hasta que encuentre un ; */
                $datos = explode(";", $linea);

                //Almacenamos los datos que vamos leyendo en una variable
                //usamos la función utf8_encode para leer correctamente los caracteres especiales
                
            $nro_dpto = utf8_encode($datos[0]);
            $periodo = utf8_encode($datos[1]);
            $anio = utf8_encode($datos[2]);
            $lectura_anterior = utf8_encode($datos[3]);
            $lectura_actual = utf8_encode($datos[4]);
            $id_medidor = utf8_encode($datos[5]);
            $id_comunidad = utf8_encode($datos[6]);
            $torre = utf8_encode($datos[7]);

            $data_comunidad['comunidad'] = $this->Egresos_model->get_comunidad($id_comunidad);

            $arrayData = array(
            'id_medidor' => $id_medidor,
            'id_torre' => $torre,
            'nro_dpto' => $nro_dpto,
            'periodo' => $periodo,
            'anio' => $anio,
            'lectura_anterior' => $lectura_anterior,
            'lectura_actual' => $lectura_actual,
            'id_comunidad' => $id_comunidad
            
           );
            $data['response'] = 'Archivo Cargado...!!!';
            
            $this->Medidores_model->registar_lectura2($arrayData);
            $this->Medidores_model->delete_duplicados();
            //$this->Medidores_model->delete_nulls();
            $this->Medidores_model->delete_dpto_invalido();
            $this->Medidores_model->delete_medidor_invalido();
            $this->Medidores_model->delete_comunidad_invalido();
            //$this->Medidores_model->delete_torre_invalido();

                //guardamos en base de datos la línea leida
                // mysql_query("INSERT INTO datos(nombre,edad,profesion) VALUES('$nombre','$edad','$profesion')");
                //cerramos condición
            }

            /* Cuando pase la primera pasada se incrementará nuestro valor y a la siguiente pasada ya 
              entraremos en la condición, de esta manera conseguimos que no lea la primera línea. */
            $i++;
            //cerramos bucle
        }
         $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <i class='icon fa fa-check'></i>Archivo subido correctamente...</div>");
        redirect('Medidores/registrar_lectura', 'refresh');
       }else{

           $this->session->set_flashdata('warning', "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <i class='icon fa fa-close'></i> Alerta..! El tipo de Archivo debe ser solamente .CSV...</div>");
            redirect('Medidores/registrar_lectura', 'refresh');
       }
    
     }
    
    
    
    public function subir_ministerio() {

        $tipo = $_FILES['archivo']['type'];
        $tamanio = $_FILES['archivo']['size'];
        $archivotmp = $_FILES['archivo']['tmp_name'];
        if ($tipo == "text/csv") {

            //cargamos el archivo
            $lineas = file($archivotmp);

            //inicializamos variable a 0, esto nos ayudarÃ¡ a indicarle que no lea la primera lÃ­nea
            $i = 0;

            //Recorremos el bucle para leer lÃ­nea por lÃ­nea
            foreach ($lineas as $linea_num => $linea) {
                //abrimos bucle
                /* si es diferente a 0 significa que no se encuentra en la primera lÃ­nea 
                  (con los tÃ­tulos de las columnas) y por lo tanto puede leerla */
                if ($i != 0) {
                    //abrimos condiciÃ³n, solo entrarÃ¡ en la condiciÃ³n a partir de la segunda pasada del bucle.
                    /* La funcion explode nos ayuda a delimitar los campos, por lo tanto irÃ¡ 
                      leyendo hasta que encuentre un ; */
                    $datos = explode(";", $linea);
                    
                    //Almacenamos los datos que vamos leyendo en una variable
                    //usamos la funciÃ³n utf8_encode para leer correctamente los caracteres especiales

                    $ministerio_nombre = utf8_encode($datos[0]);
                    $apellidos = utf8_encode($datos[1]);
                    $nombres = utf8_encode($datos[2]);
                    $cedula = utf8_encode($datos[3]);
                    $tlf = utf8_encode($datos[4]);
                    $ubicacion = utf8_encode($datos[5]);
                    $estados_nombre = utf8_encode($datos[6]);
                    $id_municipio = utf8_encode($datos[7]);
                    $localidad = utf8_encode($datos[8]);
                    $nom = utf8_encode($datos[9]);
                    
                    $array = array();

                    $array[0] = $ministerio_nombre;
                    $array[1] = $apellidos;
                    $array[2] = $nombres;
                    $array[3] = $cedula;
                    $array[4] = $tlf;
                    $array[5] = $ubicacion;
                    $array[6] = $estados_nombre;
                    $array[7] = $id_municipio;
                    $array[8] = $localidad;
                    $array[9] = $nom;

                    $this->Pgsql->SELECTPLSQL('insertar_registro_ministerio2', $array);
                    $this->session->set_flashdata('success', "<div class='alert alert-success alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <i class='icon fa fa-check'></i> Suceso..! Archivo Subido exitosamente...</div>");

                    //cerramos condiciÃ³n
                }

                /* Cuando pase la primera pasada se incrementarÃ¡ nuestro valor y a la siguiente pasada ya 
                  entraremos en la condiciÃ³n, de esta manera conseguimos que no lea la primera lÃ­nea. */
                $i++;
                //cerramos bucle
            }
            redirect('Registro/ministerio', 'refresh');
        } else {
            /* En caso de que el archivo no se CSV se muestra el siguiente mensaje */
            $this->session->set_flashdata('warning', "<div class='alert alert-warning alert-dismissable'>
                <button type='button' class='close' data-dismiss='alert'>&times;</button>
                <i class='icon fa fa-check'></i> Alerta..! El tipo de Archivo debe ser solamente .CSV...</div>");
            redirect('Registro/ministerio', 'refresh');
        }
    }
    
    
    
    
    
    
    
    
 
 
 
 	public function plantilla()
 {
     
        $variablesSesion = $this->session->userdata('usuario');
        $id_comunidad = ($variablesSesion['id_comunidad']);
        $data_comunidades['comunidades']  = $this->Egresos_model->nombre_comunidad($id_comunidad);
        $data_torre['torres'] = $this->Ingresos_model->get_torres($id_comunidad);
        $data_medidores['medidores'] = $this->Medidores_model->get_medidores($id_comunidad);

        $this->load->view('plantillas/administracion/header');
        $this->load->view('plantillas/menu');
   		$this->load->view('procesos/plantilla_view',$data_comunidades+$data_torre+$data_medidores); 
 }

}