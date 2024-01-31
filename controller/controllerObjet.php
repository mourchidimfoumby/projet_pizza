<?php

abstract class controllerObjet{
    protected static string $classe;
    protected static string $identifiant;
    protected static array $champs;
    // protected static array $tableauSelect;

    public static function displayDefault(){
        $classe = static::$classe;
        $title = ucfirst($classe);
        $objects = $classe::getAll();
        require_once("view/head.php");
        require_once("view/popup_edit_command.php");
        require_once("view/navbar.php");
        require_once("view/products.php");
        require_once("view/cart.php");
        require_once("view/footer.html");
    }

    public static function update(){
        $classe = static::$classe;
        $donnees = array();
        $POST = array_diff_key($_POST, array("action" => ""));
        foreach($POST as $name => $value){
            $donnees[$name] = $value;
        }
        $idRecuperee = $_GET[static::$identifiant];
        $classe::update($donnees, $idRecuperee);
        header("Location: index.php?objet=$classe");
        exit();
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
    //     require_once("view/debut.php");
    //     require_once("view/menu.html");
    //     $tableau = $classeRecuperee::getOne($idRecuperee);
    //     require_once("view/details.php");
    //     require_once("view/fin.php");
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
    //     require_once("view/debut.php");
    //     require_once("view/menu.html");
    //     require_once("view/formulaireCreation.php");
    //     require_once("view/fin.php");
    // }

    public static function create(){
        $classe = static::$classe;
        $donnees = array();
        $POST = array_diff_key($_POST, array("action"));
        foreach($POST as $key => $element){
            $donnees[$key] = $element;
        }
        $classe::create($donnees);
        if($classe == "pizza"){
            header("location: index.php?objet=$classe&action=stockPizza");
        }else{
            header("location: index.php?objet=$classe");
        }
        
    }

}

?>