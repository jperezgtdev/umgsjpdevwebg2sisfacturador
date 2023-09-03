<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'config/timezone_config.php';
class ProveedorController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('ProveedorModel');
        $this->load->helper('autenticacion');
    }

    public function ConsultaProveedor()
    {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->ProveedorModel->getProveedorData();
        $this->load->view('Proveedor/ConsultaProveedor', $data);
    }

    public function AltaProveedor()
    {
        verificar_autenticacion($this);
        $this->load->view('Proveedor/AltaProveedor');
    }
    public function crear_proveedor()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            $nombreC = $this->input->post('nombreC');
            $nit = $this->input->post('nit');
            $direccion = $this->input->post('Direccion');
            $telefono = $this->input->post('Telefono');
            $estado = "Activo";


            $fecha_actual = date("Y-m-d");
            $usuario_crear = $this->session->userdata('id_usuario');

            $data = array(
                'nombre' => $nombreC,
                'direccion' => $direccion,
                'telefono' => $telefono,
                'nit' => $nit,
                'fecha_crear' => $fecha_actual,
                'usuario_crear' => $usuario_crear,
                'estado' => $estado
            );
            $this->ProveedorModel->insertar_proveedor($data);
            redirect('ConsultaProveedor');
        }
    }

     public function desactivarProveedor($idProveedor) {
        $data['proveedor'] = $this->ProveedorModel->bajaProveedor($idProveedor);
        $data['prueba_data'] = $this->ProveedorModel->getProveedorData();
        $this->load->view('Proveedor/ConsultaProveedor', $data);    
    }


    public function guardarCambios($idProveedor) {
        $nuevoNombre = $this->input->post('editCliente');
        $nuevoNit = $this->input->post('editNit');
        $nuevaDireccion = $this->input->post('editDireccion');
        $nuevoTelefono = $this->input->post('editTelefono');
        $usuario_mod = $this->session->userdata('id_usuario'); 
        $fecha_mod = date('Y-m-d H:i:s');
    
       
        $this->ProveedorModel->actualizarProveedor($idProveedor,$nuevoNombre, $nuevoNit, $nuevaDireccion,$nuevoTelefono, $fecha_mod, $usuario_mod);
        return redirect('ConsultaProveedor');
    }
}