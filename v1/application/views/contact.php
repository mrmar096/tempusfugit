<div class="row">
    <div class="col-md-8 white">
        <h3 class="orangelight"><b>¿De dónde viene?</b> </h3>
        <div><img class="pull-right img-responsive" height="200" width="180" src="<?=base_url('resources/img/commons/clock.png')?>"
            <p>Al contrario del pensamiento popular, el texto de Lorem Ipsum no es simplemente texto aleatorio. Tiene sus raices en una pieza cl´sica de la literatura del Latin, que data del año 45 antes de Cristo, haciendo que este adquiera mas de 2000 años de antiguedad. Richard McClintock, un profesor de Latin de la Universidad de Hampden-Sydney en Virginia, encontró una de las palabras más oscuras de la lengua del latín, "consecteur", en un pasaje de Lorem Ipsum, y al seguir leyendo distintos textos del latín, descubrió la fuente indudable. Lorem Ipsum viene de las secciones 1.10.32 y 1.10.33 de "de Finnibus Bonorum et Malorum" (Los Extremos del Bien y El Mal) por Cicero, escrito en el año 45 antes de Cristo. Este libro es un tratado de teoría de éticas, muy popular durante el Renacimiento. La primera linea del Lorem Ipsum, "Lorem ipsum dolor sit amet..", viene de una linea en la sección 1.10.32
                El trozo de texto estándar de Lorem Ipsum usado desde el año 1500 es reproducido debajo para aquellos interesados. Las secciones 1.10.32 y 1.10.33 de "de Finibus Bonorum et Malorum" por Cicero son también reproducidas en su forma original exacta, acompañadas por versiones en Inglés de la traducción realizada en 1914 por H. Rackham.</p>

        </div>

    </div>

    <div class="col-md-4 white">
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

            <div class="checkbox">
                <label>
                    Privado &nbsp<input name="privado" type="checkbox"/>
                </label>

            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-raised  btn-warning">Enviar</button>
            </div>
            <div class="alert error-block alert-danger alert-dismissable" style="display:none">
            </div>
        </form>
        <hr class="white"/>
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



</div>


