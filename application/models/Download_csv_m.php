<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Download_csv_m extends CI_Model {

    function __construct(){
        parent::__construct();
        $this->load->database('SGA',TRUE);
    }
    function get_tablas($schemaname='gestion_alimentaria'){

        $query = $this->db->query("SELECT tablename FROM pg_tables WHERE schemaname=?",$schemaname);
  
        // si hay resultados
        if ($query->num_rows()>0){
            $arrDatos = array();

            // almacenamos en una matriz bidimensional
            foreach($query->result() as $row){
                $nombre_tabla = htmlspecialchars($row->tablename,ENT_QUOTES);
                $arrDatos[$nombre_tabla] = $nombre_tabla;
            }
        
            $query->free_result();
            return $arrDatos;            
        }
    }

    function get_datos_tabla($sTabla,$schemaname='mi_esquema'){

        if(empty($sTabla)){
            return false;
        }
        // limpiamos los datos recibidos..
        $schemaname = $this->db->escape_str($schemaname);
        $sTabla    = $this->db->escape_str($sTabla);
        
        // opciones del csv
        $delimitador = ";";
        $nueva_linea = "\r\n";

        $this->load->dbutil();
        $query = $this->db->query("SELECT * FROM $schemaname.$sTabla");

        // generamos el csv
        return $this->dbutil->csv_from_result($query, $delimitador, $nuevalinea);
    } 
}
?>