<?php
require_once("controller/controllerObjet.php");
require_once("controller/controllerCommande.php");
require_once("model/carte_paiement.php");

class controllerPaiement extends controllerObjet{

    protected static string $classe = "carte_paiement";
 
    public static function displayDefault(){
        if(isset($_SESSION["client"])) {
            $title = "Paiement";
            require_once("view/head.php");
            require_once("view/navbar.php");
            require_once("view/formulaire_paiement.html");
            require_once("view/footer.html");
        }  
        else{
            header('Location: index.php?objet=client');
            exit();
        }
    }

    public static function verif_Carte(){
        $classe = static::$classe;
        $donnee_carte = array(
            'numeroCarte' => $_POST['numero_carte'],
            'cryptoCarte' => $_POST['crypto_carte']
        );
        return $classe::verif($donnee_carte);    
    }
    public static function insertCartePaiement(){
        $classe = static::$classe;
        $donnees = array(
            'titulaire_carte' => $_POST['nom_titulaire'],
            'numero_carte' => $_POST['numero_carte'],
            'cryptogramme' => $_POST['crypto_carte'],
            'date_expiration' => $_POST['date_expiration'],
            'id_client' => 1
        );
        
        if(!self::verif_Carte()){
            $classe::create($donnees);
        }
        require_once("view/head.php");
        require_once("view/payment-approve.html");
        controllerCommande::create();
        unset($_SESSION["cart"]);
        echo "<script>
            setTimeout(function() {
                window.location.href = 'index.php';
            }, 3000);
        </script>";
        echo "</body>";
    }

}
 
?>