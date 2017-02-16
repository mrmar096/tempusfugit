<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class User_model extends CI_Model 
{
    const TABLE_USER='users';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function registro($user)
    {
      return $this->db->insert(self::TABLE_USER,$user);
    }
    public function get($id=null)
    {
        if($id==null){
            return $this->db->get(self::TABLE_USER)->result();
        }else{
            return $this->db->get_where(self::TABLE_USER,$id)->result();
        }

    }
    public function get_object($id)
    {
        return $this->db->get_where(self::TABLE_USER,$id)->row();
    }
}
