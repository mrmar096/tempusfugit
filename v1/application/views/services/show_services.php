
<?php foreach ($servicios as $servicio){?>
    <div class="col-md-4">

        <div class="card">



            <div class="card-content">

                <div class="card-image">
                    <a href="<?=base_url('user/detailservice/'.$servicio->id)?>">
                        <?php
                        if(!empty($servicio->multimedia[0])){
                            if(strpos($servicio->multimedia[0]->type,FILE_IMG_TYPE)!== false) {?>
                                <img class="img-responsive pull-left" src="<?=base_url($servicio->multimedia[0]->src)?>" alt="<?= $servicio->multimedia[0]->alt?>"/>
                            <?php }else if(strpos($servicio->multimedia[0]->type,FILE_VIDEO_TYPE)!== false) {?>
                                <video controls autoplay>
                                    <source src="<?=base_url($servicio->multimedia[0]->src)?>"  type="<?=$servicio->multimedia[0]->type?>" >
                                    Your browser does not support the video tag.
                                </video>
                            <?php } else {?>
                                <img class="img-responsive pull-left" src="<?=base_url('resources/img/commons/noimage.png') ?>" alt="<?= $servicio->multimedia[0]->alt?>"/>
                            <?php }
                        }else {?>
                            <img class="img-responsive pull-left" src="<?=base_url('resources/img/commons/noimage.png') ?>" alt="imgen"/>
                        <?php }
                        ?>
                        <h3 class="card-image-headline"><?=$servicio->titulo?></h3>
                    </a>
                </div>


                <div class="card-body">
                    <p><?=substr($servicio->descripcion,0,300)."..."?></p>
                </div>

                <footer class="card-footer">
                    <div class="row row-center">
                        <a class="btn pull-left btn-flat btn-xs"><i class="material-icons">format_list_bulleted</i> <?=$servicio->categoria." || ".$servicio->subcategoria?></a>
                        <a class="text-muted pull-right text-danger"><i class="material-icons">av_timer</i>  <?=$servicio->duracion?></a>
                    </div>
                </footer>

            </div>

        </div>
    </div>
    <?php
}



