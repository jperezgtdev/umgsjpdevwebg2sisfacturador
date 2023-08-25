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
    

    public function getCategoria() {
        $this->db->select('*');
        $this->db->from('categoria');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return array();
        }
    }

    public function ObtenerProductoPorId($id_producto) {
        $this->db->select('p.id_producto, p.producto, p.existencia, p.id_categoria,');
        $this->db->from('producto p');
        $this->db->where('p.id_producto', $id_producto);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row(); 
        } else {
            return null;
        }
    }

    public function actualizarProducto($id_producto, $nuevoProducto, $nuevaCategoria, $nuevaExistencia, $usuario_mod, $fecha_mod) {
        $datosActualizados = array(
            'producto' => $nuevoProducto,
            'id_categoria' => $nuevaCategoria,
            'existencia' => $nuevaExistencia,
            'fecha_mod' => $usuario_mod,
            'usuario_mod' => $usuario_mod
           
        );
    
        $this->db->where('id_producto', $id_producto);
        $this->db->update('producto', $datosActualizados);
    }


    public function insertarProducto($data) {
        $this->db->insert('producto', $data);
    }
    

    public function eliminarProducto($id_producto) {
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d');
        $nuevoEstado = "Inactivo";
        $datosActualizados = array(
            'estado' => $nuevoEstado,
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod
        );
        $this->db->where('id_producto', $id_producto);
        $this->db->update('producto', $datosActualizados);
    }
    

}