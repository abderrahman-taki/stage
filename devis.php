<?php
session_start();
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');
define('SITEURL', 'http://localhost/php.account/');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

if (isset($_GET['id'])) {
    $projet_id = $_GET['id'];

    // Récupérer les informations du projet depuis la base de données
    $sql = "SELECT * FROM pojets WHERE id = $projet_id";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    // Vérifier si le projet existe
    if ($row) {
        echo '<h2>Détails du projet : ' . $row['nom'] . '</h2>';
        
        // Bouton Devis
        echo '<button class="devis-button"><a href="devis_tableau.php?id=' . $row['id'] . '">Devis</a></button>';
        
        // Bouton Créer un nouveau devis
        echo '<button class="nouveau-devis-button"><a href="nouveau_devis.php?id=' . $row['id'] . '">Créer un nouveau devis</a></button>';
    } else {
        echo 'Le projet spécifié n\'existe pas.';
    }
} else {
    echo 'ID du projet non spécifié.';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="devis.css">
</head>
<body>
    <div class="dashboard">
        <div class="dash">
            
        </div>
    </div>
</body>            
</html>