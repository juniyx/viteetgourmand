<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];

$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

$requete16 = $pdo->prepare("SELECT numero_commande, menu, nombre_personne, adresse_livraison, date_livraison, heure_livraison, prix_menu, date_commande, prix_livraison, statut, id_utilisateur 
FROM commande  ORDER BY date_commande DESC LIMIT 50");
$requete16->execute();
$commandes = $requete16->fetchAll();
?>





<?php
require 'header.php';
?>

<div class="conteneur1">

<H1 class="epeemploye">ESPACE EMPLOYE</H1>


<div class="navbarresecond">
    <ul class="navsecond">
    <li><a href="employecompte.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">INFORMATIONS COMPTE</a></li>
    <li><a href="employemenus.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION DES MENUS</a></li>
    <li><a href="employecommande.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">GESTION ET VALIDATION DES COMMANDES </a></li>
    <li><a href="employecomclients.php?id=<?=$user_id?>" style="text-decoration:none" class="liensecond">TRAITEMENT DES COMMENTAIRES CLIENTS </a></li>
    </ul>
</div>

<h4 class="pstcommande">GESTION DES COMMANDES</h4>

<table  class="tablecommande" cellpadding="10" cellspacing="0">
                <thead class="entetetableau">
                    <tr>
                        <th>NUMERO COMMANDE</th>
                        <th>ID UTILISATEUR</th>
                        <th>MENU</th>
                        <th>DATE COMMANDE</th>
                        <th>STATUT</th>
                        <th>NOMBRE DE PERSONNES</th>
                        <th>PRIX DU MENU</th>
                        <th>ADRESSE DE LIVRAISON</th>
                        <th>DATE DE LIVRAISON</th>
                        <th>MODIFIER</th>
                        <th>SUPPRIMER</th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($commandes as $commande): ?>
                    <tr>
                        <td><?= htmlspecialchars($commande->numero_commande) ?></td>
                        <td><?= htmlspecialchars($commande->id_utilisateur) ?></td>
                        <td><?= htmlspecialchars($commande->menu) ?></td>
                        <td><?= htmlspecialchars($commande->date_commande) ?></td>
                        <td><?= htmlspecialchars($commande->statut) ?></td>
                        <td><?= htmlspecialchars($commande->nombre_personne) ?></td>
                        <td><?= htmlspecialchars($commande->prix_menu) ?></td>
                        <td><?= htmlspecialchars($commande->adresse_livraison) ?></td>
                        <td><?= htmlspecialchars($commande->date_livraison) ?></td>
                        <td><a href="employecommandemodifier.php?id=<?=$user_id?>&idcommande=<?=$commande->numero_commande?>" class="btn btn-warning" >Modifier</a></td>
                        <td><a href="employecommandesupprimer.php?id=<?=$user_id?>&idcommande=<?=$commande->numero_commande?>" class="btn btn-danger"  onclick="return confirm('Confirmer suppression ?')">Supprimer</a> </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>





            








<?php                
 require 'footer.php';
?>