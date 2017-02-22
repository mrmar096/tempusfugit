
<?php if(isset($servicios)) $this->load->view('services/show_services',$servicios);?>

<a class="btn btn-fab btn-default btn-fab-corner btn-inverse" href="<?=base_url('user/servicesFormDialog')?>" onclick="return getFormData(this.href)"><i class="material-icons">add</i> </a>
