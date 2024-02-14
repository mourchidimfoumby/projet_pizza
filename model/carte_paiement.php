<?php

require_once("objet.php");

class carte_paiement extends objet{
    protected static string $classe = "carte_paiement";
  protected static string $identifiant = "numero_carte";
    //attributs
    protected $id_carte;
    protected $titulaire_carte;
    protected $numero_carte;
    protected $cryptogramme;
    protected $date_expiration;
    protected $id_client;

    // constructeur
    function __construct
    (
        $id_carte=null,
        $titulaire_carte=null,
        $numero_carte=null, 
        $cryptogramme=null, 
        $date_expiration=null, 
        $id_client=null
    ){
        if(!is_null($id_carte)){
            $this->id_carte = $id_carte;
            $this->titulaire_carte= $titulaire_carte;
            $this->numero_carte= $numero_carte;
            $this->cryptogramme= $cryptogramme;
            $this->date_expiration= $date_expiration;
            $this->id_client= $id_client;
        }
    }

    //vérif carte
    public static function verif($donnee_carte){
        $num_carte = $donnee_carte['numeroCarte'];
        $crypto =  $donnee_carte['cryptoCarte'];

        $requeteVerif = "SELECT COUNT(*) FROM carte_paiement WHERE numero_carte = $num_carte AND cryptogramme = $crypto";
        $resultat = connexion::pdo()->prepare($requeteVerif); 
        try{
        $resultat->execute();

         // Récupération du résultat
         $nombreCartes = $resultat->fetchColumn();

         // Si le résultat est supérieur à 0, alors la carte existe déjà
         return $nombreCartes > 0;
        }catch(PDOException $e){
            echo $e->getMessage();
            echo $requeteVerif;
        }

    }
}

?>