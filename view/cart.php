<section class="cart">
    <h2> Votre panier</h2>
    <?php
        $price = "";
    echo '<button class="button-cart" disabled> 
            <span class="text-center">Commander </span> 
            <span class="text-end"> ' . $price . '</span>
        </button>';
    ?>
</section>