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

// Traitement du formulaire de nouvel attachement
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $commentaire = $_POST['commentaire'];
    $numero_prix = $_POST['numero_prix'];
    $designation_prestation = $_POST['designation_prestation'];
    $unite = $_POST['unite'];
    $quantite_precedente = $_POST['quantite_precedente'];
    $quantite_actuelle = $_POST['quantite_actuelle'];
    $quantite_cumulee = $_POST['quantite_cumulee'];
    $prix_unitaire = $_POST['prix_unitaire'];
    $prix_total = $_POST['prix_total'];

    // Insérer les informations de l'attachement dans la base de données
    $sql = "INSERT INTO atachements (projet_id, commentaire, numero_prix, designation_prestation, unite, quantite_precedente, quantite_actuelle, quantite_cumulee, prix_unitaire, prix_total) VALUES ($projet_id, '$commentaire', $numero_prix, '$designation_prestation', '$unite', $quantite_precedente, $quantite_actuelle, $quantite_cumulee, $prix_unitaire, $prix_total)";
    if (mysqli_query($conn, $sql)) {
        echo 'Attachement enregistré avec succès.';
    } else {
        echo 'Erreur lors de l\'enregistrement de l\'attachement : ' . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="nouvel_attachement.css">
</head>
<body>
    <div class="project-details">
        <h4><?php echo $projet['nom']; ?></h4>

    </div>

    <div class="attachment-form">
        <h4>Ajouter un nouvel attachement</h4>
        <form method="post">
            <label for="commentaire">Commentaire :</label>
            <textarea name="commentaire" id="commentaire" required></textarea>

            <table>
                <thead>
                    <tr>
                        <th>N° des prix</th>
                        <th>Désignation des prestations</th>
                        <th>Unité</th>
                        <th>Quantité PRECEDENTE</th>
                        <th>Quantité ACTUELLE</th>
                        <th>Quantité CUMULÉE</th>
                        <th>Prix Unitaire en DH</th>
                        <th>Prix Total en DH</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><input type="text" name="numero_prix" required></td>
                        <td><input type="text" name="designation_prestation" required></td>
                        <td><input type="text" name="unite" required></td>
                        <td><input type="text" name="quantite_precedente" required></td>
                        <td><input type="text" name="quantite_actuelle" required></td>
                        <td><input type="text" name="quantite_cumulee" required></td>
                        <td><input type="text" name="prix_unitaire" required></td>
                        <td><input type="text" name="prix_total" required></td>
                    </tr>
                </tbody>
            </table>

            <button type="submit">Ajouter</button>
        </form>
    </div>
    <div>
    <a href="attachement.php?id=<?php echo $projet_id; ?>">Retour</a>
    </div>
</body>
</html>
