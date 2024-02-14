<?php
require_once("objet.php");
class client
{

  protected static string $classe = "client";
  protected static string $identifiant = "id_client";

  // tableau pour construre le <select> : 
  // 1. la valeur de l'attribut name
  // 2. le(s) champ()s à afficher dans le visuel
  //protected static $tableauSelect = array("emprunteur", "login");

  protected $id_client;
  protected $nom_client;
  protected $prenom_client;
  protected $mail_client;
  protected $mdp_client;
  protected $numero_telephone;
  protected $adresse_client;
  protected $reduction_client;


  public function __construct(
    $id_client = null,
    $mdp_client = null,
    $nom_client = null,
    $prenom_client = null,
    $mail_client = null,
    $numero_telephone = null,
    $adresse_client = null,
    $reduction_client = null
    ){
    if (!is_null($id_client)) {
      $this->id_client = $id_client;
      $this->mdp_client = $mdp_client;
      $this->prenom_client = $prenom_client;
      $this->nom_client = $nom_client;
      $this->mail_client = $mail_client;
      $this->numero_telephone = $numero_telephone;
      $this->adresse_client = $adresse_client;
      $this->reduction_client = $reduction_client;
    }
  }

  public function __toString(): string
  {

    $nom = $this->nom_client;
    $prenom = $this->prenom_client;
    return "$prenom $nom";
  }

  public function get($variable){
    return $this->$variable;
  }

  public static function connection($login, $mdp)
  {
    // écriture de la requête
    $requetePreparee = "SELECT * FROM client WHERE mail_client = :mail AND mdp_client = :mdp;";
    // envoi de la requête et stockage de la réponse dans une variable $resultat
    $resultat = connexion::pdo()->prepare($requetePreparee);
    // on crée le tableau contenant le tag et sa valeur
    $tags = array("mail" => $login, "mdp" => $mdp);
    try {
      // on exécute la requête préparée
      $resultat->execute($tags);
      // on interprète le résultat selon la classe récupérée
      $resultat->setFetchmode(PDO::FETCH_CLASS, self::$classe);
      // on récupère le tableau
      $client = $resultat->fetchAll();
      // on retourne lefait que $tableau soit oui ou non de taille 1
      if(!empty($client)) return $client;
      else return null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }
}