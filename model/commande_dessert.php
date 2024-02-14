<?php

require_once("objet.php");

class commande_dessert extends objet
{
    protected static string $classe = "commande_dessert";

    protected $id_commande;
    protected $id_dessert;
    protected $quantite_dessert;
    
    public function __construct(
        $id_commande = NULL,
        $id_dessert = NULL,
        $quantite_dessert = NULL,
    ) {
        if (!is_null($id_commande)) {
            $this->id_commande = $id_commande;
            $this->id_dessert = $id_dessert;
            $this->quantite_dessert = $quantite_dessert;
        }
    }
}
