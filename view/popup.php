<?php
if(isset($_GET[$identifiant])):
    $id = $_GET[$identifiant];
    $object = $class::getOne($id);
    if($class == "pizza") {
        $value = $object->get($champ);
        $actionFin = "Créer";
        $actionDebut = "Nouvelle pizza";
    }
    else {
        $value = "";
        $actionFin = "Enregistrer";
        $actionFin = "Modifier stock";
    }
    ?>
    <div id="popup-overlay">
        <div class="popup-container popup-container-edit-command">
            <button class="bi bi-x"></button>
            <h2> <?= $actionDebut?></h2>
            <form class="popup-form" method="post" autocomplete="off">
            <input type="hidden" name="action"value="<?=$action?>">
                <?php
                    foreach($champs as $champ => $details) {
                        echo "<div>";
                        echo "<label for\"$champ\">$details[1]</label>";
                        if($champ != $identifiant)
                            echo '<input type="'.$details[0] .'" name="'.$champ .'" placeholder="'.$details[1] .'" value="'.$value.'" required>';
                        else 
                            echo "<label>".$id."</label>";
                        echo "</div>";
                    }
                ?>
                <button type="submit"><?=$actionFin?></button>
            </form>
        </div>
    </div>
<?php endif; ?>