<section class="cart">
    <h2> Votre panier</h2>
    <div id="cart-item">
    <?php
    $totalPrice = 0;
    $i = 0;
        foreach($objects as $object){
            while($i < 20){
            $totalPrice += $object->get("prix_$classe");
            $price = $object->get("prix_$classe");
            echo "<p>$object - $price €</p>";
            $i++;
            }
        }
        $totalPrice = number_format($totalPrice,2);
        if($totalPrice > 0) $valPrice = "$totalPrice €";
        else $valPrice = "";
    echo '</div>';
    echo '<button class="button-cart" disabled> 
            <span class="text-center">Commander </span> 
            <span class="text-end"> ' . $valPrice . '</span>
        </button>';
    ?>
</section>

