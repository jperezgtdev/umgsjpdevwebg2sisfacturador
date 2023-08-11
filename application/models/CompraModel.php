<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompraModel extends CI_Model {
    public function obtener_proveedores() {
        $query = $this->db->get('proveedor'); // 'proveedores' es el nombre de la tabla en la base de datos
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function buscar_productos($term) {
        $this->db->select('id_producto, producto'); // Seleccionar solo las columnas necesarias
        $this->db->from('producto'); // 'producto' es el nombre de la tabla en la base de datos
        $this->db->like('producto', $term); // Aplicar el término de búsqueda en la columna 'producto'
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }    

    public function insertar_Compra($data) {
        // Insertar el registro en la tabla "Usuario"
        $this->db->insert('Compra', $data);
    }

}