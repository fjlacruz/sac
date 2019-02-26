<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Remuneraciones_model extends CI_Model {

	function __construct()
	{
		parent::__construct();
	}
	
        
  public function registrar_trabajador($array){
    extract($array);
    $sql = "INSERT INTO t_trabajador 
       (rut,nombres_trabajador,apellidos_trabajador,direccion,id_comunidad,
       telf_local,telf_celular,email,sexo,nacionalidad,id_cargo,fecha_contrato,tipo_contrato,tipo_sueldo,
       tipo_trabajador,jubilado,paga_afp,horas_semanales,regimen_provisional,afp,caja_ex_regimen,cargas_normales,
       cargas_maternales,cargas_invalidez,tramo_sueldo,sueldo_base,movilizacion,colacion,bono_mensual,
       bono_proporcional_dias,bono_afecta_remuneraciones,prevencion_salud,id_usuario) 
       VALUES 
       ('{$rut}','{$nombres_trabajador}','{$apellidos_trabajador}','{$direccion}','{$id_comunidad}','{$telf_local}','{$telf_celular}','{$email}',
        '{$sexo}','{$nacionalidad}','{$id_cargo}','{$fecha_contrato}','{$tipo_contrato}','{$tipo_sueldo}',
        '{$ttipo_trabajador}','{$jubilado}','{$paga_afp}','{$horas_semanales}','{$regimen_provisional}','{$afp}',
        '{$caja_ex_regimen}','{$cargas_normales}','{$cargas_maternales}','{$cargas_invalidez}','{$tramo_sueldo}','{$sueldo_base}',
        '{$movilizacion}','{$colacion}','{$bono_mensual}','{$bono_proporcional_dias}','{$bono_afecta_remuneraciones}','{$prevencion_salud}','{$id_usuario}')";
    $this->db->query($sql);
    //return 1;
    if ($this->db->affected_rows() > 0) {
      return 1;
    }
    else{
      return 0;
    }
} 

 public function trabajadores($id_comunidad) 
   {
      $query = $this->db->query
     ("select t.id_trabajador,t.rut,t.nombres_trabajador, t.apellidos_trabajador,t.direccion, t.id_comunidad, c.nombre_comunidad,
       t.telf_local, t.	telf_celular, t.email, t.sexo, t.nacionalidad, t.id_cargo,ca.descripcion_cargo,t.fecha_contrato, t.tipo_contrato, t.tipo_sueldo,
       t.tipo_trabajador, t.jubilado, t.paga_afp, t.horas_semanales, t.regimen_provisional, t.afp,t.caja_ex_regimen,t.cargas_normales,
       t.cargas_maternales,t.cargas_invalidez, t.tramo_sueldo, t.sueldo_base, t.movilizacion, t.colacion, t.bono_mensual,
       t.bono_proporcional_dias,t.bono_afecta_remuneraciones,t.fecha_registro,t.id_usuario,t.estatus,t.prevencion_salud
       
       from t_trabajador t
       
       left join n_comunidad c on (t.id_comunidad=c.id_comunidad)
       left join n_cargos ca on (t.id_cargo=ca.id_cargo)
       
       where c.id_comunidad='{$id_comunidad}'");
       
      return $query->result();  
  }
  
  public function trabajadoresT() 
   {
      $query = $this->db->query
     ("select t.id_trabajador,t.rut,t.nombres_trabajador, t.apellidos_trabajador,t.direccion, t.id_comunidad, c.nombre_comunidad,
       t.telf_local, t.	telf_celular, t.email, t.sexo, t.nacionalidad, t.id_cargo,ca.descripcion_cargo,t.fecha_contrato, t.tipo_contrato, t.tipo_sueldo,
       t.tipo_trabajador, t.jubilado, t.paga_afp, t.horas_semanales, t.regimen_provisional, t.afp,t.caja_ex_regimen,t.cargas_normales,
       t.cargas_maternales,t.cargas_invalidez, t.tramo_sueldo, t.sueldo_base, t.movilizacion, t.colacion, t.bono_mensual,
       t.bono_proporcional_dias,t.	bono_afecta_remuneraciones,t.fecha_registro, t.id_usuario,t.estatus,t.prevencion_salud
       
       from t_trabajador t
       
       left join n_comunidad c on (t.id_comunidad=c.id_comunidad)
       left join n_cargos ca on (t.id_cargo=ca.id_cargo)");
       
      return $query->result();  
  }
  
  
  public function existe_rut($rut) {
        $sql = "SELECT * from t_trabajador where rut = '{$rut}'";
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
    
     public function get_id($id = null) {

        if (!is_null($id)) {
            $query = $this->db->query("select * from t_trabajador where id_trabajador = '{$id}' ");
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
  
   public function get_cargos() 
   {
      $query = $this->db->query
     ("select id_cargo,descripcion_cargo from n_cargos");
       
      return $query->result();  
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