<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}
include_once "$racine/modele/bd.utilisateur.inc.php";
include_once "$racine/modele/authentification.inc.php";

// Récupération des données GET, POST, et SESSION
$erreur = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données reçues
    $mailU = isset($_POST["mailU"]) ? trim($_POST["mailU"]) : "";
    $pseudoU = isset($_POST["pseudoU"]) ? trim($_POST["pseudoU"]) : "";
    $mdpU = isset($_POST["mdpU"]) ? $_POST["mdpU"] : "";
    $mdpU2 = isset($_POST["mdpU2"]) ? $_POST["mdpU2"] : "";
    $acceptCGU = isset($_POST["acceptCGU"]) ? true : false;

    // Validation côté serveur
    if (empty($mailU) || empty($pseudoU) || empty($mdpU) || empty($mdpU2)) {
        $erreur = "Tous les champs sont obligatoires.";
    } elseif (!filter_var($mailU, FILTER_VALIDATE_EMAIL)) {
        $erreur = "L'adresse email n'est pas valide.";
    } elseif (strlen($mdpU) < 8) {
        $erreur = "Le mot de passe doit contenir au moins 8 caractères.";
    } elseif (!preg_match("/[0-9]/", $mdpU)) {
        $erreur = "Le mot de passe doit contenir au moins un chiffre.";
    } elseif (!preg_match('/[!@#$%^&*(),.?":{}|<>_\-+=\[\]\\\/]/', $mdpU)) {
        $erreur =
            "Le mot de passe doit contenir au moins un symbole spécial (!@#$%^&*(),.?\":{}|<>_-+=[]\\/).";
    } elseif ($mdpU !== $mdpU2) {
        $erreur = "Les mots de passe ne correspondent pas.";
    } elseif (!$acceptCGU) {
        $erreur = "Vous devez accepter les Conditions Générales d'Utilisation.";
    } else {
        // Vérifier si l'email existe déjà
        $utilisateurExistant = getUtilisateurByMailU($mailU);

        if ($utilisateurExistant) {
            $erreur = "Un compte existe déjà avec cette adresse email.";
        } else {
            // Créer l'utilisateur
            $resultat = addUtilisateur($mailU, $mdpU, $pseudoU);

            if ($resultat) {
                $success =
                    "Votre compte a été créé avec succès ! Vous pouvez maintenant vous connecter.";
                login($mailU, $mdpU);
                header("refresh:2;url=./?action=profil");
            } else {
                $erreur =
                    "Une erreur est survenue lors de la création de votre compte. Veuillez réessayer.";
            }
        }
    }
}

// Appel du script de vue qui permet de gérer l'affichage des données
$titre = "Inscription";
include "$racine/vue/entete.html.php";
include "$racine/vue/vueInscription.php";
include "$racine/vue/pied.html.php";
?>
