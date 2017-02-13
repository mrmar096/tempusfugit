<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

	public function __construct()
    {
        parent::__construct();

    }

    public function index()
	{
        //Preparar las ciudades
        $this->load->view('commons/header',['title'=>'TempusFugit']);

		$this->load->view('home',['cities'=>$this->admin_model->getCities()]);
        $this->load->view('services/index');
        $this->load->view('commons/footer');

	}
}
