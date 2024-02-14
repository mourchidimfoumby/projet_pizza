<div class="div-stats">
<?php
        echo "<h1>Journalier</h1>";
        echo "<table>";
        echo "<tr>
                <th>Date</th>
                <th>Nombre de commandes</th>
                <th>Chiffres d'affaire</th>
            </tr>"; 

        foreach($stat_Day as $row){
            echo "<tr>"; 
            echo "<td>" . $row['date_commande'] . "</td>"; 
            echo "<td>" . $row['nb_Commandes'] . "</td>"; 
            echo "<td>" . $row['total_journalier'] . "</td>"; 
            echo "</tr>"; 
        }
        echo "</table>";
?>
</div>