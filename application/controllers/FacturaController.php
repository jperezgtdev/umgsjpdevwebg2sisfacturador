<?php
defined('BASEPATH') or exit('No direct script access allowed');
class FacturaController extends CI_Controller {

public function __construct() {
    parent::__construct();
    require_once(APPPATH.'libraries/dompdf/autoload.inc.php');
    $this->dompdf = new \Dompdf\Dompdf();
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

    redirect('ConsultaFactura');
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

public function facturaPdf($id_factura) {
    $data['detalles'] = $this->FacturaModel->getDetalles($id_factura);

    $html = $this->load->view('Factura/FacturaPdf', $data, true);

    $this->dompdf->loadHtml($html);
    $this->dompdf->setPaper('letter', 'portrait');
    $this->dompdf->render();

    $output = $this->dompdf->output();
    $pdfFileName = 'factura_' . $id_factura . '.pdf';

    // Enviar el contenido PDF al cliente
    header('Content-type: application/pdf');
    header("Content-Disposition: inline; filename=$pdfFileName");
    header('Content-Transfer-Encoding: binary');
    header('Accept-Ranges: bytes');
    echo $output;
}

}
?>