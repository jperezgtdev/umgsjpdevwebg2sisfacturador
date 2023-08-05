<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function index() {

        $this->load->view('Login');
    }

    public function login() {

        $usuario = $this->input->post('usuario');
        $clave = $this->input->post('clave');
    
        $this->load->model('UsuarioModel'); 
        $usuario_valido = $this->UsuarioModel->validar_usuario($usuario, $clave);
    
        if ($usuario_valido) {
            $id_usuario = $this->UsuarioModel->obtener_id_usuario_por_nombre($usuario);
            $this->session->set_userdata('id_usuario', $id_usuario);
            $this->crear_sesion($id_usuario);
            redirect('DashboardController');
        } else {
            echo "Usuario o contraseña incorrectos";
            redirect('Login');
        }
    }

    private function crear_sesion($id_usuario) {
        $token = bin2hex(random_bytes(32));
        $this->load->model('SesionModel'); 
        $this->SesionModel->crear_sesion($id_usuario, $token);

        $this->input->set_cookie('token', $token, 86400); 

       
    }
}
