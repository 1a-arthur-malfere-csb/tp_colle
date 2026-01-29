<?php

function connexionPDO()
{
    $login = "userrestofr";
    $mdp = "m0n_suPR_mdp_CQriZe";
    $bd = "restofr";
    $serveur = "127.0.0.1";

    $dsn = "mysql:host=$serveur;dbname=$bd;charset=utf8mb4";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    try {
        $conn = new PDO($dsn, $login, $mdp, $options);
        return $conn;
    } catch (PDOException $e) {
        header("Content-Type: text/plain");

        echo "Erreur de connexion PDO: " . $e->getMessage() . "\n";

        $sqlState = $e->getCode();
        if (!empty($sqlState)) {
            echo "SQLSTATE/Code: " . $sqlState . "\n";
        }

        echo "DSN: " . $dsn . "\n";
        echo "Utilisateur: " . $login . "\n";
        echo "Hôte: " . $serveur . "\n";
        echo "Base: " . $bd . "\n";
        die();
    }
}

if ($_SERVER["SCRIPT_FILENAME"] == __FILE__) {
    header("Content-Type: text/plain");

    echo "Test de connexionPDO()...\n";
    $cnx = connexionPDO();
    if ($cnx instanceof PDO) {
        echo "OK: Connexion établie.\n";
        $stmt = $cnx->query("SELECT VERSION() AS version");
        $info = $stmt ? $stmt->fetch() : null;
        if ($info && isset($info["version"])) {
            echo "Version serveur: " . $info["version"] . "\n";
        }
    }
}
?>
