<?php

abstract class controllerObjet{
    protected static string $classe;
    protected static string $identifiant;
    protected static array $champs;
    // protected static array $tableauSelect;

    public static function displayDefault(){
        $classe = static::$classe;
        $title = ucfirst($classe)."s";
        $objects = $classe::getAll();
        if(isset($_GET["id_pizza"])){
            $id_pizza = $_GET["id_pizza"];
            $object = $classe::getOne($id_pizza);
            $condition = "modifiable = 1";
            $ingredientsPizzaModifiable = $object->getIngredientList($id_pizza, $condition);
            $ingredientsPizzaAll = $object->getIngredientList($id_pizza);
            $ingredientsPizzaAll = implode(", ", $ingredientsPizzaAll);
            $ingredientsModifiable = ingredient::getAll($condition);
            $ingredientsModifiable = array_diff($ingredientsModifiable, $ingredientsPizzaModifiable);
            $allergenesPizza = $classe::getAllergenesList($id_pizza);
            $allergenesPizza = implode(", ", $allergenesPizza);
        }
        require_once("view/head.php");
        require_once("view/popup_edit_commande.php");
        require_once("view/navbar.php");
        require_once("view/products.php");
        require_once("view/cart.php");
        require_once("view/footer.html");
    }

    public static function update(){
        $classe = static::$classe;
        $donnees = array();
        $POST = array_diff_key($_POST, array("action" => ""));
        foreach($POST as $name => $value){
            $donnees[$name] = $value;
        }
        $idRecuperee = $_GET[static::$identifiant];
        $classe::update($donnees, $idRecuperee);
        header("Location: index.php?objet=$classe");
        exit();
    }
}