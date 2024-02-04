<section class="section-pizza-list"> 
    <?php
        foreach ($pizzas as $pizza) { 
            $id = $pizza->get('id_pizza');
            $isDuMoment = $pizza->get("pizza_du_moment") == 1;
            $ingredientsPizzaAll = $pizza->getIngredientList($id);
            $ingredientsPizzaAll = implode(", ", $ingredientsPizzaAll);
            echo '<div class="pizza-list">';
            if($isDuMoment) echo '<span class="bi bi-star-fill logoIsMoment" data-id_pizza="'.$id.'"></span>';
            else echo '<span class="bi bi-star logoIsMoment" data-id_pizza="'.$id.'"></span>';
                echo '<img src="https://t4.ftcdn.net/jpg/02/66/32/05/360_F_266320596_SanLfHjGAet6paZwDYpKEXN0uXdIIOHa.jpg">';
                echo "<div>";
                    echo "<h3> ". $pizza->get('nom_pizza'). "</h3>";
                    echo "<p>".$ingredientsPizzaAll."</p>";
                    echo  '<p class="prix-pizza">'.$pizza->get('prix_pizza').'</p>';
                echo "</div>";
            echo "</div>";
        }
    ?>
    <a href="index.php?objet=pizza&action=displayCreateForm"><button> Nouvelle pizza</button></a>
</section>