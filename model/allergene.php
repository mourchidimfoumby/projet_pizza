<?php

require_once("objet.php");

class allergene extends objet
{
    protected static string $identifiant = "id_allergene";

    protected static string $classe = "allergene";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_allergene;
    protected $nom_allergene;

    public function __construct(
        $id_allergene = NULL,
        $nom_allergene = NULL,
    ) {
        if (!is_null($id_allergene)) {
            $this->id_allergene = $id_allergene;
            $this->nom_allergene = $nom_allergene;
        }
    }

    public function __toString(): string{
        return  strval($this->nom_allergene);
    }
}