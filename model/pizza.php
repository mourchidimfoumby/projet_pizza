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

    protected static array $champs = array(
        "nom_pizza" =>["text", "Nom de la pizza"],
        "prix_pizza" =>["numbre", "Prix"]
    );

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
    
    public static function getIngredientList($id, $condition = NULL){
        $request = "";
        $request .= "SELECT id_ingredient, nom_ingredient FROM pizza ";
        $request .= "NATURAL JOIN ingredient_pizza ";
        $request .= "NATURAL JOIN ingredient ";
        if($condition == null)
            $request .= "WHERE id_pizza = $id";
        else
            $request .= "WHERE id_pizza = $id AND $condition";
        $result = connexion::pdo()->prepare($request);
        try{
            $result->execute();
            return $result->fetchAll(PDO::FETCH_KEY_PAIR);
        }
        catch(PDOException $e){
            echo $e->getMessage();
            echo $request;
        }
    }

    public static function getVuePizza(){
        $classe = static::$classe;
        $request = "SELECT * FROM Liste_pizza";
        $result = connexion::pdo()->prepare($request);
        $result->setFetchMode(pdo::FETCH_CLASS, $classe);
        $resultat = $result->fetchAll();
        try{
            return $resultat;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }


    public function __toString(): string{
        return strval($this->nom_pizza);
    }
}
?>