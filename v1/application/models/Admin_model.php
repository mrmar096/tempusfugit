<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }
    //SELECT

    public function num_rows($table)
    {

        $consulta = $this->db->get($table);
        return $consulta->num_rows();

    }

    public function paginacion($table,$limit, $offset)
    {

        $consulta = $this->db->get($table, $limit, $offset);
        if ($consulta->num_rows() > 0)
        {

            return $consulta->result_array();

        }

    }



    public function getCities($where=null,$wannaObj=false,$limit=null, $offset=null)
    {
        if($wannaObj&&$where){
            return $this->db->get_where(TABLE_CITY,$where,$limit,$offset)->row();
        }
        if($where){
            return $this->db->get_where(TABLE_CITY,$where,$limit,$offset)->result_array();
        }else{
            return $this->db->get(TABLE_CITY,$limit,$offset)->result_array();
        }

    }
    public function getCategories($where=null,$wannaObj=false,$limit=null, $offset=null)
    {
        if($wannaObj){
            return $this->db->get_where(TABLE_CATEGORIES,$where,$limit,$offset)->result();
        }
        if($wannaObj&&$where){
            return $this->db->get_where(TABLE_CATEGORIES,$where,$limit,$offset)->row();
        }
        if($where){
            return $this->db->get_where(TABLE_CATEGORIES,$where,$limit,$offset)->result_array();
        }else{
            return $this->db->get(TABLE_CATEGORIES,$limit,$offset)->result_array();
        }
    }
    public function getSubCategories($id=null, $wannaObj=false,$limit=null, $offset=null)
    {
        if($wannaObj){
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.TABLE_CATEGORIES.' ca, '.TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id and  sc.id='.$id.' LIMIT '.$limit.' OFFSET '.$offset)->result();
        }

        if($wannaObj&&$id){
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.TABLE_CATEGORIES.' ca, '.TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id and  sc.id='.$id.' LIMIT '.$limit.' OFFSET '.$offset)->row();
        }
        if($id){
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.TABLE_CATEGORIES.' ca, '.TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id and  sc.id='.$id.' LIMIT '.$limit.' OFFSET '.$offset)->result_array();
        }else{
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.TABLE_CATEGORIES.' ca, '.TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id '.'LIMIT '.$limit.' OFFSET '.$offset)->result_array();
        }



    }
    public function getMessages($where=null,$wannaObj=false,$limit=null, $offset=null)
    {
        if($wannaObj){
            return $this->db->get_where(TABLE_CONTACT,$where,$limit,$offset)->result();
        }
        if ($wannaObj && $where) {
            return $this->db->get_where(TABLE_CONTACT, $where,$limit, $offset)->row();
        }
        if ($where) {
            return $this->db->get_where(TABLE_CONTACT, $where,$limit, $offset)->result_array();
        } else {

            return $this->db->get(TABLE_CONTACT,$limit, $offset)->result_array();
        }
    }

    //UPDATE
    public function updateApt($where,$data)
    {

        $this->db->update(self::TABLE_APT,$data,$where);
        return $this->db->affected_rows()>0;
    }
    public function updateCategorie($where,$data)
    {

        $this->db->update(TABLE_CATEGORIES,$data,$where);
        return $this->db->affected_rows()>0;
    }
    public function updateSubCategorie($where,$data)
    {
        
        $this->db->update(TABLE_SUBCATEGORIES,$data,$where);
        return $this->db->affected_rows()>0;
    }
    public function updateCity($where,$data)
    {
        
        $this->db->update(TABLE_CITY,$data,$where);
        return $this->db->affected_rows()>0;
    }




    //DELETE

    public function deleteCategories($where=null)
    {
        $key=key($where);
        $this->db->where_in($key,$where[$key]);
        $this->db->delete(TABLE_CATEGORIES);
        return $this->db->affected_rows()>0;
    }

    public function deleteSubCategories($where=null)
    {
        $key=key($where);
        $this->db->where_in($key,$where[$key]);
        $this->db->delete(TABLE_SUBCATEGORIES);
        return $this->db->affected_rows()>0;
    }

    public function deleteCities($where=null)
    {
        $key=key($where);
        $this->db->where_in($key,$where[$key]);
        $this->db->delete(TABLE_CITY);

        return $this->db->affected_rows()>0;
    }

    public function deleteMessages($where=null)
    {
        $key=key($where);
        $this->db->where_in($key,$where[$key]);
        $this->db->delete(TABLE_CONTACT);

        return $this->db->affected_rows()>0;
    }

    //INSERT

    public function newCity($city){

        $this->db->insert(TABLE_CITY,$city);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function newCategorie($categorie){

        $this->db->insert(TABLE_CATEGORIES,$categorie);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function newSubCategorie($subcategorie){

        $this->db->insert(TABLE_SUBCATEGORIES,$subcategorie);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }










}
