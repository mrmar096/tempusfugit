<table class="table row-center table-bordered ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Comentario</th>
        <th>Tipo</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($data as $messages) { ?>
        <tr id="table_tr_<?=$messages->id?>">
            <td>
                <?=$messages->id?>
            </td>
            <td>
                <?=$messages->nombre?>
            </td>
            <td>
                <?=$messages->comentario?>
            </td>
            <td>
                <?=$messages->privado==true?'Privado':'Publico'?>
            </td>
            <td>
                <a href="<?=base_url('admin/deletemessage/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return deleteObj(this.href,<?=$messages->id?>,'table_tr_<?=$messages->id?>');"><i class="material-icons">delete</i> </a>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
