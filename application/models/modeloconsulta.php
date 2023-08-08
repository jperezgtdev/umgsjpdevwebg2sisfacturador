<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class modeloconsulta extends CI_Model {

    public function getUsuarioData() {
        $estado = "Activo";
        $this->db->select('u.id_usuario, u.usuario, r.rol, u.clave  ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $this->db->where('u.estado',$estado);


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Devolver un array con los resultados
        } else {
            return array(); // Devolver un array vacío si no hay datos
        }
    }
    

    public function bajaUsuario($idUsuario) {
        // Crear un arreglo con los datos a actualizar

        $nuevoEstado = "Inactivo";
        $estadoActualizado = array(
            'estado' => $nuevoEstado
            
            // Agrega aquí otros campos que desees actualizar en la tabla usuario
        );
    
        // Realizar la actualización en la base de datos
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $estadoActualizado);
    }
    public function getUsuariosPorNombre($nombre) {
        $this->db->select('u.id_usuario, u.usuario, r.rol, u.clave ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $this->db->like('u.usuario', $nombre); // Filtrar por nombre de usuario
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); // Devolver un array con los resultados
        } else {
            return array(); // Devolver un array vacío si no hay datos
        }
    }

   
    public function obtenerUsuarioPorId($idUsuario) {
        $this->db->select('u.id_usuario, u.usuario, u.id_rol,u.clave');
        $this->db->from('usuario u');
        $this->db->where('u.id_usuario', $idUsuario);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row(); // Devolver un solo resultado (la fila con los datos del usuario y su rol)
        } else {
            return null; // Devolver null si no hay datos
        }
    }

    public function actualizarUsuario($idUsuario, $nuevoRol, $nuevoUsuario, $nuevaClave, $fecha_mod, $usuario_mod) {
        $datosActualizados = array(
            'id_rol' => $nuevoRol,
            'usuario' => $nuevoUsuario,
            'clave' => $nuevaClave,
            'fecha_mod' => $fecha_mod,
            'usuario_mod' => $usuario_mod
        );
    
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $datosActualizados);
    }

    
}
