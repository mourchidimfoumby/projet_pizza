<?php

require_once("objet.php");

class pizza extends objet{
    protected static string $identifiant ="id_pizza";
    
    protected static string $classe ="pizza";
    // protected static $tableauSelect = array("adherent", "login");

    protected $id_pizza;
    protected $nom_pizza;
    protected $prix_pizza;
    protected $pizza_du_moment;

    public function __construct(
        $id_pizza = NULL,
        $nom_pizza = NULL,
        $prix_pizza = NULL,
        $pizza_du_moment = NULL
    ){
        if(!is_null($id_pizza))
        {
            $this->id_pizza = $id_pizza;
            $this->nom_pizza = $nom_pizza;
            $this->prix_pizza = $prix_pizza;
            $this->pizza_du_moment = $pizza_du_moment;
        }
    }

    public static function getIngredientList($id){
        $request = "";
        $request .= "SELECT nom_ingredient FROM pizza ";
        $request .= "NATURAL JOIN ingredient_pizza ";
        $request .= "NATURAL JOIN ingredient ";
        $request .= "WHERE id_pizza = $id";
        $result = connexion::pdo()->prepare($request);
        try{
            $result->execute();
            return $result->fetchAll(PDO::FETCH_COLUMN);
        }
        catch(PDOException $e){
            echo $e->getMessage();
            echo $request;
        }
    }
    public function __toString(): string{
        return strval($this->nom_pizza);
    }
}
?>