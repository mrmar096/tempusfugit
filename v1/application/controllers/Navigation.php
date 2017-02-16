<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();

    }

    public function index()
    {
        $this->load->view('commons/header', ['title' => 'Home']);

        $this->load->view('home', ['cities' => $this->admin_model->getCities()]);
        $this->load->view('services/show_services');
        $this->load->view('commons/footer');
    }
    public function contact()
    {
        $this->load->view('commons/header', ['title' => 'Contacta']);

        $this->load->view('contact');
        $this->load->view('commons/footer');
    }
}
