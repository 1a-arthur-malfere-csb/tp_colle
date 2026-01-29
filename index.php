<?php
require_once "getRacine.php";
require_once "$racine/controleur/controleurPrincipal.php";
require_once "$racine/modele/authentification.inc.php"; // pour pouvoir utiliser isLoggedOn()

if (isset($_GET["action"])) {
    $action = $_GET["action"];
} else {
    $action = "defaut";
}

$fichier = controleurPrincipal($action);
require_once "$racine/controleur/$fichier";
?>
