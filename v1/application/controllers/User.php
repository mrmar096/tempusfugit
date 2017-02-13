<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
	public function registro()
	{
        if($this->input->is_ajax_request()){

            //Le asignamos las reglas de validacion
            $this->form_validation->set_rules("nombre","Nombre","trim|min_length[3]|max_length[100]|required|xss_clean");
            $this->form_validation->set_rules("email","Email","trim|min_length[3]|max_length[100]|required|xss_clean|is_unique[users.email]");
            $this->form_validation->set_rules("city","Ciudad","trim|xss_clean");
            $this->form_validation->set_rules("pass","Contraseña","trim|min_length[6]|max_length[12]|required|xss_clean");
            $this->form_validation->set_rules("apellidos","Apellidos","trim|min_length[3]|max_length[100]|required|xss_clean");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("is_unique","Lo sentimos ya existe un usuario con ese email");
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                echo json_encode(["status"=>0,"mensaje"=>validation_errors()]);

            }else{
                $user=$this->input->post();
                $pass=$user['pass'];
                $user['pass']=$this->encryption->encrypt($pass);
                unset($user['submit']);
                if(!$this->user_model->registro($user)){
                    echo json_encode(["status"=>0,"mensaje"=>"No se ha podido Registrar"]);
                }else{
                    echo json_encode(["status"=>1,"mensaje"=>"Registrado Correctament"]);
                }


            }
            exit;

        }else{
            redirect(base_url('navigation'));
        }

	}
}