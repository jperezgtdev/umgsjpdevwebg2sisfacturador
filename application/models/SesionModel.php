<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SesionModel extends CI_Model {

    public function crear_sesion($usuario, $token) {
        $datos_sesion = array(
            'id_usuario' => $usuario,
            'token' => $token,
            'fecha_creacion' => date('Y-m-d H:i:s'),
            'fecha_actualizacion' => date('Y-m-d H:i:s')
        );

        $this->db->insert('sesiones', $datos_sesion);
    }

    public function verificar_sesion($token) {
        $this->db->where('token', $token);
        $query = $this->db->get('sesiones');

        if ($query->num_rows() > 0) {
            // Actualizar la fecha de actualización de la sesión para mantenerla activa
            $this->db->where('token', $token);
            $this->db->update('sesiones', array('fecha_actualizacion' => date('Y-m-d H:i:s')));

            return TRUE;
        } else {
            return FALSE;
        }
    }
}