<?php

require_once("objet.php");

class ingredient_pizza extends objet{
    protected static $identifiant = array("id_pizza","id_ingredient");
    
    protected static string $classe ="ingredient_pizza";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_pizza;
    protected $id_ingredient;
    protected $quantite;

    public function __construct(
        $id_pizza = NULL,
        $id_ingredient = NULL,
        $quantite = NULL,
    ){
        if(!is_null($id_pizza)){
            $this->id_pizza = $id_pizza;
            $this->id_ingredient = $id_ingredient;
            $this->quantite = $quantite;
        }
    }

}
?>