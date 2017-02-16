<?php
defined('BASEPATH') OR exit('No direct script access allowed');

final class Admin_model extends CI_Model
{
    const TABLE_CITY='cities';
    const TABLE_CATEGORIES='categories';
    const TABLE_SUBCATEGORIES='subcategories';
    const TABLE_CONTACT='contact';


    public function __construct()
    {
        parent::__construct();
    }

    public function getCities()
    {
      return $this->db->get(self::TABLE_CITY)->result();
    }
    public function getCategories()
    {
        return $this->db->get(self::TABLE_CATEGORIES)->result();
    }
    public function getSubCategories()
    {
        return $this->db->query('select sc.id,sc.nombre,ca.nombre as categoria from '.self::TABLE_CATEGORIES.' ca, '.self::TABLE_SUBCATEGORIES.' sc 
        where sc.categorie=ca.id ')->result();
    }
    public function getMessages()
    {
        return $this->db->get(self::TABLE_CONTACT)->result();
    }
}
