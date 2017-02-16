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
        $this->load->view('admin/messages');
        $this->load->view('commons/footer');
    }
    public function categories()
    {
        $this->load->view('commons/header',['title'=>'Categorias']);
        $this->load->view('admin/menu_categories',['active'=>'0']);
        $this->load->view('admin/categories',["data"=>$this->admin_model->getCategories()]);
        $this->load->view('commons/footer');
    }
    public function deletecategorie($id)
    {
        output_json(['status'=>1,'message'=>'Has intentado eliminar la categoria '.$id]);
    }
    public function deletesubcategorie($id)
    {
        output_json(['status'=>1,'message'=>'Has intentado eliminar la subcategoria '.$id]);
    }
    public function subcategories()
    {
        $this->load->view('commons/header',['title'=>'Sub-Categorias']);
        $this->load->view('admin/menu_categories',['active'=>'1']);
        $this->load->view('admin/subcategories',["data"=>$this->admin_model->getSubCategories()]);
        $this->load->view('commons/footer');
    }
    public function cities()
    {
        $this->load->view('commons/header',['title'=>'Ciudades']);
        $this->load->view('admin/cities');
        $this->load->view('commons/footer');
    }
}
//End of file applications/controller/Hello.php