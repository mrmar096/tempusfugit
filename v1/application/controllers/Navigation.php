<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Navigation extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Navigation_model","nm");

    }

    public function index()
    {
        $this->load->view('commons/header', ['title' => 'Home']);

        $this->load->view('home', ['cities' => $this->nm->getCities()]);
        $this->load->view('services/show_services');
        $this->load->view('commons/footer');
    }
    public function contact()
    {
        $this->load->view('commons/header', ['title' => 'Contacta']);
        $data=$this->nm->getMessages(["privado"=>false]);
        $this->load->view('contact',["data"=>$data]);
        $this->load->view('commons/footer');
    }
    public function newmessage(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Nombre","trim|min_length[3]|max_length[100]|required");
            $this->form_validation->set_rules("comentario","Comentario","trim|min_length[3]|max_length[100]|required");
            //Le asignamos los mensajes para las reglas

            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                $data["privado"]=$data["privado"]=="on";
                if($id=$this->nm->newMessage($data)){
                    $data=$this->nm->getMessages(["id"=>$id,"privado"=>false],false);
                    $html=build_list_group_messages($data);
                    output_json(['status'=>1,'message'=>'El mensaje  se ha enviado correctamente','html'=>$html,'element'=>'.list-messages']);
                }else{
                    output_json(['status'=>0,'message'=>'El mensaje no se ha enviado']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }
}
