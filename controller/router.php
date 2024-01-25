<?php

require_once("config/connexion.php");
connexion::connect();

//les objets possibles
$objets = [
    "pizza",
    "dessert",
    "boisson",
    "stock"
];

//test pour savoir si un objet correct est passé dans l'url
if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)) {
    //si c'est le cas, on récupère l'objet passé dans l'url
    $objet = $_GET["objet"];
    $controller = "controller". ucfirst($objet);
    require_once("controller/$controller.php");
    $controller::displayAll();
}
else{
    include("view/home.php");
}
?>
