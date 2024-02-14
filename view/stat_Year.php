<div class="div-stats">
<?php
    echo "<h1>Annuel</h1>";
    echo "<table>";
    echo "<tr>
            <th>Date</th>
            <th>Nombre de commandes</th>
            <th>Chiffres d'affaire</th>
        </tr>"; 

    foreach($stat_Year as $row){
        echo "<tr>"; 
        echo "<td>" . $row['année'] . "</td>"; 
        echo "<td>" . $row['nombre_commandes'] . "</td>"; 
        echo "<td>" . $row['montant_total_annuel'] . "</td>"; 
        echo "</tr>"; 
    }
    echo "</table>";
?>
</div>