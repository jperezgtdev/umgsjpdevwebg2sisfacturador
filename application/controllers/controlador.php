<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Controlador extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->helper('url'); // Carga el URL helper
    }
    public function index() {
        $this->load->model('modeloconsulta');
        $data['prueba_data'] = $this->modeloconsulta->getPruebaData();
        $this->load->view('usuario/consulta', $data);
    }


    public function obtenerDatos($idUsuario) {
        $this->load->model('modeloconsulta');
        $data['usuario'] = $this->modeloconsulta->obtenerUsuarioPorId($idUsuario);
        $this->load->view('usuario/actualizar', $data);
    }
    

    public function guardarCambios($id_usuario) {
        // Obtener el valor de la variable $referer
        $referer = $_SERVER['HTTP_REFERER'];
    
        // Obtener los datos del formulario
        $nuevoUsuario = $this->input->post('editUsuario');
        $nuevoRol = $this->input->post('editRol');
        $nuevaClave = $this->input->post('editClave');
    
        // Cargar el modelo
        $this->load->model('modeloconsulta');
    
        // Actualizar el usuario en la tabla usuario
        $this->modeloconsulta->actualizarUsuario($id_usuario, $nuevoUsuario, $nuevaClave);
    
        // Actualizar el rol en la tabla rol (si lo deseas)
        $this->modeloconsulta->actualizarRol($id_usuario, $nuevoRol);
    
        // Redireccionar a la página de consulta o a donde desees
        return redirect()->to($referer);
    }
    
    
}
