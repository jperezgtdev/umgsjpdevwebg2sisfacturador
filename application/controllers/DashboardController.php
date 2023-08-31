<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class DashboardController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('autenticacion');
    }

    public function index() {
        verificar_autenticacion($this);
        $this->load->view('vDashboard'); 
    }
}




