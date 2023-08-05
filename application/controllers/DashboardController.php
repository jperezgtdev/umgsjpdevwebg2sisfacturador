<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
      
        $this->verificar_autenticacion();
    }

    private function verificar_autenticacion() {
       
        $token = $this->input->cookie('token'); 
       
        $this->load->model('SesionModel'); 
        $sesion_valida = $this->SesionModel->verificar_sesion($token);

        if (!$sesion_valida) {
           
            redirect('LoginController');
        }
    }

    public function index() {
        
        $this->load->view('navbar'); 
    }
}




