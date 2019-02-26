<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Copropietarios_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
        
  public function registar_copropietarios($array){
    extract($array);
    $sql = "INSERT INTO t_copropietarios 
    (rut,nombres,apellidos,nro_dpto,alicuota_dpto,alicuota_maletero,alicuota_estacionamiento,alicuota_total,telefono,email,fecha_registro,id_usuario, id_comunidad, id_torre) 
    VALUES 
    ('{$rut}','{$nombres}','{$apellidos}','{$nro_dpto}','{$alicuota_dpto}','{$alicuota_maletero}','{$alicuota_estacionamiento}','{$alicuota_total}','{$telefono}','{$email}','{$fecha_registro}','{$id_usuario}','{$id_comunidad}','{$id_torre}')";
    $this->db->query($sql);
    //return 1;
    if ($this->db->affected_rows() > 0) {
      return 1;
    }
    else{
      return 0;
    }
} 

 public function copropietarios($id_comunidad) 
   {
      $query = $this->db->query
     ("select c.id_copropietario,c.rut,c.nombres,c.apellidos,c.alicuota_dpto,c.alicuota_estacionamiento,
       c.alicuota_maletero,c.alicuota_total,c.email,c.telefono,c.fecha_registro,c.id_usuario,c.nro_dpto, 
       c.estatus, u.nombre_comunidad,c.id_comunidad,c.id_torre, t.nombre_torre
       from t_copropietarios c
       left join n_comunidad u on (u.id_comunidad=c.id_comunidad)
       left join n_torres t on (t.id_torre=c.id_torre)
       
       where c.id_comunidad='{$id_comunidad}'");
       
      return $query->result();  
  }
  
  public function copropietariosT() 
   {
      $query = $this->db->query
     ("select c.id_copropietario,c.rut,c.nombres,c.apellidos,c.alicuota_dpto,c.alicuota_estacionamiento,
       c.alicuota_maletero,c.alicuota_total,c.email,c.telefono,c.fecha_registro,c.id_usuario,c.nro_dpto, 
       c.estatus, u.nombre_comunidad,c.id_comunidad,c.id_torre, t.nombre_torre
       from t_copropietarios c
       left join n_comunidad u on (u.id_comunidad=c.id_comunidad)
       left join n_torres t on (t.id_torre=c.id_torre)
       
       
       ");
       
      return $query->result();  
  }
  
  
   public function torresT() 
   {
      $query = $this->db->query
     ("select id_torre,nombre_torre from n_torres");
       
      return $query->result();  
  }
  public function torres($id_comunidad) 
   {
      $query = $this->db->query
     ("select id_torre,nombre_torre from n_torres where id_comunidad='{$id_comunidad}'");
       
      return $query->result();  
  }
   public function get_idCop($id = null) {

        if (!is_null($id)) {
            $query = $this->db->query("select  *
              from t_copropietarios where id_copropietario = '{$id}' ");
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    public function existe_rut($rut) {
        $sql = "SELECT * from t_copropietarios where rut = '{$rut}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    public function existe_dpto($nro_dpto) {
        $sql = "SELECT * from t_copropietarios where nro_dpto = '{$nro_dpto}'";
        $query = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    
  
 public function modificar_copropietarios($id,$rut,$nombres,$apellidos,$alicuota_dpto,$alicuota_estacionamiento,
                                          $alicuota_maletero,$alicuota_total,$estatus,$telefono,$email, $nro_dpto) {
       // extract($$arrayData2);
    $sql = "UPDATE t_copropietarios set rut = '{$rut}',
                                    nombres = '{$nombres}',
                                    apellidos = '{$apellidos}',
                                    alicuota_dpto = '{$alicuota_dpto}',
                                    alicuota_estacionamiento = '{$alicuota_estacionamiento}',
                                    alicuota_maletero = '{$alicuota_maletero}',
                                    alicuota_total = '{$alicuota_total}',
                                    estatus = '{$estatus}',
                                    telefono = '{$telefono}',
                                    email = '{$email}',
                                    nro_dpto = '{$nro_dpto}'
                                  where id_copropietario = {$id}";
                                  
    $query = $this->db->query( $sql );
       // return $query->result();          
} 
public function cantidad_copropietarios($id_comunidad){

     $query = $this->db-> query("SELECT count(*) as cantidad  FROM t_copropietarios where id_comunidad='{$id_comunidad}'");
       // si hay resultados
    return $query->result();
}
  public function cantidad_copropietariosT(){

     $query = $this->db-> query("SELECT count(*) as cantidad  FROM t_copropietarios");
       // si hay resultados
    return $query->result();
}
public function delete_copropietario($id_copropietario)
	{
		$this->db->where('id_copropietario', $id_copropietario);
	
	    $this->db->delete('t_copropietarios');
	}
  

}
?>