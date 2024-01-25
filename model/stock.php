<?php

require_once("objet.php");

class stock extends objet{

    protected static string $identifiant ="id_stock";
    
    protected static string $classe ="stock";

    protected $id_stock;
    protected $nom_stock;
    protected $quantite_stock;
    protected $seuil_stock;

    public function __construct(
        $id_stock = NULL,
        $nom_stock = NULL,
        $quantite_stock = NULL,
        $seuil_stock = NULL
    ){
        if(!is_null($id_stock))
        {
            $this->id_stock = $id_stock;
            $this->nom_stock = $nom_stock;
            $this->quantite_stock = $quantite_stock;
            $this->seuil_stock = $seuil_stock;
        }
    }
}
?>