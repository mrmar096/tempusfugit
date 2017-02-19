<?php
defined('BASEPATH') OR exit('No direct script access allowed');
if(!function_exists('build_tr')){

    function build_tr($data,$urledit=null,$urldelete=null){
        $html="";
        foreach ($data as $row){
            $id=$row->id;
            $id_table='table_tr_'.$id;
            $tr='<tr id="'.$id_table.'">';
            $td="";
            foreach ($row as $col){
                $td.="<td>".$col."</td>";
                $values[]=$col;
            }
            $td.='<td>';

            if($urledit){
                $td.='<a href="'.$urledit.'" class="btn  btn-xs btn-raised btn-success" data-values="'.implode(",", $values).'" onclick="return updateObj(this,\''.$id_table.'\');"><i class="material-icons">edit</i> </a>';
            }
            if($urldelete){
                $td.='<a href="'.$urldelete.'" class="btn  btn-xs btn-raised  btn-danger" onclick="return deleteObj(this.href,\''.$id.'\',\''.$id_table.'\');"><i class="material-icons">delete</i> </a>';
            }
            $td.='</td>';
            $tr.=$td."</tr>";
            $html.=$tr;
        }
        return $html;
    }


}else{
    log_message(LOG_ALERT,'existe la funcion build_tr');
}
if(!function_exists('build_list_group_messages')){
    function build_list_group_messages($data){
        $html="";
        foreach ($data as $row){
            $html.=' <div class="list-group-item">';
            $html.='<div class="row-picture pull-left">
                       <img src="'.base_url('resources/img/commons/noimage.png').'" alt="avatar-contact" class="img-circle" >
                    </div>
                    <div class="row-content">
                        <h4 class="list-group-item-heading orangelight">'.$row->nombre.'</h4>

                        <p class="list-group-item-text white">'.$row->comentario.'</p>
                    </div>';

            $html.=' <div class="list-group-separator white"></div>';
        }
        return $html;




    }

}else{
    log_message(LOG_ALERT,'existe la funcion build_tr');
}



