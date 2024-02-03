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
        "nom_pizza" =>["text", "Nom de la pizza"],
        "prix_pizza" =>["number", "Prix"]
    );

    public static function displayStock() {
        if(isset($_SESSION["gestionnaire"])) {
            $class = static::$classe;
            $identifiant= static::$identifiant;
            $pizzas= $class::getAll();
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/pizza_list.php");
            require_once("view/footer.html");
        }
        else{
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }

    public static function displayCreateForm() {
        if(isset($_SESSION["gestionnaire"])) {
            $class = static::$classe;
            $identifiant= static::$identifiant;
            $action = "create";
            $champs = static::$champs;
            $pizzas = $class::getAll();
            $ingredients = ingredient::getAll();
            $allergenes = allergene::getAll();
            require_once("view/head.php");
            require_once("view/popup_create.php");
            require_once("view/navbar.php");
            require_once("view/pizza_list.php");
            require_once("view/footer.html");
        }
        else {
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }

    public static function create() {
        if(isset($_SESSION["gestionnaire"])) {
            $class = static::$classe;
            $identifiant = static::$identifiant;
            $donnees = array();
            $POST = array_diff_key($_POST, array("action" => ""));
            $ingredients = $POST["ingredient"];
            $allergenes = $POST["allergene"];
            $pizza = array_diff_key($POST, array("ingredient" => "", "allergene" => ""));
            $donnees = array(
                "pizza" => $pizza,
                "ingredient" => $ingredients,
                "allergene" => $allergenes
            );
            $identifiant = static::$identifiant;

        $valuesSQL = function($values){
            $result = "";
            foreach($values as $val){
                $result.= "'$val',";
            }
            $result = substr_replace($result, "", -1);
            return $result;
        };

        $pizza = $donnees["pizza"];
        $ingredients = $donnees["ingredient"];
        $allergenes = $donnees["allergene"];
        
        $pizzaClass = static::$classe;
        $ingredientPizzaClass = "ingredient_pizza";
        $allergenePizzaClass = "allergene_pizza";
        
        $pizzaColumns = implode(', ', array_keys($pizza));
        $ingredientPizzaColumns = "id_pizza, id_ingredient, quantite_ingredient";
        $allergenePizzaColumns = "id_pizza, id_allergene";

        $pizzaRequest = "INSERT INTO $pizzaClass ($pizzaColumns)
        VALUES(". $valuesSQL($pizza) .")";
        connexion::pdo()->query($pizzaRequest);
        $lastIdRequest = "SELECT MAX($identifiant) FROM $pizzaClass";
        $resultLastId = connexion::pdo()->query($lastIdRequest);
        $lastId = $resultLastId->fetchColumn();
        $ingredientRequest = "";
        $allergeneRequest = "";

        foreach($ingredients as $ingredient){
            $ingredientRequest.= "INSERT INTO $ingredientPizzaClass ($ingredientPizzaColumns)
            VALUES($lastId, $ingredient[id], $ingredient[quantite]);";
        }
        foreach($allergenes as $id){
            $allergeneRequest.= "INSERT INTO $allergenePizzaClass ($allergenePizzaColumns)
            VALUES($lastId, $id);";
        }
        $resultatIngredient = connexion::pdo()->prepare($ingredientRequest); 
        $resultatAllergene = connexion::pdo()->prepare($allergeneRequest); 
        $resultatIngredient->execute();
        $resultatAllergene->execute();
        //     //$class::create($donnees);
            // header("Location: index.php?objet=pizza&action=displayStock");
            // exit();
        }
        else {
            header("Location: index.php?objet=gestionnaire");
            exit();
        }
    }
}
