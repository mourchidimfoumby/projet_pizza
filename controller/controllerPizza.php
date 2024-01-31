<?php
    require_once("model/pizza.php");
    require_once("model/ingredient.php");
    require_once("controller/controllerObjet.php");
    
    class controllerPizza extends controllerObjet {
        protected static string $classe = "pizza";
        protected static string $identifiant ="id_pizza";
    

        public static function stockPizza(){
            $class = static::$classe;
            $pizzas= $class::getAll();
            require_once("view/head.php");
            require_once("view/navbar.html");
            require_once("view/pizzaList.php");
            require_once("view/footer.html");
        }

        public static function ingredientPizza(){
            $classe = static::$classe;
            $pizza = $classe::getIngredientList();
            require_once("view/head.php");
            require_once("view/navbar.html");
            require_once("view/pizzaIngredientList.php");
            require_once("view/footer.html");
        }
    }
?>