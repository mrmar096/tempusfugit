<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Services extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function index()
    {
        $this->load->view('commons/header',["title"=>"Servicios"]);
        $this->load->view('services/show_services');
        $this->load->view('commons/footer');
    }
}
//End of file applications/controller/Hello.php