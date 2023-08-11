<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'config/timezone_config.php';
class UsuarioController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
     
        $this->load->model('UsuarioModel');
        $this->load->helper('autenticacion');
    }

    public function indexAlta() {
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

    public function indexConsulta() {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->UsuarioModel->getUsuarioData();
        $this->load->view('usuario/consulta', $data);
    }

    public function desactivarUsuario($idUsuario) {
        $data['usuario'] = $this->UsuarioModel->bajaUsuario($idUsuario);
        $data['prueba_data'] = $this->UsuarioModel->getUsuarioData();
        $this->load->view('usuario/consulta', $data);    }

    public function buscarPorNombre() {
        $nombre = $this->input->post('firstName');
        $data['prueba_data'] = $this->UsuarioModel->getUsuariosPorNombre($nombre);
        $this->load->view('usuario/consulta', $data);
    }


    public function obtenerDatos($idUsuario) {
        $data['usuario'] = $this->UsuarioModel->obtenerUsuarioPorId($idUsuario);
        $this->load->view('usuario/actualizar', $data);
    }
    

    public function guardarCambios($id_usuario) {
        $referer = $_SERVER['HTTP_REFERER'];
    
        $nuevoUsuario = $this->input->post('editUsuario');
        $nuevoRol = $this->input->post('editRol');
        $claveIngresado = $this->input->post('claveIngresado');
        $editClave = $this->input->post('editClave');
        $confirmarClave = $this->input->post('confirmarClave');
        $usuario_mod = $this->session->userdata('id_usuario'); 
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
        $this->UsuarioModel->actualizarUsuario($id_usuario, $id_rol, $nuevoUsuario, $claveEncriptada, $fecha_mod, $usuario_mod);
        return redirect('Usuarios');
    }
}