<?php
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'vider') {
    // Vider le panier
    $_SESSION['reference'] = array();
    $_SESSION['quantite'] = array();

    // Rediriger vers menu.php
    header('Location: menu.php');
    exit();
}

// Ajout au panier
if (isset($_GET['action']) && $_GET['action'] === 'ajouter') {
    if (isset($_GET['refPdt']) && isset($_GET['quantite'])) {
        $refPdt = $_GET['refPdt'];
        $quantite = $_GET['quantite'];

        // Compter le nombre d'éléments du panier
        $i = count($_SESSION['reference']);

        // Vérifier si le nouvel élément existe déjà dans le panier
        $found = false;
        for ($j = 0; $j < $i; $j++) {
            if ($_SESSION['reference'][$j] === $refPdt) {
                // Si l'élément existe, ajouter la quantité à la référence déjà présente
                $_SESSION['quantite'][$j] += $quantite;
                $found = true;
                break;
            }
        }

        if (!$found) {
            // Si l'élément n'existe pas, ajouter le nouvel élément au panier
            $_SESSION['reference'][$i] = $refPdt;
            $_SESSION['quantite'][$i] = $quantite;
        }

        // Rediriger vers menu.php
        header('Location: menu.php');
        exit();
    }
}

?>