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
            //$decod_password = base64_decode($password);
            $confirm_password = $this->input->post('confirm_password');
            //$decod_confirm_password = base64_decode($confirm_password);
            $role = $this->input->post('role');


            $empleado = $this->UsuarioModel->buscar_empleado($nombre);

            if ($empleado) {

                $id_persona = $empleado['id_persona'];

                $query_person = $this ->UsuarioModel->buscar_person($id_persona);
                if($query_person){
                    $response['success'] = false;
                    $response['message'] = "El empleado ya tiene un usuario. Por favor, elige otro empleado.";
                    echo json_encode($response);
                    return;
                }

                $query_username = $this ->UsuarioModel->buscar_username($username);
                if($query_username){
                    $response['success'] = false;
                    $response['message'] = "El nombre de usuario ya existe. Por favor, elige otro nombre.";
                    echo json_encode($response);
                    return;
                }

                if ($password !== $confirm_password) {
                    $response['success'] = false;
                    $response['message'] = "Las contraseñas no coinciden. Por favor, inténtelo de nuevo.";
                    echo json_encode($response);
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
                $response['success'] = true;
                $response['message'] = "Usuario creado exitosamente.";
                echo json_encode($response);

            } else {
                $response['success'] = false;
                $response['message'] = "El empleado no fue encontrado.";
                echo json_encode($response);
                return;
            }


        } else {
           
            redirect('RegistroUsuario');
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
        $decod_claveIngresado = base64_decode($claveIngresado);
        $editClave = $this->input->post('editClave');
        $decod_editClave = base64_decode($editClave);
        $confirmarClave = $this->input->post('confirmarClave');
        $decod_confirmarClave = base64_decode($confirmarClave);
        $usuario_mod = $this->session->userdata('id_usuario'); 
        $fecha_mod = date("Y-m-d");
        $claveActual = $this->input->post('clave');
        $decod_claveActual = base64_decode($claveActual);
    
        if (empty($decod_claveIngresado)) {
            $claveEncriptada = $decod_claveActual;
        } else {
            if (sha1($decod_claveIngresado) !== $decod_claveActual) {
                return redirect($referer);
            }

            if ($decod_editClave !== $decod_confirmarClave) {
                return redirect($referer);
            }
    
            $claveEncriptada = sha1($decod_editClave);
        }

        $this->UsuarioModel->actualizarUsuario($id_usuario, $nuevoRol, $nuevoUsuario, $claveEncriptada, $fecha_mod, $usuario_mod);
        return redirect('Usuarios');
    }
}