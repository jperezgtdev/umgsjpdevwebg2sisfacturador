<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProductoModel extends CI_Model {

    public function getProductos() {
        //$estado = "Activo";
        $this->db->select('p.id_producto, p.producto, p.existencia, c.categoria');
        $this->db->from('producto p');
        $this->db->join('categoria c', 'p.id_categoria = c.id_categoria');
        //$this->db->where('u.estado',$estado);


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Devolver un array con los resultados
        } else {
            return array(); // Devolver un array vacío si no hay datos
        }
    }

    public function ObtenerProductoPorId($id_producto) {
        $this->db->select('p.id_producto, p.producto, p.existencia, p.id_categoria,');
        $this->db->from('producto p');
        $this->db->where('p.id_producto', $id_producto);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row(); // Devolver un solo resultado (la fila con los datos del usuario y su rol)
        } else {
            return null; // Devolver null si no hay datos
        }
    }

    public function actualizarProducto($id_producto, $nuevoProducto, $nuevaCategoria, $nuevaExistencia) {
        $datosActualizados = array(
            'producto' => $nuevoProducto,
            'id_categoria' => $nuevaCategoria,
            'existencia' => $nuevaExistencia,
           
        );
    
        
        $this->db->where('id_producto', $id_producto);
        $this->db->update('producto', $datosActualizados);
    }
    


    
}
