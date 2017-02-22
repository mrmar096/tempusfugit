<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 15/02/2017
 * Time: 21:42
 */
class Control_Access
{
private $grant = array('/','contact','newmessage', 'user/registro', 'user/login');
private $grant_admin='admin';
    function __get($name)
    {
        return get_instance()->$name;
    }


    function controlAccess()
    {

        $peticion=$this->uri->segment(1)."/".$this->uri->segment(2);

        if(!in_array($peticion,$this->grant)){
            if(!$this->session->userdata("user")){
                redirect(base_url());
            }
        }
    }
}