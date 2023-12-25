<?php

require_once("objet.php");

class pizza extends objet{
    protected static string $identifiant ="numPizza";
    
    protected static string $classe ="pizza";
    // protected static $tableauSelect = array("adherent", "login");

    protected $numPizza;
    protected $nomPizza;
    protected $prixPizza;
    protected $listeIngredient;

    public function __construct(
        $numPizza = NULL,
        $nomPizza = NULL,
        $prixPizza = NULL,
        $listeIngredient = NULL,
    ){
        if(!is_null($numPizza)){
            $this->numPizza = $numPizza;
            $this->nomPizza = $nomPizza;
            $this->prixPizza = $prixPizza;
            $this->listeIngredient = $listeIngredient;
        }
    }

    // public function __toString(): string{
    //     $l = $this->login;
    //     $p = $this->prenomAdherent;
    //     $n = $this->nomAdherent;
    //     return "adhérent $l ($p $n)";
    // }
}
?>