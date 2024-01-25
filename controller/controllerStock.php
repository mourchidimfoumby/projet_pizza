<?php

require_once("model/stock.php");
require_once("controller/controllerObjet.php");

class controllerStock extends controllerObjet
{
    protected static string $classe = "stock";
    protected static string $identifiant = "id_stock";

    public static function displayAll(){
        $classe = static::$classe;
        $title = ucfirst($classe);
        $objects = $classe::getAll();
        include("view/head.php");
        include("view/navbar.html");
        include("view/footer.html");
    }
}
