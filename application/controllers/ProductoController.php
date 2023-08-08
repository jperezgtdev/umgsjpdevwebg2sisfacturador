<?php
defined('BASEPATH') or exit('No direct script access allowed');



class ProductoController extends CI_Controller {

public function __construct() {
        parent::__construct();
        //$this->load->model('productoModel');
        //$this->load->helper('autenticacion');
    }


public function index() {
    //verificar_autenticacion($this);
    $this->load->view ('Producto/ConsultaProducto');
}    

}

?>