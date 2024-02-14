<section class="gestionnaire-home-section">
    <?php
    if(!empty($alertes)){
        $nbAlertes = count($alertes);
        echo '<a id="gestionnaire-home-link-alerte" href="index.php?objet=alerte">Attention, il y a '.$nbAlertes.' stock à réapprovisionner !<span class="bi bi-exclamation-triangle-fill"></span></a>';
    }
?>
    <div>
        <a id="links-pizza-stock" href="index.php?objet=pizza&action=displayStock">Pizza</a>
        <a id="links-stock" href="index.php?objet=stock">Stock</a>
        <a id="links-statistiques" href="index.php?objet=statistiques">Statistiques</a>
    </div>
</section>
