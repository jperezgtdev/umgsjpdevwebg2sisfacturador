<?php
class UsuarioModel extends CI_Model {
    public function validar_usuario($usuario, $clave) {
        // Realizar la consulta en la base de datos para verificar las credenciales
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', $clave);
        $query = $this->db->get('Usuario');

        // Si la consulta devuelve un resultado, las credenciales son válidas
        if ($query->num_rows() > 0) {
            // Obtener el id_usuario del resultado de la consulta
            $row = $query->row();
            return $row->id_usuario;
        } else {
            return false;
        }
    }

    public function obtener_id_usuario_por_nombre($usuario) {
        // Realizar la consulta en la base de datos para obtener el id_usuario por nombre de usuario
        $this->db->where('usuario', $usuario);
        $query = $this->db->get('Usuario');

        // Si la consulta devuelve un resultado, retornar el id_usuario
        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_usuario;
        } else {
            return false;
        }
    }
}
