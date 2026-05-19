<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id']??'';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);



$requete9 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur 
FROM commande WHERE id_utilisateur =:idutil AND statut ='acceptee' ORDER BY date_commande DESC LIMIT 50");
$requete9->bindvalue(':idutil', $user_id);
$requete9->execute();
$commandesrecuperees = $requete9->fetchAll();

?>

<?php
require 'header.php';
?>
<div class="conteneur1">

<H1 class="epeutilisateur">ESPACE UTILISATEUR</H1>;


<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="esputicompte.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="esputicommandes.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES COMMANDES</a></li>
    <li><a href="esputisuivi.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">LE SUIVI DES COMMANDES ACCEPTEES</a></li>
    </ul>
</div>


<table  class=tablecommande cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>NUMERO DE COMMANDE</th>
            <th>MENU</th>
            <th>NOMBRE DE PERSONNES</th>
            <th>PRIX DU MENU</th>
            <th>ADRESSE DE LIVRAISON</th>
            <th>DATE DE LIVRAISON</th>
            <th>HEURE DE LIVRAISON </th>
            <th>STATUT</th>
            

        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandesrecuperees as $commandesrecuperee): ?>
        <tr>
            <td><?= htmlspecialchars($commandesrecuperee->numero_commande) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->menu) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->nombre_personne) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->prix_menu) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->adresse_livraison) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->date_livraison) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->heure_livraison) ?></td>
            <td><?= htmlspecialchars($commandesrecuperee->statut) ?></td>
            
            
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>




<?php                
 require 'footer.php';
?>