<section class="form-section">
    <form class="authentication-form" autocomplete="off" method="post">
        <input type="hidden" name="action" value="connection">
        
        <h2>Connexion Gestionnaire</h2>
        <div>
            <label for="email">Adresse mail:</label>
            <input type="text" id="manager_username" name="mail_gestionnaire" placeholder="Entrer adresse mail" required>
        </div>
        <div>
            <label for="manager_password">Mot de passe:</label>
            <input type="password" id="manager_password" name="mdp_gestionnaire" placeholder="Entrer mot de passe" required>
        </div>
        <?php 
            if(
                isset($authenticationError) &&
                $authenticationError
            ) echo '<p style="color: red;"> Adresse mail ou mot de passe incorrect</p>'
        ?>
        <button type="submit">Se connecter</button>
     </form>
</section>