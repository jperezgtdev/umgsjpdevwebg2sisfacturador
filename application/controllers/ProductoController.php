<?php
defined('BASEPATH') or exit('No direct script access allowed');



class ProductoController extends CI_Controller {

public function __construct() {
        parent::__construct();
        $this->load->model('ProductoModel');
        $this->load->helper('autenticacion');
    }


public function index() {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->ProductoModel->getProductos();
         $this->load->view ('Producto/ConsultaProducto',$data);
}  

public function obtenerDatos($id_Producto) {
    $data['producto'] = $this->ProductoModel->ObtenerProductoPorId($id_Producto);
    $this->load->view('Producto/ActualizarProducto', $data);
}

public function guardarCambios($id_Producto) {
    $referer = $_SERVER['HTTP_REFERER'];

    $nuevoProducto = $this->input->post('editProducto');
    $nuevaCategoria = $this->input->post('editCategoria');
    $nuevaExistencia = $this->input->post('editExistencia');
    

   

    if ($nuevaCategoria === "Libro") {
        $categoria = 1;
    } //elseif ($nuevaCategoria === "Cuadernos") {
       // $categoria = 3;
   // } else {
//$categoria = 1; // Valor por defecto si no se cumple ninguna condición
   //}
        
    $this->ProductoModel->actualizarProducto($id_Producto, $nuevoProducto, $categoria, $nuevaExistencia);
    return redirect('ProductoController');
}

}

?>