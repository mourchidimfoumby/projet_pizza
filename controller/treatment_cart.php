<?php

const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;
const HTTP_METHOD_NOT_ALLOWED = 405;
const REQUEST = "HTTP_X_REQUESTED_WITH";
const XML_REQUEST = "XMLHTTPREQUEST";
const ERROR_MISS_PARAMETER = "Il manque le paramètre action";
const ERROR_MISS_DATA = "Il manque la donnée";
const METHOD_NOT_ALLOWED = "Method not allowed";
$methodAllowed = isset($_SERVER[REQUEST]) && strtoupper($_SERVER[REQUEST]) == XML_REQUEST;

if($methodAllowed){
    if(!isset($_POST["action"])) 
        response(HTTP_BAD_REQUEST, ERROR_MISS_PARAMETER);
    else
        switch($_POST["action"]){
            case "addToCart":
                addToCart();
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
    if(!isset($_POST["product"])) response(HTTP_BAD_REQUEST, ERROR_MISS_DATA);
    else{
        $response_code = HTTP_OK;
        $product = $_POST["product"];
        addToSession($product);
        $message = "Le produit $product a été ajouté !";
        response($response_code, $message);
    }
    
    function addToSession($product){
        if(isset($_SESSION["cart"])){
            $panier = $_SESSION["cart"];
            $panier[] = $product;
            $_SESSION["cart"] = $panier;
        }
        else $_SESSION["cart"] = array($product);
    }

}
?>