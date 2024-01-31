<?php
    require_once("model/pizza.php");
    require_once("model/ingredient.php");
    require_once("controller/controllerObjet.php");
    
    class controllerPizza extends controllerObjet {
        protected static string $classe = "pizza";
        protected static string $identifiant ="id_pizza";
    
        protected static array $champs = array(
            "nom_pizza" =>["text", "Nom de la pizza"],
            "prix_pizza" =>["numbre", "Prix"]
        );

        public static function stockPizza(){
            $class = static::$classe;
            $identifiant= static::$identifiant;
            $action = "create";
            $champs = static::$champs;
            $pizzas= $class::getAll();
            require_once("view/head.php");
            require_once("view/popup.php");
            require_once("view/navbar.php");
            require_once("view/pizzaList.php");
            require_once("view/footer.html");
        }

        public static function ingredientPizza(){
            $classe = static::$classe;
            $pizza = $classe::getIngredientList();
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/pizzaIngredientList.php");
            require_once("view/footer.html");
        }

    }
?>