<section class="product-container">
    <?php
    if ($objects != null) {
       foreach ($objects as $object) {
            $id = $object->get("id_$classe");
            if($classe == "pizza") echo '<a class="product" href="index.php?objet='.$classe.'&id_pizza='.$id.'">';
            else echo '<a class="product other-product" href="#" data-id_product="'.$id.'">';
                switch($classe){
                    case "boisson":
                        echo '<img src="https://www.pngall.com/wp-content/uploads/15/Soda-Can-PNG-Photo.png">';
                        break;
                    case "pizza":
                        echo '<img src="https://t4.ftcdn.net/jpg/02/66/32/05/360_F_266320596_SanLfHjGAet6paZwDYpKEXN0uXdIIOHa.jpg">';
                        break;
                    case 'dessert':
                        echo '<img src="https://static.vecteezy.com/system/resources/previews/010/179/006/original/delicious-dessert-cake-file-free-png.png">';
                        break;
                }
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