<?php

class statistiques {
    public static function getCommand_Day(){
        $requete = "SELECT * FROM StatCommand_Day";
        $resultat = connexion::pdo()->prepare($requete);
        try{
            $resultat->execute();
            $result = $resultat->fetchAll(pdo::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getCommand_Month(){
        $requete = "SELECT * FROM StatCommand_Month";
        $resultat = connexion::pdo()->prepare($requete);
        try{
            $resultat->execute();
            $result = $resultat->fetchAll(pdo::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }

    public static function getCommand_Year(){
        $requete = "SELECT * FROM StatCommand_Year";
        $resultat = connexion::pdo()->prepare($requete);
        try{
            $resultat->execute();
            $result = $resultat->fetchAll(pdo::FETCH_ASSOC);
            return $result;
        }catch(PDOException $e){
            echo $e->getMessage();
        }
    }
}
