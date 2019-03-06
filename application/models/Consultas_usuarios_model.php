<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Consultas_usuarios_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }


    public function consultar_usuario($usuario = false, $clave = false) {
        $parametros = get_defined_vars();
        $sql = "SELECT cedula,nombres,apellidos,rol,id_usuario 
		from t_usuarios 
		where usuario='{$usuario}' and clave='{$clave}' and estatus='1'";
        $query = $this->db->query($sql);
        $result = $query->result();
        return $query->result();
    }

   

}
?>
