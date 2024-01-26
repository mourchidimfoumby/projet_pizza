<?php
require_once("objet.php");
class adherent extends objet
{

  protected static string $classe = "client";
  protected static string $identifiant = "login";

  // tableau pour construre le <select> : 
  // 1. la valeur de l'attribut name
  // 2. le(s) champ()s à afficher dans le visuel
  //protected static $tableauSelect = array("emprunteur", "login");

  protected string $id_client;
  protected string $mdp_client;
  protected string $nom_client;
  protected string $prenom_client;
  protected string $mail_client;
  protected string $telephone_client;


  public function __construct(string $id_client = null, string $mdp_client = null, string $nom_client = null, string $prenom_client = null, string $mail_client = null, string $telephone_client = null)
  {
    if (!is_null($id_client)) {
      $this->id_client = $id_client;
      $this->mdp_client = $mdp_client;
      $this->prenom_client = $prenom_client;
      $this->nom_client = $nom_client;
      $this->mail_client = $mail_client;
      $this->telephone_client = $telephone_client;
    }
  }

  public function __toString(): string
  {

    $n = $this->nom_client;
    $p = $this->prenom_client;
    return "$p ' ' $n";
  }





  public static function checkMDP($l, $m)
  {
    // écriture de la requête
    $requetePreparee = "SELECT * FROM client WHERE mail_client = :mail_client AND mdp = :mdp_client;";
    // envoi de la requête et stockage de la réponse dans une variable $resultat
    $resultat = connexion::pdo()->prepare($requetePreparee);
    // on crée le tableau contenant le tag et sa valeur
    $tags = array("mail_client" => $l, "mdp" => $m);
    try {
      // on exécute la requête préparée
      $resultat->execute($tags);
      // on interprète le résultat selon la classe récupérée
      $resultat->setFetchmode(PDO::FETCH_CLASS, "client");
      // on récupère le tableau
      $tableau = $resultat->fetchAll();
      // on retourne lefait que $tableau soit oui ou non de taille 1
      return sizeof($tableau) == 1;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}
