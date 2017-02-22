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
    //GETS
    public function messages($offset=0)
    {
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        //HEADER
        $header=array('#','NOMBRE','COMENTARIO','VISIBLE');
        //GET DATA DB
        $data=$this->admin_model->getMessages(null,false,$this->config->item("items_per_page"), $offset);
        $count=$this->admin_model->num_rows(TABLE_CONTACT);
        //PREPARE TABLE
        $this->table->set_heading($header);
        foreach ($data as $item){
            $id=$item["id"];
            $this->table->add_row(build_checkbox(implode(",",$item),null,$id,$is_ajax),$item["nombre"],$item["comentario"],$item["privado"]==true?PRIVATE_ICON:PUBLIC_ICON);
        }
        //Table HTML
        $table=$this->createPagination(base_url('admin/messages/'),$count,"",base_url('admin/deletemessages'));
        if($is_ajax){
            echo $table;
        }else{
            $this->load->view('commons/header',['title'=>'Mensajes',"icon"=>"local_post_office","color"=>"btn-primary"]);
            $this->load->view('admin/messages',["table"=>$table]);
            $this->load->view('commons/footer');
        }
    }


    public function categories($offset=0)
    {
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        //HEADER
        $header=array('#','NOMBRE');
        //GET DATA DB
        $data=$this->admin_model->getCategories(null,false,$this->config->item("items_per_page"), $offset);
        $count=$this->admin_model->num_rows(TABLE_CATEGORIES);
        //PREPARE TABLE
        $this->table->set_heading($header);
        foreach ($data as $item){
            $id=$item["id"];
            $this->table->add_row(build_checkbox(implode(",",$item),$id,$id,$is_ajax),$item["nombre"]);
        }
        //Table HTML
        $table=$this->createPagination(base_url('admin/categories/'),$count,base_url('admin/categoriesFormDialog/'),base_url('admin/deletecategories'));

        if($is_ajax){

            echo $table;
        }else {

            $this->load->view('commons/header', ['title' => 'Categorias', "icon" => "format_list_bulleted", "color" => "btn-danger"]);
            $this->load->view('admin/menu_categories', ['active' => '0']);
            $this->load->view('admin/categories', ["table" =>$table]);
            $this->load->view('commons/footer');
        }
    }

    public function subcategories($offset=0){
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        //HEADER
        $header=array('#','NOMBRE','CATEGORIA');
        //GET DATA DB
        $data=$this->admin_model->getSubCategories(null,false,$this->config->item("items_per_page"), $offset);
        $count=$this->admin_model->num_rows(TABLE_SUBCATEGORIES);
        //PREPARE TABLE
        $this->table->set_heading($header);
        foreach ($data as $item){
            $id=$item["id"];
            $this->table->add_row(build_checkbox(implode(",",$item),$id,$id,$is_ajax),$item["nombre"],$item["categoria"]);
        }
        //Table HTML
        $table=$this->createPagination(base_url('admin/subcategories/'),$count,base_url('admin/subcategoriesFormDialog/'),base_url('admin/deletesubcategories'));

        if($is_ajax){
            echo $table;
        }else {
            $this->load->view('commons/header', ['title' => 'Sub-Categorias', "icon" => "format_list_bulleted", "color" => "btn-primary"]);
            $this->load->view('admin/menu_categories', ['active' => '1']);
            $this->load->view('admin/subcategories', ["table" => $table]);
            $this->load->view('commons/footer');
        }
    }

    public function cities($offset=0)
    {
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        //HEADER
        $header=array('#','NOMBRE','LATITUD','LONGITUD');
        //GET DATA DB
        $data=$this->admin_model->getCities(null,false,5, $offset);
        $count=$this->admin_model->num_rows(TABLE_CITY);
        //PREPARE TABLE
        $this->table->set_heading($header);
        foreach ($data as $item){
            $id=$item["id"];
            $this->table->add_row(build_checkbox(implode(",",$item),$id,$id,$is_ajax),$item["nombre"],$item["lat"],$item["log"]);
        }
        //Table HTML
        $table=$this->createPagination(base_url('admin/cities/'),$count,base_url('admin/citiesFormDialog/'),base_url('admin/deletecities'));
        if($is_ajax){
            echo $table;
        }else {

            $this->load->view('commons/header',['title'=>'Ciudades',"icon"=>"add_location","color"=>"btn-warning"]);
            $this->load->view('admin/cities', ["table" =>$table]);
            $this->load->view('commons/footer');
        }

    }

    //POST
    public function newcategorie(){
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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
                    ob_start();
                    $this->categories();
                    $html=ob_get_contents();
                    ob_end_clean();
                    output_json(['status'=>1,'message'=>'La categoria ha sido añadida','html'=>$html,'element'=>'.pagination-container']);
                }else{
                    output_json(['status'=>0,'message'=>'La categoria no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

    public function newsubcategorie(){
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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
                    ob_start();
                    $this->subcategories();
                    $html=ob_get_contents();
                    ob_end_clean();
                    output_json(['status'=>1,'message'=>'La Sub-Categoria ha sido añadida','html'=>$html,'element'=>'.pagination-container']);
                }else{
                    output_json(['status'=>0,'message'=>'La Sub-Categoria  no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

    public function newcity(){
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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
                    ob_start();
                    $this->cities();
                    $html=ob_get_contents();
                    ob_end_clean();
                    output_json(['status'=>1,'message'=>'La ciudad ha sido añadida','html'=>$html,'element'=>'.pagination-container']);
                }else{
                    output_json(['status'=>0,'message'=>'La ciudad no ha podido ser añadida']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }




    //PUT
    public function updatecategorie($id)
    {
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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
                    ob_start();
                    $this->categories();
                    $html=ob_get_contents();
                    ob_end_clean();
                    output_json(['status'=>1,'message'=>'La categoria ha sido actualizada','html'=>$html,'element'=>'.pagination-container']);
                }else{
                    output_json(['status'=>0,'message'=>'La categoria no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }


    public function updatesubcategorie($id)
    {
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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
                    ob_start();
                    $this->subcategories();
                    $html=ob_get_contents();
                    ob_end_clean();
                    output_json(['status'=>1,'message'=>'La Sub-Categoria ha sido actualizada','html'=>$html,'element'=>'.pagination-container']);
                }else{
                    output_json(['status'=>0,'message'=>'La Sub-Categoria  no ha sufrido cambios']);
                }

            }

        }else{
            output_json(['status'=>0,'message'=>'No es ajax']);
        }
    }

    public function updatecity($id){
        //GET_AJAX?
        $is_ajax=$this->input->is_ajax_request();
        if($is_ajax){
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



    //DELETE
    public function deletemessages($id=null){
        $where["id"]=$id;
        if(!empty($multiple=$this->input->post("multiple"))){
            $where["id"]=$multiple;
        }
        if($this->admin_model->deleteMessages($where)){
            output_json(['status'=>1,'message'=>'Los mensajes seleccionados han sido eliminados']);
        }else{
            output_json(['status'=>0,'message'=>'No se pudo efectuar la eliminacion']);
        }
    }

    public function deletecategories($id=null)
    {
        $where["id"]=$id;
        if(!empty($multiple=$this->input->post("multiple"))){
            $where["id"]=$multiple;
        }
        if($this->admin_model->deleteCategories($where)){
            output_json(['status'=>1,'message'=>'Las categorias seleccionadas han sido eliminadas']);
        }else{
            output_json(['status'=>0,'message'=>'No se pudo efectuar la eliminacion']);
        }


    }

    public function deletesubcategories($id=null){
        $where["id"]=$id;
        if(!empty($multiple=$this->input->post("multiple"))){
            $where["id"]=$multiple;
        }
        if($this->admin_model->deleteSubCategories($where)){
            output_json(['status'=>1,'message'=>'La subcategorias seleccionads han sido eliminadas ']);
        }else{
            output_json(['status'=>0,'message'=>'No se pudo efectuar la eliminacion']);
        }
    }

    public function deletecities($id=null){
        $where["id"]=$id;
        if(!empty($multiple=$this->input->post("multiple"))){
            $where["id"]=$multiple;
        }
        if($this->admin_model->deleteCities($where)){
            output_json(['status'=>1,'message'=>'Las ciudades seleccionadas han sido eliminadas']);
        }else{
            output_json(['status'=>0,'message'=>'No se pudo efectuar la eliminacion']);
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
        $list_cat=$this->admin_model->getCategories(null,true);
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

    //PAGINATION

    public function createPagination($url,$total_rows,$urledit,$urldelete){
        $config['base_url'] = $url;
        $config['total_rows'] = $total_rows;
        $config['per_page'] = $this->config->item("items_per_page");
        $config['show_count']=false;
        $config['full_tag_open']="<ul class='pagination pagination-lg'>";
        $config['full_tag_close']="</ul>";
        $config['num_tag_open']='<li>';
        $config['num_tag_close']='</li>';
        $config['cur_tag_open']='<li class="active" disabled="disabled"><a>';
        $config['cur_tag_close']='</a></li>';
        $config['next_tag_open']='<li>';
        $config['next_tag_close']='</li>';
        $config['prev_tag_open']='<li>';
        $config['prev_tag_close']='</li>';
        $config['last_tag_open']='<li>';
        $config['last_tag_close']='</li>';
        $config['first_tag_open']='<li>';
        $config['first_tag_close']='</li>';
        $config['last_link']="Ultimo";
        $config['first_link']="Primero";
        $this->pagination->initialize($config);
        $template = array(
            'table_open'            => '<table class="table multiselect-checkbox" >',
            'tbody_open'            => '<tbody class="white">',
            'cell_start'               => '<td valign="center">'
        );
        $this->table->set_template($template);

        $zone_buttons='<div class="col-md-12 pull-left">
        <a disabled href="'.$urledit.'" class=" white btn  btn-xs btn-raised btn-success btn-edit">Editar <i class="material-icons">edit</i> </a>
        <a disabled href="'.$urldelete.'"  class=" white btn  btn-xs btn-raised btn-danger btn-delete">Eliminar <i class="material-icons">delete</i> </a>
        </div>';
        $html=$zone_buttons.$this->table->generate()."</br>".$this->pagination->create_links();

        return $html;

    }
}
