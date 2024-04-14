<?php
session_start();

// Déclaration et initialisation du panier
if (!isset($_SESSION['reference'])) {
	$_SESSION['reference'] = array();
	$_SESSION['quantite'] = array();
}
//Test
//echo '<pre>';
//print_r($_SESSION['reference']);
//print_r($_SESSION['quantite']);
//echo '</pre>';


$servname = 'localhost';
$dbname = 'baseLafleur2';
$user='lafleur';
$pass='secret';

try {
    $conn = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Requête
	$requete = "SELECT * FROM categorie";
	$stmt = $conn->prepare($requete);
	$stmt->execute();

	$result = $stmt->fetchAll();

$html = <<<html
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Menu</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body class="menu">
		<h1>Sté LaFleur</h1>
		<div id="accueil">
			<p><a href="logo.html" target="page">Accueil</a></p>
			<p><a href="mailto:commercial@lafleur.com">Nous écrire</a></p> 
		</div>
		<hr>
		<div id="produits">
			<p>Nos produits</p>
			<ul>
html;

		foreach ($result as $element) {
			$html .= "<li><a href='listePdt.php?categ=" .$element['cat_code']. "' target='page'>" .$element['cat_libelle'] . "</a></li>";
		}
			

    
    // Fermeture de la connexion à la base
    $conn = null;

} catch (PDOException $e) {
    echo "Erreur: " .$e->getMessage();
    die();
}

$html .= <<<html
			</ul>
		</div>
		<hr>
		<div id="form-vider">
			<form action="panier.php" target="menu" method="get">
				<button type="submit" name="action" value="vider">Vider le panier</button>
			</form>
		</div>
		<div id="bouton-commander">
			<form action="commande.php" target="page" method="get">
				<button type="submit" value="commander">Commander</button>
			</form>
		</div>
	</body>
</html>
html;
echo $html;