<?php
class ClienteModel extends CI_Model {
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

    public function insertar_cliente($data) {
        $this->db->insert('Cliente', $data);
    }


    public function getClienteData() {
        $estado = "Activo";
        $this->db->select('id_cliente,nombre,nit,direccion,telefono ');
        $this->db->from('cliente');
        $this->db->where('estado',$estado);


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return array(); 
        }
    }
    
    public function obtenerClientePorId($idCliente) {
        $this->db->select('id_cliente,nombre, nit, direccion, telefono');
        $this->db->from('cliente');
        $this->db->where('id_cliente', $idCliente);
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return null;
        }
    }

    public function bajaUsuario($idCliente) {
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d H:i:s');
        $nuevoEstado = "Inactivo";
        $datosActualizados = array(
            'estado' => $nuevoEstado,
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod
        );
        $this->db->where('id_cliente', $idCliente);
        $this->db->update('cliente', $datosActualizados);
    }

    public function actualizarCliente($idCliente, $nuevoNombre, $nuevoNit, $nuevaDireccion,$nuevoTelefono, $fecha_mod, $usuario_mod) {
        $datosActualizados = array(
            'nombre' => $nuevoNombre,
            'direccion' => $nuevaDireccion,
            'telefono' => $nuevoTelefono,
            'nit' => $nuevoNit,
            'fecha_mod' => $fecha_mod,
            'usuario_mod' => $usuario_mod
        );
    
        $this->db->where('id_cliente', $idCliente);
        $this->db->update('cliente', $datosActualizados);
    }

}
