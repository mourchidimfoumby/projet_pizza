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
        //on récupère le nom de la table
        $classeRecuperee = static::$classe; 

        //on récupère le nom de l'identifiant
        $identifiant = static::$identifiant;

        //on construit la requête préparée avec un tag qui
        //remplace la valeur de l'identifiant
        $requetePreparee = "SELECT * FROM $classeRecuperee WHERE $identifiant = :id_tag;";

        //on lance la méthode "prepare" et on récupère le résultat
        // (qui n'est pas du tout exploitable puisque le tag n'a pas été remplacé)
        $resultat = connexion::pdo()->prepare($requetePreparee);

        //on crée le tableau contenant le tag et sa valeur
        $tags = array("id_tag" => $id);

        try{
            //on éxecute la requête préparée
            $resultat->execute($tags);
            
            $element = $resultat->fetchObject($classeRecuperee);

            //on le retourne
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
        $resultat = connexion::pdo()->prepare($requetePreparee); 
        try{
            $resultat->execute();
        }
        catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    // public static function delete($id){
    //      $classeRecuperee = static::$classe; 
    //      $identifiant = static::$identifiant;
    //      $requetePreparee = "DELETE FROM $classeRecuperee WHERE $identifiant = '$id'";
    //      $resultat = connexion::pdo()->prepare($requetePreparee); 
    //      try{
    //          $resultat->execute();
    //      }
    //      catch(PDOException $e){
    //         echo $e->getMessage();
    //      }
    // }

    // public static function create($donnees){
    //     $columns = implode(', ', array_keys($donnees));
    //     $values = array();
    //     $classeRecuperee = static::$classe;
    //     foreach($donnees as $val){
    //         array_push($values, $val);
    //     }
    //     $valuesSQL = function($values){
    //         $result = "";
    //         foreach($values as $val){
    //             $result.= "'$val',";
    //         }
    //         $result = substr_replace($result, "", -1);
    //         return $result;
    //     };
    //     $requetePreparee = "INSERT INTO $classeRecuperee ($columns)
    //     VALUES(". $valuesSQL($values) .")";
    //     $resultat = connexion::pdo()->prepare($requetePreparee); 
    //     try{
    //         $resultat->execute();
    //     }
    //     catch(PDOException $e){
    //     echo $e->getMessage();
    //     echo $requetePreparee;
    //     }
    // }

    // public static function getSelect(){
    //     $tableauSelect = static::$tableauSelect;
    //     $classe = $tableauSelect[0];
    //     if(isset($tableauSelect[2])){
    //         $value = $tableauSelect[1].",".$tableauSelect[2]; 
    //     }
    //     else{
    //         $value = $tableauSelect[1];
    //     }
    //     $requetePrepare = "SELECT $value FROM $classe";
    //     $resultat = connexion::pdo()->prepare($requetePrepare);
    //     try{
    //         $i = 0;
    //         $resultat->execute();
    //         $tableau = $resultat->fetchAll();
    //         if($classe == "adherent") $classe = "emprunteur";
    //         $result = "";
    //         $result .= "<select name=".$classe." required>";
    //         $result .= "<option selected disabled>choisissez</option>";
    //         foreach($tableau as $val){
    //             $i++;
    //             $result .= "<option value=". $i.">".$val[$value] ."</option>";
    //         }
    //         $result .= "</select>";
    //         return $result;
    //     }
    //     catch(PDOException $e){
    //     echo $e->getMessage();
    //     echo $requetePrepare;
    //     }
    // }
}
?>