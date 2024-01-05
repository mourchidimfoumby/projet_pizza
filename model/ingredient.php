<?php

require_once("objet.php");

class ingredient extends objet
{
    protected static string $identifiant = "id_ingredient";

    protected static string $classe = "ingredient";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_ingredient;
    protected $nom_ingredient;
    protected $modifiable;
    protected $id_stock;
    
    public function __construct(
        $id_ingredient = NULL,
        $nom_ingredient = NULL,
        $modifiable = NULL,
        $id_stock = NULL,
    ) {
        if (!is_null($id_ingredient)) {
            $this->id_ingredient = $id_ingredient;
            $this->nom_ingredient = $nom_ingredient;
            $this->modifiable = $modifiable;
            $this->id_stock = $id_stock;
        }
    }

    public function __toString(): string{
        return  strval($this->nom_ingredient);
    }
}
