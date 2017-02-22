
<h2 class="white"><b>Mensajes Recibidos</b></h2>
<div class="col-md-12"> <div class="table-responsive"><table class="table  ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Mensaje</th>
        <th>Servicio</th>
        <th>Tipo</th>
        <th>De</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($recibidos as $messages) { ?>
        <tr id="table_tr_<?=$messages->id?>">
            <td>
                <?=$messages->id?>
            </td>
            <td>
                <?=$messages->mensaje?>
            </td>
            <td>
                <?=$messages->servicio?>
            </td>
            <td>
                <?=$messages->privado==true?'Privado':'Publico'?>
            </td>
            <td>
                <?=$messages->emisor?>
            </td>
            <td>
                <a href="<?=base_url('user/deletemessage/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return multipleDelete(this.href,<?=$messages->id?>,'table_tr_<?=$messages->id?>');"><i class="material-icons">delete</i> </a>
            </td>
        </tr>
        <?php
    }
    ?>
</tbody> </table>  </div> </div></br>
<hr class="white"/>
<h2 class="white"><b>Mensajes Emitidos</b></h2>
<div class="col-md-12"> <div class="table-responsive"><table class="table  ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Mensaje</th>
        <th>Servicio</th>
        <th>Tipo</th>
        <th>Para</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($emitidos as $messages) { ?>
        <tr id="table_tr_<?=$messages->id?>">
            <td>
                <?=$messages->id?>
            </td>
            <td>
                <?=$messages->mensaje?>
            </td>
            <td>
                <?=$messages->servicio?>
            </td>
            <td>
                <?=$messages->privado==true?'Privado':'Publico'?>
            </td>
            <td>
                <?=$messages->receptor?>
            </td>
            <td>
                <a href="<?=base_url('admin/deletemessage/')?>" class="btn  btn-xs btn-raised  btn-danger" onclick="return multipleDelete(this.href,<?=$messages->id?>,'table_tr_<?=$messages->id?>');"><i class="material-icons">delete</i> </a>
            </td>
        </tr>
        <?php
    }
    ?>
</tbody> </table>  </div>

</div>