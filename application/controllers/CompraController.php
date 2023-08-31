<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CompraController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('CompraModel');
        $this->load->helper('autenticacion');

    }

    public function indexAlta() {
        verificar_autenticacion($this);
        $data['proveedores'] = $this->CompraModel->obtener_proveedores();
        $this->load->view('Compra/AltaCompra', $data); 
    } 
    public function indexConsulta()
    {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->CompraModel->getCompraData();
        $this->load->view('Compra/ConsultaCompra', $data);
    }   
    public function cargar_productos()
    {
        $term = $this->input->get('q'); // Término de búsqueda enviado por Select2
        $productos = $this->CompraModel->buscar_productos($term);

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
            $proveedor = $this->input->post('proveedor');
            $producto = $this->input->post('producto'); 
            $cantidad = $this->input->post('cantidad');
            $precio = $this->input->post('precio');

            $usuario_crear = $this->session->userdata('id_usuario');
            $fecha_actual = date("Y-m-d");

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

            $existencia_actual = $this->CompraModel->obtener_existencia($producto);
            $nueva_existencia = $existencia_actual + $cantidad;

            $this->CompraModel->actualizar_existencia($producto, $nueva_existencia);
            redirect('ConsultaCompra');
            
        } else {
           
            redirect('/');
        }
    }

    public function desactivarCompra($idCompra) {
        $compra = $this->CompraModel->obtenerCompraPorId($idCompra);

    if ($compra !== null) {
        $producto_id = $compra['id_producto'];
        $cantidad_compra = $compra['cantidad'];

        $existencia_actual = $this->CompraModel->obtener_existencia($producto_id);
        $nueva_existencia = $existencia_actual - $cantidad_compra;
        $this->CompraModel->bajaCompra($idCompra);
        $this->CompraModel->actualizar_existencia($producto_id, $nueva_existencia);

        redirect('ConsultaCompra');
    }  
    }
}