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
}
