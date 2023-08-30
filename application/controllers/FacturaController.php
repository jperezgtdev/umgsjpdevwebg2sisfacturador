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
    $data['prueba_data'] = $this->FacturaModel->getFacturas();
    $this->load->view('Factura/ConsultaFactura', $data);
  
}

public function Facturacion() {
    verificar_autenticacion($this);
    $data['numero_factura']= $this->FacturaModel->num_factura();
    $this->load->view ('Factura/VFacturacion', $data);
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


public function crear_factura() {
  
    $cliente_id = $this->input->post('cliente');
    $referencia= $this->input->post('numero_factura');
    $fecha = $this->input->post('fecha');
    $productos = $this->input->post('producto');
    $cantidades = $this->input->post('cantidad');
    $precios = $this->input->post('precio_unitario');
    $serie_aleatoria = random_bytes(4); 
    $serie = strtoupper(bin2hex($serie_aleatoria));
    $numero_aleatorio = mt_rand(1000000000, 9999999999);
    $numero = (string) $numero_aleatorio;
    $autorizacion_aleatoria = random_bytes(16);
    $autorizacion = vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(strtoupper(bin2hex($autorizacion_aleatoria)), 4));
    $fecha_actual = date("Y-m-d");
    $usuario_crear = $this->session->userdata('id_usuario');

    $data_factura = array(
        'id_cliente' => $cliente_id,
        'referencia' => $referencia,
        'fecha' => $fecha,
        'serie' => $serie,
        'numero' => $numero,
        'authorization'=> $autorizacion,
        'fecha_crear' => $fecha_actual,
        'usuario_crear' => $usuario_crear,
        'fecha_mod' => $fecha_actual,
        'usuario_mod' => $usuario_crear,
        'estado' => 'Emitida'

    );
    $id_factura = $this->FacturaModel->insertar_factura($data_factura);

    foreach ($productos as $index => $producto_id) {
        $data_detalle = array(
            'id_producto' => $producto_id,
            'id_factura' => $id_factura,
            'cantidad' => $cantidades[$index],
            'precio' => $precios[$index]
        );      

        $this->FacturaModel->insertar_detalle($data_detalle);
    }

   
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