<?php
class ProveedorModel extends CI_Model {

    public function insertar_proveedor($data) {
        $this->db->insert('proveedor', $data);
    }


    public function getProveedorData() {
        $estado = "Activo";
        $this->db->select('id_proveedor,nombre,nit,direccion,telefono ');
        $this->db->from('proveedor');
        $this->db->where('estado',$estado);


        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result(); 
        } else {
            return array(); 
        }
    }

    public function bajaProveedor($idProveedor) {
        $usuario_mod = $this->session->userdata('id_usuario');
        $fecha_mod = date('Y-m-d H:i:s');
        $nuevoEstado = "Inactivo";
        $datosActualizados = array(
            'estado' => $nuevoEstado,
            'usuario_mod' => $usuario_mod,
            'fecha_mod' => $fecha_mod
        );
        $this->db->where('id_proveedor', $idProveedor);
        $this->db->update('proveedor', $datosActualizados);
    }

    public function actualizarProveedor($idProveedor, $nuevoNombre, $nuevoNit, $nuevaDireccion,$nuevoTelefono, $fecha_mod, $usuario_mod) {
        $datosActualizados = array(
            'nombre' => $nuevoNombre,
            'direccion' => $nuevaDireccion,
            'telefono' => $nuevoTelefono,
            'nit' => $nuevoNit,
            'fecha_mod' => $fecha_mod,
            'usuario_mod' => $usuario_mod
        );
    
        $this->db->where('id_proveedor', $idProveedor);
        $this->db->update('proveedor', $datosActualizados);
    }

}