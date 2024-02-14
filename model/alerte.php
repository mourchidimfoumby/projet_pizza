<?php

require_once("objet.php");

class alerte extends objet
{
    protected static string $identifiant = "id_alerte";

    protected static string $classe = "alerte";
    
    protected $id_alerte;
    protected $message_alerte;
    protected $date_alerte;
    protected $id_stock;
    

    public function __construct(
        $id_alerte = NULL,
        $message_alerte = NULL,
        $date_alerte = NULL,
        $id_stock = NULL,
        
    ) {
        if (!is_null($id_alerte)) {
            $this->id_alerte = $id_alerte;
            $this->message_alerte = $message_alerte;
            $this->date_alerte = $date_alerte;
            $this->id_stock = $id_stock;
           
        }
    }

    public function __toString(): string{
        return strval($this->message_alerte);
    }

    public static function getAll($condition = null){
        $requete = "";
        $requete .= "SELECT message_alerte, date_alerte, nom_stock FROM alerte ";
        $requete .= "NATURAL JOIN stock;";
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
