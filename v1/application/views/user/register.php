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
        <div class="alert error-block alert-danger alert-dismissable" style="display:none">
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-raised  btn-info">Registrar</button>
        </div>
    </form>




</div>