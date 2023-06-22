<?php
session_start();
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

// Vérifiez si le bouton "projet" est cliqué
if (isset($_POST['projet'])) {
    // Récupérer tous les projets existants depuis la base de données
    $sql = "SELECT * FROM pojets";
    $result = mysqli_query($conn, $sql);

    // Vérifier s'il y a des projets existants
    if (mysqli_num_rows($result) > 0) {
        echo '<h4>Liste des projets :</h4>';
        echo '<ul>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<li><a href="projet_detail.php?id=' . $row['id'] . '">' . $row['nom'] . '</a></li>';
        }
        echo '</ul>';
    } else {
        echo 'Aucun projet trouvé.';
    }
}

// Vérifiez si le formulaire de suppression est soumis
if (isset($_POST['supprimer'])) {
    $nomProjet = $_POST['nom_projet'];

    // Supprimer le projet de la base de données
    $sql = "DELETE FROM pojets WHERE nom = '$nomProjet'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Le projet a été supprimé avec succès.";
    } else {
        echo "Une erreur s'est produite lors de la suppression du projet.";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="projet.css">
</head>
<body>
    <div class="dashboard">
        <span>
            <?php
            if (isset($_SESSION['loginMessage'])) {
                echo $_SESSION['loginMessage'];
                unset($_SESSION['loginMessage']);
            }
            ?>
        </span>
        <div class="dash">
            <h4>Dashboard</h4>
            <form method="post">
                <button class="project-button" name="projet">Projets</button>
            </form>
            <form method="post" action="supprimer_projet.php">
                <label for="nom_projet">Nom du projet à supprimer :</label>
                <input type="text" name="nom_projet" id="nom_projet">
                <button type="submit" name="supprimer">Supprimer le projet</button>
            </form>
            <button class="create-project-button"><a href="nouveau_projet.php">Créer un nouveau projet</a></button>
        </div>
    </div>
</body>
</html>
