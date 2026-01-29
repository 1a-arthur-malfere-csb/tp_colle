<?php
if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    $racine = "..";
}

$titre = "CGU";

include "$racine/vue/entete.html.php";
include "$racine/vue/vueCgu.php";
include "$racine/vue/pied.html.php";
?>
