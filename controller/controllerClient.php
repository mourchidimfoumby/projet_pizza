<?php
require_once("model/client.php");
require_once("controller/controllerObjet.php");

class controllerClient extends controllerObjet
{

    protected static string $classe = "client";
    protected static string $identifiant = "mail_client";


    protected static $champs = array(
        "login"          => ["text", "identifiant"],
        "mdp_client"     => ["password", "mot de passe"],
        "nom_client"    => ["text", "nom"],
        "prenom_client" => ["text", "prénom"],
        "mail_client"          => ["email", "email"],
        "telephone_client"      => ["text", "téléphone"]
    );
    //appele au formulaire
    public static function displayConnectionForm()
    {

        include("view/connexion.php");
    }

    public static function connect()
    {
        // Démarre la session
        session_start();

        // Récupère les identifiants depuis la méthode POST
        $login = isset($_POST["mail_client"]) ? $_POST["mail_client"] : '';
        $mdp_client = isset($_POST["mdp_client"]) ? $_POST["mdp_client"] : '';

        // Vérifie les identifiants avec la méthode checkMDP
        if (client::checkMDP($login, $mdp_client)) {
            // Enregistre le login dans la session
            $_SESSION["mail_client"] = $login;

            // Inclut les vues nécessaires à votre script principal
            include("view/navbar.html");
            include("view/footer.html");
        } else {
            // Affiche le formulaire de connexion en cas d'échec de vérification
            self::displayConnectionForm();
        }
    }


    public static function disconnect()
    {
        session_unset();
        session_destroy();
        setcookie(session_name(), '', time() - 1);
        self::displayConnectionForm();
    }
}
