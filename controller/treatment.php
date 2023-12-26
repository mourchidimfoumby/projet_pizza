<?php
// Vérifie si l'action est définie dans la requête
if (isset($_POST['action'])) {
    // Récupère l'action à effectuer depuis la requête
    $action = $_POST['action'];

    // Exécute la fonction appropriée en fonction de l'action
    switch ($action) {
        case 'getObjet':
            fonction1();
            break;
        default:
            $response = array('error' => 'Action non reconnue.');
            echo json_encode($response);
            break;
    }
} else {
    // Aucune action spécifiée
    echo "Aucune action spécifiée.";
}

// Exemple de fonction1
function fonction1() {
    $response = array("response" => "Salut ça va");
    echo json_encode($response);
}
?>
