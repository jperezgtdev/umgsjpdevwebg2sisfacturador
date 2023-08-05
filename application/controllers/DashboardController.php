<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Verificar la autenticación antes de acceder a la vista "prueba"
        $this->verificar_autenticacion();
    }

    private function verificar_autenticacion() {
        // Obtener el token almacenado en la cookie o en la variable de sesión
        $token = $this->input->cookie('token'); // Si estás usando cookies
        // $token = $this->session->userdata('token'); // Si estás usando variables de sesión

        // Consultar la base de datos para verificar si el token es válido
        $this->load->model('SesionModel'); // Asegúrate de tener un modelo para manejar la tabla de sesiones
        $sesion_valida = $this->SesionModel->verificar_sesion($token);

        if (!$sesion_valida) {
            // Si el token no es válido, redirigir al usuario al formulario de inicio de sesión
            redirect('LoginController');
        }
    }

    public function index() {
        // Cargar el modelo que se encargará de interactuar con la tabla "prueba"

        // Cargar la vista y pasar los datos a la misma
        $this->load->view('Dashboard'); 
    }
}




