<?php

require_once("objet.php");

class commande_pizza_personnalise extends objet
{

    protected static string $classe = "commande_pizza_personnalise";

    protected $id_pizza;
    protected $id_ingredient;
    protected $id_commande;
    protected $quantite_pizza_personnalise;
    protected $id_type_personnalise;
    
    public function __construct(
        $id_pizza = NULL,
        $id_ingredient = NULL,
        $id_commande = NULL,
        $quantite_pizza_personnalise = NULL,
        $id_type_personnalise = NULL
    ) {
        if (!is_null($id_pizza)) {
            $this->id_pizza = $id_pizza;
            $this->id_ingredient = $id_ingredient;
            $this->id_commande = $id_commande;
            $this->quantite_pizza_personnalise = $quantite_pizza_personnalise;
            $this->id_type_personnalise = $id_type_personnalise;
        }
    }
}
