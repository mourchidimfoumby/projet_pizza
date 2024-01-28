<?php
    $columns = array(
        "ID stock",
        "Nom du stock",
        "Quantité (kg/unité)",
        "Seuil minimal",
    )
?>
<section class="table-section">
    <div>
        <button id="btn-stock-edit"><a href="index.php?objet=stock&action=edit">Editer</a></button>
        <button id="btn-stock-discard"><a href="index.php?objet=stock">Annuler</a></button>
    </div>

    <table id="table-stock">
        <thead>
            <tr>
            <?php foreach($columns as $c) echo "<th>$c</th>"; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach($objects as $object){
                array_pop($object);
                echo "<tr>";
                    foreach($object as $val) echo "<td>$val</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>