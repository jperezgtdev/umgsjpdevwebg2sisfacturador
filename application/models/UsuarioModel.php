<?php
class UsuarioModel extends CI_Model {
    public function validar_usuario($usuario, $clave) {
        $estadoUsuario = 'Activo';
        $this->db->where('usuario', $usuario);
        $this->db->where('clave', $clave);
        $this->db->where('estado',$estadoUsuario);
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

    public function insertar_usuario($data) {
        // Insertar el registro en la tabla "Usuario"
        $this->db->insert('Usuario', $data);
    }

    public function buscar_empleado($nombre) {
        // Consulta para buscar el empleado por nombre en la tabla 'Persona'
        $this->db->select('*');
        $this->db->from('Persona');
        $this->db->where('nombre', $nombre);
        $query = $this->db->get();

        // Verificar si se encontró el empleado
        if ($query->num_rows() > 0) {
            return $query->row_array(); // Devolver los datos del empleado como un arreglo asociativo
        } else {
            return FALSE; // Devolver FALSE si el empleado no existe
        }
    }

    public function buscar_username($username){
        // Verificar si el username ya existe en la tabla 'Usuario'
        $this->db->select('id_usuario');
        $this->db->from('Usuario');
        $this->db->where('usuario', $username);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Si hay resultados, el username ya existe, muestra un alert
            return TRUE;
            //echo "<script>alert('El nombre de usuario ya existe. Por favor, elige otro nombre.');window.history.back();</script>";
        }
    }

    public function buscar_person($id_persona){
        // Verificar si el empleado ya tiene usuario en la tabla 'Usuario'
        $this->db->select('id_persona');
        $this->db->from('Usuario');
        $this->db->where('id_persona', $id_persona);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            // Si hay resultados, el username ya existe, muestra un alert
            return TRUE;
            //echo "<script>alert('El nombre de usuario ya existe. Por favor, elige otro nombre.');window.history.back();</script>";
        }
    }
}
