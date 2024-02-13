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

    protected $image_pizza;


    public function __construct(
        $id_pizza = NULL,
        $nom_pizza = NULL,
        $prix_pizza = NULL,
        $pizza_du_moment = NULL,
        $image_pizza = NULL
    ){
        if(!is_null($id_pizza))
        {
            $this->id_pizza = $id_pizza;
            $this->nom_pizza = $nom_pizza;
            $this->prix_pizza = $prix_pizza;
            $this->pizza_du_moment = $pizza_du_moment;
            $this->image_pizza = $image_pizza;
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
    public static function getAllergenesList($id){
        $request = "";
        $request .= "SELECT id_allergene, nom_allergene FROM pizza ";
        $request .= "NATURAL JOIN allergene_pizza ";
        $request .= "NATURAL JOIN allergene ";
        $request .= "WHERE id_pizza = $id";
        $result = connexion::pdo()->query($request);
        return $result->fetchAll(PDO::FETCH_KEY_PAIR);
    }

    public static function getPizzaMoment() {
        $request = "SELECT nom_pizza, prix_pizza, image_pizza FROM pizza WHERE pizza_du_moment = 1";
        $result = connexion::pdo()->prepare($request);
        $result->execute();
        $pizzaMoment = $result->fetchAll(PDO::FETCH_ASSOC);
        return $pizzaMoment;
    }
    public function __toString(): string{
        return strval($this->nom_pizza);
    }

    public static function create($donnees)
    {
        $identifiant = static::$identifiant;

        $valuesSQL = function ($values) {
            $result = "";
            foreach ($values as $val) {
                $result .= "'$val',";
            }
            $result = substr_replace($result, "", -1);
            return $result;
        };

        $pizza = $donnees["pizza"];
        $pizzaClass = static::$classe;
        $pizzaColumns = implode(', ', array_keys($pizza));
        $pizzaRequest = "INSERT INTO $pizzaClass ($pizzaColumns)
        VALUES(" . $valuesSQL($pizza) . ")";
        connexion::pdo()->query($pizzaRequest);

        if (isset($donnees["ingredient"]) || isset($donnees["allergene"])) {
            $lastIdRequest = "SELECT MAX($identifiant) FROM $pizzaClass";
            $resultLastId = connexion::pdo()->query($lastIdRequest);
            $lastId = $resultLastId->fetchColumn();

            if (isset($donnees["ingredient"])) {
                $ingredients = $donnees["ingredient"];
                $ingredientPizzaClass = "ingredient_pizza";
                $ingredientPizzaColumns = "id_pizza, id_ingredient, quantite_ingredient";
                $ingredientRequest = "";
                foreach ($ingredients as $ingredient) {
                    $ingredientRequest .= "INSERT INTO $ingredientPizzaClass ($ingredientPizzaColumns)
                    VALUES($lastId, $ingredient[id], $ingredient[quantite]);";
                }
                connexion::pdo()->query($ingredientRequest);
            }
            if (isset($donnees["allergene"])) {
                $allergenePizzaColumns = "id_pizza, id_allergene";
                $allergenePizzaClass = "allergene_pizza";
                $allergenes = $donnees["allergene"];
                $allergeneRequest = "";
                foreach ($allergenes as $id) {
                    $allergeneRequest .= "INSERT INTO $allergenePizzaClass ($allergenePizzaColumns)
                    VALUES($lastId, $id);";
                }
                connexion::pdo()->query($allergeneRequest);
            }
        }
    }

    public static function setPizzaMoment($idPizza)
    {
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $pizzaMomentRequest = "SELECT currentPizzaMoment() AS idPizza";
        $resultPizzaMoment = connexion::pdo()->query($pizzaMomentRequest);
        $idPizzaMoment = $resultPizzaMoment->fetchColumn();
        if ($idPizzaMoment != 0) {
            $requestRemove = "UPDATE $classe SET pizza_du_moment = 0 WHERE $identifiant = $idPizzaMoment";
            connexion::pdo()->query($requestRemove);
        }
        $request = "UPDATE $classe SET pizza_du_moment = 1 WHERE $identifiant = $idPizza";
        connexion::pdo()->query($request);
    }
    public static function unsetPizzaMoment($idPizza)
    {
        $classe = static::$classe;
        $identifiant = static::$identifiant;
        $request = "UPDATE $classe SET pizza_du_moment = 0 WHERE $identifiant = $idPizza";
        connexion::pdo()->query($request);
    }
}
?>