<?php

include("config.php");

class connexion{
    //L'attribut static qui materialisera la connexion
    static private $pdo;

    //le getter public de cet attrbut
    static public function pdo(){
        return self::$pdo;
    }

    //La fonction static de connexion qui initialise $pdo et lance
    //la tentative de connexion PDO = PHP Data Object = une classe native
    //adaptée à la connexion
    static public function connect(){
        try{
            self::$pdo = new PDO(
                "mysql:host=".HOSTNAME.";dbname=".DATABASE,
                LOGIN,
                PASSWORD,
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e){
            echo "erreur de connexion : ".$e->getMessage()."<br>";
        }
    }
}
?>