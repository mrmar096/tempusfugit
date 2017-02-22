<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class User extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $prefs['template'] = array(
            'table_open'           => '<table class="calendar">',
            'cal_cell_start'       => '<td class="day">',
            'cal_cell_content'     =>'<a  data-toggle="tooltip" data-placement="bottom" title="" data-original-title="prueba" class="text-danger" onclick="return pickDatecalendar(this)">{day}',

            'cal_cell_start_today' => '<td class="today">'
        );
        $this->load->library('calendar', $prefs);

    }
    public function index(){
      $this->profile();
    }
    //GET


    public function profile(){
        $this->load->view('commons/header',["title"=>"Profile","icon"=>"person_pin","color"=>"btn-info"]);
        $this->load->view('user/profile');
        $this->load->view('commons/footer');
    }
    public function messages()
    {
        $this->load->view('commons/header',['title'=>'Mensajes',"icon"=>"local_post_office","color"=>"btn-primary"]);
        $this->load->view('user/messages',["recibidos"=>$this->user_model->getMessagesRecibidos($this->session->userdata("user")->id),"emitidos"=>$this->user_model->getMessagesEmitidos($this->session->userdata("user")->id)]);
        $this->load->view('commons/footer');
    }

    public function my_services(){
        if($this->session->userdata("user")->type!=NORMAL_USER){
            redirect($this->agent->referer);
        }
        $this->load->view('commons/header',["title"=>"Mis Servicios","icon"=>"work","color"=>""]);
        $this->load->view('user/services/my_services',["servicios"=>$this->user_model->getMyServices($this->session->userdata("user")->id)]);
        $this->load->view('commons/footer');
    }
    public function detailservice($id){
        $this->load->view('commons/header',["title"=>"Detalle Servicio","icon"=>"work","color"=>""]);
        $this->load->view('user/services/detail',["servicio"=>$this->user_model->getService($id)]);
        $this->load->view('commons/footer');
    }
    //POST
    public function newmessage($destino){
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
                if(isset($data["privado"])){
                    $data["privado"]=true;
                }
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
    public function newservicemage($id){
        $this->uploadFileanDb($id);
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



    //DELETE
    public function deletemessage($id){
        if($this->user_model->deleteMessages(["id"=>$id])){
            output_json(['status'=>1,'message'=>'El mensaje ha sido eliminado']);
        }else{
            output_json(['status'=>0,'message'=>'El mensaje no ha podido ser eliminado']);
        }
    }




  //Extra --UPLOAD MULTIMEDIA

    public function uploadFileanDb($id)
    {
        $config['upload_path']          = 'resources/uploads';
        $config['allowed_types']        = 'gif|jpg|png|mp4|wmv';
        $config['file_name']            = 'serv_'.$id.'_'.time();
        $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('file'))
        {
            $error = array('error' => $this->upload->display_errors());
            output_json(["status"=>0,"message"=>"Subida Erronea","errors"=>$error]);
        }
        else
        {
            $src='resources/uploads/'.$this->upload->data("file_name");
            if(!empty($this->input->post("alt"))){
                $alt=$this->input->post("alt");
            }else{
                $alt="";
            }
            $type=$this->upload->data('file_type');
            if($id=$this->sm->newMm($id,$src,$alt,$type)){
                output_json(["status"=>1,"message"=>"Subida Satisfactoria"]);
            }else{
                output_json(["status"=>0,"message"=>"Subida Erronea"]);
            }

        }
    }
    //PAGINATION


}