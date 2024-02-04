<?php
if(isset($_GET["id_pizza"])):
    $id_pizza = $_GET["id_pizza"];
    $object = $classe::getOne($id_pizza);
    ?>
    <div id="popup-overlay">
        <div class="popup-container-edit-command">
            <button class="bi bi-x"></button>
            <div id="popup-title">
                <h2><?= $object ?></h2>
                <?php
                if($classe == "pizza"){
                    $condition = "modifiable = 1";
                    $ingredientsPizzaModifiable = $object->getIngredientList($id_pizza, $condition);
                    $ingredientsPizzaAll = $object->getIngredientList($id_pizza);
                    $ingredientsPizzaAll = implode(", ", $ingredientsPizzaAll);
                    echo '<p>' . $ingredientsPizzaAll . '</p>';

                    $ingredientsModifiable = ingredient::getAll($condition);
                    $ingredientsModifiable = array_diff($ingredientsModifiable, $ingredientsPizzaModifiable);
                };
            ?>
            </div>
            <table id="popup-table">
                <tr>
                    <th>Modifier vos ingrédients</th>
                    <th>Ajouter des ingrédients</th>
                </tr>
                <tr>
                    <td>
                        <ul id="popup-ul-remove">
                            <?php 
                            foreach($ingredientsPizzaModifiable as $id_ingredient => $ingredient){
                                echo '<li class="popup-list popup-list-remove" data-id_ingredient="'.$id_ingredient.'">'.$ingredient.' <span class="bi bi-x-circle"></span></li>';
                            }
                            ?>
                        </ul>
                    </td>
                    <td>
                        <ul id="popup-ul-add">
                            <?php 
                            foreach($ingredientsModifiable as $ingredient){
                                echo '<li class="popup-list popup-list-add" data-id_ingredient="'.$ingredient->get("id_ingredient").'">'.$ingredient.' <span class="popup-list-add-price">3.00 €<span class="bi bi-plus-lg"></span></span></li>';
                            }
                            ?>
                        </ul>
                    </td>
                </tr>
            </table>
            <button class="button-cart" id="popup-btn-add">Ajouter au panier<span id="total-price"><?= $object->get("prix_$classe")?></span>€</button>
        </div>
    </div>
<?php
    endif;
?>