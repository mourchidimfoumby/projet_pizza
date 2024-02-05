<?php
require_once("model/gestionnaire.php");
require_once("controller/controllerObjet.php");

class controllerGestionnaire extends controllerObjet
{

    protected static string $classe = "gestionnaire";
    protected static string $identifiant = "id_gestionnaire";

    public static function displayDefault()
    {
        $classe = static::$classe;
        if(isset($_SESSION["gestionnaire"])) {
            $title = "Page $classe";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/home_gestionnaire.php");
            require_once("view/footer.html");
        }
        else {
            $title = "Connexion $classe";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/gestionnaire_connection_form.php");
            require_once("view/footer.html");
        }
    }

    public static function connection()
    {
        $classe = static::$classe;

        $login = $_POST["mail_gestionnaire"] ?? '';
        $mdp_gestionnaire = $_POST["mdp_gestionnaire"] ?? '';

        $gestionnaire = $classe::connection($login, $mdp_gestionnaire);

        if (isset($gestionnaire)) {
            $_SESSION["gestionnaire"] = $gestionnaire;
            header("Location: index.php?objet=gestionnaire");
            exit();
        } 
        else {
            $authenticationError = true;
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/gestionnaire_connection_form.php");
            require_once("view/footer.html");
        }
    }

    public static function disconnection()
    {
        unset($_SESSION["gestionnaire"]);
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
}