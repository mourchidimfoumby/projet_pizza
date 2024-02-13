<?php
$title = "Pizza Hub";
include("view/head.php");
include("view/navbar.php");
echo '<section class="section-home">';
foreach($pizza_Moment as $pizza){
    ?>
    <div id="hot">
        <?php
    echo '<h1 id="texte">Le HOT du moment </h1>';
    echo '<img src="'.$pizza['image_pizza'].'" id="pizza_Moment"/>';
    echo '<h2 id="prix">'.$pizza['prix_pizza']. "€". '</h2>';
    echo '<h1 id="nom_pizza"> '.$pizza['nom_pizza']. '</h1>';
}
echo '</section>';
include("view/footer.html");


?>

