<div class="row">

    <div class="col-md-8">
        <h1 class="text-info"><?=$servicio[0]->titulo?></h1>
        <h4 class="white btn btn-fab-min"><i class="material-icons">format_list_bulleted</i>  <?=$servicio[0]->categoria." || ".$servicio[0]->subcategoria?></h4>
        <p class="white">
            <?=$servicio[0]->descripcion?>
        </p>
        </br>
        </br>
    </div>
    <div class="col-md-4 white">
        <?php


        $data = array(
            3  => 'http://example.com/news/article/2006/06/03/',
            7  => 'http://example.com/news/article/2006/06/07/',
            13 => 'http://example.com/news/article/2006/06/13/',
            26 => 'http://example.com/news/article/2006/06/26/'
        );



        echo $this->calendar->generate(null,null,$data);
        ?>
    </div>
</div>
<div class="col-md-12">
    <h1 class="white">Multimedia</h1>
</div>
<?php $i=0;foreach ($servicio[0]->multimedia as $item) {?>
    <?php
    if ($i % 3 == 0){
        ?>
        <div class="row">
    <?php } ?>

    <div class="col-md-4">
        <div class="card">
            <div class="card-content">

                <div class="card-image">
                    <?php if (strpos($item->type, FILE_IMG_TYPE) !== false) { ?>
                        <img class="img-responsive pull-left" src="<?= base_url($item->src) ?>"
                             alt="<?= $item->alt ?>"/>
                        <h3 class="card-image-headline"><?= $item->alt ?> <i
                                class="material-icons">camera_alt</i></h3>
                    <?php } else if (strpos($item->type, FILE_VIDEO_TYPE) !== false) { ?>

                        <video>
                            <source src="<?= base_url($item->src) ?>" type="<?= $item->type ?>">
                            Your browser does not support the video tag.
                        </video>
                        <h3 class="card-image-headline"><?= $item->alt ?> <i class="material-icons btnvideo">play_circle_filled</i>
                        </h3>

                    <?php } else { ?>
                        <img class="img-responsive pull-left"
                             src="<?= base_url('resources/img/commons/noimage.png') ?>"
                             alt="<?= $item->alt ?>"/>
                        <h3 class="card-image-headline"><?= $item->alt ?></h3>
                    <?php } ?>


                </div>


                <div class="card-body">
                    <?php if (!empty($item->opinions)) { ?>
                        <p>Opiniones</p>
                        <div id="list-opinions-mm-<?= $item->id ?>" class="list-group ">

                            <div class="list-group-item">
                                <div class="row-picture pull-left">
                                    <img class="circle"
                                         src="<?= base_url('resources/img/commons/noimage.png') ?>"
                                         alt="icon">
                                </div>
                                <div class="row-content">
                                    <h4 class="list-group-item-heading orangelight"><?= $item->opinions[0]->nombre ?></h4>

                                    <p class="list-group-item-text "><?= $item->opinions[0]->comentario ?></p>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>

                <footer class="card-footer">
                    <?php if ($servicio[0]->ofertante != $this->session->userdata("user")->id) { ?>
                        <form action="<?= base_url('/services/newmmopinion/' . $item->id) ?>" method="post"
                              role="form">
                            <div class="form-grouplabel-floating">
                                <label class="control-label" for="opinion">Manda tu opinion</label>
                                <div class="input-group">
                                    <input class="form-control" name="opinion" type="text"/>
                                    <span class="input-group-btn">
                                          <button class="btn btn-fab btn-fab-mini">
                                            <i class="material-icons">send</i>
                                          </button>
                                        </span>
                                </div>
                                <div class="alert error-block alert-danger alert-dismissable"
                                     style="display:none">

                                </div>
                        </form>
                    <?php } ?>
                    </br>
                    <div class="row row-center">
                        <a class="text-muted pull-right text-danger"><i class="material-icons">favorite</i>Me
                            gusta</a>
                    </div>
                </footer>

            </div>
        </div>
    </div>

    <?php
    $i++;
    if ($i % 3 == 0 || $i==count($servicio[0]->multimedia) ){
        ?>
        </div>
        <?php
    }

}
if($servicio[0]->ofertante==$this->session->userdata("user")->id){
?>
<a class="btn btn-fab btn-default btn-fab-corner btn-inverse" href="<?=base_url('user/newservicemage/'.$servicio[0]->id)?>" onclick="return newImageDialog(this.href)" ><i class="material-icons">camera</i> </a>
<?php } ?>