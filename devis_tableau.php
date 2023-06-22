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

    // Récupérer les devis associés au projet à partir de la base de données
    $sql = "SELECT * FROM quotes WHERE projet_id = $projet_id";
    $result = mysqli_query($conn, $sql);
} else {
    echo 'ID du projet non spécifié.';
    exit();
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="devis_tableau.css">
</head>
<body>
    <h2>Tableau des devis</h2>
    <table>
        <tr>
            <th>N° des prix</th>
            <th>Désignation des prestations</th>
            <th>Unité de mesure</th>
            <th>Quantité</th>
            <th>Prix Unitaire en DH</th>
            <th>Prix Total en DH</th>
        </tr>
        <?php
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo '<tr>';
                echo '<td>' . $row['numero_prix'] . '</td>';
                echo '<td>' . $row['designation'] . '</td>';
                echo '<td>' . $row['unite_mesure'] . '</td>';
                echo '<td>' . $row['quantite'] . '</td>';
                echo '<td>' . $row['prix_unitaire'] . '</td>';
                echo '<td>' . $row['prix_total'] . '</td>';
                echo '</tr>';
            }
        } else {
            echo '<tr><td colspan="6">Aucun devis trouvé.</td></tr>';
        }
        ?>
    </table>

    <a href="nouveau_devis.php?id=<?php echo $projet_id; ?>">Ajouter un nouveau devis</a>
    <a href="devis.php?id=<?php echo $projet_id; ?>">Retour</a>
</body>
</html>
