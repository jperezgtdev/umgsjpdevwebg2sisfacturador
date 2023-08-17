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

public function IngresarProducto() {
    verificar_autenticacion($this);
    $this->load->view('Producto/IngresarProducto');
}

public function nuevoProducto(){
    if ($this->input->server('REQUEST_METHOD') === 'POST') {
        // Recuperar datos del formulario
        $producto = $this->input->post('editProducto');
        $id_categoria = $this->input->post('editCategoria');
        $existencia = $this->input->post('editExistencia');



            // Insertar los datos en la base de datos
            $data = array(
                'producto' => $producto,
                'id_categoria' => $id_categoria,
                'existencia' => $existencia,
            );

            $this->ProductoModel->insertarProducto($data);

            // Redirigir a otra página o mostrar un mensaje de éxito
            redirect('ProductoController');

        


    } else {
        // Si se intenta acceder directamente a la URL del controlador sin enviar el formulario, redirigir a la página de inicio.
        redirect('/');
    }

    
    
}

public function eliminarProducto($id_Producto) {
    // Lógica para eliminar el producto con el id $id_Producto
    $this->ProductoModel->eliminarProducto($id_Producto);

    // Redireccionar a la vista principal
    return redirect('ProductoController');
}

}

?>