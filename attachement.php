<?php
session_start();
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');
define('SITEURL', 'http://localhost/php.account/');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

// Vérifiez si l'ID du projet est passé dans l'URL
if (isset($_GET['id'])) {
    $projet_id = $_GET['id'];

    // Récupérer les détails du projet à partir de la base de données
    $sql = "SELECT * FROM pojets WHERE id = $projet_id";
    $result = mysqli_query($conn, $sql);

    // Vérifier si le projet existe
    if (mysqli_num_rows($result) > 0) {
        $projet = mysqli_fetch_assoc($result);
    } else {
        echo 'Projet introuvable.';
        exit();
    }
} else {
    echo 'ID de projet non spécifié.';
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="attachement.css">
</head>
<body>
    <div class="project-details">
        <h4><?php echo $projet['nom']; ?></h4>
        <div class="buttons">
            <button class="attachement-button"><a href="afficher_attachement.php?id=<?php echo $projet['id']; ?>">Attachement</a></button>
            <button class="new-attachement-button"><a href="nouvel_attachement.php?id=<?php echo $projet['id']; ?>">Nouvel attachement</a></button>
        </div>
    </div>
</body>
</html>
