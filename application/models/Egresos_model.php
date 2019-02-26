<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Egresos_model extends CI_Model
{
    
    function __construct()
    {
        parent::__construct();
    }
    
    // ============== Funcion para registrar egresos ==========================//
    
    public function registar_Egreso($array)
    {
        extract($array);
        $sql = "INSERT INTO t_egresos( id_comunidad,   id_proveedor,     monto,    nro_cuotas,     medio_pago,     id_cheque,     periodo,     anio,      id_item,     descripcion_item,     id_pago,     fecha_registro,      id_torre,       nro_dpto,      id_usuario,       adjunto,  id_medidor ) 
                              VALUES ({$id_comunidad},{$id_proveedor}, '{$monto}','{$nro_cuotas}','{$medio_pago}','{$id_cheque}','{$periodo}','{$anio}', '{$id_item}','{$descripcion_item}','{$id_pago}','{$fecha_registro}', '{$id_torre}' ,'{$nro_dpto}','{$id_usuario}', '{$adjunto}', '{$id_medidor}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public function registar_Egreso2($array)
    {
        extract($array);
        $sql = "INSERT INTO t_egresos( id_comunidad,   id_proveedor,     monto,    nro_cuotas,     medio_pago,     id_cheque,     periodo,     anio,      id_item,     descripcion_item,     id_pago,     fecha_registro,      id_torre,             id_usuario,       adjunto, id_medidor) 
                              VALUES ({$id_comunidad},{$id_proveedor}, '{$monto}','{$nro_cuotas}','{$medio_pago}','{$id_cheque}','{$periodo}','{$anio}', '{$id_item}','{$descripcion_item}','{$id_pago}','{$fecha_registro}', '{$id_torre}' ,'{$id_usuario}', '{$adjunto}', '{$id_medidor}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    // ============== Funcion para cargar la tabla de egresos ==========================//
    public function egresos_todos()
    {
        $query = $this->db->query("SELECT e.id_egreso,e.id_comunidad,co.nombre_comunidad,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario,e.estatus as estatus1,
              case when e.estatus= 1 then 'ACTIVO' else 'CERRADO' end estatus, e.id_usuario, u.nombres, u.apellidos
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  left join n_comunidad co on (e.id_comunidad=co.id_comunidad)
                  left join t_usuarios u  on (e.id_usuario=u.id_usuario)
                  order by id_egreso desc");
        
        return $query->result();
    }
    
    
    // ============== Funcion para cargar la tabla de egresos por comunidad ==========================//
    public function egresos_todos_comunidad($id_comunidad)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_comunidad,co.nombre_comunidad,e.id_proveedor,
                                   p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,
                                   e.descripcion_item,e.fecha_registro,e.id_usuario,e.estatus as estatus1,e.medio_pago,
                                   m.descripcion,e.id_pago,f.forma_pago,e.nro_dpto,
                                   case when e.estatus= 1 then 'PENDIENTE' else 'CANCELADO' end estatus, 
                                   e.id_usuario, u.nombres, u.apellidos,e.nro_cuotas,e.nro_cuotas_pagadas
                                  from t_egresos e
                                  
                                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                                  left join n_item i on (e.id_item=i.id_item)
                                  left join n_comunidad co on (e.id_comunidad=co.id_comunidad)
                                  left join t_usuarios u  on (e.id_usuario=u.id_usuario)
                                  left join n_medio_pago m  on (e.medio_pago=m.id_forma_pago)
                                  left join n_forma_pago f  on (e.id_pago=f.id_pago)
                                  
                                  where e.id_comunidad='{$id_comunidad}'
                                  order by id_egreso desc");
        
        return $query->result();
    }
    
     public function egresos_todos_comunidadT()
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_comunidad,co.nombre_comunidad,e.id_proveedor,
                                   p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,
                                   e.descripcion_item,e.fecha_registro,e.id_usuario,e.estatus as estatus1,e.medio_pago,
                                   m.descripcion,e.id_pago,f.forma_pago,
                                   e.nro_dpto,
                                   case when e.estatus= 1 then 'PENDIENTE' else 'CANCELADO' end estatus, 
                                   e.id_usuario, u.nombres, u.apellidos,e.nro_cuotas,e.nro_cuotas_pagadas
                                   
                                  from t_egresos e
                                  
                                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                                  left join n_item i on (e.id_item=i.id_item)
                                  left join n_comunidad co on (e.id_comunidad=co.id_comunidad)
                                  left join t_usuarios u  on (e.id_usuario=u.id_usuario)
                                  left join n_medio_pago m  on (e.medio_pago=m.id_forma_pago)
                                  left join n_forma_pago f  on (e.id_pago=f.id_pago)
                                  
                 
                                  order by id_egreso desc");
        
        return $query->result();
    }
    
    
    // ============== Funcion para consultar estatus del egreso ==========================//
    public function estatus_egreso()
    {
        //return $this->db->get('t_egresos')->row()->estatus;
        $query = $this->db->query("SELECT estatus from t_egresos");
        // si hay resultados
        return $query->result();
    }
    
    // ============== Funcion para consultar estatus del egreso por comunidad==========================//
    public function estatus_egreso_comunidad($id_comunidad)
    {
        //return $this->db->get('t_egresos')->row()->estatus;
        $query = $this->db->query("SELECT estatus from t_egresos where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    public function estatus_egreso_comunidadT()
    {
        //return $this->db->get('t_egresos')->row()->estatus;
        $query = $this->db->query("SELECT estatus from t_egresos");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para sumar los montos de los egresos ==============//
    public function get_suma_egresos()
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para sumar los montos de los egresos por comunidad==============//
    public function get_suma_egresos_comunidad($id_comunidad)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos  where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
     public function get_suma_egresos_comunidadT()
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para sumar los montos de los egresos por comunidad==============//
    public function get_suma_egresos_comunidad_total()
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos");
        // si hay resultados
        return $query->result();
    }
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_id($id_egreso)
    {
        $query = $this->db->query("SELECT e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,
                       e.medio_pago,case when periodo='1' then 'ENERO' when periodo='2' then 'FEBRERO'  
                       when periodo='3' then 'MARZO' when periodo='4' then 'ABRIL' 
                       when periodo='5' then 'MAYO' when periodo='6' then 'JUNIO' 
                       when periodo='7' then 'JULIO' when periodo='8' then 'AGOSTO'
                       when periodo='9' then 'SEPTIEMBRE' when periodo='10' then 'OCTUBRE' 
                       when periodo='11' then 'NOVIEMBRE' else 'DICIEMBRE'  end periodo ,
                       e.anio,i.item,e.fecha_registro,e.id_usuario,e.id_comunidad,
                       co.nombre_comunidad,co.direccion,e.descripcion_item
                       
                  from t_egresos e
                  
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  left join n_comunidad co on (e.id_comunidad=co.id_comunidad)
                  where e.estatus=1 and id_egreso= '{$id_egreso}'
                  
                 ");
        return $query->result();
    }
    
    
    // ============== Funcion para consultar el nombre de la comunidad ==========================//
    public function nombre_comunidad($id_comunidad)
    {
        $query = $this->db->query("SELECT id_comunidad, nombre_comunidad from n_comunidad  where id_comunidad='{$id_comunidad}'");
        return $query->result();
    }
    
    
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_detalles($id_egreso)
    {
        $query = $this->db->query("SELECT e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo,e.id_cheque, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.id_descripcion_item,d.descripcion_item,
                  e.fecha_registro,e.id_usuario, case when e.estatus=1 then 'Activo' else 'Cerrado' end estatus
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  left join n_descripcion_item d on (e.id_item=d.id_item)
                  where e.estatus=1 and id_egreso= '{$id_egreso}'
                  
                 ");
        return $query->result();
    }
    
    // ============== Funcion para consultar los montos de egresos ==========================//
    public function montos_todos()
    {
        $this->db->select('monto');
        $this->db->from('t_egresos');
        $query = $this->db->get();
        return $query->result();
    }
    
    // ============== Funcion para consultar id de la tabla de egresos y mostrar en la ventana modal ==========================// 
    public function get_id($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_comunidad,co.nombre_comunidad,e.id_proveedor,
                                   p.proveedor, e.monto, e.motivo, e.id_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.id_item,
                                   e.descripcion_item,e.fecha_registro,e.id_usuario,e.estatus as estatus1,e.medio_pago,
                                   m.descripcion,e.id_pago,f.forma_pago,
                                   e.nro_dpto,m.descripcion,
                                   case when e.estatus= 1 then 'PENDIENTE' else 'CANCELADO' end estatus, 
                                   e.id_usuario, u.nombres, u.apellidos,e.nro_cuotas,e.nro_cuotas_pagadas
                                   
                                  from t_egresos e
                                  
                                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                                  left join n_item i on (e.id_item=i.id_item)
                                  left join n_comunidad co on (e.id_comunidad=co.id_comunidad)
                                  left join t_usuarios u  on (e.id_usuario=u.id_usuario)
                                  left join n_medio_pago m  on (e.medio_pago=m.id_forma_pago)
                                  left join n_forma_pago f  on (e.id_pago=f.id_pago)
                                  
                                  
                                  where id_egreso = '{$id}' ");
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            
            return null;
        }
    }
    
    // ============== Funcion para consultar id de la tabla de egresos y mostrar en la ventana modal ==========================// 
    public function get_descripcion_item_id()
    {
        
        $query = $this->db->query("SELECT id_descripcion_item, descripcion_item from  n_descripcion_item");
        
        return $query->result();
    }
    // ============== Funcion para modificar egresos ==========================// 
    public function modificar_egreso($id, $id_proveedor_modal, $monto_modal, $id_cheque_modal, $medio_pago_modal, $periodo_modal, $anio_modal, $id_item_modal, $descripcion_item_modal,$id_pago_modal)
    {
        // extract($$arrayData2);
        $sql = "UPDATE  t_egresos set id_proveedor = '{$id_proveedor_modal}',
                                  monto = '{$monto_modal}', 
                                  id_cheque= '{$id_cheque_modal}',
                                  medio_pago= '{$medio_pago_modal}',
                                  periodo= '{$periodo_modal}',
                                  anio= '{$anio_modal}',
                                  id_item= '{$id_item_modal}',
                                  descripcion_item= '{$descripcion_item_modal}',
                                  id_pago= '{$id_pago_modal}'
                                  
                                  where id_egreso={$id}";
        
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    public function modificar_egreso2($id, $id_item2, $id_descripcion_item2)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  t_egresos set id_item = '{$id_item2}',
                                  id_descripcion_item = '{$id_descripcion_item2}'
                                  where id_egreso={$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    // ============== Funcion para cargar la tabla de egresos ==========================//
    public function proveedores_todosT()
    {
        $query = $this->db->query("SELECT p.id_proveedor,p.cod_proveedor,p.proveedor,p.fecha_registro,p.usuario,p.rut_dni,
                                  case when p.estatus= 1 then 'ACTIVO' else 'DESACTIVADO' end  estatus,c.nombre_comunidad,p.id_comunidad
                                  from n_proveedor p
                                  left join n_comunidad c on (c.id_comunidad=p.id_comunidad)");
        return $query->result();
    }
     public function proveedores_todos($id_comunidad)
    {
        $query = $this->db->query("SELECT p.id_proveedor,p.cod_proveedor,p.proveedor,p.fecha_registro,p.usuario,p.rut_dni,
                                  case when p.estatus= 1 then 'ACTIVO' else 'DESACTIVADO' end  estatus,c.nombre_comunidad,p.id_comunidad
                                  from n_proveedor p
                                  left join n_comunidad c on (c.id_comunidad=p.id_comunidad)
                                  where p.id_comunidad='{$id_comunidad}'");
        return $query->result();
    }
    // ============== Funcion para registrar Proveedores ==========================//
    
    public function registar_Proveedor($array)
    {
        extract($array);
        $sql = "INSERT INTO n_proveedor (cod_proveedor,proveedor,fecha_registro,usuario, rut_dni, id_comunidad) 
                          VALUES ('{$cod_proveedor}','{$proveedor}','{$fecha_registro}','{$usuario}','{$rut_dni}','{$id_comunidad}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    // ============== Funcion para consultar id de la tabla de proveedores y mostrar en la ventana modal ==========================// 
    public function get_idP($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_proveedor where id_proveedor = '{$id}' ");
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            
            return null;
        }
    }
    
    // ============== Funcion para modificar proveedores ==========================// 
    public function modificar_proveedor($id, $proveedor, $estatus, $rut_dni)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_proveedor set proveedor = '{$proveedor}',                           
                                      estatus= '{$estatus}',
                                      rut_dni= '{$rut_dni}'
                                      where id_proveedor={$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    
    
    //============== Funcion para obtener la lista de los Proveedores==============//
    public function get_proveedores($id_comunidad)
    {
        
        $query = $this->db->query("SELECT id_proveedor,proveedor from n_proveedor where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    public function get_proveedores2($id_comunidad)
    {
        
        $query = $this->db->query("SELECT m.id_proveedor,p.proveedor from t_medidores m 
                                  left join n_proveedor p on (m.id_proveedor=p.id_proveedor)
                                   where m.id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
     public function get_proveedoresT()
    {
        
        $query = $this->db->query("SELECT id_proveedor,proveedor from n_proveedor where estatus=1");
        // si hay resultados
        return $query->result();
    }
    public function get_proveedoresT2()
    {
        
        $query = $this->db->query("SELECT m.id_proveedor,p.proveedor from t_medidores m 
                                  left join n_proveedor p on (m.id_proveedor=p.id_proveedor)");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para obtener la lista de los Comunidades==============//
    public function get_comunidades()
    {
        
        $query = $this->db->query("SELECT id_comunidad,nombre_comunidad from n_comunidad where estatus=1");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para obtener la lista de los Comunidades==============//
    public function get_comunidad($id_comunidad)
    {
        
        $query = $this->db->query("SELECT nombre_comunidad,direccion,telefono from n_comunidad where estatus=1 and id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    // ============== Funcion para cargar la tabla de egresos ==========================//
    public function cheques_todosT()
    {
        $query = $this->db->query("SELECT c.id_cheque,c.nro_cheque,c.talonario,c.fecha_registro,c.usuario,
                                   case when c.estatus= 1 then 'ACTIVO' else 'DESACTIVADO' end  estatus,c.id_comunidad,
                                   co.nombre_comunidad
                                   from n_cheque c
                                   left join n_comunidad co on (c.id_comunidad=co.id_comunidad)");
        return $query->result();
    }
     public function cheques_todos($id_comunidad)
    {
        $query = $this->db->query("SELECT c.id_cheque,c.nro_cheque,c.talonario,c.fecha_registro,c.usuario,
                                   case when c.estatus= 1 then 'ACTIVO' else 'DESACTIVADO' end  estatus,c.id_comunidad,
                                   co.nombre_comunidad
                                   from n_cheque c
                                   left join n_comunidad co on (c.id_comunidad=co.id_comunidad)
                                   
                                   where c.id_comunidad='{$id_comunidad}'");
        return $query->result();
    }
    // ============== Funcion para registrar Cheques ==========================//
    
    public function registar_Cheque($array)
    {
        extract($array);
        $sql = "INSERT INTO n_cheque (  nro_cheque    ,   talonario    ,    cantidad   ,   fecha_registro    ,   usuario, id_comunidad) 
                          VALUES ('{$nro_cheque}' , '{$talonario}' , '{$cantidad}' , '{$fecha_registro}' , '{$usuario}', '{$id_comunidad}')";
        
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    // ============== Funcion para consultar id de la tabla de cheques y mostrar en la ventana modal ==========================// 
    public function get_idC($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_cheque where id_cheque = '{$id}' ");
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
     public function get_medio_pago()
    {
        
        $query = $this->db->query("SELECT * from n_medio_pago");
        // si hay resultados
        return $query->result();
    }
    // ============== Funcion para modificar cheques ==========================// 
    public function modificar_cheque($id, $nro_cheque, $talonario, $estatus)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_cheque set nro_cheque = '{$nro_cheque}',                           
                                 talonario  = '{$talonario}',
                                 estatus    = '{$estatus}'
                                 where id_cheque={$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    // ============== Funcion para actualizar estatus de cheques ==========================// 
    public function actualizar_estatus_cheque($id_cheque)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_cheque set estatus=2 where nro_cheque={$id_cheque}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    //============== Funcion para obtener la lista de los Cheques activos ==============//
    public function get_cheques($id_comunidad)
    {
        
        $query = $this->db->query("SELECT id_cheque,nro_cheque from n_cheque where id_comunidad='{$id_comunidad}' and estatus=1");
        // si hay resultados
        return $query->result();
    }
    public function get_chequesT()
    {
        
        $query = $this->db->query("SELECT id_cheque,nro_cheque from n_cheque where estatus=1");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para obtener la lista de los Cheques activos en inactivos==============//
    public function get_cheques2($id_comunidad)
    {
        
        $query = $this->db->query("SELECT id_cheque,nro_cheque from n_cheque  where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    
     public function get_cheques2T()
    {
        
        $query = $this->db->query("SELECT id_cheque,nro_cheque from n_cheque ");
        // si hay resultados
        return $query->result();
    }
    
    // ============== Funcion para cargar la tabla de item ==========================//
    public function item_todos()
    {
        $query = $this->db->query("SELECT i.id_item,i.item,i.fecha_registro,i.usuario,case when i.estatus= 1 then 'ACTIVO' else 'DESACTIVADO' end  estatus
               from n_item i
               
               ");
        return $query->result();
    }
    // ============== Funcion para cargar la tabla de descripcion de item ==========================//
    public function item_todos_id($id_item)
    {
        $query = $this->db->query("SELECT id_descripcion_item,descripcion_item,fecha_registro, case when estatus =1 then 'ACTIVO' else 'DESAHBILITADO' end estatus
              from n_descripcion_item i where id_item={$id_item} ");
        
        return $query->result();
    }
    
    // ============== Funcion para registrar Item ==========================//
    
    public function registar_Item($array)
    {
        extract($array);
        $sql = "INSERT INTO n_item (item,fecha_registro,usuario) 
                          VALUES ('{$item}','{$fecha_registro}', '{$usuario}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    // ============== Funcion para registrar descripcion del Item ==========================//
    
    public function registar_descripcion_Item($array)
    {
        extract($array);
        $sql = "INSERT INTO n_descripcion_item (id_item,  descripcion_item,     fecha_registro,      id_usuario) 
                                    VALUES ('{$id}','{$descripcion_item}','{$fecha_registro}', '{$id_usuario}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    
    //============== Funcion para obtener la descripcion del item==============//
    public function get_descripcion_item($id_item)
    {
        $query = $this->db->query("SELECT id_descripcion_item, descripcion_item from  n_descripcion_item where id_item={$id_item}");
        
        return $query->result();
    }
    
    // ============== Funcion para consultar id de la tabla de items y mostrar en la ventana modal ==========================// 
    public function get_idI($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_item where id_item = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    // ============== Funcion para consultar id de la tabla de descripcion de items y mostrar en la ventana modal ==========================// 
    public function get_idIdes($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_descripcion_item where id_descripcion_item = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    // ============== Funcion para modificar Items ==========================// 
    public function modificar_item($id, $item, $estatus)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_item set item = '{$item}',                           
                                      estatus= '{$estatus}'
                                      where id_item={$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    
    // ============== Funcion para modificar Items ==========================// 
    public function modificar_descripcion_item($id, $descripcion_item, $estatus)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_descripcion_item set descripcion_item = '{$descripcion_item}',                           
                                      estatus= '{$estatus}'
                                      where id_descripcion_item={$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    
    //============== Funcion para obtener la lista de los Cheques==============//
    public function get_item()
    {
        
        $query = $this->db->query("SELECT id_item,item from n_item where estatus=1");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para consultar si exixte un proveedor==============//
    public function existe_proveedor($proveedor)
    {
        $sql    = "SELECT * from n_proveedor where proveedor = '{$proveedor}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    //============== Funcion para consultar si exixte un proveedor==============//
    public function existe_rut_dni($rut_dni)
    {
        $sql    = "SELECT * from n_proveedor where rut_dni = '{$rut_dni}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    //============== Funcion para consultar si exixte un proveedor==============//
    public function existe_rut($rut)
    {
        $sql    = "SELECT * from n_comunidad where rut = '{$rut}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    //============== Funcion para consultar si exixte un cheque==============//
    public function existe_nro_cheque($nro_cheque)
    {
        $sql    = "SELECT * from n_cheque where nro_cheque = '{$nro_cheque}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    //============== Funcion para consultar si exixte un cheque==============//
    public function existe_nro_documento($nro_documento)
    {
        $sql    = "SELECT * from t_egresos where nro_documento = '{$nro_documento}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    //============== Funcion para consultar si exixte un Item ==============//
    public function existe_item($item)
    {
        $sql    = "SELECT * from n_item where item = '{$item}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    //============== Funcion para obtener el maximi id_proveedor ==============//
    public function max_id_proveedor($id_comunidad)
    {
        
        $query = $this->db->query("SELECT max( id_proveedor ) as max_id_proveedor 
                                  FROM n_proveedor where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
     public function max_id_proveedorT()
    {
        
        $query = $this->db->query("SELECT max( id_proveedor ) as max_id_proveedor FROM n_proveedor");
        // si hay resultados
        return $query->result();
    }
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_por_periodo_serv_bas($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=5");
        return $query->result();
    }
    
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_gastos_generales($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=6");
        return $query->result();
    }
    
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_servicios_seguros($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=7");
        return $query->result();
    }
    
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_otros_rubros($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=8");
        return $query->result();
    }
    
    // ============== Funcion para consultar un egreso segun su id==========================//
    public function egresos_por_periodo_administracion($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=1");
        return $query->result();
    }
    //============== Funcion para sumar los montos de los egresos por periodo==============//
    public function get_suma_egresos_admin_periodo($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}'  and id_comunidad='{$id_comunidad}' and id_item=1 ");
        // si hay resultados
        return $query->result();
    }
    
    //============== Funcion para sumar los montos de los egresos por periodo==============//
    public function get_suma_egresos_ser_bas($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}'  and id_comunidad='{$id_comunidad}' and id_item=5 ");
        // si hay resultados
        return $query->result();
    }
    
    //============== Funcion para sumar los montos de los egresos por periodo==============//
    public function get_suma_gastos_generales($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}'  and id_comunidad='{$id_comunidad}' and id_item=6 ");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para sumar los montos de los egresos por periodo==============//
    public function get_suma_servicios_seguros($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}'  and id_comunidad='{$id_comunidad}' and id_item=7 ");
        // si hay resultados
        return $query->result();
    }
    
    //============== Funcion para sumar los montos de los egresos por periodo==============//
    public function get_suma_rubros($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}'  and id_comunidad='{$id_comunidad}' and id_item=8 ");
        // si hay resultados
        return $query->result();
    }
    public function egresos_por_period_mantencion($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=3");
        return $query->result();
    }
    
    public function get_suma_egresos_man_periodo($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos  
     where periodo='{$periodo}' and anio='{$anio}' and id_comunidad='{$id_comunidad}' and id_item=3");
        // si hay resultados
        return $query->result();
    }
    
    public function egresos_por_period_comun($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=4");
        return $query->result();
    }
    
    public function get_suma_egresos_comun_periodo($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}' and id_comunidad='{$id_comunidad}' and id_item=4");
        // si hay resultados
        return $query->result();
    }
    
    public function egresos_por_period_varios($id_comunidad, $periodo, $anio)
    {
        $query = $this->db->query("SELECT e.nro_documento,e.id_egreso,e.id_proveedor,p.proveedor, e.monto, e.motivo, c.nro_cheque,e.medio_pago,e.periodo,e.anio,i.item,e.descripcion_item,e.fecha_registro,e.id_usuario 
                  from t_egresos e
                  left join n_proveedor p on (e.id_proveedor=p.id_proveedor)
                  left join n_cheque c on (e.id_cheque=c.id_cheque)
                  left join n_item i on (e.id_item=i.id_item)
                  where periodo='{$periodo}' and anio='{$anio}' and e.id_comunidad='{$id_comunidad}' and e.id_item=2");
        return $query->result();
    }
    
    public function get_suma_egresos_varios_periodo($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and anio='{$anio}' and id_comunidad='{$id_comunidad}' and id_item=2");
        // si hay resultados
        return $query->result();
    }
    public function get_suma_egresos_total_periodo($id_comunidad, $periodo, $anio)
    {
        
        $query = $this->db->query("SELECT SUM(monto) as monto from t_egresos where periodo='{$periodo}' and id_comunidad='{$id_comunidad}' and anio='{$anio}'");
        // si hay resultados
        return $query->result();
    }
    
    
    // ============== Funcion para cargar la tabla de comunidad ==========================//
    public function comunidades_todas()
    {
        $query = $this->db->query("SELECT id_comunidad,nombre_comunidad,direccion,fecha_registro,id_usuario,case when estatus=1 then 'Activa' else 'Deshabilitada' end estatus,
                  rut,telefono from n_comunidad where estatus=1");
        return $query->result();
    }
     public function torres_todas()
    {
        $query = $this->db->query("SELECT id_torre,nombre_torre from n_torres");
        return $query->result();
    }
    
    //============== Funcion para obtener el maximo id_comunidad ==============//
    public function max_id_comunidad()
    {
        
        $query = $this->db->query("SELECT max( id_comunidad ) as max_id_comunidadr FROM n_comunidad");
        // si hay resultados
        return $query->result();
    }
    
    // ============== Funcion para registrar descripcion del Item ==========================//
    
    public function registar_Comunidad($array)
    {
        extract($array);
        $sql = "INSERT INTO n_comunidad (nombre_comunidad,    direccion,       rut,     telefono,     fecha_registro,      id_usuario) 
                          VALUES ('{$nombre_comunidad}','{$direccion}', '{$rut}', '{$telefono}','{$fecha_registro}', '{$id_usuario}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
     public function registar_torre($array)
    {
        extract($array);
        $sql = "INSERT INTO n_torres (nombre_torre,id_comunidad) 
                          VALUES ('{$nombre_torre}','{$id}')";
        $this->db->query($sql);
        //return 1;
        if ($this->db->affected_rows() > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    //============== Funcion para consultar si exixte una comunidad==============//
    public function existe_comunidad($nombre_comunidad)
    {
        $sql    = "SELECT * from n_comunidad where nombre_comunidad = '{$nombre_comunidad}'";
        $query  = $this->db->query($sql);
        $result = $query->result();
        //print_r($result);
        //exit;
        if (isset($result[0])) {
            return "1";
        } else {
            return "0";
        }
    }
    
    // ============== Funcion para consultar id de la tabla de COMUNIDADES y mostrar en la ventana modal ==========================// 
    public function get_idCom($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_comunidad where id_comunidad = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    public function get_idTorr($id = null)
    {
        
        if (!is_null($id)) {
            $query = $this->db->query("select * from n_torres where id_torre = '{$id}' ");
            
            
            if ($query->num_rows() === 1) {
                return $query->row_array();
            }
            return null;
        }
    }
    
    // ============== Funcion para modificar Comunidads ==========================// 
    public function modificar_comunidad($id, $nombre_comunidad, $direccion, $estatus, $rut, $telefono)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  n_comunidad set nombre_comunidad = '{$nombre_comunidad}',                           
                                           direccion = '{$direccion}',
                                             estatus = '{$estatus}',
                                             rut = '{$rut}',
                                             telefono = '{$telefono}'
                                  where id_comunidad = {$id}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
     public function modificar_torre($id, $nombre_torre)
    {
        $sql   = "UPDATE  n_torres set nombre_torre = '{$nombre_torre}'                          
                                  where id_torre = '{$id}'";
        $query = $this->db->query($sql);
    }
    
    // ============== Funcion para consultar adjuntos==========================//
    public function getAdjunto($id_egreso)
    {
        return $this->db->where('id_egreso', $id_egreso)->get('t_egresos')->row()->adjunto;
    }
    // ============== Funcion para consultar adjuntos==========================//
    public function getAdjuntoId($id_egreso)
    {
        return $this->db->where('id_egreso', $id_egreso)->get('t_egresos')->row()->id_egreso;
    }
    // ============== Funcion para consultar adjuntos==========================//
    public function getAdjuntoId2($id_egreso)
    {
        $query = $this->db->query("SELECT id_egreso from t_egresos where id_egreso={$id_egreso}");
        return $query->result();
    }
    // ============== Funcion para modificar adjunto ==========================// 
    public function modificar_adjunto($id_egreso, $adjunto)
    {
        // extract($$arrayData2);
        $sql   = "UPDATE  t_egresos set adjunto = '{$adjunto}' where id_egreso={$id_egreso}";
        $query = $this->db->query($sql);
        // return $query->result();          
    }
    

    //============== Funcion para obtener la lista de los Departamenos==============//
    public function get_departamento()
    {
        
        $query = $this->db->query("SELECT id_departamento,descripcion_departamento from t_departamento");
        // si hay resultados
        return $query->result();
    }
    //============== Funcion para obtener la lista de las formas de pago ==============//
    public function get_forma_pago()
    {
        
        $query = $this->db->query("SELECT id_pago,forma_pago,fecha_registro,estatus from n_forma_pago");
        // si hay resultados
        return $query->result();
    }


    //=========== Funcion para obtener el estatus de la foto ( si tiene o no)==============//
    public function getEstatus_Foto($cedula)
    {
        $query = $this->db->query("SELECT estatus_foto FROM t_visitantes WHERE cedula={$cedula}");
        
        return $query->result();
    }
    
    public function cantidad_comunidades($id_comunidad)
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_comunidad where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    public function cantidad_comunidadesT()
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_comunidad");
        // si hay resultados
        return $query->result();
    }
    
    public function cantidad_proveedores($id_comunidad)
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_proveedor where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    public function cantidad_proveedoresT()
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_proveedor");
        // si hay resultados
        return $query->result();
    }
    
    public function cantidad_items($id_comunidad)
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_item ");
        // si hay resultados
        return $query->result();
    }
    public function cantidad_itemsT()
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_item");
        // si hay resultados
        return $query->result();
    }
    
    public function cantidad_cheques($id_comunidad)
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_cheque where id_comunidad='{$id_comunidad}'");
        // si hay resultados
        return $query->result();
    }
    public function cantidad_chequesT()
    {
        
        $query = $this->db->query("SELECT count(*) as cantidad  FROM n_cheque");
        // si hay resultados
        return $query->result();
    }
    public function delete_egresos($id_egreso)
	{
		$this->db->where('id_egreso', $id_egreso);
	
	    $this->db->delete('t_egresos');
	}
	public function delete_torre($id_torre)
	{
		$this->db->where('id_torre', $id_torre);
	
	    $this->db->delete('n_torres');
	}
	public function delete_comunidad($id_comunidad)
	{
		$this->db->where('id_comunidad', $id_comunidad);
	
	    $this->db->delete('n_comunidad');
	}
    public function delete_item($id_item)
	{
		$this->db->where('id_item', $id_item);
	
	    $this->db->delete('n_item');
	}
	public function delete_proveedor($id_proveedor)
	{
		$this->db->where('id_proveedor', $id_proveedor);
	
	    $this->db->delete('n_proveedor');
	}
	 public function get_medidores($id_proveedor)
    {
        $query = $this->db->query("select nombre_medidor from t_medidores where id_proveedor ='{$id_proveedor}'");
        return $query->result();
    }
}
?>