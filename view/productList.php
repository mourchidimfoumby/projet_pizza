<?php
$classe =  static::$classe;
?>
<main>
    <?php
    if ($tableau != null) {
        foreach ($tableau as $objet) {
            $listeIngredient = $objet->get("listeIngredient");
            $ingredients = implode(", ", $listeIngredient);
            echo '<div class="product-cards">';
            echo '<img src="../pictures/pizza_img.jpg">';
            echo '<div id="text-parts">';
            echo '<h3>' . $objet->get("nomPizza") . '</h3>';
            echo '<p>' . $ingredients . '</p>';
            echo '<button> AJOUTER ' . $objet->get("prixPizza") . '</button>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Rien à afficher";
    }
    ?>
</main>