<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin extends CI_Controller 
{
    public function __construct()
    {
        parent::__construct();
        if($this->session->userdata("user")->type!=ADMIN_USER){
            redirect($this->agent->referer);
        }
    }
    
    public function messages()
    {
        $this->load->view('commons/header',['title'=>'Mensajes']);
        $this->load->view('admin/messages',["data"=>$this->admin_model->getMessages()]);
        $this->load->view('commons/footer');
    }
    public function deletemessage($id){
        if($this->admin_model->deleteMessages(["id"=>$id])){
            output_json(['status'=>1,'message'=>'El mensaje ha sido eliminado']);
        }else{
            output_json(['status'=>0,'message'=>'El mensaje no ha podido ser eliminado']);
        }
    }
    public function categories()
    {
        $this->load->view('commons/header',['title'=>'Categorias']);
        $this->load->view('admin/menu_categories',['active'=>'0']);
        $this->load->view('admin/categories',["data"=>$this->admin_model->getCategories()]);
        $this->load->view('commons/footer');
    }
    public function newcategorie(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Categoria","trim|min_length[3]|max_length[100]|required|is_unique[categories.nombre]");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("is_unique","Lo sentimos ya existe una categoria con ese nombre");
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($id=$this->admin_model->newCategorie($data)){
                    $data=$this->admin_model->getCategories(["id"=>$id],false);
                    $html=build_tr($data,base_url('admin/categoriesFormDialog/update'),base_url('admin/deletecategorie/'));
                    output_json(['status'=>1,'message'=>'La categoria ha sido añadida','html'=>$html,'element'=>'table']);
                }else{
                    output_json(['status'=>0,'message'=>'La categoria no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }




    public function updatecategorie($id)
    {
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Categoria","trim|min_length[3]|max_length[100]|required");
            //Le asignamos los mensajes para las reglas

            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($this->admin_model->updateCategorie(["id"=>$id],$data)){
                    $data=$this->admin_model->getCategories(["id"=>$id],false);
                    $html=build_tr($data,base_url('admin/categoriesFormDialog/update'),base_url('admin/deletecategorie/'));
                    output_json(['status'=>1,'message'=>'La categoria ha sido actualizada','html'=>$html,'element'=>'#table_tr_'.$id]);
                }else{
                    output_json(['status'=>0,'message'=>'La categoria no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }


    public function deletecategorie($id)
    {
        if($this->admin_model->deleteCategories(["id"=>$id])){
            output_json(['status'=>1,'message'=>'La categoria ha sido eliminada']);
        }else{
            output_json(['status'=>0,'message'=>'La categoria no ha podido ser eliminada']);
        }


    }

    public function subcategories()
    {
        $this->load->view('commons/header',['title'=>'Sub-Categorias']);
        $this->load->view('admin/menu_categories',['active'=>'1']);
        $this->load->view('admin/subcategories',["data"=>$this->admin_model->getSubCategories()]);
        $this->load->view('commons/footer');
    }
    public function newsubcategorie(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Subcategoria","trim|min_length[3]|max_length[100]|required|is_unique[subcategories.nombre]");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("is_unique","Lo sentimos ya existe una Sub-Categoria con ese nombre");
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($id=$this->admin_model->newSubCategorie($data)){
                    $data=$this->admin_model->getSubCategories($id);
                    $html=build_tr($data,base_url('admin/subcategoriesFormDialog/update'),base_url('admin/deletesubcategorie/'));
                    output_json(['status'=>1,'message'=>'La Sub-Categoria ha sido añadida','html'=>$html,'element'=>'table']);
                }else{
                    output_json(['status'=>0,'message'=>'La Sub-Categoria  no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

    public function updatesubcategorie($id)
    {
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Subcategoria","trim|min_length[3]|max_length[100]|required");
            //Le asignamos los mensajes para las reglas

            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($this->admin_model->updateSubCategorie(["id"=>$id],$data)){
                    $data=$this->admin_model->getSubCategories($id);
                    $html=build_tr($data,base_url('admin/subcategoriesFormDialog/update'),base_url('admin/deletesubcategorie/'));
                    output_json(['status'=>1,'message'=>'La Sub-Categoria ha sido actualizada','html'=>$html,'element'=>'#table_tr_'.$id]);
                }else{
                    output_json(['status'=>0,'message'=>'La Sub-Categoria  no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }
    public function deletesubcategorie($id)
    {
        if($this->admin_model->deleteSubCategories(["id"=>$id])){
            output_json(['status'=>1,'message'=>'La subcategoria ha sido eliminada ']);
        }else{
            output_json(['status'=>0,'message'=>'La subcategoria no ha podido ser eliminada']);
        }
    }
    public function cities()
    {
        $this->load->view('commons/header',['title'=>'Ciudades']);
        $this->load->view('admin/cities',["data"=>$this->admin_model->getCities()]);
        $this->load->view('commons/footer');
    }

    public function newcity(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Ciudad","trim|min_length[3]|max_length[100]|required|is_unique[cities.nombre]");
            $this->form_validation->set_rules("lat","Latitud","trim|min_length[3]|max_length[15]|required");
            $this->form_validation->set_rules("log","Longitud","trim|min_length[3]|max_length[15]|required");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("is_unique","Lo sentimos ya existe una ciudad con ese nombre");
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $city=$this->input->post();
                if($id=$this->admin_model->newCity($city)){
                    $city=$this->admin_model->getCities(["id"=>$id],false);
                    $html=build_tr($city,base_url('admin/citiesFormDialog/update'),base_url('admin/deletecity/'));
                    output_json(['status'=>1,'message'=>'La ciudad ha sido añadida','html'=>$html,'element'=>'table']);
                }else{
                    output_json(['status'=>0,'message'=>'La ciudad no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }
    public function deletecity($id){
        if($this->admin_model->deleteCities(["id"=>$id])){
            output_json(['status'=>1,'message'=>'La ciudad ha sido eliminada']);
        }else{
            output_json(['status'=>0,'message'=>'La ciudad no ha podido ser eliminada']);
        }
    }

    public function updatecity($id){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("nombre","Ciudad","trim|min_length[3]|max_length[100]|required");
            $this->form_validation->set_rules("lat","Latitud","trim|min_length[3]|max_length[15]|required");
            $this->form_validation->set_rules("log","Longitud","trim|min_length[3]|max_length[15]|required");
            //Le asignamos los mensajes para las reglas

            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $city=$this->input->post();
                if($this->admin_model->updateCity(["id"=>$id],$city)){
                    $city=$this->admin_model->getCities(["id"=>$id],false);
                    $html=build_tr($city,base_url('admin/citiesFormDialog/update'),base_url('admin/deletecity/'));
                    output_json(['status'=>1,'message'=>'La ciudad ha sido actualizada','html'=>$html,'element'=>'#table_tr_'.$id]);
                }else{
                    output_json(['status'=>0,'message'=>'La ciudad no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }
    public function aptitudes()
    {
        $this->load->view('commons/header',['title'=>'Aptitudes']);
        $this->load->view('admin/aptitudes',["data"=>$this->admin_model->getApt()]);
        $this->load->view('commons/footer');
    }

    public function newapt(){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("aptitud","Aptitud","trim|min_length[3]|max_length[100]|required|is_unique[apt.aptitud]");
            //Le asignamos los mensajes para las reglas
            $this->form_validation->set_message("is_unique","Lo sentimos ya existe una ciudad con ese nombre");
            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($id=$this->admin_model->newApt($data)){
                    $data=$this->admin_model->getApt(["id"=>$id],false);
                    $html=build_tr($data,base_url('admin/aptFormDialog/update'),base_url('admin/deleteapt/'));
                    output_json(['status'=>1,'message'=>'La Aptitud ha sido añadida','html'=>$html,'element'=>'table']);
                }else{
                    output_json(['status'=>0,'message'=>'La Aptitud no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }
    public function deleteapt($id){
        if($this->admin_model->deleteApt(["id"=>$id])){
            output_json(['status'=>1,'message'=>'La Aptitud ha sido eliminada']);
        }else{
            output_json(['status'=>0,'message'=>'La Aptitud no ha podido ser eliminada']);
        }
    }

    public function updateapt($id){
        if($this->input->is_ajax_request()){
            $this->form_validation->set_rules("aptitud","Aptitud","trim|min_length[3]|max_length[100]|required");

            //Le asignamos los mensajes para las reglas

            $this->form_validation->set_message("required","El campo %s es obligatorio");
            $this->form_validation->set_message("min_length","El campo %s debe ser superior a %s caracteres");
            $this->form_validation->set_message("max_length","El campo %s debe ser inferior a %s caracteres");
            if(!$this->form_validation->run()) {
                output_json(["status"=>0,"message"=>validation_errors()]);
            }else{
                $data=$this->input->post();
                if($this->admin_model->updateApt(["id"=>$id],$data)){
                    $data=$this->admin_model->getApt(["id"=>$id],false);
                    $html=build_tr($data,base_url('admin/aptFormDialog/update'),base_url('admin/deleteapt/'));
                    output_json(['status'=>1,'message'=>'La Aptitud ha sido actualizada','html'=>$html,'element'=>'#table_tr_'.$id]);
                }else{
                    output_json(['status'=>0,'message'=>'La Aptitud no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

    //Formularios

    public function citiesFormDialog($type="register"){
        $values=array();
        if($post=$this->input->get("values")){
            $values=$post;
        }
        $html="";
        if($type=="register"){
            $title="Añade una ciudad";
            $html.=form_open('admin/newcity/',["class"=>"form-dialog-sw"]);
        }
        else{
            $title="Edita la ciudad";
            $html.=form_open('admin/updatecity/'.$values[0],["class"=>"form-dialog-sw"]);
        }
        $field_nombre=array(
            'class'=>'form-control',
            'required'=>'required',
            'name'=>'nombre',
            'value'=>count($values)>1?$values[1]:"",
        );
        $field_lat=array(
            'class'=>'form-control',
            'name'=>'lat',
            'type'=>'number',
            'step'=>'any',
            'required'=>'required',
            'value'=>count($values)>2?$values[2]:"",
        );

        $field_log=array(
            'class'=>'form-control',
            'name'=>'log',
            'type'=>'number',
            'step'=>'any',
            'required'=>'required',
            'value'=>count($values)>3?$values[3]:"",
        );


        $html.='<div class="form-group label-floating">';
        $html.=form_label("Ciudad","nombre",["class"=>"control-label"]);
        $html.=form_input($field_nombre);
        $html.="</div>";
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Latitud","latitud",["class"=>"control-label"]);
        $html.=form_input($field_lat);
        $html.="</div>";
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Longitud","longitud",["class"=>"control-label"]);
        $html.=form_input($field_log);
        $html.="</div>";
        $html.=form_button(["type"=>"submit","class"=>"btn btn-primary btn-raised "],"Enviar");
        $html.=form_close();
        output_json(['status'=>1,'title'=>$title,'html'=>$html]);

    }
    public function aptFormDialog($type="register"){
        $values=array();
        if($post=$this->input->get("values")){
            $values=$post;
        }
        $html="";
        if($type=="register"){
            $title="Añade una aptitud";
            $html.=form_open('admin/newapt/',["class"=>"form-dialog-sw"]);
        }
        else{
            $title="Edita la aptitud";
            $html.=form_open('admin/updateapt/'.$values[0],["class"=>"form-dialog-sw"]);
        }
        $field_apt=array(
            'class'=>'form-control',
            'required'=>'required',
            'name'=>'aptitud',
            'value'=>count($values)>1?$values[1]:"",
        );
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Aptitud","aptitud",["class"=>"control-label"]);
        $html.=form_input($field_apt);
        $html.="</div>";
        $html.=form_button(["type"=>"submit","class"=>"btn btn-primary btn-raised "],"Enviar");
        $html.=form_close();
        output_json(['status'=>1,'title'=>$title,'html'=>$html]);

    }

    public function categoriesFormDialog($type="register"){
        $values=array();

        if($post=$this->input->get("values")){
            $values=$post;
        }
        $html="";
        if($type=="register"){
            $title="Añade una categoria";
            $html.=form_open('admin/newcategorie/',["class"=>"form-dialog-sw"]);
        }
        else{
            $title="Edita la categoria";
            $html.=form_open('admin/updatecategorie/'.$values[0],["class"=>"form-dialog-sw"]);
        }

        $field_nombre=array(
            'class'=>'form-control',
            'required'=>'required',
            'name'=>'nombre',
            'value'=>count($values)>1?$values[1]:"",

        );
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Nombre &nbsp","categoria",["class"=>"control-label"]);
        $html.=form_input($field_nombre);
        $html.="</div>";
        $html.=form_button(["type"=>"submit","class"=>"btn btn-primary btn-raised "],"Enviar");
        $html.=form_close();
        output_json(['status'=>1,'title'=>$title,'html'=>$html]);

    }

    public function subcategoriesFormDialog($type="register"){
        $values=array();

        if($post=$this->input->get("values")){
            $values=$post;
        }
        $html="";
        if($type=="register"){
            $title="Añade una Sub-Categoria";
            $html.=form_open('admin/newsubcategorie/',["class"=>"form-dialog-sw"]);
        }
        else{
            $title="Edita la Sub-Categoria";
            $html.=form_open('admin/updatesubcategorie/'.$values[0],["class"=>"form-dialog-sw"]);
        }
        $field_nombre=array(
            'class'=>'form-control',
            'required'=>'required',
            'name'=>'nombre',
            'value'=>count($values)>1?$values[1]:""
        );
        $list_attr_cat=array(
            'class'=>'form-control',
            'required'=>'required'
        );
        $list_cat=$this->admin_model->getCategories();
        $selected="";
        foreach ($list_cat as $cat){
            $dropdown_cat[$cat->id]=$cat->nombre;
            if(count($values)>2){
                if($values[2]==$cat->nombre)
                $selected=$cat->id;
            }
        }
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Nombre &nbsp","subcategoria",["class"=>"control-label"]);
        $html.=form_input($field_nombre);
        $html.="</div>";
        $html.='<div class="form-group label-floating">';
        $html.=form_label("Seleccione categoria &nbsp","categorie",["class"=>"control-label"]);
        $html.=form_dropdown("categorie",$dropdown_cat,$selected,$list_attr_cat);
        $html.="</div>";
        $html.=form_button(["type"=>"submit","class"=>"btn btn-primary btn-raised "],"Enviar");
        $html.=form_close();
        output_json(['status'=>1,'title'=>$title,'html'=>$html]);

    }


}
