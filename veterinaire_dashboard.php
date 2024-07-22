<?php
session_start();

if (!isset($_SESSION['role']) || $_SESSION['role'] != 'veterinaire') {
    header("Location: connexion.html");
    exit;
}

echo "Bienvenue, " . $_SESSION['prenom'] . " " . $_SESSION['nom'] . "! Vous êtes connecté en tant que veterinaire.";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de Bord Veterinaire</title>
</head>
<body>
    <h1>Tableau de Bord Vetrinaire</h1>
    <!-- Contenu spécifique pour le veterinaire -->
</body>
</html>

