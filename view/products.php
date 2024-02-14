<section class="product-container">
    <?php
    if ($objects != null) {
       foreach ($objects as $object) {
            $id = $object->get("id_$classe");
            if($classe == "pizza") echo '<a class="product" href="index.php?objet='.$classe.'&id_pizza='.$id.'">';
            else echo '<a class="product other-product" href="#" data-id_product="'.$id.'">';

                echo '<img src=" '.$object->get("image_$classe").'"/>';
                
                echo '<div id="text-parts">';
                    echo '<h3>' .$object. '</h3>';
                    if($classe == "pizza"){
                        $ingredientList = $object->getIngredientList($id);
                        $ingredients = implode(", ", $ingredientList);
                        echo '<p>' . $ingredients . '</p>';
                    }
                    echo '<button class="button-cart"><span>Ajouter</span>' . $object->get("prix_$classe") . ' €</button>';
                echo '</div>';
            echo '</a>';
        }
    }else {
        echo "<h2>Aucun produit, revenez plus tard :)</h2>";
    }
    ?>
</section>