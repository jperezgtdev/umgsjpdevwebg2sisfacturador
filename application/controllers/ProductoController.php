<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ProductoController extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model('ProductoModel');
    $this->load->helper('autenticacion');
}


public function indexConsulta() {
    verificar_autenticacion($this);
    $data['prueba_data'] = $this->ProductoModel->getProductos();
    $data['categorias'] = $this->ProductoModel->getCategoria();
    $this->load->view('Producto/ConsultaProducto', $data);
}

public function indexAlta() {
    verificar_autenticacion($this);
    $data['categorias'] = $this->ProductoModel->getCategoria();
    $this->load->view ('Producto/IngresarProducto',$data);
}  
public function guardarCambios($id_Producto) {

    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        $nuevoProducto = $this->input->post('editProducto');
        $nuevaCategoria = $this->input->post('editCategoria');
        $nuevaExistencia = $this->input->post('editExistencia');
        $usuario_mod = $this->session->userdata('id_usuario'); 
        $fecha_mod = date("Y-m-d");
        
        $this->ProductoModel->actualizarProducto($id_Producto, $nuevoProducto, $nuevaCategoria, $nuevaExistencia,$usuario_mod, $fecha_mod);
        return redirect('ConsultaProducto');
    }else {
           
        redirect('ConsultaProducto');
    }
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
        redirect('AltaProducto');
    }
    
}

public function eliminarProducto($id_Producto) {
    $this->ProductoModel->eliminarProducto($id_Producto);
    return redirect('ConsultaProducto');
}

}

?>