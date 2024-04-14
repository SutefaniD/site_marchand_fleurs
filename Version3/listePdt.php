<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Catalogue</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
		<table id="catalogue">
			<tbody>

<?php
if (isset($_GET['categ']) && !empty($_GET['categ'])) {

    // Connexion
    $servname = 'localhost';
    $dbname = 'baseLafleur2';
    $user='lafleur';
    $pass='secret';

    try {
        $conn = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête
        $requete = "SELECT * FROM produit WHERE pdt_categorie = '".$_GET['categ']. "'";
        $stmt = $conn->prepare($requete);
        $stmt->execute();

        $result = $stmt->fetchAll();

        foreach ($result as $element) {
            echo "<tr>";
            echo "<td><img src='../Images/" .$element['pdt_image']. ".jpg' alt='" .$element['pdt_designation']. "'></td>";
            echo "<td>" .$element['pdt_ref']. "</td>";
            echo "<td>" .$element['pdt_designation']. "</td>";
            echo "<td>" .$element['pdt_prix']. "€</td>";
            echo "</tr>";
        }
?>   

            </tbody>
        </table>

        <form action="panier.php" target="menu" method="get">
            <select name="refPdt" size="1">
                <?php 
                // Remplissage de la liste déroulante à partir de la bdd
                foreach ($result as $element) {
                    echo "<option value='" .$element['pdt_ref']. "'>" .$element['pdt_designation']. "</option>";
                }
                ?>
            </select>
            <label for="quantite">Quantité: </label>
            <input type="text" id="quantite" name="quantite" size="5" value="1">
            <button type="submit" name="action" value="ajouter">Ajouter au panier</button>
        </form>

<?php
        $conn = null;
    } catch (PDOException $e) {
        echo "Erreur: " .$e->getMessage();
        die();
    }

} else {
    echo "Erreur";
}

?>

    </body>
</html>