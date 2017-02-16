<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
    }
    public function index(){
        $this->services();
    }
    public function profile(){
        $this->load->view('commons/header',["title"=>"Profile"]);
        
        $this->load->view('user/profile');
        $this->load->view('commons/footer');
    }
    public function messages(){
        $this->load->view('commons/header',["title"=>"Mensajes"]);
    
        $this->load->view('user/messages');
        $this->load->view('commons/footer');
    }
    public function services(){
        $this->load->view('commons/header',["title"=>"Mis Servicios"]);
        $this->load->view('user/services/my_services');
        $this->load->view('commons/footer');
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
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $user=$this->input->post();
                $pass=$user['pass'];
                $user['pass']=$this->encryption->encrypt($pass);
                if(!$this->user_model->registro($user)){
                    output_json(["status"=>0,"message"=>"No se ha podido Registrar"]);
                }else{
                    $user=$this->user_model->get_object(["email"=>$user["email"]]);
                    $this->session->set_userdata("user",$user);
                    output_json(["status"=>1,"message"=>"Registrado Correctament","url"=>base_url('user')]);
                }
            }
            exit;

        }else{
            redirect(base_url('navigation'));
        }

    }
    public function login()
    {
        if($this->input->is_ajax_request()){
            //Le asignamos las reglas de validacion
            $this->form_validation->set_rules("email","Email","trim|min_length[3]|max_length[100]|required|xss_clean");
            $this->form_validation->set_rules("pass","Contraseña","trim|min_length[6]|max_length[12]|required|xss_clean");

            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $post=$this->input->post();
                $email=$post['email'];
                $pass=$post['pass'];
                $user=$this->user_model->get_object(["email"=>$email]);
                if($user){
                    if($pass!=$this->encryption->decrypt($user->pass)){
                        output_json(["status"=>0,"message"=>"Usuario o contraseña invalidos"]);
                    }else{
                        $this->session->set_userdata("user",$user);
                        output_json(["status"=>1,"message"=>"Login exitoso","url"=>base_url('user')]);
                    }
                }else{
                    output_json(["status"=>0,"message"=>"Usuario o contraseña invalidos"]);
                }
            }
            exit;

        }else{
            redirect(base_url('navigation'));
        }

    }
    public function logout(){
        $this->session->unset_userdata("user");
        redirect(base_url());
    }
}