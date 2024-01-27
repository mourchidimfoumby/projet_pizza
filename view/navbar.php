<?php

    $userType = "client";
    $user = "Se connecter";
    if(isset($_SESSION["gestionnaire"])){
        $userType = "gestionnaire";
        $user = $_SESSION["gestionnaire"][0];
    }
    else if(isset($_SESSION["client"])){
        $user = $_SESSION["client"][0];
    }
?>
<div class="app-container">
<header>
    <div id="top-header">
        <img src="https://projets.iut-orsay.fr/saes3-mmfoumb/mourchidi/pizza-4/media/pictures/5.png" id="img-logo">
        <h1> Pizza Hub</h1>
    </div>
    <nav>
        <ul>
            <li><a href="index.php"> Accueil</a></li>
            <li><a href="index.php?objet=pizza"> Pizzas</a></li>
            <li><a href="index.php?objet=boisson"> Boissons</a></li>
            <li><a href="index.php?objet=dessert"> Dessert</a></li>
        </ul>
        <ul>
            <li><a href="index.php?objet=<?=$userType ?>"><?=$user?></a></li>
        </ul>
        <button id="btn"> CLEAR SESSION</button>
    </nav>
</header>
<main>