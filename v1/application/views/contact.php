<div class="row">
    <div class="col-md-8">

    </div>

    <div class="col-md-4">
        <h2 class="orange">Mandanos tu Opinion</h2>
        <form  action="<?=base_url('newmessage')?>"   method="post" role="form">
            <div class="form-group label-floating">
                <label class="control-label" for="nombre">Nombre</label>
                <input class="form-control input-lg" required type="text" name="nombre" />
            </div>
            <div class="form-group">
                <label class="control-label" for="nombre">Mensaje</label>
                <textarea name="comentario" class="form-control" rows="3"></textarea>
            </div>
            <div class="alert error-block alert-danger alert-dismissable" style="display:none">
            </div>
            <div class="checkbox">
                <label>
                    Privado &nbsp<input name="privado" type="checkbox"/>
                </label>

            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-raised  btn-warning">Enviar</button>
            </div>

        </form>
    </div>



</div>
<div class="row">
    <div class="col-md-8"></div>

    <div class="col-md-4">
        <h2 class="orange">Mensajes</h2>
        <div class="list-group list-messages">
            <?php foreach ($data as $message) { ?>
                <div class="list-group-item">
                    <div class="row-picture pull-left">
                        <img class="circle" src="<?= base_url('resources/img/commons/noimage.png') ?>" alt="icon">
                    </div>
                    <div class="row-content">
                        <h4 class="list-group-item-heading orangelight"><?=$message->nombre?></h4>

                        <p class="list-group-item-text white"><?=$message->comentario?></p>
                    </div>
                </div>
                <div class="list-group-separator white"></div>
                <?php
            }
            ?>
    </div>
</div>


