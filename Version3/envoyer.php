<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET["code_client"]) && isset($_GET["mdp_client"])) {

    // Récupération et validation des données du formulaire
    $codeClient = trim(htmlspecialchars($_GET["code_client"], ENT_QUOTES, 'UTF-8'));
    $mdpClient = $_GET["mdp_client"];

    // Connexion à la bdd baseLafleur2
    $host = 'localhost';
    $dbname = 'baseLafleur2';
    $username = 'lafleur';
    $password = 'secret';

    try {
        $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Requête préparée pour vérification code et mdp
        $requete = "SELECT clt_code, clt_motPasse FROM clientconnu WHERE clt_code = :clt_code";
        $stmt = $conn->prepare($requete);
        $stmt->bindValue(':clt_code', $codeClient);
        $stmt->execute();

        $user = $stmt->fetch();
        if ($user && $mdpClient === $user['clt_motPasse']) {

            // Vérification réussie
            $timestamp = time();
            $date = date("Y-m-d");

            // Création de l'identifiant de la commande
            $commandeId = $codeClient . "/" .$timestamp;

            // Insertion des données dans la table COMMANDE
            $req = "INSERT INTO commande (cde_moment, cde_client, cde_date) VALUES (:cde_moment, :cde_client, :cde_date)";
            $stmt = $conn->prepare($req);
            $stmt->bindValue(':cde_moment', $timestamp);
            $stmt->bindValue(':cde_client', $codeClient);
            $stmt->bindValue(':cde_date', $date);
            $stmt->execute();

            // Insertion des données dans la table CONTENIR
            foreach ($_SESSION['reference'] as $index => $reference) {
                $quantite = $_SESSION['quantite'][$index];              
                $req = "INSERT INTO contenir (cde_moment, cde_client, produit, quantite) VALUES (:cde_moment, :cde_client, :produit, :quantite)";
                $stmt = $conn->prepare($req);
                $stmt->bindValue(':cde_moment', $timestamp);
                $stmt->bindValue(':cde_client', $codeClient);
                $stmt->bindValue(':produit', $reference);
                $stmt->bindValue(':quantite', $quantite);
                $stmt->execute();

            }

            echo "<pre>
            ===================================================================================
            Votre commande a bien été enregistrée sous la référence " .$commandeId. "
            ===================================================================================
            </pre";


        
        } else {

            // Echec de la vérification:
                echo "Client inconnu";
        }

        $conn = null;

    } catch (PDOException $e) {
        echo "Erreur: " .$e->getMessage();
        die();
    }

} else {
    echo "Accès refusé";
}
?>