<?php
    require_once("model/boisson.php");
    require_once("controller/controllerObjet.php");
    
    class controllerBoisson extends controllerObjet {
        protected static string $classe = "boisson";
        protected static string $identifiant ="id_boisson";
    
    }
?>