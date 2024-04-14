<?php
session_start();

// S'assurer que le panier n'est pas vide
if (isset($_SESSION['reference']) && count($_SESSION['reference']) > 0) {
    $servname = 'localhost';
    $dbname = 'baseLafleur2';
    $user='lafleur';
    $pass='secret';

    try {
        $conn = new PDO("mysql:host=$servname;dbname=$dbname", $user, $pass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $totalPrix = 0;
?>    

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Commande</title>
		<link href="../style.css" rel="stylesheet" type="text/css">
	</head>
	<body>
        <h2>Récapitulatif des articles commandés</h2>
		<table id="recap">
			<thead>
                <tr>
                    <th>Ref</th>
                    <th>Désignation</th>
                    <th>Px Unit.</th>
                    <th>Qté</th>
                    <th>Montant</th>
                </tr>
			</thead>
			<tbody>

<?php
        foreach ($_SESSION['reference'] as $index=>$reference) {
            
            $requete = "SELECT pdt_designation, pdt_prix FROM produit WHERE pdt_ref= :ref";
            $stmt = $conn->prepare($requete);
            $stmt->bindValue(':ref', $reference);
            $stmt->execute();

            $result = $stmt->fetch();

            $designation = $result['pdt_designation'];
            $prix = $result['pdt_prix'];

            $quantite = $_SESSION['quantite'][$index];
            $subtotal = $quantite * $prix;
            $totalPrix += $subtotal;

            echo "<tr>";
            echo "<td>" .$reference. "</td>";
            echo "<td>" .$designation. "</td>";
            echo "<td>" .$prix. "</td>";
            echo "<td>" .$quantite. "</td>";
            echo "<td>" .$subtotal. " €</td>";
            echo "</tr>";

            
        }
        $conn = null;

    } catch (PDOException $e) {
        echo "Erreur : " .$e->getMessage();
        die();
    }
} else {
    echo "<p>Panier vide</p>";
    $totalPrix = 0;
}

?>
            </tbody>
            <tfoot>
                <tr>
                   <td colspan="4">Total</td>
                   <td><?php echo isset($totalPrix) ? $totalPrix . ' €' : '' ?></td>
                </tr> 
            </tfoot>
        </table>
        
        <form action="envoyer.php" method="get">
            <label for="code_client">Code client</label>
            <input id="code_client" type="text" name="code_client" required>

            <label for="mdp_client">Mot de passe</label>
            <input type="password" id="mdp_client" name="mdp_client" required>

            <button type="submit">Envoyer la commande</button>
        </form>
    </body>
</html>