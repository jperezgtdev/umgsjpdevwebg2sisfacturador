<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'config/timezone_config.php';
class ClienteController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('ClienteModel');
        $this->load->helper('autenticacion');
    }

    public function index()
    {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->ClienteModel->getClienteData();
        $this->load->view('Cliente/vConsultaClientes', $data);
    }

    public function altasCliente()
    {
        verificar_autenticacion($this);
        $this->load->view('Cliente/vAltasClientes');
    }
    public function crear_cliente()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $nombreC = $this->input->post('nombreC');
            $nit = $this->input->post('nit');
            $direccion = $this->input->post('Direccion');
            $telefono = $this->input->post('Telefono');


            $fecha_actual = date("Y-m-d");
            $usuario_crear = $this->session->userdata('id_usuario');

            $data = array(
                'nombre' => $nombreC,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'nit' => $nit,
                'fecha_crear' => $fecha_actual,
                'usuario_crear' => $usuario_crear,
                'estado' => 'Activo'
            );
            $this->ClienteModel->insertar_cliente($data);
            redirect('ClienteController');
        }
    }

    public function obtenerClientes($idCliente)
    {
        $data['cliente'] = $this->ClienteModel->obtenerClientePorId($idCliente);
        $this->load->view('Cliente/vEditarCliente', $data);
    }

     public function desactivarUsuario($idCliente) {
       $data['cliente'] = $this->ClienteModel->bajaUsuario($idCliente);
        $data['prueba_data'] = $this->ClienteModel->getClienteData();
        $this->load->view('Cliente/vConsultaClientes', $data);    
    }


    public function guardarCambios($id_cliente) {
        $nuevoNombre = $this->input->post('editCliente');
        $nuevoNit = $this->input->post('editNit');
        $nuevaDireccion = $this->input->post('editDireccion');
        $nuevoTelefono = $this->input->post('editTelefono');
        $usuario_mod = $this->session->userdata('id_usuario'); 
        $fecha_mod = date('Y-m-d H:i:s');
    
       
        $this->ClienteModel->actualizarCliente($id_cliente,$nuevoNombre, $nuevoNit, $nuevaDireccion,$nuevoTelefono, $fecha_mod, $usuario_mod);
        return redirect('ClienteController');
    }
}
