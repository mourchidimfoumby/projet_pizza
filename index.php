<?php
require_once("model/client.php");
require_once("model/gestionnaire.php");
session_start();
print_r($_SESSION);
require_once("controller/router.php");
?>