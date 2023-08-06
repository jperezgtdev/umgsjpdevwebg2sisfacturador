<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modeloconsulta extends CI_Model {

    public function getUsuarioData() {
        // Realizar la consulta para obtener los datos de la tabla "Usuario" junto con el nombre de rol
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

   
    public function obtenerUsuarioPorId($idUsuario) {
        // Realizar la consulta para obtener los datos del usuario por su ID
        $this->db->select('u.id_usuario, u.usuario, r.rol,u.clave   ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $this->db->where('u.id_usuario', $idUsuario);
        $query = $this->db->get();
    
        // Verificar si hay datos
        if ($query->num_rows() > 0) {
            return $query->row(); // Devolver un solo resultado (la fila con los datos del usuario y su rol)
        } else {
            return null; // Devolver null si no hay datos
        }
    }

    public function actualizarUsuario($idUsuario, $nuevoUsuario, $nuevaClave) {
        // Crear un arreglo con los datos a actualizar
        $datosActualizados = array(
            'usuario' => $nuevoUsuario,
            'clave' => $nuevaClave
            // Agrega aquí otros campos que desees actualizar en la tabla usuario
        );
    
        // Realizar la actualización en la base de datos
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $datosActualizados);
    }
    


     

    public function actualizarRol($idUsuario, $nuevoRol) {
        // Crear un arreglo con los datos a actualizar en la tabla rol
        $datosActualizados = array(
            'rol' => $nuevoRol
            // Agrega aquí otros campos que desees actualizar en la tabla rol
        );
    
        // Realizar la actualización en la base de datos
        $this->db->where('id_rol', $idUsuario); // Usar el campo 'id_rol' en lugar de 'id_usuario'
        $this->db->update('rol', $datosActualizados);
    }
    
    
    
    
    
    
    

    
}
