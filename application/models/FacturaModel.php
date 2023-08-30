<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class FacturaModel extends CI_Model {

    public function getProductos() {
        $estado = "Activo";
        $this->db->select('c.nombre, f.fecha, f.serie, f.numero');
        $this->db->from('factura f');
        $this->db->join('cliente c', 'f.id_cliente = c.id_cliente');
        $this->db->where('f.estado', $estado);
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
}