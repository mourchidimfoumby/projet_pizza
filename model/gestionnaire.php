<?php
require_once("objet.php");
class gestionnaire
{

  protected static string $classe = "gestionnaire";
  protected static string $identifiant = "id_gestionnaire";

  protected $id_gestionnaire;
  protected $nom_gestionnaire;
  protected $prenom_gestionnaire;
  protected $mail_gestionnaire;
  protected $mdp_gestionnaire;

  public function __construct(
    $id_gestionnaire = null,
    $mdp_gestionnaire = null,
    $nom_gestionnaire = null,
    $prenom_gestionnaire = null,
    $mail_gestionnaire = null,
    ){
    if (!is_null($id_gestionnaire)) {
      $this->id_gestionnaire = $id_gestionnaire;
      $this->mdp_gestionnaire = $mdp_gestionnaire;
      $this->prenom_gestionnaire = $prenom_gestionnaire;
      $this->nom_gestionnaire = $nom_gestionnaire;
      $this->mail_gestionnaire = $mail_gestionnaire;
    }
  }

  public function __toString(): string
  {
    $nom = $this->nom_gestionnaire;
    $prenom = $this->prenom_gestionnaire;
    return "$prenom $nom";
  }
  public function __get($variable){
    return $this->$variable;
  }
  public static function connection($login, $mdp)
  {
    // écriture de la requête
    $requetePreparee = "SELECT * FROM gestionnaire WHERE mail_gestionnaire = :mail AND mdp_gestionnaire = :mdp;";
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
      $gestionnaire = $resultat->fetchAll();
      // on retourne lefait que $tableau soit oui ou non de taille 1
      if(!empty($gestionnaire)) return $gestionnaire;
      else return null;
    } catch (PDOException $e) {
      echo $e->getMessage();
      return null;
    }
  }
}