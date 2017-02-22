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
        $this->load->view('commons/header',["title"=>"Servicios","icon"=>"work","color"=>""]);
        $this->load->view('services/show_services',["servicios"=>$this->sm->getServices()]);
        $this->load->view('commons/footer');
    }

    public function newmmopinion($idmm){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("opinion","Opinion","trim|min_length[3]|required");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                $data["user"]=$this->session->userdata("user")->id;
                $data["multimedia"]=$idmm;
                if($id=$this->sm->newOpinion($data)){
                    $data=$this->sm->getOpinionsMMService($id);
                    $html=build_list_group_messages($data);
                    output_json(['status'=>1,'message'=>'El mensaje  se ha enviado correctamente','cleanhtml'=>true,'html'=>$html,'element'=>'#list-opinions-mm-'.$idmm]);
                }else{
                    output_json(['status'=>0,'message'=>'El mensaje no se ha enviado']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

}
//End of file applications/controller/Hello.php