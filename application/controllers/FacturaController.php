<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FacturaController extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('FacturaModel');
    $this->load->helper('autenticacion');
}


public function indexFactura() {
    verificar_autenticacion($this);
    $data['prueba_data'] = $this->FacturaModel->getProductos();
    //$data['categorias'] = $this->ProductoModel->getCategoria();
    $this->load->view('Factura/ConsultaFactura', $data);
}

public function Facturacion() {
    verificar_autenticacion($this);
    $this->load->view ('Factura/VFacturacion');
}  
public function guardarCambios($id_Producto) {
    $referer = $_SERVER['HTTP_REFERER'];

    $nuevoProducto = $this->input->post('editProducto');
    $nuevaCategoria = $this->input->post('editCategoria');
    $nuevaExistencia = $this->input->post('editExistencia');
    $usuario_mod = $this->session->userdata('id_usuario'); 
    $fecha_mod = date("Y-m-d");
    
    $this->ProductoModel->actualizarProducto($id_Producto, $nuevoProducto, $nuevaCategoria, $nuevaExistencia,$usuario_mod, $fecha_mod);
    return redirect('ConsultaProducto');
}

public function nuevoProducto(){
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $producto = $this->input->post('editProducto');
        $id_categoria = $this->input->post('editCategoria');
        $existencia = $this->input->post('editExistencia');
        $usuario_crear = $this->session->userdata('id_usuario'); 
        $fecha_crear = date("Y-m-d");

        $data = array(
            'producto' => $producto,
            'id_categoria' => $id_categoria,
            'existencia' => $existencia,
            'fecha_crear' => $fecha_crear,
            'usuario_crear' => $usuario_crear,
            'estado' => 'Activo',
        );

        $this->ProductoModel->insertarProducto($data);
        redirect('ConsultaProducto');

    } else {
        redirect('LoginController');
    }
    
}

public function eliminarProducto($id_Producto) {
    $this->ProductoModel->eliminarProducto($id_Producto);
    return redirect('ConsultaProducto');
}

public function cargar_cliente(){
    $term = $this->input->get('q'); 
    $clientes = $this->FacturaModel->buscar_cliente($term);

    $response = [];
    foreach ($clientes as $cliente) {
        $response[] = [
            'id' => $cliente['id_cliente'],
            'nit' => $cliente['nit'],
            'text' => $cliente['nombre']
        ];
    }

    echo json_encode($response);
}



public function cargar_producto(){
    $term = $this->input->get('q'); 
    $productos = $this->FacturaModel->buscar_producto($term);
    $response = [];
    foreach ($productos as $producto) {
        $response[] = [
            'id' => $producto['id_producto'],
            'text' => $producto['producto'],
        ];
    }

    echo json_encode($response);
}


public function bajaFactura($id_factura) {

    $detalles = $this->FacturaModel->obtenerDetallesFactura($id_factura);

    foreach ($detalles as $detalle) {
        $producto_id = $detalle->id_producto;
        $cantidad_devuelta = $detalle->cantidad;


        $producto = $this->FacturaModel->obtenerProductoPorId($producto_id);
        $existencia_actual = $producto->existencia;

        $nueva_existencia = $existencia_actual + $cantidad_devuelta;

        $this->FacturaModel->actualizarExistencia($producto_id, $nueva_existencia);
    }

    $this->FacturaModel->bajaFactura($id_factura);

    redirect('ConsultaFactura');
}

}
?>