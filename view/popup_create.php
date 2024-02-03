<div id="popup-overlay">
    <div class="popup-container popup-container-form">
        <button class="bi bi-x"></button>
        <h2> Créer <?=$class?></h2>
        <form action="index.php?objet=pizza&action=create" class="popup-form" method="post" autocomplete="off">
        <input type="hidden" name="action" value="create">
            <?php
                foreach($champs as $champ => $details) {
                    echo '<div class="popup-div-input">';
                        echo "<label for\"$champ\">$details[1]</label>";
                        echo '<input type="'.$details[0] .'" name="'.$champ .'" placeholder="'.$details[1] .'" required>';
                    echo "</div>";
                }
                if($_GET["objet"] == "pizza"){
                    echo '<div class="popup-create-container-checkbox">';
                        displayCheckbox($ingredients);
                        displayCheckbox($allergenes);
                    echo '</div>';
                }
            ?>
            <button class="btn-submit" type="submit">Créer</button>
        </form>
    </div>
</div>

<?php
    function displayCheckbox($arrayObject) {
        $class = get_class($arrayObject[0]);
        $identifiant = "id_$class";
        echo "<div>";
        echo "<p>".ucfirst($class)."</p>";
        echo '<div class="popup-create-div-checkbox">';
        foreach($arrayObject as $obj){
            $idObj = $obj->get($identifiant);
            echo '<div class="popup-create-checkbox">';
                echo '<label for="'.$class.'_'.$idObj.'">'.$obj->get("nom_$class").'</label>';
                echo '<input type="checkbox" class="myCheckBox" id="'.$class.'_'.$idObj.'" name="'.$class.'[]" value="'.$idObj.'">';
            echo "</div>";
        }
        echo "</div>";
        echo "</div>";
    }
?>
