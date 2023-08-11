<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompraModel extends CI_Model {

    public function getCompraData() {
        $this->db->select('c.id_compra, p.producto, c.precio_compra, c.cantidad');
        $this->db->from('compra c');
        $this->db->join('producto p', 'c.id_producto = p.id_producto');
        $this->db->where('c.estado','Activo');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return array(); 
        }
    }
    public function obtenerCompraPorId($idCompra) {
        $this->db->where('id_compra', $idCompra);
        $query = $this->db->get('compra');
        
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return null;
        }
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
    public function obtener_proveedores() {
        $this->db->where('estado','Activo');
        $query = $this->db->get('proveedor');
        
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
        $this->db->where('estado', 'Activo');
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

    public function bajaCompra($idCompra) {
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d');
        $nuevoEstado = "Inactivo";
        $datosActualizados = array(
            'estado' => $nuevoEstado,
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod
        );
        $this->db->where('id_compra', $idCompra);
        $this->db->update('compra', $datosActualizados);
    }

}