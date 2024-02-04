<?php

require_once("../model/pizza.php");
require_once("../config/connexion.php");
connexion::connect();

const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;
const HTTP_METHOD_NOT_ALLOWED = 405;
const REQUEST = "HTTP_X_REQUESTED_WITH";
const XML_REQUEST = "XMLHTTPREQUEST";
const ERROR_MISS_ACTION = "Il manque l'action";
const ERROR_MISS_PARAMETERS = "Il manque le parametre (id)";
const METHOD_NOT_ALLOWED = "Method not allowed";
$methodAllowed = isset($_SERVER[REQUEST]) && strtoupper($_SERVER[REQUEST]) == XML_REQUEST;

if($methodAllowed){
    if(!isset($_POST["action"])) 
        response(HTTP_BAD_REQUEST, ERROR_MISS_ACTION);
    else
        switch($_POST["action"]){
            case "setPizzaMoment":
                setPizzaMoment();
                break;
            case "unsetPizzaMoment":
                unsetPizzaMoment();
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

function setPizzaMoment(){
    if(!isset($_POST["id"])){
        response(HTTP_BAD_REQUEST, ERROR_MISS_PARAMETERS);
        response(HTTP_BAD_REQUEST, print_r($_POST));
    }
    else
    {
        $response_code = HTTP_OK;
        $id = $_POST["id"];
        pizza::setPizzaMoment($id);
        $message = "Le pizza numero $id a ete mise en avant !";
        response($response_code, $message);
    }
}

function unsetPizzaMoment(){
    if(!isset($_POST["id"])){
        response(HTTP_BAD_REQUEST, ERROR_MISS_PARAMETERS);
    }
    else
    {
        $response_code = HTTP_OK;
        $id = $_POST["id"];
        pizza::unsetPizzaMoment($id);
        $message = "Le pizza numero $id a ete retire de la mise en avant !";
        response($response_code, $message);
    }
}
?>