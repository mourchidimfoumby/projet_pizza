<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" type="text/css" href="css/formulaire.css">

</head>

<body>

    <main>
        <form action="index.php" method="post">
            <input type="hidden" name="objet" value="client">
            <input type="hidden" name="action" value="connect">
            <div>
                <label for="email">E-mail</label>
                <input type="text" name="email" placeholder="Enter e-mail" required>
            </div>
            <div>
                <label for="mdp">Password</label>
                <input type="password" name="mdp" placeholder=" Enter password" required>
            </div>
            <button type="submit">Connect</button>
        </form>
        <p>Pour les gestionnaires de la pizzeria, <a href="manager_login.html">cliquez ici</a> pour vous connecter.</p>

    </main>
</body>

</html>