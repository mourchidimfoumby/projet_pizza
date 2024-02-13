<?php
    $columns = array(
        "Date",
        "Message",
        "Stock"
    )
?>
<section class="section-stock">
    <table id="table-stock">
        <thead>
            <tr>
                <?php foreach($columns as $c) echo "<th>$c</th>"?>
            </tr>
        </thead>
        <tbody>
            <?php   
                foreach($alertes as $a){
                    echo "<tr>";
                        echo '<td>'.$a["date_alerte"].'</td>';
                        echo '<td>'.$a["message_alerte"].'</td>';
                        echo '<td>'.$a["nom_stock"].'</td>';
                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
</section>