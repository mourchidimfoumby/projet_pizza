<?php

class objet{
    protected static string $identifiant;

    protected static string $classe;
    // protected static $tableauSelect;
    public function get($attribut){
        return $this->$attribut;
    }

    public function set($attribut, $valeur): void{
        $this->$attribut = $valeur;
    }

    public static function getAll($condition = NULL){
        $classeRecuperee = static::$classe;
        if($condition == NULL)
            $requete ="SELECT * FROM $classeRecuperee;";
        else
            $requete ="SELECT * FROM $classeRecuperee WHERE $condition;";
        $resultat = connexion::pdo()->query($requete);
        $resultat->setFetchMode(PDO::FETCH_CLASS, $classeRecuperee);
        $tableau = $resultat->fetchAll();
        return $tableau;
    }
    
    public static function getOne($id){
        $classeRecuperee = static::$classe; 
        $identifiant = static::$identifiant;
        $requetePreparee = "SELECT * FROM $classeRecuperee WHERE $identifiant = :id_tag;";
        $resultat = connexion::pdo()->prepare($requetePreparee);
        $tags = array("id_tag" => $id);
        try{
            $resultat->execute($tags);
            $element = $resultat->fetchObject($classeRecuperee);
            return $element;
        }
        catch(PDOException $e){
            echo"".$e->getMessage();
        }
    }

    public static function update($donnees, $id){
        $classeRecuperee = static::$classe;
        $identifiant = static::$identifiant;
        $requetePreparee = "";
        foreach($donnees as $column => $val){
            $requetePreparee .= "UPDATE $classeRecuperee SET $column = '$val' WHERE $identifiant = '$id';";
        }
        connexion::pdo()->query($requetePreparee);
    }

    public static function create($donnees){
        $columns = implode(', ', array_keys($donnees));
        $values = array();
        $classeRecuperee = static::$classe;
        foreach($donnees as $val){
            array_push($values, $val);
        }
        $valuesSQL = function($values){
            $result = "";
            foreach($values as $val){
                $result.= "'$val',";
            }
            $result = substr_replace($result, "", -1);
            return $result;
        };
        $requetePreparee = "INSERT INTO $classeRecuperee ($columns)
        VALUES(". $valuesSQL($values) .")";
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        try{
            $resultat->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
?>