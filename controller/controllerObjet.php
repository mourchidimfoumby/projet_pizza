<?php

class ControllerObjet{
    protected static string $classe;
    protected static string $identifiant;
    // protected static array $champs;
    // protected static array $tableauSelect;

    public static function displayAll(){
        $classe = static::$classe;
        $title = ucfirst($classe);
        $objects = $classe::getAll();
        include("view/head.php");
        include("view/navbar.html");
        include("view/products.php");
        include("view/cart.php");
        include("view/footer.html");
    }
    

    // public static function displayOne(){
    //     $classeRecuperee = static::$classe;
    //     $tablesFem = array(
    //         "serie",
    //         "bd",
    //         "categorie",
    //         "nationalite"
    //     );
    //     if(in_array($classeRecuperee, $tablesFem)){
    //         $title = "une $classeRecuperee";
    //     }
    //     else{
    //         $title = "un $classeRecuperee";
    //     }
    //     $idRecuperee = $_GET[static::$identifiant];
    //     include("view/debut.php");
    //     include("view/menu.html");
    //     $tableau = $classeRecuperee::getOne($idRecuperee);
    //     include("view/details.php");
    //     include("view/fin.php");
    // }

    // public static function delete(){
    //     $classeRecuperee = static::$classe;
    //     $idRecuperee = $_GET[static::$identifiant];
    //     $classeRecuperee::delete($idRecuperee);
    //     self::displayAll();
    // }

    // public static function displayCreationForm(){
    //     $champs = static::$champs;
    //     $classe = static::$classe;
    //     $identifiant = static::$identifiant;
    //     $title = "création $classe";
    //     include("view/debut.php");
    //     include("view/menu.html");
    //     include("view/formulaireCreation.php");
    //     include("view/fin.php");
    // }

    // public static function create(){
    //     $champs = static::$champs;
    //     $classe = static::$classe;
    //     $donnees = array();
    //     $GET = array_diff_key($_GET, array("objet" => "", "action" => ""));
    //     foreach($GET as $key => $element){
    //         $donnees[$key] = $element;
    //     }
    //     $classe::create($donnees);
    //     self::displayAll();
    // }

}

?>