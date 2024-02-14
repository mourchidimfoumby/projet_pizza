<?php

require_once("model/stock.php");
require_once("controller/controllerObjet.php");

class controllerStock extends controllerObjet
{
    protected static string $classe = "stock";
    protected static string $identifiant = "id_stock";
    protected static array $champs = array(
        "nom_stock" => ["text","Nom du stock"],
        "quantite_stock" => ["number","Quantité"],
        "seuil_stock" => ["number","Seuil minimal"]
    );

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
}
