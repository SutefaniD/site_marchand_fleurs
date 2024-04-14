# site_marchand_fleurs
Projet de BTS SIO

1/ Site Web Lafleur: un catalogue de fleurs

Conception du site en respectant le cahier des charges et les photos numérisées fournies
compétences: html, css

2/ un catalogue évolutif
création d'une base de données "LaFleur" en MySql, pour répertorier l'ensemble du catalogue  (table "catégorie" et table "produit")

utilisateur: lafleur
mot de passe: secret
privilèges: select

modification du fonctionnement du site
- affichage par le script du document menu.php des libellés de catégories provenant de la base de données sous la forme d'un lien HTML
- transmission de la catégorie choisie au script listePdt.php
- affichage par le script du document listePdt.php des informations sur les produits d'une catégorie provenant de la base de données sous la forme d'un tableau html
compétences: MySql, Php

3/ Prise de commandes en ligne
modification de la structure du site (maquette) et ajout de fonctionnalités
- constitution du panier virtuel du client
- récapitulatif des articles commandés et envoi de la commande
- confirmation de commande enregistrée (à l'envoi)

travail:
représentation du panier
- déclaration et initialisation du panier
- vidage du panier et ajout au panier

travail
récapitulatif de la commande
- commande.php

travail
confirmation de la commande
- évolution de la BDD et identifiant d'une commande
- envoi et enregistrement de la commande: script envoyer.php
  * vérifier code et mdp du client
  * générer l'identifiant de la commande et créer le n-uplet de commande (date du jour)
  * générer les n-uplets de CONTENIR en utilisant les variables de session "reference" et "quantite"
  * informer le client du résultat de l'opération

compétences: php, MySql, html, css

4/ Validation du code
