<?php

    function displayCart(){
            $cart = $_SESSION["cart"];
            $totalPrice = 0;
            $i = 0;
            echo '<div id="cart">';
                foreach($cart as $c){
                    $i++;
                    echo '<div id="cart-item">';
                        echo '<p><span>'. $c["name"].'</span> <span>'.$c["price"].' €</span></p>';
                        echo '<span class="bi bi-x-circle" data-position="'.$i.'"></span>';
                    echo '</div>';
                $totalPrice += $c["price"];
            }
            echo '
                </div>
                <button class="button-cart">
                    <span class="text-center">Commander</span>
                    <span class="text-end">'.number_format($totalPrice, 2).' €</span>
                </button>';
           
    }
?>
<?php
if(isset($_SESSION["cart"][0])) : ?>
<section class="cart-container">
    <h2>Votre panier</h2>
    <?php displayCart(); ?>
</section>
<?php endif; ?>
