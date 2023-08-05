<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LoginController extends CI_Controller {

    public function index() {
        // Cargar la vista y pasar los datos a la misma
        $this->load->view('Login');
    }

    public function login() {
        // Obtener los datos del formulario de inicio de sesión
        $usuario = $this->input->post('usuario');
        $clave = $this->input->post('clave');
    
        // Validar las credenciales en la base de datos
        $this->load->model('UsuarioModel'); // Asegúrate de tener un modelo que maneje la tabla Usuario
        $usuario_valido = $this->UsuarioModel->validar_usuario($usuario, $clave);
    
        if ($usuario_valido) {
            // Si las credenciales son válidas, obtener el id_usuario del modelo y crear una sesión
            $id_usuario = $this->UsuarioModel->obtener_id_usuario_por_nombre($usuario);
            // Después de validar las credenciales y obtener el $id_usuario
            $this->session->set_userdata('id_usuario', $id_usuario);
            $this->crear_sesion($id_usuario);
            redirect('DashboardController');
        } else {
            // Si las credenciales no son válidas, mostrar mensaje de error y redirigir al formulario de inicio de sesión
            echo "Usuario o contraseña incorrectos";
            redirect('Login');
        }
    }

    private function crear_sesion($id_usuario) {
        // Generar un token único para la sesión
        $token = bin2hex(random_bytes(32));

        // Guardar la sesión en la base de datos
        $this->load->model('SesionModel'); // Asegúrate de tener un modelo para manejar la tabla de sesiones
        $this->SesionModel->crear_sesion($id_usuario, $token);

        // Guardar el token en una cookie (si prefieres usar cookies)
        $this->input->set_cookie('token', $token, 86400); // Cookie válida por 24 horas

       
    }
}
