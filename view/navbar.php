<?php
    $userType = "client";
    $user = "";
    if(isset($_SESSION["gestionnaire"][0])){
        $userType = "gestionnaire";
        $user = $_SESSION["gestionnaire"][0];
    }
    else if(isset($_SESSION["client"][0])){
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
            <li id="li-account">
                <a id="nav-icon" href="index.php?objet=<?=$userType?>">
                    <?=$user?><span class="bi bi-person-fill"></span>
                </a>
            <?php if(!empty($user)): ?>
                <ul id="sub-menu-account">
                    <li>
                        <a class="link-account" href="index.php?objet=<?= $userType?>&action=disconnection">
                            <span class="bi bi-box-arrow-right"></span>Se déconnecter
                        </a>
                    </li>
                </ul>
            <?php endif; ?>
            </li>
        </ul>
    </nav>
</header>
<main>