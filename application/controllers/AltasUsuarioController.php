<?php
defined('BASEPATH') or exit('No direct script access allowed');

class AltasUsuarioController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Cargamos el modelo para interactuar con la base de datos
        $this->load->model('UsuarioModel');
    }

    public function index() {

        $this->load->view('usuario/altas');
    }

    public function crear_usuario()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Recuperar datos del formulario
            $nombre = $this->input->post('person');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $role = $this->input->post('role');


            $empleado = $this->UsuarioModel->buscar_empleado($nombre);

            if ($empleado) {

                // Si el empleado existe, obtenemos su ID y lo usamos para el registro
                $id_persona = $empleado['id_persona'];

                //verificar si la persona ya tiene un usuario
                $query_person = $this ->UsuarioModel->buscar_person($id_persona);
                if($query_person){
                    echo "<script>alert('el empleado ya tiene un usuario. Por favor, elige otro empleado.');window.history.back();</script>";
                    return;
                }

                //verificar si no se repite el username
                $query_username = $this ->UsuarioModel->buscar_username($username);
                if($query_username){
                    echo "<script>alert('El nombre de usuario ya existe. Por favor, elige otro nombre.');window.history.back();</script>";
                    return;
                }

                // Verificar si las contraseñas coinciden
                if ($password !== $confirm_password) {
                    // Las contraseñas no coinciden, mostrar alerta
                    echo '<script>alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo."); window.history.back();</script>';
                    return;
                }

                // Generar un hash de la contraseña
                $encrypted_password = md5($password);

                // Obtener el usuario que está creando al nuevo usuario (puedes obtenerlo desde la sesión, por ejemplo)
                $usuario_crear = $this->session->userdata('id_usuario'); // O el valor almacenado en la cookie si usaste cookies

                // Obtener la fecha actual
                $fecha_actual = date("Y-m-d");

                // Asignar el valor adecuado para id_rol
                $id_rol = ($role === "administrador") ? 1 : 2;

                // Insertar los datos en la base de datos
                $data = array(
                    'usuario' => $username,
                    'id_rol' => $id_rol,
                    'id_persona' => $id_persona,
                    'clave' => $encrypted_password,
                    'fecha_crear' => $fecha_actual,
                    'usuario_crear' => $usuario_crear,
                    'estado' => 'activo'
                );

                $this->UsuarioModel->insertar_usuario($data);

                // Redirigir a otra página o mostrar un mensaje de éxito
                echo '<script>alert("Usuario creado exitosamente.");</script>';
                redirect('DashboardController');

            } else {
                // Si el empleado no existe, mostramos un mensaje de alerta
                echo "<script>alert('El empleado no fue encontrado.'); window.history.back();</script>";
            }


        } else {
            // Si se intenta acceder directamente a la URL del controlador sin enviar el formulario, redirigir a la página de inicio.
            redirect('/');
        }
    }
}