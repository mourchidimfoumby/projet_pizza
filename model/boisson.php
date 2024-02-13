<?php

require_once("objet.php");

class boisson extends objet
{
    protected static string $identifiant = "id_boisson";

    protected static string $classe = "boisson";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_boisson;
    protected $nom_boisson;
    protected $prix_boisson;
    protected $volume_boisson;
    protected $image_boisson;

    public function __construct(
        $id_boisson = NULL,
        $nom_boisson = NULL,
        $prix_boisson = NULL,
        $volume_boisson = NULL,
        $image_boisson = NULL,
    ) {
        if (!is_null($id_boisson)) {
            $this->id_boisson = $id_boisson;
            $this->nom_boisson = $nom_boisson;
            $this->prix_boisson = $prix_boisson;
            $this->volume_boisson = $volume_boisson;
            $this->image_boisson = $image_boisson;
        }
    }

    public function __toString(): string{
        $volume_boisson = $this->formatNombre($this->volume_boisson);
        return "$this->nom_boisson $volume_boisson";
    }

    private function formatNombre($nombre) {
        $chaineNombre = strval($nombre);
        $chaineNombre = rtrim($chaineNombre, '0');
        $chaineNombre = rtrim($chaineNombre, '.');
        return $chaineNombre."L";
    }
}
