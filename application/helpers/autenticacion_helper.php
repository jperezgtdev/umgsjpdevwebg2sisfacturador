<?php
defined('BASEPATH') OR exit('No direct script access allowed');

     // application/helpers/prueba_helper.php
function verificar_autenticacion($CI) {
    // Obtener el token almacenado en la cookie o en la variable de sesión
    $token = $CI->input->cookie('token'); // Si estás usando cookies
    // $token = $CI->session->userdata('token'); // Si estás usando variables de sesión

    // Consultar la base de datos para verificar si el token es válido
    $CI->load->model('SesionModel'); // Asegúrate de tener un modelo para manejar la tabla de sesiones
    $sesion_valida = $CI->SesionModel->verificar_sesion($token);

    if (!$sesion_valida) {
        redirect('LoginController');
    }
}
