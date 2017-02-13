<div class="row center-block  bg-alert-dark">
    <div class="col-md-7">
        <div class="row">
            <img src="<?=base_url()?>resources/img/home/home_screen.png" class="img-responsive" height="150"/>
        </div>
        <div class="row text-center">
            <h2 class="white">La web de tu futuro, ofrece y compra servicios sin necesidad de gastar dinero.
                ¿Quieres saber más?
                <a type="button" class="btn btn-raised btn-warning">Contacta</a>
            </h2>

        </div>

    </div>

    <div class="col-md-5 ">
        <h3 class="white text-center">¿A que estas esperando?</h3><h3 class="text-info text-center"> Registrate Ahora  </h3>

        <form  action="<?=base_url('user/registro')?>" class="form-padding" id="form-registro-user" method="post" role="form">
            <div class="form-inline">
                <div class="form-group label-floating">
                    <label class="control-label left" for="nombre">Nombre</label>
                    <input class="form-control input-lg" value="Mario" required type="text" name="nombre" />
                </div>
                <div class="form-group label-floating">
                    <label class="control-label" for="apellidos">Apellidos</label>
                    <input type="text" required value="Muñoz Castellanos" class="form-control input-lg" name="apellidos" />
                </div>
            </div>
            <div class="form-group label-floating">
                <label class="control-label left" for="email">Email</label>
                <input class="form-control input-lg" required type="email" value="mario.pcdl@gmail.com" name="email" />
            </div>
            <div class="form-group label-floating">
                <label class="control-label" for="pass">Contraseña</label>
                <input type="password" required value="mario1234" class="form-control input-lg" name="pass" />
            </div>
            <div class="form-group label-floating">
                <label class="control-label" for="city">Ciudad</label>
                <select class="form-control " name="city" >
                    <?php
                    foreach ($cities as $city){
                        ?>
                        <option value="<?=$city->id?>"><?=$city->nombre?></option>
                    <?php
                    }
                    ?>
                </select>
            </div>
            <div class="alert  alert-danger alert-dismissable" id="error-block">

               </div>
            <div class="text-center">
                <button type="submit" class="btn btn-raised  btn-info">Registrar</button>
            </div>
        </form>




    </div>
</div>
</div>
</br></br>
<!-- <div class="text-center">
     <h4 class="white bg-alert-dark"><b>En Tempus Fugit cuidamos tu dinero y es por eso que para poder contratar servicios en esta web, lo unico que te pediremos sera tu
             tiempo para poder solicitar servicios. es muy sencillo, la moneda de intercambio es el tiempo. La forma de ganar tiempo es ofreciendo tus propios servicios,
             para poder canjear ese tiempo ganeado por otros servicios que te interesen.Si empiezas ahora recibiras 10h</b></h4>
     </br><button type="button" class="btn btn-danger btn-raised btn-hover align-center">Contacta <i class="wy-dropdown-arrow"></i> </button>
 </div>-->
</br>
