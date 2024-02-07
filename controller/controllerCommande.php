<?php

require_once("model/commande.php");
require_once("controller/controllerObjet.php");

class controllerCommande extends controllerObjet
{
    protected static string $classe = "commande";
    protected static string $identifiant = "id_commande";

    public static function displayDefault(){
        if(isset($_SESSION["gestionnaire"])){
            $classe = static::$classe;
            $identifiant = static::$identifiant;
            $champs = static::$champs;
            $objects = $classe::getAll();
            $title = "Gestion des ".$classe."s";
            require_once("view/head.php");
            require_once("view/popup_edit.php");
            require_once("view/navbar.php");
            require_once("view/stock.php");
            require_once("view/footer.html");
        }
        else{
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
    public static function create(){
        if(isset($_SESSION["cart"])){
            $classe = static::$classe;
            $cart = $_SESSION["cart"];
            $classe::create($cart);
        }
    }
}
