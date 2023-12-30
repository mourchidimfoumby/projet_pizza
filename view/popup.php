<?php
if(isset($_GET["id"])):
    $id = $_GET["id"];
    $object = $classe::getOne($id);         
    ?>
        <div class="popup">
            <button class="bi bi-x"></button>
            <div id="title-popup">
                <h2><?= $object ?></h2>
                <?php
                if($classe == "pizza"){
                    $ingredientList = $object->getIngredientList($id);
                    $ingredients = implode(", ", $ingredientList);
                    echo '<p>' . $ingredients . '</p>';
                };
            ?>
            </div>
            <div id="element-popup">
                
            </div>
            <button class="button-cart" id="btn-popup-add"><span>Ajouter </span><?= $object->get("prix_$classe")?>€</button>
        </div>
        <div id="overlay"></div>
        <?php
        endif;
?>