<?php 
$client = $_SESSION["client"][0];
$nbCaractereMdp = strlen($client->get("mdp_client"));
$mdpChiffre = str_repeat("*", $nbCaractereMdp);
$reduClient = $user->get("reduction_client");
$mailClient = $user->get("mail_client");
$adresseClient = $user->get("adresse_client");
$telClient = $user->get("telephone_client");
?>
<section class="section-client-page">
    <div class="head-client-page">
        <div>
            <span class="bi bi-person-fill"></span>
            <h2><?= $user ?></h2>
        </div>
        <h3> Reduction de commande : <?= $reduClient?></h3>
    </div>
    <div class="body-client-page">
        <ul>
            <li>Adresse email : <?= $mailClient ?></li>
            <li>Mot de passe : <?= $mdpChiffre ?></li>
        </ul>
        <ul>
            <li>Adresse : <?= $adresseClient ?></li>
            <li>Numéro de téléphone : <?= $telClient ?></li>
        </ul>
    </div>
</section>