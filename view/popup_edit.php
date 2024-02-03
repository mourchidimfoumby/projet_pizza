<?php
if(isset($_GET[$identifiant])):
    $id = $_GET[$identifiant];
    $object = $classe::getOne($id);
    ?>
    <div id="popup-overlay">
        <div class="popup-container popup-container-form">
            <button class="bi bi-x"></button>
            <h2> Modifier</h2>
            <form class="popup-form" method="post" autocomplete="off">
            <input type="hidden" name="action"value="update">
                <?php
                    foreach($champs as $champ => $details) {
                        echo "<div>";
                        echo '<label for="'.$champ.'">'.$details[1].'</label>';
                        if($champ != $identifiant)
                            echo '<input type="'.$details[0] .'" name="'.$champ .'" placeholder="'.$details[1] .'" value="'.$object->get($champ) .'" required>';
                        else 
                            echo "<label>".$id."</label>";
                        echo "</div>";
                    }
                ?>
                <button class="btn-submit" type="submit">Enregistrer</button>
            </form>
        </div>
    </div>
<?php endif; ?>