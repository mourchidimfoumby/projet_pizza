<section class="section-pizza-list"> 
    <?php
        foreach ($pizzas as $pizza) { 
            $id = $pizza->get('id_pizza');
            $ingredientsPizzaAll = $pizza->getIngredientList($id);
            $ingredientsPizzaAll = implode(", ", $ingredientsPizzaAll);
            echo '<div class="pizza-list">';
                echo "<div>";
                    echo "<h3> ". $pizza->get('nom_pizza'). "</h3>";
                    echo  '<p class="prix-pizza">'.$pizza->get('prix_pizza').'</p>';
                echo "</div>";
                echo "<p>".$ingredientsPizzaAll."</p>";
            echo "</div>";     
        }
    ?>
    <a href="index.php?objet=pizza&action=displayCreateForm"><button> Nouvelle pizza</button></a>
</section>