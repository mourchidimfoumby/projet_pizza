<?php

require_once("objet.php");

class dessert extends objet
{
    protected static string $identifiant = "id_dessert";

    protected static string $classe = "dessert";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_dessert;
    protected $nom_dessert;
    protected $prix_dessert;

    protected $image_dessert;

    public function __construct(
        $id_dessert = NULL,
        $nom_dessert = NULL,
        $prix_dessert = NULL,
        $image_dessert = NULL,
    ) {
        if (!is_null($id_dessert)) {
            $this->id_dessert = $id_dessert;
            $this->nom_dessert = $nom_dessert;
            $this->prix_dessert = $prix_dessert;
            $this->image_dessert = $image_dessert;
        }
    }

    public function __toString(): string{
        return strval($this->nom_dessert);
    }
}
