<?php
    if(isset($_SESSION["client"])) $user = $_SESSION["client"][0];
    else $user = $_SESSION["gestionnaire"][0];
?>
<section class="account-section">
    <div></div>
    <h2> Salut <?= $user ?> </h2>
</section>