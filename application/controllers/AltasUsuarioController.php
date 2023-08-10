<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'config/timezone_config.php';
class AltasUsuarioController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        $this->load->model('UsuarioModel');
        $this->load->helper('autenticacion');
    }

    public function index() {
        verificar_autenticacion($this);
        $this->load->view('usuario/altas');
    }

    public function crear_usuario()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $nombre = $this->input->post('person');
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $confirm_password = $this->input->post('confirm_password');
            $role = $this->input->post('role');


            $empleado = $this->UsuarioModel->buscar_empleado($nombre);

            if ($empleado) {

                $id_persona = $empleado['id_persona'];

                $query_person = $this ->UsuarioModel->buscar_person($id_persona);
                if($query_person){
                    echo "<script>alert('el empleado ya tiene un usuario. Por favor, elige otro empleado.');window.history.back();</script>";
                    return;
                }

                $query_username = $this ->UsuarioModel->buscar_username($username);
                if($query_username){
                    echo "<script>alert('El nombre de usuario ya existe. Por favor, elige otro nombre.');window.history.back();</script>";
                    return;
                }

                if ($password !== $confirm_password) {
                    echo '<script>alert("Las contraseñas no coinciden. Por favor, inténtelo de nuevo."); window.history.back();</script>';
                    return;
                }

                $encrypted_password = sha1($password);
                $usuario_crear = $this->session->userdata('id_usuario'); 

                $fecha_actual = date("Y-m-d");

                $id_rol = ($role === "administrador") ? 1 : 2;

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
                echo '<script>alert("Usuario creado exitosamente.");</script>';
                redirect('ConsultaUsuarioController');

            } else {
                echo "<script>alert('El empleado no fue encontrado.'); window.history.back();</script>";
            }


        } else {
           
            redirect('/');
        }
    }
}