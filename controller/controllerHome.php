<?php
require_once("model/pizza.php");
require_once("controller/controllerObjet.php");


class controllerHome extends controllerObjet
{
    protected static string $classe = "pizza";
    protected static string $identifiant = "id_pizza";


    public static function showPizzaMoment(){
        $classe = static::$classe;
        $pizza_Moment = array();
        $pizza_Moment = $classe::getPizzaMoment();
        require_once("view/home.php");
    }
                                                 
}
