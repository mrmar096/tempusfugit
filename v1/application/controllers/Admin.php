<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
    
    public function messages()
    {
        $this->load->view('commons/header',['title'=>'Mensajes']);

        $this->load->view('commons/footer');
    }
    public function categories()
    {
        $this->load->view('commons/header',['title'=>'Categorias']);

        $this->load->view('commons/footer');
    }
    public function subcategories()
    {
        $this->load->view('commons/header',['title'=>'Sub-Categorias']);

        $this->load->view('commons/footer');
    }
    public function cities()
    {
        $this->load->view('commons/header',['title'=>'Ciudades']);

        $this->load->view('commons/footer');
    }
}
//End of file applications/controller/Hello.php