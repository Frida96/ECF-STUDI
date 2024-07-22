<?php
session_start();
include 'config.php'; // fichier contenant les informations de connexion à la base de données

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Connexion à la base de données
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Vérification des informations de connexion
    $sql = "SELECT id, nom, prénom, email, password, rôle FROM users WHERE email=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->store_result();
    $stmt->bind_result($id, $nom, $prenom, $db_email, $db_password, $role);

    if ($stmt->num_rows == 1 && $stmt->fetch()) {
        if (password_verify($password, $db_password)) {
            $_SESSION['email'] = $db_email;
            $_SESSION['role'] = $role;
            $_SESSION['nom'] = $nom;
            $_SESSION['prenom'] = $prenom;

            // Redirection en fonction du rôle
            if ($role == 'administrateur') {
                header("Location: admin_dashboard.php");
            } elseif ($role == 'employe') {
                header("Location: employe_dashboard.php");
            } elseif ($role == 'veterinaire') {
                header("Location: veterinaire_dashboard.php");
            }
        } else {
            echo "Email ou mot de passe incorrect.";
        }
    } else {
        echo "Email ou mot de passe incorrect.";
    }

    $stmt->close();
    $conn->close();
}
?>

