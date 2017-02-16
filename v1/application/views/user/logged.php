<ul class="nav navbar-nav  navbar-right">
    <li>
        <a class="btn white" href="<?=base_url('services')?>">SERVICIOS</a>
    </li>
    <li class="row-center">
        <span>
            <a class="text-capitalize white " href="<?=base_url('user/profile')?>"><i class="material-icons">person_pin</i><b><?=$this->session->userdata("user")->nombre?></b></a>
            <a href="<?=base_url('user/logout')?>" class="btn btn-fab btn-fab-mini btn-danger white active"><i class="material-icons">exit_to_app</i> </a>
            </span>
    </li>

</ul>
