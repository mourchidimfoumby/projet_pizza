<?php

    function displayCart(){
            $cart = $_SESSION["cart"];
            $totalPrice = 0;
            $position = 0;
            echo '<div id="cart">';
                foreach($cart as $c){
                    $position++;
                    if($c["type"] == "pizza_personnalise")
                        $productPrice = number_format($c["productPrice"], 2);
                    else
                        $productPrice = number_format($c["price"], 2);
                    echo '<div id="cart-item">';
                        echo '
                            <p>
                                <span id="cart-item-title">'. $c["name"].' '.$productPrice.' €</span>
                                <span class="bi bi-x-circle" data-position="'.$position.'"></span>
                            </p>';
                        if($c["type"] == "pizza_personnalise"){
                            $ingredientsAdded = $c["ingredientsAdded"];
                            $ingredientsRemoved = $c["ingredientsRemoved"];
                            echo '<div id="ingredient-container">';
                            foreach($ingredientsAdded as $ingredientAdded){
                                echo '<p class="p-ingredient-added"><span>'. $ingredientAdded.'</span><span>+ 3.00 €</span></p>';
                            }
                            foreach($ingredientsRemoved as $ingredientRemoved){
                                echo '<p class="p-ingredient-removed"> - '. $ingredientRemoved.'</p>';
                            }
                            echo '</div>';
                        }
                    echo '</div>';
                $totalPrice += $c["price"];
            }
            echo '
                </div>
                <a href="index.php?objet=paiement">
                    <button class="button-cart">
                        <span class="text-center">Commander</span>
                        <span class="text-end">'.number_format($totalPrice, 2).' €</span>
                    </button>
                </a>';
           
    }
?>
<?php
if(isset($_SESSION["cart"][0])) : ?>
<section class="cart-container">
    <h2>Votre panier</h2>
    <?php displayCart(); ?>
</section>
<?php endif; ?>
