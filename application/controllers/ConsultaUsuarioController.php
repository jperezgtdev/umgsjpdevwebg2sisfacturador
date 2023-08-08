<?php
defined('BASEPATH') or exit('No direct script access allowed');

class ConsultaUsuarioController extends CI_Controller {


    public function __construct() {
        parent::__construct();
        $this->load->model('modeloconsulta');
        $this->load->helper('autenticacion');
    }

    public function index() {
        verificar_autenticacion($this);
        $data['prueba_data'] = $this->modeloconsulta->getUsuarioData();
        $this->load->view('usuario/consulta', $data);
    }

    public function desactivarUsuario($idUsuario) {
        $data['usuario'] = $this->modeloconsulta->bajaUsuario($idUsuario);
        $data['prueba_data'] = $this->modeloconsulta->getUsuarioData();
        $this->load->view('usuario/consulta', $data);    }

    public function buscarPorNombre() {
        $nombre = $this->input->post('firstName');
        $data['prueba_data'] = $this->modeloconsulta->getUsuariosPorNombre($nombre);
        $this->load->view('usuario/consulta', $data);
    }


    public function obtenerDatos($idUsuario) {
        $data['usuario'] = $this->modeloconsulta->obtenerUsuarioPorId($idUsuario);
        $this->load->view('usuario/actualizar', $data);
    }
    

    public function guardarCambios($id_usuario) {
        // Obtener el valor de la variable $referer
        $referer = $_SERVER['HTTP_REFERER'];
    
        // Obtener los datos del formulario
        $nuevoUsuario = $this->input->post('editUsuario');
        $nuevoRol = $this->input->post('editRol');
        $claveIngresado = $this->input->post('claveIngresado');
        $editClave = $this->input->post('editClave');
        $confirmarClave = $this->input->post('confirmarClave');
    
        // Obtener la clave actual almacenada en el hidden
        $claveActual = $this->input->post('clave');
    
        // Verificar si la claveIngresado está vacío
        if (empty($claveIngresado)) {
            // Si el campo claveIngresado está vacío, mantener la clave actual sin encriptar
            $claveEncriptada = $claveActual;
        } else {
            // Verificar si la clave ingresada coincide con la clave almacenada en el hidden
            if (md5($claveIngresado) !== $claveActual) {
                // La clave ingresada no coincide con la clave almacenada, maneja el error según tus requerimientos
                return redirect($referer);
            }
    
            // Verificar si la nueva clave y la confirmación coinciden
            if ($editClave !== $confirmarClave) {
                // Las contraseñas no coinciden, maneja el error según tus requerimientos
                return redirect($referer);
            }
    
            // Convertir la nueva clave en MD5 antes de almacenarla en la base de datos
            $claveEncriptada = md5($editClave);
        }
    
        $id_rol = ($nuevoRol === "administrador") ? 1 : 2;
    
        // Actualizar el usuario en la tabla usuario con la nueva clave encriptada
        $this->modeloconsulta->actualizarUsuario($id_usuario, $id_rol, $nuevoUsuario, $claveEncriptada);
    
        // Redireccionar a la página de consulta o a donde desees
        return redirect('DashboardController');
    }
    
    
    
    
}
?>