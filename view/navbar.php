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
    <nav>
        <a href="index.php" id="links-home">
                <img src="https://projets.iut-orsay.fr/saes3-mmfoumb/mourchidi/pizza-4/media/pictures/5.png" id="img-logo">
        </a>
        <ul>
            <li><a href="index.php?objet=pizza" class="nav-links-products"> Pizzas</a></li>
            <li><a href="index.php?objet=boisson" class="nav-links-products"> Boissons</a></li>
            <li><a href="index.php?objet=dessert" class="nav-links-products"> Dessert</a></li>
        </ul>
        <ul>
            <li id="li-account">
                <a id="nav-icon" href="index.php?objet=<?=$userType?>">
                    <?=$user?><span class="bi bi-person-fill"></span>
                </a>
            </li>
            <?php if(!empty($user)): ?>
            <li id="li-account">
                <a class="link-account" href="index.php?objet=<?= $userType?>&action=disconnection">
                    <span class="bi bi-box-arrow-right"></span>
                </a>
            </li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main>