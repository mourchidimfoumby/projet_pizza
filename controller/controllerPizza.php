<?php
    require_once("model/pizza.php");
    require_once("model/ingredient.php");
    require_once("model/allergene.php");
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
        
        public static function displayStock()
        {
            if (isset($_SESSION["gestionnaire"])) {
                $class = static::$classe;
                $identifiant = static::$identifiant;
                $pizzas = $class::getAll();
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
            } else {
                header("Location: index.php?objet=gestionnaire");
                exit();
            }
        }
    
        public static function create()
        {
            if (isset($_SESSION["gestionnaire"])) {
                $class = static::$classe;
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
                $class::create($donnees);
                header("Location: index.php?objet=pizza&action=displayStock");
                exit();
            } else {
                header("Location: index.php?objet=gestionnaire");
                exit();
            }
        }
    
        // public static function setPizzaMoment(){
        //     $classe = static::$classe;
        //     $idPizza = $_POST["id"];
        //     $classe::setPizzaMoment($idPizza);
        // }
        // public static function unsetPizzaMoment(){
        //     $classe = static::$classe;
        //     $idPizza = $_POST["id"];
        //     $classe::unsetPizzaMoment($idPizza);
        // }
}


