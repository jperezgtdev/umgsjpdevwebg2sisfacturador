<?php
class UsuarioModel extends CI_Model {
    public function validar_usuario($usuario, $clave) {
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', $clave);
        $query = $this->db->get('Usuario');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_usuario;
        } else {
            return false;
        }
    }

    public function obtener_id_usuario_por_nombre($usuario) {
        $this->db->where('usuario', $usuario);
        $query = $this->db->get('Usuario');

        if ($query->num_rows() > 0) {
            $row = $query->row();
            return $row->id_usuario;
        } else {
            return false;
        }
    }
}
