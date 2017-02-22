<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('output_json')){
    function output_json($data)
    {
        http_response_code(200);
        header('Content-Type: application/json');
        echo json_encode($data);

    }
    function output_error_json($data,$code=400){
        http_response_code($code);
        header('Content-Type: application/json');
        echo json_encode($data);
    }
}else{
    log_message(LOG_ALERT,'existe_la_funcion_output_json');
}


