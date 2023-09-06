<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompraModel extends CI_Model {

    public function getCompraData() {
        $estado="Activo";
        $this->db->select('c.id_compra, p.producto, c.precio_compra, c.cantidad');
        $this->db->from('compra c');
        $this->db->join('producto p', 'c.id_producto = p.id_producto');
        $this->db->where('c.estado',$estado);
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
        $this->db->select('id_proveedor, nombre');
        $this->db->where('estado','Activo');
        $query = $this->db->get('proveedor');
        
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function buscar_productos($term) {
        $estado="Activo";
        $this->db->select('id_producto, producto');
        $this->db->from('producto');
        $this->db->like('producto', $term);
        $this->db->where('estado', $estado);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }    

    public function insertar_Compra($data) {
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