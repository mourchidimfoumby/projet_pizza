<?php

include("view/head.php");
include("view/navbar.php");
$reduc = 0;
if(isset($_SESSION["client"][0])){
    $client = $_SESSION["client"][0];
    $reduc = $client->get("reduction_client");
} 
if($reduc == 1){
    echo "<p> Vous avez une réduction disponible</p>";
}
else echo "<p> Vous n'avez pas de réduc :(</p>";
echo '<h2 style="padding: 16px;">Hello bienvenue sur notre site !</h2>';
include("view/footer.html");
?>