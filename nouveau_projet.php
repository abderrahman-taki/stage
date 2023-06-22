<?php
session_start();
define('LOCALHOST', 'localhost');
define('ROOT', 'root');
define('PASSWORD', '');
define('DATABASE', 'login_db');
define('SITEURL', 'http://localhost/php.account/');

$conn = mysqli_connect(LOCALHOST, ROOT, PASSWORD, DATABASE) or die(mysqli_error($conn));
$db_select = mysqli_select_db($conn, DATABASE) or die(mysqli_error($conn));

if (isset($_POST['create_projet'])) {
    // Récupérer les données du formulaire
    $nom_projet = $_POST['nom_projet'];

    // Valider et insérer les données dans la base de données
    if (!empty($nom_projet)) {
        $sql = "INSERT INTO pojets (nom) VALUES ('$nom_projet')";
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "Le projet a été créé avec succès.";
        } else {
            echo "Erreur lors de la création du projet : " . mysqli_error($conn);
        }
    } else {
        echo "Veuillez entrer le nom du projet.";
    }
}

mysqli_close($conn);
?>


<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="nouveau_projet.css">
</head>
<body>
    <div class="dashboard">
        <div class="dash">
            <h4>Créer un nouveau projet</h4>
            <form method="post" action="nouveau_projet.php">
                <input type="text" name="nom_projet" placeholder="Nom du projet">
                <button class="create-project-button" name="create_projet">Créer</button>
            </form>
        </div>
        <div>
            <a href="projet.php">retour</a>
        </div>
    </div>
</body>
</html>
