<?php

require_once("objet.php");

class pizza extends objet{
    protected static string $identifiant ="id_pizza";
    
    protected static string $classe ="pizza";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_pizza;
    protected $nom_pizza;
    protected $prix_pizza;

    public function __construct(
        $id_pizza = NULL,
        $nom_pizza = NULL,
        $prix_pizza = NULL,
    ){
        if(!is_null($id_pizza)){
            $this->id_pizza = $id_pizza;
            $this->nom_pizza = $nom_pizza;
            $this->prix_pizza = $prix_pizza;
        }
    }

    public static function getListeIngredient($id){
        $requete = "";
        $requete .= "SELECT nom_ingredient FROM pizza ";
        $requete .= "NATURAL JOIN ingredient_pizza ";
        $requete .= "NATURAL JOIN ingredient ";
        $requete .= "WHERE id_pizza = $id";
        $resultat = connexion::pdo()->prepare($requete);
        try{
            $resultat->execute();
            return $resultat->fetchAll(PDO::FETCH_COLUMN);
        }
        catch(PDOException $e){
            echo $e->getMessage();
            echo $requete;
        }
    }
    public function __toString(): string{
        return strval($this->nom_pizza);
    }
}
?>