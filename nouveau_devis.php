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

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les valeurs du formulaire
        $numero = $_POST['numero'];
        $designation = $_POST['designation'];
        $unite_mesure = $_POST['unite_mesure'];
        $quantite = $_POST['quantite'];
        $prix_unitaire = $_POST['prix_unitaire'];
        $prix_total = $_POST['prix_total'];

        // Insérer les données dans la base de données
        $sql = "INSERT INTO quotes (projet_id, numero_prix, designation, unite_mesure, quantite, prix_unitaire, prix_total) 
                VALUES ('$projet_id', '$numero', '$designation', '$unite_mesure', '$quantite', '$prix_unitaire', '$prix_total')";
        if(mysqli_query($conn, $sql)) {
            // Redirection vers la page du tableau de devis
            header("Location: devis_tableau.php?id=$projet_id");
            exit();
        } else {
            echo "Erreur lors de l'insertion du devis : " . mysqli_error($conn);
        }
    }
} else {
    echo 'ID du projet non spécifié.';
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="nouveau_devis.css">
</head>
<body>
    <h2>Ajouter une nouvelle ligne de devis</h2>
    <form method="POST" action="nouveau_devis.php?id=<?php echo $projet_id; ?>">
        <label for="numero">N˚ des prix:</label>
        <input type="text" name="numero" required><br>
        
        <label for="designation">Désignation des prestations:</label>
        <input type="text" name="designation" required><br>
        
        <label for="unite_mesure">Unité de mesure:</label>
        <input type="text" name="unite_mesure" required><br>
        
        <label for="quantite">Quantité:</label>
        <input type="text" name="quantite" required><br>
        
        <label for="prix_unitaire">Prix Unitaire en DH:</label>
        <input type="text" name="prix_unitaire" required><br>
        
        <label for="prix_total">Prix Total en DH:</label>
        <input type="text" name="prix_total" required><br>
        
        <button type="submit">Valider</button>
    </form>

    <form method="POST" action="nouveau_devis.php?id=<?php echo $projet_id; ?>">
        <input type="hidden" name="add_another" value="true">
        <button type="submit">Ajouter une autre ligne</button>
    </form>

    <a href="devis.php?id=<?php echo $projet_id; ?>">Retour</a>
</body>            
</html>
