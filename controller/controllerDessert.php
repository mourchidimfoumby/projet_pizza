<?php
require_once("model/dessert.php");
require_once("controller/controllerObjet.php");

class controllerDessert extends controllerObjet
{
    protected static string $classe = "dessert";
    protected static string $identifiant = "id_dessert";
}
