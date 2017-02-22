









<!--Close Content-->
</div>
<!--Close Container of Content-->
</div>
</div>
<script>
    const BASE_URL ="<?=base_url()?>";
</script>
<script type="text/javascript" src="<?=base_url('node_modules/jquery/dist/jquery.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap/dist/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap-material-design/dist/js/material.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap-material-design/dist/js/ripples.js')?>"></script>
<script type="text/javascript" src="<?=base_url('resources/js/ajax/form.js')?>"></script>
<script type="text/javascript" src="<?=base_url('resources/js/ajax/pagination.js')?>"></script>
<script type="text/javascript" src="<?=base_url('resources/js/multiselect_table.js')?>"></script>
<!--Sweet Alert-->

<script src="<?=base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>

<script type="text/javascript">$.material.init();</script>

<!--Custom functions-->
<script type="text/javascript" src="<?=base_url('resources/js/ajax/delete.js')?>"></script>
<script type="text/javascript" src="<?=base_url('resources/js/dialogForm.js')?>"></script>
<!--Video Options-->
<script>
    $('video').on('click',function (e) {
        var iconvideo=$(this).next('h3').find('i');
        console.log(iconvideo);
            if (this.paused){
                this.play();
                iconvideo.text("pause_circle_filled");
            }
            else{
                this.pause();
                iconvideo.text("play_circle_filled");
            }

    });
</script>
</body>
</html>