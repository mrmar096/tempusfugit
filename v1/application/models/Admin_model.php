<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin_model extends CI_Model
{
    const TABLE_CITY='cities';

    public function __construct()
    {
        parent::__construct();
    }

    public function getCities()
    {
      return $this->db->get(self::TABLE_CITY)->result();
    }
}
