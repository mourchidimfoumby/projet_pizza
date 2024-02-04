<section class="form-section">
    <form class="authentication-form" method="post">
        <input type="hidden" name="action" value="connection">
        <div>
            <label for="email">Adresse mail</label>
            <input type="text" name="mail_client" placeholder="Entrer adresse mail" required>
        </div>
        <div>
            <label for="mdp">Mot de passe</label>
            <input type="password" name="mdp_client" placeholder="Entrer mot de passe" required>
        </div>
        <?php 
            if(
                isset($authenticationError) &&
                $authenticationError
            ) echo '<p style="color: red;"> Adresse mail ou mot de passe incorrect</p>'
        ?>
        <button type="submit">Se connecter</button>
    </form>
    <p>Pour les gestionnaires de la pizzeria,
        <a href="index.php?objet=gestionnaire" id="link_gestionnaire"> cliquez ici</a> pour vous connecter.
    </p>
</section>