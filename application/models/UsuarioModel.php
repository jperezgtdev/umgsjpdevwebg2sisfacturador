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
        $this->db->insert('Usuario', $data);
    }

    public function buscar_empleado($nombre) {
        $this->db->select('*');
        $this->db->from('Persona');
        $this->db->where('nombre', $nombre);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row_array(); 
        } else {
            return FALSE; 
        }
    }

    public function buscar_username($username){
        $this->db->select('id_usuario');
        $this->db->from('Usuario');
        $this->db->where('usuario', $username);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    public function buscar_person($id_persona){
        $this->db->select('id_persona');
        $this->db->from('Usuario');
        $this->db->where('id_persona', $id_persona);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return TRUE;
        }
    }

    public function getUsuarioData() {
        $estado = "Activo";
        $this->db->select('u.id_usuario, u.usuario, u.id_rol, r.rol, u.clave  ');
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
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d');
        $nuevoEstado = "Inactivo";
        $estadoActualizado = array(
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod,
            'estado' => $nuevoEstado
        );
    
        // Realizar la actualización en la base de datos
        $this->db->where('id_usuario', $idUsuario);
        $this->db->update('usuario', $estadoActualizado);
    }
    public function getUsuariosPorNombre($nombre) {
        $this->db->select('u.id_usuario, u.usuario, r.rol, u.clave ');
        $this->db->from('usuario u');
        $this->db->join('rol r', 'u.id_rol = r.id_rol');
        $this->db->like('u.usuario', $nombre);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
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
