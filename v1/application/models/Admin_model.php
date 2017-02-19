<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin_model extends CI_Model
{
    const TABLE_CITY='cities';
    const TABLE_CATEGORIES='categories';
    const TABLE_SUBCATEGORIES='subcategories';
    const TABLE_CONTACT='contact';
    const TABLE_APT='apt';


    public function __construct()
    {
        parent::__construct();
    }
    //SELECT
    public function getApt($where=null,$wannaObj=false)
    {
        if($wannaObj&&$where){
            return $this->db->get_where(self::TABLE_APT,$where)->row();
        }
        if($where){
            return $this->db->get_where(self::TABLE_APT,$where)->result();
        }else{
            return $this->db->get(self::TABLE_APT)->result();
        }

    }
    public function getCities($where=null,$wannaObj=false)
    {
        if($wannaObj&&$where){
            return $this->db->get_where(self::TABLE_CITY,$where)->row();
        }
        if($where){
            return $this->db->get_where(self::TABLE_CITY,$where)->result();
        }else{
            return $this->db->get(self::TABLE_CITY)->result();
        }

    }
    public function getCategories($where=null,$wannaObj=false)
    {

        if($wannaObj&&$where){
            return $this->db->get_where(self::TABLE_CATEGORIES,$where)->row();
        }
        if($where){
            return $this->db->get_where(self::TABLE_CATEGORIES,$where)->result();
        }else{
            return $this->db->get(self::TABLE_CATEGORIES)->result();
        }
    }
    public function getSubCategories($id=null, $wannaObj=false)
    {
        if($wannaObj&&$id){
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.self::TABLE_CATEGORIES.' ca, '.self::TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id and  sc.id='.$id)->row();
        }
        if($id){
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.self::TABLE_CATEGORIES.' ca, '.self::TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id and  sc.id='.$id)->result();
        }else{
            return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.self::TABLE_CATEGORIES.' ca, '.self::TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id ')->result();
        }



    }
    public function getMessages($where=null,$wannaObj=false)
    {

        if ($wannaObj && $where) {
            return $this->db->get_where(self::TABLE_CONTACT, $where)->row();
        }
        if ($where) {
            return $this->db->get_where(self::TABLE_CONTACT, $where)->result();
        } else {
            return $this->db->get(self::TABLE_CONTACT)->result();
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

        $this->db->update(self::TABLE_CATEGORIES,$data,$where);
        return $this->db->affected_rows()>0;
    }
    public function updateSubCategorie($where,$data)
    {
        
        $this->db->update(self::TABLE_SUBCATEGORIES,$data,$where);
        return $this->db->affected_rows()>0;
    }
    public function updateCity($where,$data)
    {
        
        $this->db->update(self::TABLE_CITY,$data,$where);
        return $this->db->affected_rows()>0;
    }




    //DELETE
    public function deleteApt($where=null)
    {
        $this->db->delete(self::TABLE_APT,$where);
        return $this->db->affected_rows()>0;
    }
    public function deleteCategories($where=null)
    {
        $this->db->delete(self::TABLE_CATEGORIES,$where);
        return $this->db->affected_rows()>0;
    }

    public function deleteSubCategories($where=null)
    {
        $this->db->delete(self::TABLE_SUBCATEGORIES,$where);
        return $this->db->affected_rows()>0;
    }

    public function deleteCities($where=null)
    {
        $this->db->delete(self::TABLE_CITY,$where);
        return $this->db->affected_rows()>0;
    }

    public function deleteMessages($where=null)
    {
        $this->db->delete(self::TABLE_CONTACT,$where);
        return $this->db->affected_rows()>0;
    }

    //INSERT

    public function newCity($city){

        $this->db->insert(self::TABLE_CITY,$city);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function newCategorie($categorie){

        $this->db->insert(self::TABLE_CATEGORIES,$categorie);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }
    public function newSubCategorie($subcategorie){

        $this->db->insert(self::TABLE_SUBCATEGORIES,$subcategorie);
        $insert_id = $this->db->insert_id();

        return  $insert_id;

    }










}
