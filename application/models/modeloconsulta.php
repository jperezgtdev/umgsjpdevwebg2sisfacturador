<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modeloconsulta extends CI_Model {

    public function getUsuarioData() {
        $this->db->select('u.id_usuario, u.usuario, r.rol, u.clave ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $query = $this->db->get();

        // Verificar si hay datos
        if ($query->num_rows() > 0) {
            return $query->result(); // Devolver un array con los resultados
        } else {
            return array(); // Devolver un array vacío si no hay datos
        }
    }

    public function getUsuariosPorNombre($nombre) {
        $this->db->select('u.id_usuario, u.usuario, r.rol, u.clave ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $this->db->like('u.usuario', $nombre); // Filtrar por nombre de usuario
        $query = $this->db->get();

        // Verificar si hay datos
        if ($query->num_rows() > 0) {
            return $query->result(); // Devolver un array con los resultados
        } else {
            return array(); // Devolver un array vacío si no hay datos
        }
    }

   
    public function obtenerUsuarioPorId($idUsuario) {
        // Realizar la consulta para obtener los datos del usuario por su ID
        $this->db->select('u.id_usuario, u.usuario, u.id_rol,u.clave');
        $this->db->from('usuario u');
        $this->db->where('u.id_usuario', $idUsuario);
        $query = $this->db->get();
    
        // Verificar si hay datos
        if ($query->num_rows() > 0) {
            return $query->row(); // Devolver un solo resultado (la fila con los datos del usuario y su rol)
        } else {
            return null; // Devolver null si no hay datos
        }
    }

    public function actualizarUsuario($idUsuario, $nuevoRol, $nuevoUsuario, $nuevaClave) {
        // Crear un arreglo con los datos a actualizar
        $datosActualizados = array(
            'id_rol' => $nuevoRol,
            'usuario' => $nuevoUsuario,
            'clave' => $nuevaClave
            // Agrega aquí otros campos que desees actualizar en la tabla usuario
        );
    
        // Realizar la actualización en la base de datos
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $datosActualizados);
    }

    
}
