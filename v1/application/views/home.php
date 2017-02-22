<div class="row bg-alert-dark" id="home">
    <div class="col-md-7">
        <div class="row">
            <img src="<?=base_url()?>resources/img/home/home_screen.png" class="img-responsive" height="150"/>
        </div>
        <div class="row text-center">
            <h2 class="white">La web de tu futuro, ofrece y compra servicios sin necesidad de gastar dinero.
                ¿Quieres saber más?
                <a href="<?=base_url('contact')?>" class="btn btn-raised btn-warning">Contacta</a>
            </h2>

        </div>

    </div>

<?php if(!$this->session->userdata("user")) $this->load->view('user/register');?>

</div>

<!-- <div class="text-center">
     <h4 class="white bg-alert-dark"><b>En Tempus Fugit cuidamos tu dinero y es por eso que para poder contratar servicios en esta web, lo unico que te pediremos sera tu
             tiempo para poder solicitar servicios. es muy sencillo, la moneda de intercambio es el tiempo. La forma de ganar tiempo es ofreciendo tus propios servicios,
             para poder canjear ese tiempo ganeado por otros servicios que te interesen.Si empiezas ahora recibiras 10h</b></h4>
     </br><button type="button" class="btn btn-danger btn-raised btn-hover align-center">Contacta <i class="wy-dropdown-arrow"></i> </button>
 </div>-->
</br>
