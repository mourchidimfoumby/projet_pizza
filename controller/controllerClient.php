<?php
require_once("model/client.php");
require_once("controller/controllerObjet.php");

class controllerClient extends controllerObjet
{
    protected static string $classe = "client";
    protected static string $identifiant = "id_client";

    //appele au formulaire
    public static function displayDefault()
    {
        $classe = static::$classe;
        if (isset($_SESSION["client"])) {
            $title = "Page $classe";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/compte_client.php");
            require_once("view/footer.html");
        } else {
            $title = "Connexion $classe";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/client_connection_form.php");
            require_once("view/footer.html");
        }
    }

    public static function connection()
    {
        $authenticationError = false;
        $classe = static::$classe;
        $login = $_POST["mail_client"] ?? '';
        $mdp_client = $_POST["mdp_client"] ?? '';

        $client = $classe::connection($login, $mdp_client);
        if (isset($client)) {
            $_SESSION["client"] = $client;
            header("Location: index.php?objet=paiement");
            exit();
        } else {
            $authenticationError = true;
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/client_connection_form.php");
            require_once("view/footer.html");
        }
    }

    public static function disconnection()
    {
        unset($_SESSION["client"]);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}