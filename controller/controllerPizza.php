<?php
    require_once("model/pizza.php");
    require_once("controller/controllerObjet.php");
    
    class controllerPizza extends controllerObjet {
        protected static string $classe = "pizza";
        protected static string $identifiant ="id_pizza";
    
    }
?>