<div class="div-stats">
<?php
    echo "<h1>Mensuel</h1>";
    echo "<table>";
    echo "<tr>
            <th>Date</th>
            <th>Mois</th>
            <th>Nombre de commandes</th>
            <th>Chiffres d'affaire</th>
        </tr>"; 

    foreach($stat_Month as $row){
        echo "<tr>"; 
        echo "<td>" . $row['année'] . "</td>"; 
        echo "<td>" . $row['mois']. "</td>"; 
        echo "<td>" . $row['nombre_commandes'] . "</td>"; 
        echo "<td>" . $row['montant_total_mois'] . "</td>"; 
        echo "</tr>"; 
    }
    echo "</table>";
?>
</div>