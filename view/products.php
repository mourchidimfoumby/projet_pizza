<?php
$classe =  static::$classe;
?>
<section class="product">
    <?php
    if ($objects != null) {
        $i = 0;
        while($i < 20){
            $i++;
        foreach ($objects as $object) {
            $id = $object->get("id_$classe");
            echo '<a href="#">';
            echo '<div class="product-cards">';
            echo '<img src="https://imagesvc.meredithcorp.io/v3/mm/image?url=https%3A%2F%2Fstatic.onecms.io%2Fwp-content%2Fuploads%2Fsites%2F43%2F2023%2F02%2F20%2F6776_Pizza-Dough_ddmfs_4x3_1724.jpg&q=60&c=sc&orient=true&poi=auto&h=512">';
            echo '<div id="text-parts">';
            echo '<h3>' .$object. '</h3>';
            if($classe == "pizza"){
                $ingredientList = $object->getIngredientList($id);
                $ingredients = implode(", ", $ingredientList);
                echo '<p>' . $ingredients . '</p>';
            }
            echo '<button class="button-cart"> <span class="text-center">Ajouter </span> <span class="text-end">' . $object->get("prix_$classe") . ' €</span></button>';
            echo '</div>'; 
            echo '</div>';
            echo '</a>';
        }
    }
 } else {
        echo "<h2>Rien à afficher</h2>";
    }
    ?>
</section>