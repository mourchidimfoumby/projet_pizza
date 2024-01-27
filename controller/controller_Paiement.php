<?php
require_once("model/carte_paiement");
class controllerPaiement{

    public static function verif_Carte(){
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $donnee_carte = array(
                'numeroCarte' => $_POST['numero_carte'],
                'cryptoCarte' => $_POST['crypto_carte']
            );
        }
        carte_paiement::verif($donnee_carte);
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

        echo "<script>window.location.href = 'index.php';</script>";
        }
    }
}




   
?>
