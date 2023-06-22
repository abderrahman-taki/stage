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

// Récupérer les attachements liés au projet
$sql = "SELECT * FROM atachements WHERE projet_id = $projet_id";
$attachements_result = mysqli_query($conn, $sql);

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="afficher_attachement.css">
</head>
<body>
    <div class="project-details">
        <h4><?php echo $projet['nom']; ?></h4>
   
    </div>

    <div class="attachment-list">
        <?php
        if (mysqli_num_rows($attachements_result) > 0) {
            echo '<h4>Commentaire</h4>';
            while ($attachement = mysqli_fetch_assoc($attachements_result)) {
                echo '<p>' . $attachement['commentaire'] . '</p>';
            }

            echo '<h4>Liste des attachements</h4>';
            echo '<table>';
            echo '<thead>';
            echo '<tr>';
            echo '<th>N° des prix</th>';
            echo '<th>Désignation des prestations</th>';
            echo '<th>Unité</th>';
            echo '<th>Quantité PRECEDENTE</th>';
            echo '<th>Quantité ACTUELLE</th>';
            echo '<th>Quantité CUMULÉE</th>';
            echo '<th>Prix Unitaire en DH</th>';
            echo '<th>Prix Total en DH</th>';
            echo '</tr>';
            echo '</thead>';
            echo '<tbody>';
            mysqli_data_seek($attachements_result, 0); // Réinitialiser le pointeur de résultat
            while ($attachement = mysqli_fetch_assoc($attachements_result)) {
                echo '<tr>';
                echo '<td>' . $attachement['numero_prix'] . '</td>';
                echo '<td>' . $attachement['designation_prestation'] . '</td>';
                echo '<td>' . $attachement['unite'] . '</td>';
                echo '<td>' . $attachement['quantite_precedente'] . '</td>';
                echo '<td>' . $attachement['quantite_actuelle'] . '</td>';
                echo '<td>' . $attachement['quantite_cumulee'] . '</td>';
                echo '<td>' . $attachement['prix_unitaire'] . '</td>';
                echo '<td>' . $attachement['prix_total'] . '</td>';
                echo '</tr>';
            }
            echo '</tbody>';
            echo '</table>';
        } else {
            echo 'Aucun attachement trouvé.';
        }
        ?>
    </div>
    <div>
    <a href="attachement.php?id=<?php echo $projet_id; ?>">Retour</a>
    </div>
</body>
</html>
