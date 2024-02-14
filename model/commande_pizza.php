<?php

require_once("objet.php");

class commande_pizza extends objet
{

    protected static string $classe = "commande_pizza";

    protected $id_commande;
    protected $id_pizza;
    protected $quantite_pizza;
    
    public function __construct(
        $id_commande = NULL,
        $id_pizza = NULL,
        $quantite_pizza = NULL,
    ) {
        if (!is_null($id_commande)) {
            $this->id_commande = $id_commande;
            $this->id_pizza = $id_pizza;
            $this->quantite_pizza = $quantite_pizza;
        }
    }
}
