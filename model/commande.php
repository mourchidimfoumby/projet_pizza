<?php

require_once("objet.php");
require_once("commande_boisson.php");
require_once("commande_dessert.php");
require_once("commande_pizza.php");
require_once("commande_pizza_personnalise.php");

const PIZZA = "pizza";
const BOISSON = "boisson";
const DESSERT = "dessert";
const PIZZA_PERSONALISE = "pizza_personnalise";
const COMMANDE_PIZZA = "commande_pizza";
const COMMANDE_BOISSON = "commande_boisson";
const COMMANDE_DESSERT = "commande_dessert";

class commande extends objet
{

    protected static string $identifiant = "id_commande";

    protected static string $classe = "commande";

    protected $id_commande;
    protected $montant_total;
    protected $date_heure_commande;
    protected $id_pizzaiolo;
    protected $id_client;
    protected $id_type_paiement;
    protected $id_caissier;
    protected $id_etat;
    protected $id_livreur;

    public function __construct(
        $id_commande = NULL,
        $montant_total = NULL,
        $date_heure_commande = NULL,
        $id_pizzaiolo = NULL,
        $id_client = NULL,
        $id_type_paiement = NULL,
        $id_caissier = NULL,
        $id_etat = NULL,
        $id_livreur = NULL
    ) {
        if (!is_null($id_commande)) {
            $this->id_commande = $id_commande;
            $this->date_heure_commande = $date_heure_commande;
            $this->montant_total = $montant_total;
            $this->id_pizzaiolo = $id_pizzaiolo;
            $this->$id_client = $id_client;
            $this->$id_type_paiement = $id_type_paiement;
            $this->$id_caissier = $id_caissier;
            $this->$id_etat = $id_etat;
            $this->$id_livreur = $id_livreur;
        }
    }

    public static function create($cart)
    {
        $commandePizza = array();
        $commandeBoisson = array();
        $commandeDessert = array();
        $commandePizzaPersonnalise = array();
        foreach ($cart as $product) {
            switch ($product["type"]) {
                case PIZZA:
                    $commandePizza[] = $product;
                    break;
                case BOISSON:
                    $commandeBoisson[] = $product;
                    break;
                case DESSERT:
                    $commandeDessert[] = $product;
                    break;
                case PIZZA_PERSONALISE:
                    $commandePizzaPersonnalise[] = $product;
                    break;
            }
        }
        $client = $_SESSION["client"][0];
        $idClient = $client->get("id_client");
        $idCommande = self::insertCommande($cart, $idClient);
        self::insertProduct($commandePizza, $idCommande, COMMANDE_PIZZA);
        self::insertProduct($commandeBoisson, $idCommande, COMMANDE_BOISSON);
        self::insertProduct($commandeDessert, $idCommande, COMMANDE_DESSERT);
        self::insertCommandePizzaPersonnalise($commandePizzaPersonnalise, $idCommande);
    }

    private static function insertCommande($cart, $idClient)
    {
        $dateTimeNow = new DateTime();
        $dateTimeNow = $dateTimeNow->setTimezone(new DateTimeZone('Europe/Paris'));
        $dateTimeNow = $dateTimeNow->format('Y-m-d H:i:s');
        $montantTotal = self::calculMontantTotal($cart);
        $idTypePaiement = 2;
        $donneesCommande = array(
            "montant_total" => $montantTotal,
            "date_heure_commande" => $dateTimeNow,
            "id_client" => $idClient,
            "id_type_paiement" => $idTypePaiement
        );
        parent::create($donneesCommande);
        return self::getIdCommande($montantTotal, $idClient);
    }
    private static function insertProduct($commandeProduct, $idCommande, $classe)
    {
        if (!empty($commandeProduct)) {
            usort($commandeProduct, array("commande", "compareId"));
            $type = $commandeProduct[0]["type"];
            $oldId = 0;
            foreach ($commandeProduct as $c) {
                if ($c["id"] != $oldId) {
                    $quantite = self::getQuantiteProduct($commandeProduct, $c["id"]);
                    $donneesCommandeProduct = array(
                        "id_$type" => $c["id"],
                        "id_commande" => $idCommande,
                        "quantite_$type" => $quantite
                    );
                    $classe::create($donneesCommandeProduct);
                }
                $oldId = $c["id"];
            }
        }
    }
    public static function insertCommandePizzaPersonnalise($commandePizzaPersonnalise, $idCommande)
    {
        if (!empty($commandePizzaPersonnalise)) {
            $classe = static::$classe;
            usort($commandePizzaPersonnalise, array($classe, "compareId"));
            $oldId = 0;
            foreach ($commandePizzaPersonnalise as $c) {
                $currentId = $c["id"];
                if ($currentId != $oldId) {
                    $quantite = self::getQuantiteProduct($commandePizzaPersonnalise, $c["id"]);
                    $ingredientsAdded = $c["ingredientsAdded"];
                    $ingredientsRemoved = $c["ingredientsRemoved"];
                    $oldId = $c["id"];
                    foreach ($ingredientsAdded as $id => $nom) {
                        $donneesCommandePizzaPersonnalise = array(
                            "id_pizza" => $c["id"],
                            "id_ingredient" => $id,
                            "id_commande" => $idCommande,
                            "id_type_personnalisation" => 1,
                            "quantite_pizza_personnalise" => $quantite,
                        );
                        commande_pizza_personnalise::create($donneesCommandePizzaPersonnalise);
                    }
                    foreach ($ingredientsRemoved as $id => $nom) {
                        $donneesCommandePizzaPersonnalise = array(
                            "id_pizza" => $c["id"],
                            "id_ingredient" => $id,
                            "id_commande" => $idCommande,
                            "id_type_personnalisation" => 2,
                            "quantite_pizza_personnalise" => $quantite,
                        );
                        commande_pizza_personnalise::create($donneesCommandePizzaPersonnalise);
                    }
                }
                $oldId = $currentId;
            }
        }
    }
    private static function compareId($product1, $product2)
    {
        return $product1["id"] - $product2["id"];
    }
    private static function getIdCommande($montantTotal, $idClient)
    {
        $identifiant = static::$identifiant;
        $classe = static::$classe;
        $requestIdCommande =
            "SELECT MAX($identifiant) 
        FROM $classe 
        WHERE id_client = $idClient 
        AND montant_total = $montantTotal";
        $resultatIdCommande = connexion::pdo()->query($requestIdCommande);
        $idCommande = $resultatIdCommande->fetchColumn();
        return $idCommande;
    }

    private static function getQuantiteProduct($listProduct, $idProduct)
    {
        $quantite = 0;
        foreach ($listProduct as $l) {
            if ($l["id"] == $idProduct) $quantite++;
        }
        return $quantite;
    }
    private static function calculMontantTotal($cart)
    {
        $montantTotal = 0;
        foreach ($cart as $c) {
            $montantTotal += $c["price"];
        }
        return $montantTotal;
    }
    public function __toString(): string
    {
        return $this->date_heure_commande;
    }
}
