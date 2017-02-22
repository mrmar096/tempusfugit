<div class="col-md-12">
    <div class="table-responsive">
        <table class="table row-center table-bordered">
            <thead style="text-align: right">
            <tr>
                <th>ID</th>
                <th>Aptitud</th>
                <th>Acciones</th>
            </tr>
            </thead>
            <tbody class="white">
            <?php foreach($data as $apt) { ?>
                <tr id="table_tr_<?=$apt->id?>">
                    <td>
                        <?=$apt->id?>
                    </td>
                    <td>
                        <?=$apt->aptitud?>
                    </td>

                    <td>
                        <a href="<?=base_url('admin/aptFormDialog/update')?>" class="btn  btn-xs btn-raised btn-success" data-values="<?=$apt->id?>,<?=$apt->aptitud?>" onclick="return updateObj(this,'table_tr_<?=$apt->id?>');"><i class="material-icons">edit</i> </a>
                        <a href="<?=base_url('admin/deleteapt/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return multipleDelete(this.href,<?=$apt->id?>,'table_tr_<?=$apt->id?>');"><i class="material-icons">delete</i> </a>
                    </td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<a class="btn btn-fab btn-default btn-fab-corner btn-info" href="<?=base_url('admin/aptFormDialog')?>" onclick="return getFormData(this.href)"><i class="material-icons">add</i> </a>