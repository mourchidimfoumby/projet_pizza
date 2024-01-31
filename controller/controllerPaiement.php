<?php
require_once("controller/controllerObjet.php");
require_once("model/carte_paiement.php");

class controllerPaiement extends controllerObjet{

    protected static string $classe = "carte_paiement";

    public static function displayDefault(){
        require_once("view/head.php");
        require_once("view/navbar.html");
        require_once("view/formulaire_paiement.html");
        require_once("view/footer.html");
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
        
            $donnees = array(
                'titulaire_carte' => $_POST['nom_titulaire'],
                'numero_carte' => $_POST['numero_carte'],
                'cryptogramme' => $_POST['crypto_carte'],
                'date_expiration' => $_POST['date_expiration'],
                'id_client' => 1
            );
        
        if(!self::verif_Carte()){
            carte_paiement::insertion($donnees);
           
        }
        echo "<h2>Paiement réussi</h2>";
        sleep(2);
        header("Location: index.php");
        }
    }
 
?>
