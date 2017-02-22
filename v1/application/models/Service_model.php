<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Service_model extends CI_Model 
{
    const TABLE_SERVICES='services';
    const TABLE_OP_MM_SERVICES='opinions_mm_services';
    const TABLE_MM_SERVICES="multimedia_services";
    const TABLE_CATEGORIES='categories';
    const TABLE_SUBCATEGORIES='subcategories';
    const TABLE_USER='users';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function newMm($service,$src,$alt,$type)
    {
        $data=array(
            'src'=>$src,
            'alt'=>$alt,
            'type'=>$type,
            'service'=>$service
        );
        $this->db->insert(TABLE_MM_SERVICES,$data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;


    }


    public function getMessages($where=null,$wannaObj=false)
    {

        if ($wannaObj && $where) {
            return $this->db->get_where(TABLE_CONTACT, $where)->row();
        }
        if ($where) {
            return $this->db->get_where(TABLE_CONTACT, $where)->result();
        } else {
            return $this->db->get(TABLE_CONTACT)->result();
        }
    }
    public function newMessage($data){
        $this->db->insert(TABLE_CONTACT,$data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }

    public function getOpinions($where=null,$wannaObj=false)
    {

        if ($wannaObj && $where) {
            return $this->db->get_where(TABLE_OP_MM_SERVICES, $where)->row();
        }
        if ($where) {
            return $this->db->get_where(TABLE_OP_MM_SERVICES, $where)->result();
        } else {
            return $this->db->get(TABLE_OP_MM_SERVICES)->result();
        }
    }
    public function newOpinion($data){
        $this->db->insert(TABLE_OP_MM_SERVICES,$data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }

    public function getServices()
    {
        $this->db->select('services.id,services.titulo,services.descripcion,services.duracion,categories.nombre as categoria,subcategories.nombre as subcategoria');
        $this->db->from(TABLE_SERVICES);
        $this->db->join(TABLE_CATEGORIES, 'categories.id = services.categorie');
        $this->db->join(TABLE_SUBCATEGORIES, 'subcategories.id = services.subcategorie');
        //die(var_dump($this->db->get_compiled_select()));
        $result=$this->db->get()->result();
        $servicios=null;
        foreach ($result as $service){
            $multimedia=$this->getMultimediaServices(["service"=>$service->id]);

            $service->multimedia=$multimedia;
            $servicios[]=$service;
        }
        return $servicios;

    }
    public function getMultimediaServices($where)
    {
        $result=$this->db->get_where(TABLE_MM_SERVICES,$where)->result();
        $multimedia=null;
        foreach ($result as $item){
            $item->opinions=$this->getOpinionsMMServicebymm($item->id);
            $multimedia[]=$item;
        }
        return $multimedia;
    }


    public function getOpinionsMMServicebymm($idmm)
    {
        $this->db->select(TABLE_OP_MM_SERVICES.'.id,opinion as comentario,puntuacion,users.nombre');
        $this->db->from(TABLE_OP_MM_SERVICES);
        $this->db->join(TABLE_USER, 'users.id = '.TABLE_OP_MM_SERVICES.'.user');
        //die(var_dump($this->db->get_compiled_select()));
        $this->db->where("multimedia",$idmm);
        return $this->db->get()->result();


    }
    public function getOpinionsMMService($idop)
    {
        $this->db->select(TABLE_OP_MM_SERVICES.'.id,opinion as comentario,puntuacion,users.nombre');
        $this->db->from(TABLE_OP_MM_SERVICES);
        $this->db->join(TABLE_USER, 'users.id = '.TABLE_OP_MM_SERVICES.'.user');
        //die(var_dump($this->db->get_compiled_select()));
        $this->db->where(TABLE_OP_MM_SERVICES.'.id',$idop);
        return $this->db->get()->result();


    }
}
