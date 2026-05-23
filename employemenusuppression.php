<?php
session_start();
?>

<?php
$host = 'localhost';
$dbname = 'vitegourmand';
$username = 'root';
$password = '';


$user_id = $_SESSION['utilisateur_id'];
$idmenu = $_GET['idmenu'] ?? '';

    
$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);


$requete13= $pdo->prepare("DELETE FROM menu WHERE menu_id =:idmenu");
$requete13->bindvalue(':idmenu', $idmenu);
$requete13->execute();

header("Location: employemenus.php?id=$user_id");
exit();

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

<h4 class="pstcommande">LES MENUS EN VENTE SUR LE SITE</h4>

<table  class="tablecommande" cellpadding="10" cellspacing="0">
    <thead>
        <tr>
            <th>MENU IDENTIFIANT</th>
            <th>TITRE</th>
            <th>PRESENTATION</th>
            <th>PRIX PAR PERSONNE</th>
            <th>NOMBRE DE PERSONNE MINIMUM</th>
            <th>DESCRIPTION</th>
            <th>MODIFIER</th>
            <th>SUPPRIMER</th>

        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): ?>
        <tr>
            <td><?= htmlspecialchars($menu->menu_id) ?></td>
            <td><?= htmlspecialchars($menu->titre) ?></td>
            <td><?= htmlspecialchars($menu->presentation) ?></td>
            <td><?= htmlspecialchars($menu->prix_parpersonne) ?></td>
            <td><?= htmlspecialchars($menu->nombre_personne_minimum) ?></td>
            <td><?= htmlspecialchars($menu->description) ?></td>
            <td><a href="" class="btn btn-warning" >Modifier</a></td>
            <td><a href="" class="btn btn-danger"  onclick="return confirm('Confirmer suppression ?')">Supprimer</a> </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>



<?php                
 require 'footer.php';
?>