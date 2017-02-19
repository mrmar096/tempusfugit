<table class="table row-center table-bordered ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Latitud</th>
        <th>Longitud</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($data as $citie) { ?>
        <tr id="table_tr_<?=$citie->id?>">
            <td>
                <?=$citie->id?>
            </td>
            <td>
                <?=$citie->nombre?>
            </td>
            <td>
                <?=$citie->lat?>
            </td>
            <td>
                <?=$citie->log?>
            </td>
            <td>
                <a href="<?=base_url('admin/citiesFormDialog/update')?>" class="btn  btn-xs btn-raised btn-success" data-values="<?=$citie->id?>,<?=$citie->nombre?>,<?=$citie->lat?>,<?=$citie->log?>" onclick="return updateObj(this,'table_tr_<?=$citie->id?>');"><i class="material-icons">edit</i> </a>
                <a href="<?=base_url('admin/deletecity/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return deleteObj(this.href,<?=$citie->id?>,'table_tr_<?=$citie->id?>');"><i class="material-icons">delete</i> </a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<a class="btn btn-fab btn-default btn-fab-corner btn-info" href="<?=base_url('admin/citiesFormDialog')?>" onclick="return getFormData(this.href)"><i class="material-icons">add</i> </a>