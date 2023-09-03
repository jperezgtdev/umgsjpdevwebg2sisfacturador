<?php
defined('BASEPATH') or exit('No direct script access allowed');

class FacturaModel extends CI_Model
{

    public function getFacturas()
    {
        $this->db->select('f.id_factura,c.nombre, f.fecha, f.serie, f.numero, f.estado, f.referencia');
        $this->db->from('factura f');
        $this->db->join('cliente c', 'f.id_cliente = c.id_cliente');
        $this->db->order_by('f.referencia', 'ASC');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }

    public function buscar_cliente($term) {
        $this->db->select('id_cliente, nombre, nit'); 
        $this->db->from('cliente'); 
        $this->db->group_start();
        $this->db->like('nit', $term); 
        $this->db->or_like('nombre', $term);
        $this->db->group_end();
        $this->db->where('estado', 'Activo');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    

    public function buscar_producto($term) {
        $this->db->select('id_producto, producto'); 
        $this->db->from('producto'); 
        $this->db->like('producto', $term); 
        $this->db->where('estado', 'Activo');
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function ObtenerProductoPorId($id_producto)
    {
        $this->db->select('p.id_producto, p.producto, p.existencia, p.id_categoria,');
        $this->db->from('producto p');
        $this->db->where('p.id_producto', $id_producto);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {

            return $query->row();
        } else {
            return array();
        }
    }    
    

    public function bajaFactura($id_factura)
    {
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d');
        $nuevoEstado = "Anulada";

        $datosActualizados = array(
            'estado' => $nuevoEstado,
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod
        );
        
        $this->db->where('id_factura', $id_factura);
        $this->db->update('factura', $datosActualizados);


    }

    public function obtenerDetallesFactura($id_factura) {
        $this->db->where('id_factura', $id_factura);
        $query = $this->db->get('detalle_factura');
        return $query->result();
    }
    public function actualizarExistencia($producto_id, $nueva_existencia) {
        $this->db->where('id_producto', $producto_id);
        $this->db->update('producto', array('existencia' => $nueva_existencia));
    }
        

    public function insertar_factura($data_factura) {
        $this->db->insert('Factura', $data_factura);
        return $this->db->insert_id();
    }
    
    public function insertar_detalle($data_detalle) {
        $this->db->insert('Detalle_Factura', $data_detalle);
    }
    
    public function num_factura() {
        $query = $this->db->query("SELECT MAX(ID_factura) AS max_id FROM Factura");
        
        $row = $query->row();
        $max_id = $row->max_id;
        $numero_siguiente =  'A0000' .($max_id + 1);

        return $numero_siguiente;
    }

    public function getDetalles($id_factura){
        $this->db->select('c.nombre AS clien,c.direccion, c.nit AS nit, u.usuario AS atendio, f.serie, f.numero, f.authorization, f.fecha AS fecha, df.cantidad, pr.producto, df.precio');
        $this->db->from('Detalle_Factura df');
        $this->db->join('Factura f', 'df.id_factura = f.id_factura');
        $this->db->join('Cliente c', 'f.id_cliente = c.id_cliente');
        $this->db->join('Usuario u', 'f.usuario_crear = u.id_usuario');
        $this->db->join('Producto pr', 'df.id_producto = pr.id_producto');
        $this->db->where('f.id_factura', $id_factura);
        
        $query = $this->db->get();
        return $query->result();
    }

    public function obtener_existencia($id_producto) {
        $this->db->select('existencia');
        $this->db->where('id_producto', $id_producto);
        $query = $this->db->get('producto');
        $row = $query->row();
        return ($row) ? $row->existencia : 0;
    }
    public function actualizar_existencia($id_producto, $nueva_existencia) {
        $this->db->where('id_producto', $id_producto);
        $this->db->update('producto', array('existencia' => $nueva_existencia));
    }
}