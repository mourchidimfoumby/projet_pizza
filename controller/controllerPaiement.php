<?php
require_once("model/carte_paiement");

class controllerPaiement extends ControllerObjet{

    protected static string $classe = "carte_paiement";

    public static function displayDefault(){
        require_once("view/head.php");
        require_once("view/navbar.php");
        require_once("view/formulaire_paiement.html");
        require_once("view/footer.php");
    }

    public static function verif_Carte(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $donnee_carte = array(
                'numeroCarte' => $_POST['numero_carte'],
                'cryptoCarte' => $_POST['crypto_carte']
            );
        }
        return carte_paiement::verif($donnee_carte);    
    }
    public static function insertCartePaiement(){

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $donnees = array(
                'nomTitulaire' => $_POST['nom_titulaire'],
                'numeroCarte' => $_POST['numero_carte'],
                'cryptoCarte' => $_POST['crypto_carte'],
                'dateExpiration' => $_POST['date_expiration']
            );  
        
        if(!self::verif_Carte()){
            carte_paiement::insertion($donnees);
        }

        echo "<h2>Paiement réussi</h2>";
        sleep(2);
        header("Location : index.php");
        }
    }
}  
?>
