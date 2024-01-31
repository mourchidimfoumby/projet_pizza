<?php
    $columns = array(
        "ID stock",
        "Nom du stock",
        "Quantité (kg/unité)",
        "Seuil minimal",
    )
?>
<section class="section-stock">
    <a href="index.php?objet=gestionnaire"><button class="bi bi-arrow-left">Retour</button></a>
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
                    foreach($object as $val)echo "<td>$val</td>";
                    echo '<td class="tab-modify-stock">
                            <a href="index.php?objet=stock&id_stock='.$object["id_stock"].'">Modifier</a>
                        </td>
                    ';
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</section>