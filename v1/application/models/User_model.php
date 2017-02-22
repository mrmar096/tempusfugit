<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class User_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function registro($user)
    {
        return $this->db->insert(TABLE_USER,$user);
    }
    public function get($id=null)
    {
        if($id==null){
            return $this->db->get(TABLE_USER)->result();
        }else{
            return $this->db->get_where(TABLE_USER,$id)->result();
        }

    }
    public function get_object($id)
    {
        return $this->db->get_where(TABLE_USER,$id)->row();
    }
    public function getMessagesEmitidos($user)
    {
        $this->db->select('messages.id,messages.mensaje,services.titulo as servicio,messages.privado,users.nombre as receptor');
        $this->db->from(TABLE_MESSAGES);
        $this->db->join(TABLE_USER, 'users.id = messages.emisor');
        $this->db->join(TABLE_SERVICES, 'services.id = messages.service');
        $this->db->where("emisor",$user);
        //die(var_dump($this->db->get_compiled_select()));
        return $this->db->get()->result();
    }
    public function getMessagesRecibidos($user)
    {
        $this->db->select('messages.id,messages.mensaje,services.titulo as servicio,messages.privado,users.nombre as emisor');
        $this->db->from(TABLE_MESSAGES);
        $this->db->join(TABLE_USER, 'users.id = messages.receptor');
        $this->db->join(TABLE_SERVICES, 'services.id = messages.service');
        $this->db->where("receptor",$user);
        //die(var_dump($this->db->get_compiled_select()));
        return $this->db->get()->result();
    }
    public function newMessage($data){
        $this->db->insert(TABLE_MESSAGES,$data);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function deleteMessages($where=null)
    {
        $this->db->delete(TABLE_MESSAGES,$where);
        return $this->db->affected_rows()>0;
    }


    public function getMultiMessages($where=null,$wannaObj=false)
    {
        if ($wannaObj && $where) {
            return $this->db->get_where(TABLE_MESSAGES, $where)->row();
        }
        if ($where) {
            return $this->db->get_where(TABLE_MESSAGES, $where)->result();
        } else {
            return $this->db->get(TABLE_MESSAGES)->result();
        }
    }
    public function getMyServices($user)
    {
        $this->db->select('services.id,services.titulo,services.descripcion,services.duracion,categories.nombre as categoria,subcategories.nombre as subcategoria');
        $this->db->from(TABLE_SERVICES);
        $this->db->join(TABLE_CATEGORIES, 'categories.id = services.categorie');
        $this->db->join(TABLE_SUBCATEGORIES, 'subcategories.id = services.subcategorie');
        $this->db->where("ofertante",$user);
        //die(var_dump($this->db->get_compiled_select()));
        $result=$this->db->get()->result();
        $servicios=null;
        foreach ($result as $service){
            $multimedia=$this->sm->getMultimediaServices(["service"=>$service->id]);
            $service->multimedia=$multimedia;
            $servicios[]=$service;
        }
        return $servicios;

    }
    public function getService($id)
    {
        $this->db->select('services.ofertante,services.id,services.titulo,services.descripcion,services.duracion,categories.nombre as categoria,subcategories.nombre as subcategoria');
        $this->db->from(TABLE_SERVICES);
        $this->db->join(TABLE_CATEGORIES, 'categories.id = services.categorie');
        $this->db->join(TABLE_SUBCATEGORIES, 'subcategories.id = services.subcategorie');
        $this->db->where("services.id",$id);
        //die(var_dump($this->db->get_compiled_select()));
        $result=$this->db->get()->result();
        $servicios=null;
        foreach ($result as $service){
            $multimedia=$this->sm->getMultimediaServices(["service"=>$service->id]);
            $service->multimedia=$multimedia;
            $servicios[]=$service;
        }
        return $servicios;

    }



}
