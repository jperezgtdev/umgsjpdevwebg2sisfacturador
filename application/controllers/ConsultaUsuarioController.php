<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConsultaUsuarioController extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('modeloconsulta');
        $this->load->helper('autenticacion');
    }

    public function index() {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->modeloconsulta->getUsuarioData();
        $this->load->view('usuario/consulta', $data);
    }

    public function desactivarUsuario($idUsuario) {
        $data['usuario'] = $this->modeloconsulta->bajaUsuario($idUsuario);
        $data['prueba_data'] = $this->modeloconsulta->getUsuarioData();
        $this->load->view('usuario/consulta', $data);    }

    public function buscarPorNombre() {
        $nombre = $this->input->post('firstName');
        $data['prueba_data'] = $this->modeloconsulta->getUsuariosPorNombre($nombre);
        $this->load->view('usuario/consulta', $data);
    }


    public function obtenerDatos($idUsuario) {
        $data['usuario'] = $this->modeloconsulta->obtenerUsuarioPorId($idUsuario);
        $this->load->view('usuario/actualizar', $data);
    }
    

    public function guardarCambios($id_usuario) {
        $referer = $_SERVER['HTTP_REFERER'];
    
        $nuevoUsuario = $this->input->post('editUsuario');
        $nuevoRol = $this->input->post('editRol');
        $claveIngresado = $this->input->post('claveIngresado');
        $editClave = $this->input->post('editClave');
        $confirmarClave = $this->input->post('confirmarClave');
        $usuario_mod = $this->session->userdata('id_usuario'); // O el valor almacenado en la cookie si usaste cookies
        $fecha_mod = date("Y-m-d");
        $claveActual = $this->input->post('clave');
    
        if (empty($claveIngresado)) {
            $claveEncriptada = $claveActual;
        } else {
            if (sha1($claveIngresado) !== $claveActual) {
                return redirect($referer);
            }

            if ($editClave !== $confirmarClave) {
                return redirect($referer);
            }
    
            $claveEncriptada = sha1($editClave);
        }
    
        $id_rol = ($nuevoRol === "administrador") ? 1 : 2;
        $this->modeloconsulta->actualizarUsuario($id_usuario, $id_rol, $nuevoUsuario, $claveEncriptada, $fecha_mod, $usuario_mod);
        return redirect('DashboardController');
    }
    
    
    
    
}
?>