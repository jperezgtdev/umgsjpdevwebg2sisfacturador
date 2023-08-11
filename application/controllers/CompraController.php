<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompraController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CompraModel');
        $this->load->helper('autenticacion');

    }

    public function index() {
        verificar_autenticacion($this);
        $data['proveedores'] = $this->CompraModel->obtener_proveedores();
        $this->load->view('Compra/AltaCompra', $data); 
    }    
    public function cargar_productos()
    {
        $term = $this->input->get('q'); // Término de búsqueda enviado por Select2
        $productos = $this->CompraModel->buscar_productos($term); // Cambia esto a tu lógica de búsqueda

        $response = [];
        foreach ($productos as $producto) {
            $response[] = [
                'id' => $producto['id_producto'],
                'text' => $producto['producto']
            ];
        }

        echo json_encode($response);
    }

    public function crear_compra()
    {
        if ($this->input->server('REQUEST_METHOD') === 'POST') {
            // Recuperar datos del formulario
            $proveedor = $this->input->post('proveedor');
            $producto = $this->input->post('producto'); 
            $cantidad = $this->input->post('cantidad');
            $precio = $this->input->post('precio');

                // Obtener el usuario que está ingresando la compra (puedes obtenerlo desde la sesión)
                $usuario_crear = $this->session->userdata('id_usuario');

                // Obtener la fecha actual
                $fecha_actual = date("Y-m-d");

                // Insertar los datos en la base de datos
                $data = array(
                    'id_producto' => $producto,
                    'id_proveedor' => $proveedor,
                    'cantidad' => $cantidad,
                    'precio_compra' => $precio,
                    'fecha_crear' => $fecha_actual,
                    'usuario_crear' => $usuario_crear,
                    'estado' => 'Activo'
                );

                $this->CompraModel->insertar_compra($data);

                // Redirigir a otra página o mostrar un mensaje de éxito
                echo '<script>alert("Usuario creado exitosamente.");</script>';
                redirect('DashboardCOntroller');
        } else {
            // Si se intenta acceder directamente a la URL del controlador sin enviar el formulario, redirigir a la página de inicio.
            redirect('/');
        }
    }
}