<table class="table row-center table-bordered ">
    <thead style="text-align: right">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Categoria</th>
        <th>Acciones</th>
    </tr>
    </thead>
    <tbody class="white">
    <?php foreach($data as $subcategories) { ?>
        <tr id="table_tr_<?=$subcategories->id?>">
            <td>
                <?=$subcategories->id?>
            </td>
            <td>
                <?=$subcategories->nombre?>
            </td>
            <td>
                <?=$subcategories->categoria?>
            </td>
            <td>
                <button class="btn  btn-xs btn-raised btn-success" onclick="updateObj(<?=$subcategories->id?>,'table_tr_<?=$subcategories->id?>')"> <i class="material-icons">edit</i> </button>
                <button class="btn  btn-xs btn-raised btn-danger" onclick="deleteObj(<?=$subcategories->id?> ,'table_tr_<?=$subcategories->id?>')"><i class="material-icons">delete</i> </button>
            </td>
        </tr>
        <?php
    }
    ?>
    </tbody>
</table>
<a class="btn btn-fab btn-default btn-fab-corner btn-info" href=""><i class="material-icons">add</i> </a>
