<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Navigation_model extends CI_Model 
{
    public function __construct()
    {
        parent::__construct();
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
    public function getCities($where=null,$wannaObj=false)
    {
        if($wannaObj&&$where){
            return $this->db->get_where(TABLE_CITY,$where)->row();
        }
        if($where){
            return $this->db->get_where(TABLE_CITY,$where)->result();
        }else{
            return $this->db->get(TABLE_CITY)->result();
        }

    }
}
