<?php
session_start();
require_once("../model/pizza.php");
require_once("../model/boisson.php");
require_once("../model/dessert.php");
require_once("../config/connexion.php");
connexion::connect();

const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;
const HTTP_METHOD_NOT_ALLOWED = 405;
const REQUEST = "HTTP_X_REQUESTED_WITH";
const XML_REQUEST = "XMLHTTPREQUEST";
const ERROR_MISS_ACTION = "Il manque l'action";
const ERROR_MISS_PARAMETERS = "Il manque les paramètres (id_cart, objet, id)";
const METHOD_NOT_ALLOWED = "Method not allowed";
$methodAllowed = isset($_SERVER[REQUEST]) && strtoupper($_SERVER[REQUEST]) == XML_REQUEST;

if($methodAllowed){
    if(!isset($_POST["action"])) 
        response(HTTP_BAD_REQUEST, ERROR_MISS_ACTION);
    else
        switch($_POST["action"]){
            case "addToCart":
                addToCart();
                break;
            case "removeToCart":
                removeToCart();
                break;
        }
}
else response(HTTP_METHOD_NOT_ALLOWED, METHOD_NOT_ALLOWED);

function response($response_code, $message){
    header("Content-Type: application/json");
    http_response_code($response_code);

    $response = [
        "response_code" => $response_code,
        "message" => $message,
    ];
    echo json_encode($response);
}

function addToCart(){
    if(!isset($_POST["parameters"])){
        response(HTTP_BAD_REQUEST, ERROR_MISS_PARAMETERS);
    }
    else
    {
        $response_code = HTTP_OK;
        $parameters = $_POST["parameters"];
        $classe = $parameters["objet"];
        $id = $parameters["id"];
        $objects = $classe::getOne($id);
        
        foreach($objects as $object){
            $price = $object->get("prix_$classe");
            $product = array(
                "name" => "$object",
                "price" => $price
            );
        }
        
        $_SESSION["cart"][] = $product;
        $message = "Le produit '". end($_SESSION["cart"])["name"] ."' a été ajouté dans le panier !";
        response($response_code, $message);
}
}

function removeToCart(){
    if(!isset($_POST["parameters"])){
        response(HTTP_BAD_REQUEST, ERROR_MISS_PARAMETERS);
    }
    else
    {
        $response_code = HTTP_OK;
        $parameters = $_POST["parameters"];
        $position = $parameters["position"];
        $position --;
        
        
        if (isset($_SESSION["cart"][$position])) {
            unset($_SESSION['cart'][$position]);
            $_SESSION['cart'] = array_values($_SESSION['cart']);
            $message = "Le produit à la position ". $position." a été retiré du panier !";
        }
        else  $message = "Erreur le produit à la position ". $position." n'existe pas.";
        response($response_code, $message);
}
}
?>