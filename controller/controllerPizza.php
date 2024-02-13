<?php
require_once("model/pizza.php");
require_once("model/ingredient.php");
require_once("model/allergene.php");
require_once("controller/controllerObjet.php");


class controllerPizza extends controllerObjet
{
    protected static string $classe = "pizza";
    protected static string $identifiant = "id_pizza";
    protected static array $champs = array(
        "nom_pizza" => ["text", "Nom de la pizza"],
        "prix_pizza" => ["number", "Prix"]
    );
    public static function displayStock()
    {
        if (isset($_SESSION["gestionnaire"])) {
            $class = static::$classe;
            $identifiant = static::$identifiant;
            $pizzas = $class::getAll();
            $title = "Stock $class";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/pizza_list.php");
            require_once("view/footer.html");
        } else {
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
    public static function displayCreateForm()
    {
        if (isset($_SESSION["gestionnaire"])) {
            $class = static::$classe;
            $identifiant = static::$identifiant;
            $champs = static::$champs;
            $pizzas = $class::getAll();
            $ingredients = ingredient::getAll();
            $allergenes = allergene::getAll();
            $title = "Stock $class";
            require_once("view/head.php");
            require_once("view/popup_create.php");
            require_once("view/navbar.php");
            require_once("view/pizza_list.php");
            require_once("view/footer.html");
        } else {
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
    public static function create()
    {
        $class = static::$classe;
        $donnees = array();
        $ingredients = $_POST["ingredient"];
        $allergenes = $_POST["allergene"];
        $pizza = array_diff_key($_POST, array("ingredient" => "", "allergene" => ""));
        $donnees = array(
            "pizza" => $pizza,
            "ingredient" => $ingredients,
            "allergene" => $allergenes
        );
        $class::create($donnees);
        header("Location: index.php?objet=pizza&action=displayStock");
        exit();
    }
}
