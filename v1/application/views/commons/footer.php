









<!--Close Content-->
</div>
<!--Close Container of Content-->
</div>
</div>
<script type="text/javascript" src="<?=base_url('node_modules/jquery/dist/jquery.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap/dist/js/bootstrap.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap-material-design/dist/js/material.js')?>"></script>
<script type="text/javascript" src="<?=base_url('node_modules/bootstrap-material-design/dist/js/ripples.js')?>"></script>
<script type="text/javascript" src="<?=base_url('resources/js/ajax/form.js')?>"></script>
<!--Sweet Alert-->

<script src="<?=base_url('node_modules/sweetalert2/dist/sweetalert2.min.js')?>"></script>

<script type="text/javascript">$.material.init();</script>

<!--Custom functions-->

<script type="text/javascript">
   function deleteObj(idObj,idObjHtml) {
       console.log(idObj);
       var url="<?php echo base_url('admin/deletecategorie/') ?>"+idObj;
       var objHtml=document.getElementById(idObjHtml);
       console.log(objHtml);
       console.log(url);
       swal.queue([{
           title: '¿Desea eliminar el registro con id '+idObj+' ?',
           showCancelButton: true,
           confirmButtonColor: '#f55246',
           confirmButtonText: 'Eliminar',
           showLoaderOnConfirm: true,
           preConfirm: function (id) {
               return new Promise(function (resolve) {
                    $.post(url,function (data) {
                        $("#"+idObjHtml).remove();
                        swal.insertQueueStep(data.message)
                        resolve()
                    })
               })
           },
           allowOutsideClick: false
       }]);
   }

</script>

</body>
</html>