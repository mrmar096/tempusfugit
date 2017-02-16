<?php
/**
 * Created by PhpStorm.
 * User: Mario
 * Date: 15/02/2017
 * Time: 21:42
 */
class Control_Access
{
private $grant = array('','contact', 'user/registro', 'user/login');

    function __get($name)
    {
        return get_instance()->$name;
    }


    function controlAccess()
    {

        $uri = $_SERVER['REQUEST_URI'];
        $peticion=substr($uri,strpos($uri,'v1')+3);
        if(!in_array($peticion,$this->grant)){
            if(!$this->session->userdata("user")){
                redirect(base_url());
            }
        }
    }
}