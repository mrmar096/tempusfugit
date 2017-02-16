<table class="table row-center table-bordered ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($data as $categorie) { ?>
        <tr id="table_tr_<?=$categorie->id?>">
            <td>
                <?=$categorie->id?>
            </td>
            <td>
                <?=$categorie->nombre?>
            </td>
            <td>
                <a href="<?=base_url('admin/deletecategorie/')?>" class="btn  btn-xs btn-raised btn-success" onclick="return updateObj(this.href,<?=$categorie->id?>,'table_tr_<?=$categorie->id?>');"><i class="material-icons">edit</i> </a>
                <a href="<?=base_url('admin/deletecategorie/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return deleteObj(this.href,<?=$categorie->id?>,'table_tr_<?=$categorie->id?>');"><i class="material-icons">delete</i> </a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<a class="btn btn-fab btn-default btn-fab-corner btn-info" href=""><i class="material-icons">add</i> </a>