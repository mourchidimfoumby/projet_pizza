<?php
//valeur par défaut de l'objet
$objet = "pizza";
//les objets possibles
$objets = [
    "pizza",
    "dessert",
    "boisson",
];

//test pour savoir si un objet correct est passé dans l'url
if (isset($_GET["objet"]) && in_array($_GET["objet"], $objets)) {
    //si c'est le cas, on récupère l'objet passé dans l'url
    $objet = $_GET["objet"];
}
//construction du contrôlleur
$controller = "controller". ucfirst($objet);
//insertion du contrôleur
require_once("controller/$controller.php");
//connexion
require_once("config/connexion.php");
connexion::connect();
//appel de la méthode displayAll du contrôleur
if(isset($_GET["action"])){
    $action = $_GET["action"];
    switch ($action) 
    {
        case "displayOne":
            $controller::displayOne();
            break;
        case "delete":
            $controller::delete();
            break;
        case "displayCreationForm":
            $controller::displayCreationForm();
            break;
        case "create":
            $controller::create();
            break;
    }
}
else $controller::displayAll();
?>
