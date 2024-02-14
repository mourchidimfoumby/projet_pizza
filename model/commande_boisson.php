<?php

require_once("objet.php");

class commande_boisson extends objet
{
    protected static string $classe = "commande_boisson";

    protected $id_commande;
    protected $id_boisson;
    protected $quantite_boisson;
    
    public function __construct(
        $id_commande = NULL,
        $id_boisson = NULL,
        $quantite_boisson = NULL,
    ) {
        if (!is_null($id_commande)) {
            $this->id_commande = $id_commande;
            $this->id_boisson = $id_boisson;
            $this->quantite_boisson = $quantite_boisson;
        }
    }
}
