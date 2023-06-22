<?php
session_start();
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

if (isset($_POST['supprimer'])) {
    $nomProjet = $_POST['nom_projet'];

    // Supprimer le projet de la base de données
    $sql = "DELETE FROM pojets WHERE nom = '$nomProjet'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $_SESSION['message'] = "Le projet a été supprimé avec succès.";
    } else {
        $_SESSION['message'] = "Une erreur s'est produite lors de la suppression du projet.";
    }
}

mysqli_close($conn);
header("Location: projet.php"); // Rediriger vers le tableau de bord ou une autre page appropriée
exit();
