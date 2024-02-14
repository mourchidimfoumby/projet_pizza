<?php
require_once("controller/controllerHome.php");
require_once("config/connexion.php");
connexion::connect();

//les objets possibles
$objets = [
    "pizza",
    "dessert",
    "boisson",
    "client",
    "gestionnaire",
    "stock",
    "finance",
    "paiement",
    "statistiques",
    "alerte"
];

$conditionUrlGet = isset($_GET["objet"]) && in_array($_GET["objet"], $objets);
$conditionUrlPost = isset($_POST["objet"]) && in_array($_POST["objet"], $objets);
//test pour savoir si un objet correct est passé dans l'url
if ($conditionUrlGet) {
    //si c'est le cas, on récupère l'objet passé dans l'url
    $objet = $_GET["objet"];
    $controller = "controller". ucfirst($objet);
    require_once("controller/$controller.php");

    if(isset($_GET["action"])){
        $action = $_GET["action"];
        switch ($action) 
        {
            case "disconnection":
                $controller::disconnection();
                break;
            case "displayStock":
                $controller::displayStock();
                break;
            case "displayCreateForm":
                $controller::displayCreateForm();
                break;
            case "create":
                $controller::create();
                break;
            default:
                $controller::displayDefault();
                break;
        }
    }

    else if(isset($_POST["action"])){
        $action = $_POST["action"];
        switch ($action) 
        {
            case "connection":
                $controller::connection();
                break;
            case "update":
                $controller::update();
                break;
            case "insertCartePaiement":
                $controller::insertCartePaiement();
                break;
            case "create":
                $controller::create();
                break;
            default:
                $controller::displayDefault();
                break;
        }
    }
    else $controller::displayDefault();
}
else controllerHome::showPizzaMoment();
?>
