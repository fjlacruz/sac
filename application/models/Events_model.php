<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Events_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function upd($param) {
        $campos = array(
            'rol' => $param['rol'],
            'estatus' => $param['estatus'],
            'id_comunidad' => $param['id_comunidad'],
        );

        $this->db->where('id_usuario', $param['id']);
        $this->db->update('t_usuarios', $campos);


        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function get() {

        $query = $this->db->query("select * from t_usuarios");

        return $query->result();
    }

    public function get_id($id = null) {


        if (!is_null($id)) {
            $query = $this->db->query("select * from t_usuarios where id_usuario = '{$id}' ");

            if ($query->num_rows() === 1) {
                return $query->row_array();
            }

            return null;
        }
    }
    public function delete_user($id_usuario)
	{
		$this->db->where('id_usuario', $id_usuario);
	
	    $this->db->delete('t_usuarios');
	}

}

/* End of file events_model.php */
/* Location: ./application/models/events_model.php */