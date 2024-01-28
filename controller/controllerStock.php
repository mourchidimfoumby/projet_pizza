<?php

require_once("model/stock.php");
require_once("controller/controllerObjet.php");

class controllerStock extends controllerObjet
{
    protected static string $classe = "stock";
    protected static string $identifiant = "id_stock";

    public static function displayDefault(){
        if(isset($_SESSION["gestionnaire"])){
            $classe = static::$classe;
            $title = ucfirst($classe);
            $objects = $classe::getAll();
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/static_stock.php");
            require_once("view/footer.html");
        }
        else{
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
    public static function displayEditStock(){
        if(isset($_SESSION["gestionnaire"])){
            $classe = static::$classe;
            $title = ucfirst($classe);
            $objects = $classe::getAll();
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/edit_stock.php");
            require_once("view/footer.html");
        }
        else{
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
}
